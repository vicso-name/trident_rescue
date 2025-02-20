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
}

add_action('wp_enqueue_scripts', 'smplfy_scripts');
