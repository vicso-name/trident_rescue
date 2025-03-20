<?php 
  $section_title = get_field('section_title');
  $slider_items = get_field('slider');
?>

<section class="section-items">
  <?php if (!empty($section_title)): ?>
    <div class="container">
      <h2 class="slider__items-title"><?php echo $section_title ?></h2>
    </div>
  <?php endif; ?>
  <div class="carousel-wrapper">
    <div class="carousel-container">

      <?php if (!empty($slider_items)): ?>
        <?php 
        $counter = 1;
        foreach ($slider_items as $item):
            $slider_image = $item['slider_image'] ?? null;
            $slider_title = $item['slider_title'] ?? '';
            $slider_description = $item['slider_description'] ?? '';
        ?>
          <div class="carousel-item">
            <div class="carousel-item__image-wrapper">
              <img src="<?php echo esc_url($slider_image['url']); ?>" alt="<?php echo esc_attr($slider_image['alt']); ?>" data-number="<?php echo $counter; ?>"/>
              <div class="carousel-item__number"><?php echo $counter; ?></div>
            </div>
            <div class="description">
              <?php if (!empty($slider_title)): ?>
                <h3 class="description-title"><?php echo esc_html($slider_title); ?></h3>
              <?php endif; ?>
              <?php if (!empty($slider_description)): ?>
                <p class="description-content"><?php echo esc_html($slider_description); ?></p>
              <?php endif; ?>
            </div>
          </div>
        <?php 
        $counter++;
        endforeach; 
        ?>
      <?php endif; ?>

    </div>
  </div>

</section>

<section class="mobile-slider-section">
  <div class="container">
    <?php if (!empty($slider_items)): ?>
      <div class="swiper carouselSwiper">
        <div class="swiper-wrapper">
          <?php 
            $counter = 1;
            foreach ($slider_items as $item):
                $slider_image = $item['slider_image'] ?? null;
                $slider_title = $item['slider_title'] ?? '';
                $slider_description = $item['slider_description'] ?? '';
          ?>
            <div class="swiper-slide">
                <div class="carousel-slider-image">
                    <img src="<?php echo esc_url($slider_image['url']); ?>" alt="<?php echo esc_attr($slider_image['alt']); ?>"/>
                    <div class="carousel-slider-number"><?php echo $counter; ?></div>
                </div>
                <div class="carousel-slider-description">
                    <?php if (!empty($slider_title)): ?>
                        <h3><?php echo esc_html($slider_title); ?></h3>
                    <?php endif; ?>
                    <?php if (!empty($slider_description)): ?>
                        <p><?php echo esc_html($slider_description); ?></p>
                    <?php endif; ?>
                </div>
            </div>
          <?php $counter++; endforeach; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

