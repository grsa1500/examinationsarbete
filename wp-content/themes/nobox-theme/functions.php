<?php
/**
 * Standard WP fil.
 * Egen kod bör helst ligga i `src/`.
 */

// Kräv Composer autoloader om den finns
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// Ladda temats funktionalitet
// TODO: Ha två stycken? En för lib och en för src
$files = [
    'lib/assets',
    'lib/wrapper',
    'src/setup',
    'src/post-types',
    'src/customizer',
    'src/theme',
    'src/actions',
    'src/filters',
    'src/helpers',
    'src/cron',
];
array_map(function ($file) {
    $file = "{$file}.php";
    if (! locate_template($file, true, true)) {
        // TODO: Errorlog här
        echo 'uh oh';
    }
}, $files);


function remove_h1_from_heading($args) {
    // Just omit h1 from the list
    $args['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Pre=pre';
    return $args;
    }
    add_filter('tiny_mce_before_init', 'remove_h1_from_heading' );



    // Method 1: Filter.
function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyD7j2Ct043_c9zUmRiADIUPwCdia19_HqA';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

// Method 2: Setting.
function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyD7j2Ct043_c9zUmRiADIUPwCdia19_HqA');
}
add_action('acf/init', 'my_acf_init');