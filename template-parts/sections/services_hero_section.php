<section class="service-hero">
    <div class="container">
        <div class="service-hero__content">

            <div class="service-hero__title">
                <?php
                $section_title = get_field('section_title');
                if (!empty($section_title)) : ?>
                    <h1 class="hero__heading">
                        <?php echo do_shortcode( $section_title ); ?>
                    </h1>
                <?php endif; ?>
            </div>

            <div class="section-hero_title_mobile">
                <?php
                    $section_title_mobile = get_field('section_title_mobile');
                    if (!empty($section_title_mobile)) : ?>
                        <h1 class="hero__heading">
                            <?php echo do_shortcode( $section_title_mobile ); ?>
                        </h1>
                <?php endif; ?>
            </div>
            
            <div class="service-hero__description">
                <div class="hero__description-text">
                    <?php
                        $description = get_field('description');
                        if(!empty($description)): 
                    ?>
                        <p><?php echo $description; ?></p>
                    <?php endif; ?>
                    <div class="service-hero__contact">
                        <?php 
                            $link = get_field('contact_button');
                            if( $link ): 
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                            <a class="button-contact" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                <span><?php echo esc_html( $link_title ); ?></span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>