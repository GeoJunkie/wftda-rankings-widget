<?php

/**
 * The Ranking Widget.
 *
 * Implements the widget to display
 *
 * @link       http://bit.ly/Stray_Taco
 * @since      1.0.0
 *
 * @package    League_Wftda_Ranking
 * @subpackage League_Wftda_Ranking/public
 */

class League_Wftda_Ranking_Widget extends WP_Widget {

  /**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'league_wftda_ranking', // Base ID
			esc_html__( 'League WFTDA Ranking', 'text_domain' ), // Name
			array(
				'description' => esc_html__( 'Display league ranking in the WFTDA', 'league-wftda-ranking' ),
			) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		$league = new League_Wftda_Ranking_League($instance['league']);
		$league_data = $league->get_league_data();

		// TODO: Allow settings to activate/deactivate these
		$url = get_option('wrw_leagues_url') . $league_data['slug'];

		include('partials/league-wftda-ranking-widget.php');

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
		$league = ! empty( $instance['league'] ) ? $instance['league'] : esc_html__( 'league-slug', 'text_domain');
		require plugin_dir_path( dirname( __FILE__ ) ) . 'widgets/partials/league-wftda-ranking-form.php';
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['league'] = ( ! empty( $new_instance['league'] ) ) ? sanitize_text_field( $new_instance['league'] ) : '';

		return $instance;
	}
}
