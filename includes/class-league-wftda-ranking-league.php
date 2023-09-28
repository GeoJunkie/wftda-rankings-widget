<?php

/**
 * League information.
 *
 * Retrieve league information. The data will be retrieved from the database if it is newer than the refresh threshold. Otherwise, it will retrieve it from stats.wftda.com
 *
 * @link       http://bit.ly/Stray_Taco
 * @since      1.0.0
 *
 * @package    League_Wftda_Ranking
 * @subpackage League_Wftda_Ranking/public
 */

class League_Wftda_Ranking_League {

  /**
   * League slug.
   *
   * @since 1.0.0
   * @var string $slug The slug of the league this instance pertains to (https://stats.wftda.com/team/{slug}).
   */
  public $slug;

  /**
   * League stats.
   *
   * @since 1.0.0
   * @access protected
   * @var array league Hold all the league's current information (Obtained from https://stats.wftda.com/team/{slug}).
   */
  protected $league_data;

  // Structure:
  // 'slug',               // League slug on stats.wftda.com
  // 'name',               // League name
  // 'logo',               // URL of the league's logo
  // 'game_point_average', // League GPA
  // 'strength_factor',    // League Strength Factor
  // 'world_ranking',      // League's worldwide ranking
  // 'region',             // Region the league is in
  // 'regional_ranking',   // League's rank within their region
  // 'wins_and_losses',    // Array of last 5 sanctioned game results ('w' or 'l')
  // 'last_update'         // Date/time stamp of most recent update from stats.wftda.com

  /**
   * GPA and Strength Factor Explanation.
   *
   * @since 1.0.0
   * @access protected
   * @var string $gpa_sf_explanation  Explanation of the GPA and SF (comes from the stats site, so we collect it here when there's a league update)
   */
  protected $gpa_sf_explanation;


  /**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    league       The slug of the league this instance pertains to (https://stats.wftda.com/team/{slug}).
	 */
	public function __construct( $league ) {
    $this->slug = $league;
    $this->load();
	}

  // TODO
  // One array to rule them all
  // Gets for each piece of info
  // Refresh to refresh now (IAW timer or a force refresh)

  /**
   * Refresh league data.
   *
   * Retrieves the league's data from stats.wftda.com
   *
   * @since 1.0.0
   *
   * @return array League Data
   */
    public function refresh() {
      $this->league_data['slug'] = $this->slug;

      $stats_site = LEAGUE_WFTDA_SITE_URL;
      $url = LEAGUE_WFTDA_LEAGUES_URL . $this->slug;

      $response = wp_remote_get($url);

      $body = wp_remote_retrieve_body($response);

      $dom = new domDocument;

      // set error level to prevent DOMDoc known warnings
      $internalErrors = libxml_use_internal_errors(true);

      $dom->loadHTML($body);

      // Restore error level
      libxml_use_internal_errors($internalErrors);


      $dom->preserveWhiteSpace = false;
      $xpath = new DOMXPath($dom);
      $stats = array();

      $logo_node = $xpath->query("//*[@class='leagueMain--image']");

      if ($logo_node->length == 0) {
          return "Logo Not Found";
      }

      $this->league_data['logo'] = $logo_node->item(0)->attributes->getNamedItem("src")->nodeValue;

      $league_name_node = $xpath->query("//*[@class='leagueMainStatsInner']/h1");

      if ($league_name_node->length == 0) {
          return "League Name Not Found";
      }

      $this->league_data['league'] = $league_name_node->item(0)->nodeValue;

      $league_location_node = $xpath->query("//*[@class='leagueMainStats--location']");
      $this->league_data['location'] = $league_location_node->item(0)->nodeValue;

      $stats_nodes = $xpath->query("//*[@class='leagueMainStats--rankingStats rankingsStats']/*");

      if ($stats_nodes->length == 0) {
          return "Stats Not Found";
      }

      // GPA is first stat, SF is second, then info button and explanation

      $this->league_data['game_point_average'] = $stats_nodes->item(0)->nodeValue;
      $this->league_data['strength_factor'] = $stats_nodes->item(1)->nodeValue;
      $this->gpa_sf_explanation = $dom->saveHTML($stats_nodes->item(3));

      $rank_nodes = $xpath->query("//*[@class='leagueMainStats--rank rankText']");

      // World ranking listed first, Regional is second

      if ($rank_nodes->length != 2) {
          return "Rankings Not Found";
      }

      $this->league_data['world_ranking'] = $rank_nodes->item(0)->nodeValue;
      $this->league_data['regional_ranking'] = $rank_nodes->item(1)->nodeValue;

      // For win/loss we'll be allowing for an option to choose how many to show (up to 5 since that's what the stats page shows)

      $win_loss_nodes = $xpath->query("//*[@class='formCircles leagueMainStats--formCircles']/span");

      if ($win_loss_nodes->length == 0) {
          return "Win/Loss info not found";
      }

      $this->league_data['win_loss_info'] = array();
      foreach ($win_loss_nodes as $node) {
          $this->league_data['win_loss_info'][] = $node->nodeValue;
      }

      $this->save();

    }

       /**
    * Get League Data.
    *
    * Returns the league's data
    *
    * @since 1.0.0
    *
    * @return array League data.
    */
    public function get_league_data()
    {
      return $this->league_data;
    }

   /**
    * Load League Data.
    *
    * Loads the league's data. If the data is not in the database or has not been refreshed in less than 'lwr_refresh_hours' hours, it will read the updated information from stats.wftda.com
    *
    * @since 1.0.0
    *
    * @return array League data.
    */
  protected function load() {
    $options = new League_Wftda_Ranking_Options;
    $this->league_data = $options->get_league_info($this->slug);
    if ($this->league_data) {
      $hours_since_update = (time() - $this->league_data['last_update']) / 3600;
      
      if ($hours_since_update > get_option( 'lwr_refresh_hours')) {
        $this->refresh();
      }
    } else {
      $this->refresh();
    }
    return $this->league_data;
  }

  /**
   * Save League Data.
   *
   * Saves the league data to the options table.
   *
   * @since 1.0.0
   */
  protected function save(){
    $this->league_data['last_update'] = time();
    $options = new League_Wftda_Ranking_Options;
    $options->set_league_info($this->league_data);
    // While we're here, update the gpa_sf_explanation if it changed
    $options->set_gpa_sf_explanation($this->gpa_sf_explanation);
  }

}
