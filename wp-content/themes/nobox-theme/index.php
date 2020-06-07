<?php
get_template_part('parts/page', 'header');

if (!have_posts()) {
    echo create_alert('danger', 'Inget finns publicerat här', false);
} else {
    while (have_posts()) {
        the_post();
        get_template_part('templates/content', get_post_type() !== 'post' ? get_post_type() : get_post_format());
    }
}
