</main><!-- main -->
<?php if ( !is_front_page() && !is_404() && !is_page_template('template-parts/tpl-thanks.php') ) : ?>


        <footer class="footer">
            <div class="container">
                <div class="footer__content">
                    
                    <div class="footer__logo">
                        <a href="/">
                            <img src="<?php echo esc_url(get_field('footer_logo', 'option')['url']); ?>" alt="Trident Rescue Logo">
                        </a>
                        <p class="footer__email">
                            <span class="footer__email--title">Email: </span>
                            <a class="footer__email--mail" href="mailto:<?php echo esc_html(get_field('email_in_footer', 'option')); ?>">
                                <?php echo esc_html(get_field('email_in_footer', 'option')); ?>
                            </a>
                        </p>
                    </div>

                    <ul class="footer__social-links">
                        <?php if (have_rows('social_links', 'option')): ?>
                        <?php while (have_rows('social_links', 'option')): the_row(); ?>
                            <li class="footer__social-item">
                            <a href="<?php echo esc_url(get_sub_field('link')['url']); ?>" target="_blank">
                                <img src="<?php echo esc_url(get_sub_field('icon')['url']); ?>" alt="Social Icon">
                            </a>
                            </li>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </ul>

                </div>

                <p class="footer__email-mobile">
                    <span class="footer__email--title">Email: </span>
                    <a class="footer__email--mail" href="mailto:<?php echo esc_html(get_field('email_in_footer', 'option')); ?>">
                        <?php echo esc_html(get_field('email_in_footer', 'option')); ?>
                    </a>
                </p>

                <div class="footer__info">
                    <p class="footer__copyright">
                        &copy; <?php echo esc_html(get_field('copirights', 'option')); ?>
                    </p>
                    <p class="footer__made-in">
                        <?php echo get_field('made_in', 'option'); ?>
                    </p>
                </div>

            </div>
        </footer>
    <?php endif; ?>

    <!-- Popup Modal -->
    <div id="contact-popup" class="modal">
        <span class="close-popup"><?php echo get_svg('close_btn', 'close_btn'); ?></span>
        <div class="modal-guts">
            <div class="popup-header">
                <?php if ($pop_up_title = get_field('pop_up_title', 'option')) : ?>
                    <h4 class="popup-header__title"><?php echo $pop_up_title; ?></h4>
                <?php endif; ?>
                <?php if ($pop_up_image = get_field('pop_up_image', 'option')) : ?>
                    <img class="popup-header__image" src="<?php echo $pop_up_image['url'] ?>" alt="<?php echo $pop_up_image['alt'] ?>">
                <?php endif; ?>
            </div>
            <div class="popup-content">
                <?php echo do_shortcode('[contact-form-7 id="eb5fb23" title="Main Contact"]'); ?>
            </div>
        </div>
    </div>
    <div class="popup-overlay"></div>

    <!-- Popup Menu  -->
    <div class="mobile-menu">
        <div class="mobile-menu__content">
            <?php 
                $mobile_menu_image = get_field('mobile_menu_image', 'option');
                if($mobile_menu_image):
                ?>
                <img class="menu-image-decoration" src="<?php echo $mobile_menu_image['url'] ?>" alt="<?php echo $mobile_menu_image['alt'] ?>">
            <?php endif; ?>
            <button class="contact-us-mobile" id="mobile-contact">
                <span> <?php _e('Contact us', 'tridentrescue'); ?> </span>
                <span class="decor-row"></span>
            </button>
            <?php 
                $mobile_menu_links = get_field('mobile_menu_links', 'option');
                if($mobile_menu_links):
                $for_adopter = $mobile_menu_links['for_adopter'];
                $for_rescues = $mobile_menu_links['for_rescues'];
            ?>
                <ul class="adopters-rescues">
                    <li class="adopters-rescues__item">
                        <?php 
                        if(  $for_adopter ): 
                            $link_url =  $for_adopter['url'];
                            $link_title =  $for_adopter['title'];
                            $link_target =  $for_adopter['target'] ?  $for_adopter['target'] : '_self';
                            ?>
                            <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                        <?php endif; ?>
                    </li>
                    <li class="adopters-rescues__item">
                        <?php 
                        if( $for_rescues ): 
                            $link_url =$for_rescues['url'];
                            $link_title = $for_rescues['title'];
                            $link_target = $for_rescues['target'] ? $for_rescues['target'] : '_self';
                            ?>
                            <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                        <?php endif; ?>
                    </li>
                </ul>
            <?php endif; ?>
            <div class="mobile-menu__footer">
                <div class="mobile-menu__footer-item">
                    <?php
                        $languages = pll_the_languages(array(
                            'show_flags' => 0,
                            'show_names' => 1,
                            'display_names_as' => 'slug',
                            'hide_current' => 0,
                            'dropdown' => 0,
                            'echo' => false
                        ));
                        $languages = preg_replace_callback('/>([a-z]{2})</', function ($matches) {
                            return '>' . ucfirst($matches[1]) . '<';
                        }, $languages);
                        echo '<div class="header-lang-switcher-footer">' . $languages . '</div>';
                    ?>
                </div>
                <div class="mobile-menu__footer-item">
                    <p class="footer__made-in">
                        <?php echo get_field('made_in', 'option'); ?>
                    </p>
                </div>
            </div>
        </div>              
    </div>


</div><!-- wrapper -->
<?php wp_footer(); ?>
    </body>
</html>