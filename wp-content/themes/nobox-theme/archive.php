<?php
get_template_part('parts/page-header');

get_template_part('templates/content-archive', get_post_type());

require locate_template('parts/pagination');
