<?php

/**
 * Admin form for the widget
 *
 * This file is used to markup the admin-facing aspects of the widget.
 *
 * @link       http://bit.ly/Stray_Taco
 * @since      1.0.0
 *
 * @package    League_Wftda_Ranking
 * @subpackage League_Wftda_Ranking/widgets/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<p>
    <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'text_domain'); ?></label>
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
           name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text"
           value="<?php echo esc_attr($title); ?>">
</p>
<p>
    <label for="<?php echo esc_attr($this->get_field_id('league')); ?>">
        <?php esc_attr_e( 'League Slug:', 'text_domain'); ?>
    </label>
    <input class="widefat" id="<?php echo esc_attr($this->get_field_id('league')); ?>"
           name="<?php echo esc_attr($this->get_field_name('league')); ?>" type="text"
           value="<?php echo esc_attr($league); ?>">
</p>