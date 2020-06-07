<aside class="sidebar" role="complementary">
    <div class="container">
        <h2 class="sidebar__title">Sidopanel</h2>
        <div class="sidebar__content">
            <?php if (is_search() || is_404()) : ?>
            <div class="search">
                <h3 class="search__title">
                <?php if (!have_posts()) : ?>
                    Gör en ny sökning
                <?php else : ?>
                    Inte nöjd med resultaten?
                <?php endif; ?>
                </h3>

                <?php get_search_form(); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</aside>
