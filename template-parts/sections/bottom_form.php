<section id="contact" class="bottom-form">
    <div class="container">

            <div class="bottom-form__content">
                
                <div class="bottom-form-header">
                    <?php if ($form_title = get_field('form_title')) : ?>
                        <h4 class="bottom-form-header__title"><?php echo $form_title; ?></h4>
                    <?php endif; ?>
                    <?php if ($form_description = get_field('form_description')) : ?>
                        <p class="bottom-form-header__description"><?php echo $form_description; ?></p>
                    <?php endif; ?>
                </div>

                <div class="bottom-form-content__wrapper">
                    <?php if ($form_image = get_field('decoration_image')) : ?>
                        <img class="bottom-form-header__image-mobile" src="<?php echo $form_image['url'] ?>" alt="<?php echo $form_image['alt'] ?>">
                    <?php endif; ?>
                    <div class="bottom-form-content">
                        <?php echo do_shortcode('[contact-form-7 id="2b182f9" title="Bottom Form"]'); ?>
                    </div>
                </div>
                <?php if ($form_image = get_field('decoration_image')) : ?>
                    <img class="bottom-form-header__image" src="<?php echo $form_image['url'] ?>" alt="<?php echo $form_image['alt'] ?>">
                 <?php endif; ?>
            </div>

    </div>
</section>