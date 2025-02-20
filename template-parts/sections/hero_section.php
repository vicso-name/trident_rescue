<?php
    $description = get_field('description');
    $social_media = get_field('social_media');
    $buttons = get_field('buttons');
?>

<section class="hero">

    <div class="container">
        <div class="hero__content">
            <div class="hero__title">
                <?php
                $main_title = get_field('main_title');
                if (!empty($main_title)) : ?>
                    <h1 class="hero__heading">
                        <?php echo do_shortcode( $main_title ); ?>
                    </h1>
                <?php endif; ?>
            </div>

            <div class="hero__description">
                <?php if($description): ?>
                    <div class="hero__description-text">
                        <p><?php echo $description; ?></p>
                    </div>
                <?php endif; ?>
                <?php if($social_media): ?>
                    <div class="hero__social">
                        <ul class="hero__social-list">
                            <?php 
                                foreach($social_media as $social): 
                                    $link = $social['link'];
                                    $icon = $social['icon'];
                            ?>
                                <li class="hero__social-item">
                                    <?php if( $link ): 
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                    ?>
                                        <a class="hero__social-link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                            <img src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>" class="hero__social-icon">
                                        </a>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($buttons): ?>

                <div class="hero__buttons">
                    
                    <ul>
                        <?php 
                            foreach ($buttons as $button): 
                                $button_bg = $button['button_background'] ?? ''; 
                                $button_link = $button['button_link'] ?? ''; 
                                $button_images = $button['images_for_hover_effect'] ?? [];
                        ?>
                            <li class="hero__button-item">
                                <div class="hero__button-item__btn-wrapper"  style="background: <?php echo esc_attr($button_bg); ?>">
                                    <?php 
                                        if( $button_link ): 
                                            $link_url =$button_link['url'];
                                            $link_title = $button_link['title'];
                                            $link_target = $button_link['target'] ? $button_link['target'] : '_self';
                                    ?>
                                        <a class="hero__button"  href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                            <?php echo esc_html( $link_title ); ?>
                                            
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($button_images)): ?>
                                    <div class="hero__button-hover-images">
                                        <?php foreach ($button_images as $image): ?>
                                            <img src="<?php echo esc_url($image['url']); ?>" 
                                                alt="<?php echo esc_attr($image['alt'] ?? ''); ?>" 
                                                width="200" height="250" 
                                                class="hero__button-hover-image">
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>

                    </ul>

                </div>
            <?php endif; ?>


        </div>
    </div>
</section>
