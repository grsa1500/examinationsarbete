<?php
// phpcs:disable WordPress.Security.NonceVerification.Recommended

if (isset($_GET['success'])) :
    ?>
    <div class="alert alert--success" role="alert">
        <i class="far fa-check"></i> Exempel på hur ett lyckat meddelande kan se ut.
    </div>
    <?php
endif;

if (isset($_GET['failed'])) :
    ?>
    <div class="alert alert--danger" role="alert">
        <i class="far fa-times" title="Ett fel uppstod"></i> Exempel på hur ett felmeddelande kan se ut.
    </div>
    <?php
endif;

if (isset($_GET['info'])) :
    ?>
    <div class="alert alert--info" role="alert">
        <i class="far fa-info-circle" title="Information"></i> Exempel på hur ett informationsmeddelande kan se ut.
    </div>
    <?php
endif;
