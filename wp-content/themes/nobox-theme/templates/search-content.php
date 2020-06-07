<article <?php post_class('post post--search'); ?>>
    <header class="post__header post--search__header">
        <h2 class="post__title post--search__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        <div class="post__meta-info post-search__meta-info">
            <?php get_template_part('templates/entry-meta'); ?>
        </div>
    </header>
    <div class="post__content post--search__content">
        <?php the_excerpt(); ?>

        <div class="post__read-more post--search__read-more">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                Läs mer
            </a>
        </div>
    </div>
</article>
