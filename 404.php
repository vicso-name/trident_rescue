
<?php
    get_header();
?>
<section class="error-page">
    <div class="container">
        <div class="error-page__content">
            <?php echo get_svg('errors_title', 'errors_title'); ?>
            <p class="error-description">
                <?php _e("Looks like someone got lost… This page can’t be found, but don’t worry! Just like we help animals find their way home, we’ll help you get back too.", "tridentrescue"); ?>
            </p>
            <a class="return-home" href="/"><span><?php _e('Return to Home')  ?></span></a>
        </div>
    </div>
</section>

<?php get_footer(); ?>