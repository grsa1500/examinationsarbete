<time class="post__updated" datetime="<?= esc_attr(get_post_time('c', true)); ?>"><?= get_the_date(); ?></time>
<p class="post__byline post__author vcard">
    <?= esc_html__('Av', 'horizon'); ?>
    <a href="<?= esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author" class="fn">
        <?= get_the_author(); ?>
    </a>
</p>