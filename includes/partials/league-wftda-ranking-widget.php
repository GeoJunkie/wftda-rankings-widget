<?php

/**
 * Display of the widget
 *
 * This file is used to markup the user-facing aspects of the widget.
 *
 * @link       http://bit.ly/Stray_Taco
 * @since      1.0.0
 *
 * @package    League_Wftda_Ranking
 * @subpackage League_Wftda_Ranking/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="lwr-stats">
	<div class="lwr-league">
		<div class="lwr-widget-image">
			<a href="<?php echo $url ?>"><img class="league_wftda-logo" src="<?php echo get_option('lwr_site_url') . $league_data['logo'] ?>" /></a>
		</div>
		<div class="lwr-league-name-location">
			<div class="lwr-league-name"><?php echo $league_data['league'] ?></div>
			<div class="lwr-location"><?php echo $league_data['location'] ?></div>
		</div>
	</div>
	<div class="lwr-all-stats">
		<div class="lwr-statistics">
			<span class="lwr-gpa">GPA: <?php echo $league_data['game_point_average'] ?></span>
			<span class="lwr-strength-factor">SF: <?php echo $league_data['strength_factor'] ?></span>
			<div class="lwr-info-button">i</button>
			</div>
		</div>
		<div class="lwr-world-ranking"><?php echo $league_data['world_ranking'] ?></div>
		<div class="lwr-regional-ranking"><?php echo $league_data['regional_ranking'] ?></div>
		<div class="lwr-win-losses">
			<?php
			foreach ($league_data['win_loss_info'] as $game_result) { ?>

				<span class="lwr-win-loss lwr-win-loss-<?php echo $game_result ?>"><?php echo $game_result ?></span>
			<?php } ?>
		</div>
	</div>
	<div class="league-wfda-stats-link">
		<a href="<?php echo $url ?>">View full stats</a>
	</div>
	<div class="lwr-last-update lwr-hidden">
		<?php echo date('D, d M Y H:i:s', $league_data['last_update']); ?>
	</div>
</div>
<div class="lwr-overlay lwr-hidden"></div>
<div class="lwr-popup lwr-hidden">
	<div class="lwr-popup-content"> 
		<img class="lwr-popup-close" src="<?php echo plugin_dir_url(__DIR__); ?>img/close.svg" />
		<?php echo get_option('lwr_gpa_sf_explanation') ?>
	</div>
</div>