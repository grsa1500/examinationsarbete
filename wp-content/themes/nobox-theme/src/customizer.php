<?php

namespace Horizon\Customizer;

/**
 * Add postMessage support
 */
function customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
}
add_action('customize_register', __NAMESPACE__ . '\\customize_register');
