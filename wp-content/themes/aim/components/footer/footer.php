<footer class="aim__footer">
    <div class="aim__footer__main">
        <div class="aim__footer__left">
            <nav class="aim__footer_cta">
               <?php get_template_part('components/footer/footer-cta-nav'); ?>
            </nav>
            <nav class="aim__footer__left__nav">
                <?php get_template_part('components/footer/footer-main-nav'); ?>
            </nav>
            <div class="aim__footer__contact">
                <div class="aim__footer__social-media">
                    <p class="aim__footer__contact__title">Connect on Social</p>
                    <div class="aim__footer__social-media__links">
                       <?php get_template_part('components/footer/footer-social-media-nav'); ?>
                    </div>
                </div>
                <div class="aim__footer__address">
                    <p class="aim__footer__contact__title">Address & Phone</p>
                    <div class="aim__footer__address__details">
                        <p>
                            <?php
                                $footer_address = get_option('footer_address', '');
                                if (!empty($footer_address)) {
                                    echo nl2br(esc_html($footer_address));
                                }
                            ?>
                        </p>
                        <p>
                            <?php
                                $footer_phone = get_option('footer_phone', '');
                                if (!empty($footer_phone)) {
                                    echo nl2br(esc_html($footer_phone));
                                }
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="aim__footer__logo-container">
                <img class="aim__footer__logo-desktop" src="<?php echo esc_url(get_template_directory_uri() . "/assets/svg/aim-logo.svg"); ?>" alt="<?php echo esc_attr(get_bloginfo("name")); ?>">
                <img class="aim__footer__logo-mobile" src="<?php echo esc_url(get_template_directory_uri() . "/assets/svg/aim-logo-mobile.svg"); ?>" alt="<?php echo esc_attr(get_bloginfo("name")); ?>">
            </div>
        </div>
        <nav class="aim__footer__right">
            <?php get_template_part('components/footer/footer-main-nav'); ?>
        </nav>
    </div>
    <div class="aim__footer__copyrights">
        <div class="aim__footer__copyrights__left">
            <p class="body-s">© <?php echo date("Y"); ?> <?php bloginfo("name"); ?>. </p> <p class="body-s">All rights reserved.</p>
        </div>
        <nav class="aim__footer__legal">
          <?php get_template_part('components/footer/footer-legal-nav'); ?>
        </nav>
    </div>
</footer>
