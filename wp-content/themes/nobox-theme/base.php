<?php

use function Horizon\Wrapper\template_path;
use function Horizon\Wrapper\sidebar_path;
use function Horizon\Theme\display_sidebar;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="stylesheet" href="<?= esc_url(get_template_directory_uri()) ?>/animations.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
        <title>Pomonadalen - <?php wp_title(''); ?></title>
        <link href="<?= esc_url(get_template_directory_uri()) ?>/favicon.png" rel="shortcut icon">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class('common'); ?>>
        <!--[if IE]>
            <div class="alert-ie-appeared">
                <?= wp_kses_post(__('Du använder <strong>Internet Explorer</strong> som webbläsare. Internet Explorer har från och med januari 2016 slutat få säkerhetsuppdateringar utav Microsoft Corporation. Så för att uppnå den bästa upplevelsen av denna webbplats, var god uppdatera till en annan <a href="https://browsehappy.com/" target="_blank" rel="noopener noreferrer">webbläsare</a>.', 'horizon')); // phpcs:ignore Generic.Files.LineLength.TooLong ?>
            </div>
        <![endif]-->
        <?php
        wp_body_open();

        get_header();
        ?>
        <main>
         
                <?php require template_path(); ?>

                <?php
                if (display_sidebar()) {
                    include sidebar_path();
                }
                ?>
      
        </main>
        <?php
        get_footer();
        ?>




<script type="text/javascript" src="<?= esc_url(get_template_directory_uri()) ?>/css3-animate-it.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7j2Ct043_c9zUmRiADIUPwCdia19_HqA"></script>

    </body>
</html>
