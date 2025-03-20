<?php
// Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode', 11);

// Remove WordPress version from head for security
remove_action('wp_head', 'wp_generator');

// Remove emoji scripts and styles for performance optimization
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

// Replace default WordPress menu classes with custom classes
function change_menu_classes($classes) {
    $classes = str_replace(['current-menu-item', 'current-menu-parent', 'current_page_item'], 'active', $classes);
    return $classes;
}
add_filter('nav_menu_css_class', 'change_menu_classes');
add_filter('page_css_class', 'change_menu_classes');

// Automatically add title as alt text if alt is missing
function add_title_to_empty_alt($response) {
    if (empty($response['alt'])) {
        $response['alt'] = sanitize_text_field($response['title']);
    }
    return $response;
}
add_filter('wp_prepare_attachment_for_js', 'add_title_to_empty_alt');

// Disable automatic paragraph wrapping in Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');

// Fallback functions if ACF (Advanced Custom Fields) is not available
if (!class_exists('acf') && !is_admin()) {
    function get_field_reference() { return ''; }
    function get_field_objects() { return false; }
    function get_fields() { return false; }
    function get_field() { return false; }
    function get_field_object() { return false; }
    function the_field() {}
    function have_rows() { return false; }
    function the_row() {}
    function reset_rows() {}
    function has_sub_field() { return false; }
    function get_sub_field() { return false; }
    function the_sub_field() {}
    function get_sub_field_object() { return false; }
    function acf_get_child_field_from_parent_field() { return false; }
    function register_field_group() {}
    function get_row_layout() { return false; }
    function acf_form_head() {}
    function acf_form() {}
    function update_field() { return false; }
    function delete_field() {}
    function create_field() {}
    function reset_the_repeater_field() {}
    function the_repeater_field() { return false; }
    function the_flexible_field() { return false; }
    function acf_filter_post_id($post_id) { return $post_id; }
}

// Add Open Graph meta tags for social sharing
function add_opengraph_namespace($output) {
    return $output . ' xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns# fb: http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'add_opengraph_namespace');

function add_opengraph_meta_tags() {
    global $post;
    
    if (is_single() || is_page()) {
        $img_src = '';
        $image_share = get_field('image_share', $post->ID);
        
        if ($image_share) {
            $img_src = $image_share['url'];
            $img_width = $image_share['width'];
            $img_height = $image_share['height'];
        } elseif (has_post_thumbnail($post->ID)) {
            $img_data = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
            $img_src = $img_data[0];
            $img_width = $img_data[1];
            $img_height = $img_data[2];
        }
        
        $excerpt = $post->post_content ? wp_trim_words(strip_shortcodes(strip_tags($post->post_content)), 55) : get_bloginfo('description');
        
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        if ($img_src) {
            echo '<meta property="og:image" content="' . esc_url($img_src) . '"/>';
            echo '<meta property="og:image:width" content="' . esc_attr($img_width) . '"/>';
            echo '<meta property="og:image:height" content="' . esc_attr($img_height) . '"/>';
        }
        echo '<meta property="og:description" content="' . esc_attr($excerpt) . '"/>';
        echo '<meta property="og:url" content="' . esc_url(get_the_permalink()) . '"/>';
        echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo()) . '"/>';
        echo '<meta property="article:published_time" content="' . esc_attr(date('c', strtotime($post->post_date_gmt))) . '"/>';
        echo '<meta property="article:modified_time" content="' . esc_attr(date('c', strtotime($post->post_date_gmt))) . '"/>';

        echo '<meta name="twitter:card" content="summary_large_image"/>';
        echo '<meta name="twitter:site" content="@' . esc_attr(get_bloginfo('name')) . '"/>';
        echo '<meta name="twitter:text:title" content="' . esc_attr(get_the_title()) . '"/>';
        echo '<meta name="twitter:url" content="' . esc_url(get_the_permalink()) . '"/>';
        echo '<meta name="twitter:text:description" content="' . esc_attr($excerpt) . '"/>';
        if ($img_src) {
            echo '<meta name="twitter:image" content="' . esc_url($img_src) . '"/>';
        }
    }
}
add_action('wp_head', 'add_opengraph_meta_tags', 5);


// Add custom body classes
add_filter('body_class', 'add_custom_body_class');

function add_custom_body_class($classes) {
    if (is_post_type_archive('project') || is_tax('project_category') || is_singular('project')) {
        $classes[] = 'color-theme-black';
    }
    return $classes;
}

// Get page ID by template
function get_template_page_id($template_name = '') {
    if (!$template_name) {
        return '';
    }
    
    $pages = new WP_Query(array(
        'post_type'     => 'page',
        'fields'        => 'ids',
        'nopaging'      => true,
        'meta_key'      => '_wp_page_template',
        'meta_value'    => $template_name,
    ));
    
    return !empty($pages->posts[0]) ? $pages->posts[0] : '';
}

// Allow SVG
function add_file_types_to_uploads($file_types){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');


// Nen logo login Page

add_action( 'login_head', 'true_change_login_logo' );
 
function true_change_login_logo() {
	echo '<style>
	#login h1 a{
		background-image : url(' . get_stylesheet_directory_uri() . '/assets/img/login-logo.jpg);
	}
	</style>';
}

add_filter('jpeg_quality', function($arg){return 100;});


// Disable WordPress' automatic image scaling feature
add_filter( 'big_image_size_threshold', '__return_false' );


add_filter( 'rank_math/frontend/breadcrumb/args', function( $args ) {
  $args = array(
    'delimiter'   => '&nbsp;/&nbsp;',
    'wrap_before' => '<nav class="rank-math-breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">',
    'wrap_after'  => '</nav>',
    'before'      => '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">',
    'after'       => '</span>',
  );
  return $args;
});


add_filter( 'rank_math/frontend/breadcrumb/html', function( $html, $crumbs, $class ) {
    ob_start(); 
?>
    <nav class="mkdf-container-inner breadcrumbs rank-math-breadcrumb" itemscope="" itemtype="https://schema.org/BreadcrumbList">
        <?php 
        $iii = 0;
        $summ = count($crumbs);
        foreach ($crumbs as $key => $crumb) {
            $iii++;
            ?>
            <?php if ($iii == $summ) { ?>
                <span itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                    <span class="last" itemprop="name"><?php echo esc_html($crumb[0]); ?></span>
                    <meta itemprop="position" content="<?php echo esc_attr($iii); ?>" />
                </span>
            <?php } else { ?>
                <span itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                    <a itemprop="item" href="<?php echo esc_url($crumb[1]); ?>">
                        <span itemprop="name"><?php echo esc_html($crumb[0]); ?></span>
                    </a>
                    <meta itemprop="position" content="<?php echo esc_attr($iii); ?>" />
                </span>
                <span class="separator"> / </span>
            <?php } ?>
        <?php } ?>
    </nav>
<?php
    return ob_get_clean();
}, 10, 3);



function is_blog () {
    return ( is_archive() || is_author() || is_category() || is_home() || is_tag()) && 'post' == get_post_type();
}


/**
* Gets and returns the contents of the SVG file, optionally adding a class.
*
* @param string $name The name of the SVG file (without extension).
* @param string $class An additional CSS class for the SVG (empty by default).
* @return string The cleaned SVG code, or an empty string if the file is not found.
*/

function get_svg($name, $class = '', $color = '') {
    $svg_path = get_template_directory() . "/assets/svg/{$name}.svg";

    if (!file_exists($svg_path)) {
        return '';
    }

    $svg = file_get_contents($svg_path);
    if ($svg === false) {
        return '';
    }

    libxml_use_internal_errors(true);

    $dom = new DOMDocument();
    $dom->loadXML($svg);

    $svgElement = $dom->getElementsByTagName('svg')->item(0);
    if ($svgElement && !empty($class)) {
        $svgElement->setAttribute('class', $class);
    }

    if (!empty($color)) {
        $xpath = new DOMXPath($dom);
        $xpath->registerNamespace("svg", "http://www.w3.org/2000/svg");
    
        $paths = $xpath->query("//svg:path[@fill='#01021E' or @fill='#02031E']");
    
        if ($paths->length === 0) {
            $paths = $xpath->query("//svg:path[not(@fill)]");
        }
    
        foreach ($paths as $path) {
            if ($path instanceof DOMElement) {
                $path->setAttribute('fill', $color);
            }
        }
    }

    return $dom->saveXML();
}


/**
 * Register a shortcode to display a Swiper slider
 * based on ACF Gallery field named "slider_images".
 *
 * Usage in content/ACF field: [hero_slider]
 */
function hero_slider_shortcode() {

    $slider_images = get_field('slider_images');
    
    if (empty($slider_images)) {
        return '';
    }

    ob_start(); 
    ?>
        <div class="hero-swiper__wrapper">
            <div class="swiper-container hero-swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($slider_images as $slider_image): ?>
                        <div class="swiper-slide">
                            <img 
                                src="<?php echo esc_url($slider_image['url']); ?>" 
                                alt="<?php echo esc_attr($slider_image['alt']); ?>"
                            >
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php
    return ob_get_clean();
}
add_shortcode('hero_slider', 'hero_slider_shortcode');

/**
 * Register a shortcode to display up to 3 static images 
 * based on the ACF Gallery field named "slider_images".
 *
 * Usage in content/ACF field: [static_images]
 */
function static_images_shortcode() {

    $images = get_field('static_images');

    if (empty($images)) {
        return '';
    }

    // Ограничиваем количество изображений (до 3)
    $images = array_slice($images, 0, 3);

    ob_start(); 
    ?>
    <div class="static-images">
        <ul class="static-images-list">
            <?php foreach ($images as $image): ?>
                <li>
                    <img 
                        src="<?php echo esc_url($image['url']); ?>" 
                        alt="<?php echo esc_attr($image['alt']); ?>"
                    >
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    <?php
    return ob_get_clean();
}
add_shortcode('static_images', 'static_images_shortcode');


/**
 * Register a shortcode to display an image 
 * based on the ACF field named "title_image" inside the group "decoration_title".
 *
 * Usage in content/ACF field: [title_image]
 */
function title_image_shortcode() {
    $decoration_group = get_field('decoration_title');

    if (empty($decoration_group) || empty($decoration_group['title_image'])) {
        return '';
    }
    $image = $decoration_group['title_image'];
    ob_start(); 
    ?>
        <div class="title_image">
            <img
                class="title_image-item" 
                src="<?php echo esc_url($image['url']); ?>" 
                alt="<?php echo esc_attr($image['alt']); ?>"
            >
        </div>
    <?php
    return ob_get_clean();
}

add_shortcode('title_image', 'title_image_shortcode');



/**
 * Generates a country selector list complete with flags for use within a Contact Form 7 form.
 *
 * This shortcode function provides an interactive list of countries, displays a default 
 * selected country (Ukraine) with a flag, and includes a hidden input field for Contact Form 7 submission. 
 * When a user clicks on a different country, both the visible label and the hidden input value 
 * update accordingly. This allows seamless integration with your CF7 forms and a more engaging user interface.
 *
 * @param array $atts  Optional shortcode attributes (currently unused).
 *
 * @return string      The HTML markup displaying a default selected country with its flag,
 *                     a list of available countries, and a hidden input for form submission.
 */
function custom_country_list_shortcode($atts) {
    $countries = [
        "Ukraine" => "ua",
        "USA" => "us",
        "Germany" => "de",
        "France" => "fr",
        "United Kingdom" => "gb",
        "Canada" => "ca",
        "Australia" => "au",
        "Japan" => "jp",
        "China" => "cn",
        "Brazil" => "br"
    ];

    // Define default country
    $defaultCountry = "Ukraine";
    $defaultCode = $countries[$defaultCountry];
    $defaultFlagUrl = "https://flagcdn.com/w40/$defaultCode.png";

    $output = '<div class="custom-country-list">';
    
    // Display default country with its flag
    $output .= '<p class="selected-country">
                    <img src="' . esc_url($defaultFlagUrl) . '" 
                         alt="' . esc_attr($defaultCountry) . '" 
                         class="flag-icon"> 
                    ' . esc_html($defaultCountry) . '
                </p>';
    
    $output .= '<ul>';

    foreach ($countries as $country => $code) {
        $flagUrl = "https://flagcdn.com/w40/$code.png"; 
        $output .= '<li data-country="' . esc_attr($country) . '">
                        <img src="' . esc_url($flagUrl) . '" 
                             alt="' . esc_attr($country) . '" 
                             class="flag-icon"> 
                        ' . esc_html($country) . '
                    </li>';
    }

    $output .= '</ul>';

    // Hidden input for CF7 submission, defaulting to Ukraine
    $output .= '<input type="hidden" name="country" 
                       id="selected-country" 
                       class="wpcf7-form-control wpcf7-hidden" 
                       value="' . esc_attr($defaultCountry) . '">';

    $output .= '</div>';

    return $output;
}

add_shortcode('country_list', 'custom_country_list_shortcode');




// Фильтр для обработки шорткодов внутри CF7
add_filter('wpcf7_form_elements', function ($content) {
    return do_shortcode($content);
});


/**
 * Filters out profanity from specified Contact Form 7 text fields by querying an external API.
 * This helps ensure that certain fields (e.g., "full-name" or "project-description") remain
 * free of inappropriate or offensive language. If the API detects any unwanted words,
 * the form submission is invalidated, prompting the user to correct the input before proceeding.
 *
 * @param WPCF7_Validation $result The current validation result object used by Contact Form 7.
 * @param WPCF7_FormTag    $tag    The form tag object for the field being validated.
 *
 * @return WPCF7_Validation         The updated validation result object, indicating success or error.
 */
function cf7_profanity_filter( $result, $tag ) {

    $fields_to_check = array(
        'user-name',
        'bottom-user-name',
    );

    foreach ($fields_to_check as $field) {
        if (isset($_POST[$field])) {
            $text = sanitize_text_field($_POST[$field]);

            // Send request to the API with parameter fill_char=*
            $api_url = 'https://www.purgomalum.com/service/json?fill_char=*&text=' . urlencode($text);
            $response = wp_remote_get($api_url);

            if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
                $body = wp_remote_retrieve_body($response);
                $cleaned_text = json_decode($body, true)['result'];

                // If the cleaned text differs, it means the API found inappropriate words
                if ($cleaned_text !== $text) {
                    $result->invalidate($field, "This field contains inappropriate words.");
                }
            }
        }
    }

    return $result;
}

add_filter('wpcf7_validate_text', 'cf7_profanity_filter', 10, 2);
add_filter('wpcf7_validate_text*', 'cf7_profanity_filter', 10, 2);

