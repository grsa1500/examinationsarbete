<?php

namespace Horizon\Setup;

use function Horizon\Assets\dist_path;
use function Horizon\Assets\actual_asset_path;

// phpcs:disable WordPress.WP.EnqueuedResourceParameters.MissingVersion

function custom_fonts()
{
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:700', [], '1.0');
}

// phpcs:ignore
/** JavaScript och CSS */
add_action('wp_enqueue_scripts', function () {
    // jQuery
    wp_deregister_script('jquery-core');
    wp_register_script('jquery-core', 'https://code.jquery.com/jquery-3.4.1.min.js', [], '3.4.1', false);

    wp_deregister_script('jquery-migrate');
    wp_register_script('jquery-migrate', 'https://code.jquery.com/jquery-migrate-3.0.1.min.js', [], '3.0.1', false);

    // Typsnitt
    custom_fonts();

    // CSS
    wp_enqueue_style('horizon/css', dist_path('css/style.css'), [], null);

    // Google Maps
    // $map_api_token = 'AIzaSyCU4dub1ES-sKBHuubVm27QS_wCTUR00BY';
    // $map_api_url = sprintf('%s?key=%s', 'https://maps.googleapis.com/maps/api/js', $map_api_token);
    // wp_register_script('googlemaps', $map_api_url, [], '1.0', true);
    // wp_enqueue_script('googlemaps');

    // JS
    $dependencies = ['jquery'];
    $manifest_path = actual_asset_path('js/manifest.js', 'dist', false);
    $js_filename = 'js/main.js';
    $use_minified = true;
    if (file_exists($manifest_path)) {
        wp_enqueue_script('horizon/js-vendor', dist_path('js/vendor.js'), ['jquery'], null, true);

        // phpcs:ignore -- TODO: ersätt nedan?
        $manifest = file_get_contents($manifest_path);
        wp_add_inline_script('horizon/js-vendor', $manifest, 'before');

        $dependencies = ['horizon/js-vendor'];

        $minified_path = actual_asset_path('js/main.min.js', 'dist', false);
        if ($use_minified && file_exists($minified_path)) {
            $js_filename = 'js/main.min.js';
        }
    }

    wp_register_script('horizon/js', dist_path($js_filename), $dependencies, null, true);
    
    $obj_data = [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'ajaxNonce' => wp_create_nonce('_ajax_nonce'),
    ];
    wp_localize_script('horizon/js', 'horizon', $obj_data);

    wp_enqueue_script('horizon/js');
}, 100);

/**
 * CSS till Loginsidan
 */
add_action('login_head', function () {
    wp_enqueue_style('horizon/login', dist_path('css/admin.css'), [], null);
});

/**
 * Scripts i admin
 */
add_action('admin_head', function () {
    wp_enqueue_script('horizon/customizer', dist_path('js/customizer.js'), ['customize-preview'], null, true);

    wp_enqueue_style('horizon/admin', dist_path('css/admin.css'), [], null);
    // add_editor_style(dist_path('css/classic-editor.css'));
});

/**
 * CSS till Gutenberg
 */
add_action('enqueue_block_editor_assets', function () {
    custom_fonts();
}, 1000);

/**
 * Tema inställningar
 */
add_action('after_setup_theme', function () {
    /**
     * Roots Soil stöd
     *
     * @link
     */
    // add_theme_support('soil-clean-up');
    // add_theme_support('soil-nav-walker');
    // add_theme_support('soil-nice-search');
    // add_theme_support('soil-relative-urls');

    /**
     * WooCommerce stöd
     *
     * @link
     */
    // add_theme_support('woocommerce');
    // add_theme_support('wc-product-gallery-zoom');
    // add_theme_support('wc-product-gallery-lightbox');
    // add_theme_support('wc-product-gallery-slider');

    /**
     * Låter plugins ta hand om <title>
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Tillåter HTML5 markup
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Gutenberg
     */
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_editor_style(dist_path('css/gutenberg-editor.css'));

    /**
     * Menyer
     *
     * @link
     */
    register_nav_menus([
        'main-nav' => __('Huvudnavigation', 'horizon'),
        'second-nav' => __('Extra navigation', 'horizon'),
    ]);

    /**
     * Thumbnails
     *
     * @link
     */
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true);
    add_image_size('medium', 250, '', true);
    add_image_size('small', 120, '', true);
    // add_image_size('custom-size', xxx, '', true); // Custom Thumbnail
}, 20);

/** ACF inställningssidor */
add_action('acf/init', function () {
    if (!function_exists('acf_add_options_page')) {
        return;
    }

    // Skapa inställningssida
    $parent = acf_add_options_page([
        'page_title'    => 'Inställningar för webbplats',
        'menu_title'    => 'Funktionalitet',
        'icon_url'      => 'dashicons-admin-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false,
    ]);

    /*
    // Lägg till undersida till ovanstående
    acf_add_options_sub_page([
        'page_title'     => 'Submenu',
        'menu_title'     => 'Submenu',
        'parent_slug'    => $parent['menu_slug'],
    ]);
    */

    /*
    // Exempel: Skapa en inställningssida för e-post.
    acf_add_options_page([
        'page_title' => 'E-post inställningar',
        'menu_title' => 'E-post inställningar',
        'menu_slug'  => 'custom-email-settings',
        'icon_url'   => 'dashicons-email-alt',
        'post_id'    => 'epost',
        'capability' => 'edit_posts',
        'redirect'   => false
    ]);
    */
});

/** Widgets */
/*
add_action('widgets_init', function () {
    register_sidebar([
        'name'           => __('Widget Namn', 'horizon'),
        'id'             => 'sidebar-primary',
        'before_widget'  => '<div class="widget %1$s %2$s">',
        'after_widget'   => '</div>',
        'before_title'   => '<h3>',
        'after_title'    => '</h3>'
    ]);
});
*/
