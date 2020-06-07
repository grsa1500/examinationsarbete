<?php
get_template_part('parts/page', 'header');

if (!have_posts()) :
    $message = sprintf('Sökordet <span class="term">%s</span> gav dessvärre ingen träff.', get_search_query());
    echo create_alert('danger', $message);
else :
    while (have_posts()) {
        the_post();
        get_template_part('templates/search', 'content');
    }
endif;
