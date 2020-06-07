<?php

use function Horizon\Assets\dist_path;

?>
<header id="header" class="site-header" role="banner">
    <div class="container">
        <div class="logotype">
            <a href="<?= esc_url(home_url()); ?>">
                <img src="<?= esc_url(dist_path('images/logotype.png')) ?>"
                    alt="Logotyp för <?php bloginfo('name'); ?>"
                    class="logotype__image"
                >
            </a>
        </div>

        <button type="button" class="site-header__nav-toggle" aria-label="Visa menyn">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav id="main-nav" class="site-header__nav" aria-hidden="true" aria-label="Huvudmeny">
            <?php
            wp_nav_menu([
                'theme_location' => 'main-nav',
                'container' => '',
                'menu_class' => 'nav-container',
            ]);
            ?>
        </nav>
    </div>
</header>
