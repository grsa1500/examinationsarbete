<?php
if (have_posts()) :
    while (have_posts()) :
        the_post();
        ?>
        <article <?php post_class('post post--archive'); ?>>
            <header class="post__header post--archive__header">
                <h1 class="post__title post--archive__header"><?php the_title(); ?></h1>
                <div class="post__meta post--archive__meta">
                    <?php get_template_part('parts/post-meta'); ?>
                </div>
            </header>

            <div class="post__content post--archive__content">
                <?php the_content(); ?>
            </div>
        </article>
        <?php
        /*
        <article id="post-<?php the_ID(); ?>" <?php post_class('post '); ?>>
            <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <?php the_post_thumbnail(''); ?>
                </a>
            <?php endif; ?>

            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>

            <span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>

            <?php the_excerpt(''); ?>
        </article>
        */
    endwhile;
endif;
