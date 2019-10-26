<?php

/**
 * Options API.
 *
 * Manages the plugin's options
 *
 * @link       http://bit.ly/Stray_Taco
 * @since      1.0.0
 *
 * @package    League_Wftda_Ranking
 * @subpackage League_Wftda_Ranking/public
 */

class League_Wftda_Ranking_Options
{

  /**
   * Current Set Options.
   *
   * @since 1.0.0
   * @access protected
   * @var array $options
   */
    protected $options;

    /**
     * Options list.
     *
     * @since 1.0.0
     * @access protected
     * @var array $options_list List of all plugin options.
     */
    protected $options_list;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        $this->options_list = array(
      'wrw_leagues' => '',        // An array of the stored leagues (see $league_info)
      'wrw_refresh_hours' => 24,  // Number of hours before retrieving updated league information
      'gpa_sf_explanation' => '',  // Explanation of GPA and SF from stats.wftda.com (refreshes with league info)
      'wrw_site_url' => 'https://stats.wftda.com', // Root URL for the WFTDA Stats Site
      'wrw_leagues_url' => 'https://stats.wftda.com/league/' // Base URL for WFTDA leagues
    );


        foreach ($this->options_list as $option => $default) {
            $this->options[$option] = get_option($option, $default);
        }
    }


    /**
     * Initialize options.
     *
     * Checks for options in the database and creates them if they don't exist.
     *
     * @since 1.0.0
     *
     * @return array The current options list.
     */
    public function initialize()
    {
        $current_options = array();
        foreach ($this->options_list as $option => $default) {
            $current_options[$option] = get_option($option);
            if (! $current_options[$option]) {
                $current_options[$option] = $default;
                add_option($option, $default);
            }
        }
        $this->options = $current_options;
        return $current_options;
    }

    /**
     * Stored league info.
     *
     * Returns an array of the requested league stats (false if league is not stored).
     *
     * @since 1.0.0
     *
     * @param string $slug The league slug to retrieve.
     * @return array league_info array.
     */
    public function get_league_info($slug) {
      if (in_array($slug, $this->options)){
      	
        foreach ($this->options['wrw_leagues'] as $this_league => $league) {
          if ($this_league == $slug) {
            return $league;
          }
          // If we reached here, the slug's not here (in case the slug pased matched something else)
          return false;
        }
      } else {
        return false;
      }
    }

    /**
     * Save league info.
     *
     * Saves the league info to the options table
     *
     * @since 1.0.0
     *
     * @param array info The league information array.
    */
    public function set_league_info($info) {
      if (!is_array($this->options['wrw_leagues'])){
        $this->options['wrw_leagues'] = [];
      }
      $this->options['wrw_leagues'][$info['slug']] = $info;
      update_option( 'wrw_leagues', $info );
    }

    /**
     * Save GPA/SF explanation.
     *
     * Saves the Game Point Average and Strength Factor explanation information (if it's changed)
     *
     * @since 1.0.0
     *
     * @param string $gpa_sf_explanation The text from the site.
     */
    public function set_gpa_sf_explanation($gpa_sf_explanation) {
      if ($this->options['gpa_sf_explanation'] != $gpa_sf_explanation) {
        $this->options['gpa_sf_explanation'] = $gpa_sf_explanation;
        update_option('gpa_sf_explanation', $gpa_sf_explanation);
      }
    }
}
