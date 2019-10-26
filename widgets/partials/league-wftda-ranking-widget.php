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
 * @subpackage League_Wftda_Ranking/widgets/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<p class="league-wfdta-name"><?php echo $league_data['league'] ?></p>
<a href="<?php $url ?>"><img class="league_wftda-logo" src="<?php echo get_option('wrw_site_url') . $league_data['logo'] ?>"/></a>
<div class="league-wftda-gpa"><strong>GPA:</strong> <?php echo $league_data['game_point_average'] ?></div>
<div class="league-wftda-strength-factor"><strong>SF:</strong> <?php echo $league_data['strength_factor'] ?></div>
<div class="league-wftda-world-ranking"><?php echo $league_data['world_ranking']?></div>
<a class="league-wfda-stats-link" href="<?php $url ?>">View full stats</a>