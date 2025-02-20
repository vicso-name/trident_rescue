</main><!-- main -->
    <footer class="footer" id="footer">
        <div class="container">
            <div class="footer-content"> 
                
            </div>
        </div>
    </footer><!-- footer -->

    <!-- Popup Modal -->
    <div id="contact-popup" class="popup-overlay">
        <div class="popup-overlay__guts">
            <span class="close-popup"><?php echo get_svg('close_btn', 'close_btn'); ?></span>
            <div class="popup-content__wrapper">
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
    
        
    </div>

</div><!-- wrapper -->
<?php wp_footer(); ?>
    </body>
</html>