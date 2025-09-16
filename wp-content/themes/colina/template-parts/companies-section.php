<?php
$companies = get_companies_clients();
$companies_count = count($companies);
?>

<?php if ($companies_count > 0): ?>
    <section class="companies-section">
        <div class="companies-container">
            <h2 class="section-title">Empresas que confían en nosotros</h2>

            <?php if ($companies_count > 1): ?>
                <div class="companies-swiper-container">
                    <div class="swiper companies-swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($companies as $company): ?>
                                <div class="swiper-slide">
                                    <?php if (!empty($company['url'])): ?>
                                        <a href="<?php echo esc_url($company['url']); ?>"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="company-card"
                                            title="Visitar sitio web de <?php echo esc_attr($company['title']); ?>">
                                            <?php if ($company['image']): ?>
                                                <div class="company-image">
                                                    <img src="<?php echo esc_url($company['image']); ?>"
                                                        alt="<?php echo esc_attr($company['title']); ?>"
                                                        loading="lazy">
                                                </div>
                                            <?php endif; ?>
                                        </a>
                                    <?php else: ?>
                                        <div class="company-card">
                                            <?php if ($company['image']): ?>
                                                <div class="company-image">
                                                    <img src="<?php echo esc_url($company['image']); ?>"
                                                        alt="<?php echo esc_attr($company['title']); ?>"
                                                        loading="lazy">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="swiper-button-next companies-next"></div>
                        <div class="swiper-button-prev companies-prev"></div>
                    </div>
                </div>

            <?php else: ?>
                <div class="single-company">
                    <?php $company = $companies[0]; ?>
                    <?php if (!empty($company['url'])): ?>
                        <a href="<?php echo esc_url($company['url']); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="company-card"
                            title="Visitar sitio web de <?php echo esc_attr($company['title']); ?>">
                            <?php if ($company['image']): ?>
                                <div class="company-image">
                                    <img src="<?php echo esc_url($company['image']); ?>"
                                        alt="<?php echo esc_attr($company['title']); ?>"
                                        loading="lazy">
                                </div>
                            <?php endif; ?>
                        </a>
                    <?php else: ?>
                        <div class="company-card">
                            <?php if ($company['image']): ?>
                                <div class="company-image">
                                    <img src="<?php echo esc_url($company['image']); ?>"
                                        alt="<?php echo esc_attr($company['title']); ?>"
                                        loading="lazy">
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>