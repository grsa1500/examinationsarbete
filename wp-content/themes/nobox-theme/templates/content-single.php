<?php
while (have_posts()) :
    the_post();
    ?>
    <article <?php post_class('post'); ?>>
        <header class="post__header">
            <h1 class="post__title"><?php the_title(); ?></h1>
            <div class="post__meta">
                <?php get_template_part('parts/post-meta'); ?>
            </div>
        </header>
        <div class="post__content">
            <?php the_content(); ?>
        </div>
    </article>
    <?php
endwhile;
