<?php
$exclude_id = null;
if (is_single()) {
    $exclude_id = get_the_ID();
}
$news_query = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => 8,
    'post_status'    => 'publish',
    'post__not_in'   => $exclude_id ? array($exclude_id) : array(),
]);
$default_img = get_template_directory_uri() . '/assets/images/news-default.jpg';
?>
<?php if ($news_query->have_posts()): ?>
    <section class="news-section">
        <div class="section-header">
            <h3 class="section-title">NOTICIAS</h3>
            <h2 class="section-subtitle">Novedades y anuncios importantes</h2>
        </div>
        <div class="news-swiper-container">
            <div class="swiper news-swiper">
                <div class="swiper-wrapper">
                    <?php while ($news_query->have_posts()): $news_query->the_post(); ?>
                        <div class="swiper-slide">
                            <div class="news-card">
                                <div class="news-image">
                                    <?php if (has_post_thumbnail()): ?>
                                        <?php the_post_thumbnail('large'); ?>
                                    <?php else: ?>
                                        <img src="<?php echo esc_url($default_img); ?>" alt="Noticia">
                                    <?php endif; ?>
                                    <div class="news-overlay">
                                        <a href="<?php the_permalink(); ?>" class="btn news-btn">Ver más</a>
                                    </div>
                                </div>
                                <div class="news-content">
                                    <span class="news-date"><?php echo get_the_date('d/m/Y'); ?></span>
                                    <h4 class="news-title"><?php the_title(); ?></h4>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
            </div>
            <div class="news-swiper-controls">
                <div class="swiper-button-prev news-prev"></div>
                <div class="swiper-button-next news-next"></div>
            </div>
        </div>
        </div>
    </section>
<?php endif; ?>