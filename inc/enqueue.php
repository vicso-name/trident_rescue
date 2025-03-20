<?php

/**
 * Including styles in the admin dashboard
 */
if (is_admin()) {
    wp_enqueue_style('admin-styles', THEME_URI . '/build/css/admin-style.min.css', array(), time());
}

/**
 * Scripts and styles.
 */
function smplfy_scripts() {
    $version = (defined('WP_DEBUG') && WP_DEBUG) ? time() : S_VERSION;

    wp_enqueue_style('umbrella-style', get_stylesheet_uri(), array(), $version);
    wp_style_add_data('umbrella-style', 'rtl', 'replace');

    wp_enqueue_style('swiper-style', get_template_directory_uri() . '/assets/swiper/swiper-bundle.min.css', array(), $version);
    wp_enqueue_style('main-styles', THEME_URI . '/build/css/style.min.css', array(), $version);

    wp_enqueue_script('main-scripts', THEME_URI . '/build/js/general.min.js', array(), $version, true);
    wp_enqueue_script('swiper-script', get_template_directory_uri() . '/assets/swiper/swiper-bundle.min.js', array(), $version, true);

    // Подключаем GSAP
    wp_enqueue_script('gsap-script', get_template_directory_uri() . '/assets/gsap/gsap.min.js', array(), null, true);
    
    // Подключаем ScrollTrigger (теперь указываем зависимость от GSAP)
    wp_enqueue_script('gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', array('gsap-script'), null, true);
    
    // Подключаем ScrollMagic и его плагины
    wp_enqueue_script('scroll-magic-script', get_template_directory_uri() . '/assets/scroll_magic/ScrollMagic.min.js', array(), null, true);
    wp_enqueue_script('gsap-animation-script', get_template_directory_uri() . '/assets/animation_gsap/animation.gsap.min.js', array(), null, true);
}

add_action('wp_enqueue_scripts', 'smplfy_scripts');

function enqueue_aos_scripts() {
    wp_enqueue_style('aos-css', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css', array(), '2.3.4');
    wp_enqueue_script('aos-js', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js', array(), '2.3.4', true);
    add_action('wp_footer', function() {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                AOS.init({
                    once: false,  
                    duration: 1000,
                    easing: 'ease-in-out',
                    offset: 100
                });
            });
        </script>";
    });
}
add_action('wp_enqueue_scripts', 'enqueue_aos_scripts');

