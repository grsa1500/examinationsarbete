<?php

namespace Horizon\Cron;

/**
 * @param string   $name Cronjobbets namn.
 * @param string   $schedule Hur ofta cronjobbet ska köras.
 * @param callable $action Funktionen som ska köras.
 */
function add_cronjob($name, $schedule, $action)
{
    $hook_name = "horizon/cron/$name";

    if (gettype($action) !== 'object' && strpos('\\', $action) !== false) {
        $action = __NAMESPACE__ . '\\' . $action;
    }

    add_action($hook_name, $action);

    if (! wp_next_scheduled($hook_name)) {
        wp_schedule_event(time(), $schedule, $hook_name);
    }
}

// Cron schedules
add_filter('cron_schedules', function ($schedules) {
    $schedules['monthly'] = [
        'interval' => 60 * 60 * 24 * 30,
        'display' => esc_html__('Varje månad', 'horizon'),
    ];

    return $schedules;
});

// Cronjobs
add_cronjob('update_footer_text', 'monthly', function () {
    $url_parts = wp_parse_url(home_url());
    $domain = $url_parts['host'];

    $response = wp_remote_get("https://noboxcrm.se/producerad.php?domain=$domain");
    $text = $response['body'];

    update_option('horizon_footer_text', $text, 'yes');
});
