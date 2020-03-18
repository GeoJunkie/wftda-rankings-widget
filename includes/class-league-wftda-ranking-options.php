<?php

/**
 * Options API.
 *
 * Manages the plugin's options
 *
 * @package    League_Wftda_Ranking
 * @subpackage League_Wftda_Ranking/public

 * @link  http://bit.ly/Stray_Taco
 * @since 1.0.0
 */

class League_Wftda_Ranking_Options
{

  /** 
   * The Options and settings for this plugin
   */
  protected const OPTION_GROUP = 'leage_wftda_ranking';

  /**
   * This is an array of args for register_setting
   * The key is the option_name and then there's an array of args
   */
  protected const SETTINGS = array(
    //'leagues' => '',        // An array of the stored leagues (see $league_info)
    'refresh_hours' => array(
      'type' => 'number',
      'description' => 'Number of hours before retrieving updated league information',
      'sanitize_callback' => 'absint',
      'show_in_rest' => true,
      'default' => 24
    ),
    'gpa_sf_explanation' => array(
      'type' => 'string',
      'description' => 'Explanation of GPA and SF from stats.wftda.com (refreshes with league info)',
      'sanitize_callback' => 'sanitize_text_field',
      'show_in_rest' => true,
      'default' => ''
    ),
    'site_url' => array(
      'type' => 'string',
      'description' => 'Root URL for the WFTDA Stats Site',
      'sanitize_callback' => 'sanitize_url',
      'show_in_rest' => true,
      'default' => 'https://stats.wftda.com'
    ),
    'leagues_url' => array(
      'type' => 'string',
      'description' => 'Base URL for WFTDA leagues',
      'sanitize_callback' => 'sanitize_url',
      'show_in_rest' => true,
      'default' => 'https://stats.wftda.com/league/'
    ),
    'delete_on_uninstall' => array(
      'type' => 'boolean',
      'description' => 'If true, all options will be erased on uninstall',
      'sanitize_callback' => 'rest_sanitize_boolean',
      'show_in_rest' => true,
      'default' => false
    )
  );

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
      'leagues' => '',        // An array of the stored leagues (see $league_info)
      'refresh_hours' => 24,  // Number of hours before retrieving updated league information
      'gpa_sf_explanation' => '',  // Explanation of GPA and SF from stats.wftda.com (refreshes with league info)
      'site_url' => 'https://stats.wftda.com', // Root URL for the WFTDA Stats Site
      'leagues_url' => 'https://stats.wftda.com/league/', // Base URL for WFTDA leagues
      'delete_on_uninstall' => false // If true, all options will be erased on uninstall
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
      if (!$current_options[$option]) {
        $current_options[$option] = $default;
        add_option($option, $default);
      }
    }
    $this->options = $current_options;
    return $current_options;
  }

  /**
   * Initialize Settings.
   *
   * Registers settings for use in Settings API. Called on `admin_init`
   *
   * @since 1.0.0
   */
  public function init_settings() 
  {
    foreach (self::SETTINGS as $option_name => $args){
      // TODO:YOU ARE HERE
      // Loop through the options and call register_setting
    }
  }

  /**
   * Delete options from the database
   * 
   * Used on uninstall to clean up the database
   * 
   * @since 1.0.0
   * 
   * @return boolean Whether the cleanup was successful
   */
  public function delete()
  {
    $success = true;
    foreach ($this->options_list as $option) {
      if (!delete_option($option)) {
        $success = false;
      }
    }
    return $success;
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
  public function get_league_info($slug)
  {
    if (in_array($slug, $this->options)) {

      foreach ($this->options['leagues'] as $this_league => $league) {
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
  public function set_league_info($info)
  {
    if (!is_array($this->options['leagues'])) {
      $this->options['leagues'] = [];
    }
    $this->options['leagues'][$info['slug']] = $info;
    update_option('leagues', $info);
  }

  /**
   * Get GPA/SF explanation.
   *
   * Returns the Game Point Average and Strength Factor explanation information
   *
   * @since 1.0.0
   *
   * @return string The HTML for the help info
   */
  public function get_gpa_sf_explanation()
  {
    return $this->options['gpa_sf_explanation'];
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
  public function set_gpa_sf_explanation($gpa_sf_explanation)
  {
    if (
      !array_key_exists('gpa_sf_explanation', $this->options)
      || $this->options['gpa_sf_explanation'] != $gpa_sf_explanation
    ) {
      $this->options['gpa_sf_explanation'] = $gpa_sf_explanation;
      update_option('gpa_sf_explanation', $gpa_sf_explanation);
    }
  }
}
