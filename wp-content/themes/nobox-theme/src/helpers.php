<?php

/**
 * Check för att se ifall vi ansluter från kontorets IP
 * Används t.ex. `if (is_nobox()) { ... }`
 */
function is_nobox()
{
    $ip = wp_kses_post(wp_unslash($_SERVER['REMOTE_ADDR'] ?? ''));
    return $ip === '81.94.168.248';
}

/**
 * @param string $name Namnet på funktionen.
 * @param string $private_action Namnet på den privata funktionen. Vid `null` används samma funktion igen.
 */
function add_ajax_action($name, $private_action = null)
{
    add_action("wp_ajax_nopriv_$name", $name);
    $private_action = $private_action ?? $name;
    add_action("wp_ajax_$private_action", $private_action);
}

/**
 * Skapar en alert.
 *
 * @param string $type Vilken sorts alert det ska vara. Ex. 'success', 'danger', 'info'.
 * @param string $message Meddelandet i alerten.
 * @param bool   $include_icon Välj ifall ikonen ska med eller inte.
 */
function create_alert($type, $message, $include_icon = true)
{
    $icon = 'far ';
    $label = '';
    if ($type === 'success') {
        $icon .= 'fa-check';
        $label = 'Succé';
    } elseif ($type === 'danger') {
        $icon .= 'fa-times';
        $label = 'Ett fel uppstod';
    } elseif ($type === 'info') {
        $icon .= 'fa-info-circle';
        $label = 'Information';
    } elseif ($type === 'warning') {
        $icon .= 'fa-exclamation-circle';
        $label = 'Varning';
    } else {
        $include_icon = false;
    }
    ob_start();
    ?>
    <div class="alert alert--<?= wp_kses_post($type) ?>" role="alert">
        <?php
        if ($include_icon) :
            ?>
        <i class="<?= wp_kses_post($icon) ?>" title="<?= wp_kses_post($label) ?>"></i>
            <?php
        endif;

        echo wp_kses_post($message);
        ?>
    </div>
    <?php
    $output = ob_get_clean();
    return $output;
}
