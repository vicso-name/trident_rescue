<?php 
    $approach_slider = get_field('approach_slider');
    $approach_slider_title = $approach_slider['slider_title'];
    $approach_slider_items = $approach_slider['slider_item'];

    $decoration_title = get_field('decoration_title');
    $decoration_title_decoration =  $decoration_title['title'];
    $title_mobile_version =  $decoration_title['title_mobile_version'];

?>
<section class="approach-section">
    <div class="container">
        <?php if($approach_slider_items): ?>
            <div class="approach-slider">
                <?php if (!empty($approach_slider_title)): ?>
                    <h2 class="approach-slider__title"><?php echo $approach_slider_title ?></h2>
                <?php endif; ?>

                <div class="approach-slider__content swiper">
                    <div class="approach-slider__items swiper-wrapper">
                        <?php
                            $counter = 1;
                            foreach($approach_slider_items as $item):
                                $icon = $item['icon'];
                                $title = $item['title'];
                                $description = $item['description'];
                        ?>
                            <div class="approach-slider__item swiper-slide">
                                <div class="approach-slider__item-icon">
                                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>">
                                    <span class="slider-number">(0<?php echo $counter; ?>)</span>
                                </div>
                                <div class="approach-slider__item-content">
                                    <h3 class="approach-slider__item-title"><?php echo $title; ?></h3>
                                    <p class="approach-slider__item-description"><?php echo $description; ?></p>
                                </div>
                            </div>
                        <?php 
                            $counter++;
                            endforeach; 
                        ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="approach-decoration__title">
            <h2 class="approach-decoration__title-inner"><?php echo do_shortcode( $decoration_title_decoration ); ?></h2>
            <h2 class="approach-decoration__title-inner-mobile"><?php echo do_shortcode( $title_mobile_version ); ?></h2>
        </div>

        <?php if( have_rows('parallax_image_section') ): ?>
            <div class="parallax-section">
                <div class="parallax-section__content">
                    <?php while( have_rows('parallax_image_section') ): the_row(); ?>

                        <h4 class="parallax-section__content-title"><?php the_sub_field('parallax_title'); ?></h4>
                        <p class="parallax-section__content-description"><?php the_sub_field('parallax_description'); ?></p>
                       
                        <?php 
                            $link = get_sub_field('parallax_button');
                            if( $link ): 
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                        ?>
                            <a href="<?php echo esc_url($link_url); ?>" class="parallax-section__content-btn">
                                <span><?php echo esc_html($link_title); ?></span>
                            </a>
                        <?php endif; ?>
                    <?php endwhile; ?>

                </div>
            </div>
        <?php endif; ?>

    </div>
    <?php if( have_rows('parallax_image_section') ): ?>
        <?php while( have_rows('parallax_image_section') ): the_row(); ?>
            <div class="parallax-images">

               

                <?php 
                    $images = get_sub_field('parallax_images');
                    if( $images ): 
                    foreach( $images as $i => $image ): 
                    $speed = (rand(0, 1) ? -1 : 1) * 0.1;
                ?>
                    <div class="parallax-item" 
                        data-speed="<?php echo $speed; ?>" 
                        style="background-image: url('<?php echo esc_url($image['url']); ?>');">
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if( get_sub_field('decoration_lable') ): ?>
                    <div class="decoration_lable"><?php the_sub_field('decoration_lable'); ?></div>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</section>