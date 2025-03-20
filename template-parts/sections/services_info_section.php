<section class="information">
    <div class="container">
        <div class="information__wrapper">

        <div class="information__slider swiper">
            <div class="swiper-wrapper">
                <?php foreach(get_field('slider') as $image): ?>
                <div class="swiper-slide">
                    <img 
                    src="<?php echo $image['url']; ?>" 
                    alt="<?php echo $image['alt']; ?>" 
                    class="slider-image">
                </div>
                <?php endforeach; ?>
            </div>

            <div class="swiper-pagination"></div>
            <div class="info-swiper-buttons">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            
        </div>

            <div class="information__content">

                <div class="information__content-wrapper">
                    <?php if(get_field('title')): ?>
                        <h2 class="information__title">
                            <?php the_field('title'); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if(get_field('description')): ?>
                        <div class="information__text">
                            <?php the_field('description'); ?>
                        </div>
                    <?php endif; ?>
                </div>
                

                <?php 
                    $link = get_field('contact_button');
                    if($link): 
                ?>
                <a href="<?php echo $link['url']; ?>" 
                   class="information__button" 
                   target="<?php echo $link['target']; ?>">
                    <?php echo $link['title']; ?>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>