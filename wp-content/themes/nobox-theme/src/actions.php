<?php

/**
 * Actions
 */

namespace Horizon\Actions;

function mailer_config(PHPMailer $mailer)
{
    // phpcs:disable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
    if (empty($mailer->AltBody)) {
        $mailer->AltBody = wp_strip_all_tags($mailer->Body);
    }
    // phpcs:enable
}
//add_action('phpmailer_init', __NAMESPACE__ . '\\mailer_config');

/** Tar bort kommentarer från admin menyn */
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

/** Tar bort kommentarstöd för `post` och `page` post types */
add_action('init', function () {
    remove_post_type_support('post', 'comments');
    remove_post_type_support('page', 'comments');
}, 100);

/** Tar bort kommentarlänk från admin bar */
add_action('wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
});
