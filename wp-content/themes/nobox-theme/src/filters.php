<?php

namespace Horizon\Filters;

use function Horizon\Theme\display_sidebar;

add_filter('body_class', function ($classes) {
    // Add page slug if it doesn't exist
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes, true)) {
            $classes[] = basename(get_permalink());
        }
    }
    
    // Add class if sidebar is active
    if (display_sidebar()) {
        $classes[] = 'has-sidebar';
    }

    return $classes;
});

// Lägg till en ändelse efter de retunerade orden på the_excerpt
// Returnerar 25 ord
add_filter('excerpt_length', function ($length) {
    return 25;
}, 999);
add_filter('excerpt_more', function () {
    return '...';
});

/**
 * Responsiva oEmbeds.
 *
 * Avkommentera ifall Gutenberg inte används.
 */
/*
function rwd_embed($html)
{
    return "<div class='embed-container'>{$html}</div>";
}
add_filter('embed_oembed_html', __NAMESPACE__ . '\\rwd_embed');
add_filter('video_embed_html', __NAMESPACE__ . '\\rwd_embed');
*/

/** Lägger Yoast längst ner på sidor och inlägg */
add_filter('wpseo_metabox_prio', function () {
    return 'low';
});

/** Stänger av XMLRPC */
add_filter('xmlrpc_enabled', '__return_false');


