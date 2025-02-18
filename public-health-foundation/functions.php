<?php
/**
 * Public Health Foundation functions and definitions
 *
 */

 // Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if (!defined('phf_version')) {
    /*
     * Set the theme's version number.
     *
     * This is used primarily for cache busting. If you use `npm run bundle`
     * to create your production build, the value below will be replaced in the
     * generated zip file with a timestamp, converted to base 36.
     */
    define('phf_version', '0.1.0');
}

function phf_enqueue_jquery() {
    // Enqueue jQuery 
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'phf_enqueue_jquery');


function phf_theme_enqueue_assets() {
    // Enqueue the main theme stylesheet
    wp_enqueue_style(
        'phf-styles',
        get_stylesheet_uri(),
        array(),
        filemtime(get_stylesheet_directory() . '/style.css')
    );
    
    // Enqueue main JavaScript file
    // $script_path = get_stylesheet_directory() . '/assets/js/phf-scripts.min.js';
    // wp_enqueue_script(
    //     'phf-scripts',
    //     get_stylesheet_directory_uri() . '/assets/js/phf-scripts.min.js',
    //     array(),
    //     filemtime($script_path),
    //     true
    // );
}
add_action('wp_enqueue_scripts', 'phf_theme_enqueue_assets');


// Add assets for the Page and Post Editor
function phf_theme_enqueue_editor_assets() {
    wp_enqueue_style(
        'phf-editor-styles',
        get_stylesheet_uri(),
        array(),
        filemtime(get_stylesheet_directory() . '/editor.css')
    );
    
    // $script_path = get_stylesheet_directory() . '/assets/js/phf-scripts.min.js';
    // wp_enqueue_script(
    //     'phf-scripts',
    //     get_stylesheet_directory_uri() . '/assets/js/phf-scripts.min.js',
    //     array(),
    //     filemtime($script_path),
    //     true
    // );
}
add_action( 'enqueue_block_editor_assets', 'phf_theme_enqueue_editor_assets' );

// Add assets for the Block Editor
function phf_theme_enqueue_block_assets() {
    // Enqueue the main theme stylesheet for all block-related contexts
    wp_enqueue_style(
        'phf-editor-styles',
        get_stylesheet_uri(),
        array(),
        filemtime(get_stylesheet_directory() . '/editor.css')
    );

    // Enqueue JavaScript only in the block editor or site editor contexts
    // if (is_admin() || wp_should_load_block_editor_scripts_and_styles()) {
    //     $script_path = get_stylesheet_directory() . '/assets/js/phf-scripts.min.js';
    //     wp_enqueue_script(
    //         'phf-scripts',
    //         get_stylesheet_directory_uri() . '/assets/js/phf-scripts.min.js',
    //         array(),
    //         filemtime($script_path),
    //         true
    //     );
    // }
}
add_action( 'enqueue_block_assets', 'phf_theme_enqueue_block_assets' );




// Add phf-theme class to body
function add_phf_theme_body_class($classes) {
    $classes[] = 'phf-theme';
    return $classes;
}
add_filter('body_class', 'add_phf_theme_body_class');

function add_editor_styles() {
    add_theme_support('editor-styles');
    add_editor_style('editor.css');
}
add_action('after_setup_theme', 'add_editor_styles');

function phf_register_menus() {
    register_nav_menus([
        'primary' => __('Primary Menu', 'public-health-foundation'),
        'footer'  => __('Footer Menu', 'public-health-foundation'), // Optional: Add more locations as needed
    ]);
}

add_action('after_setup_theme', 'phf_register_menus');

//Function to show a descriptive error if a required file is missing
function phf_theme_error($file) {
    wp_die(
        sprintf(
            'Error: The required file <strong>%s</strong> is missing from the theme. Please ensure all required files are present in the <code>inc</code> directory.',
            esc_html($file)
        ),
        'Missing Theme File',
        ['back_link' => true]
    );
}

// Array of required files in the 'inc' directory
$required_files = [
    'custom-post-types', // Empty for now, but included for structure
    'patterns/patterns', // Register custom patterns
    'riester-dev/dev-admin',  // Include the dev-admin file
    'riester-dev/page-functions',  // Include the page functions file
    'acf/blocks',
    'gravity-forms'
];

// Load each file and handle errors if a file is missing
foreach ($required_files as $file) {
    $file = "inc/{$file}.php";
    if (!locate_template($file, true, true)) {
        phf_theme_error(sprintf('Error locating <code>%s</code> for inclusion.', $file), 'File not found');
    }
}


// Register ACF Blocks
add_action('init', 'register_acf_blocks');
function register_acf_blocks(){
    register_block_type(__DIR__ . '/blocks/accordion');
}

// Swiper Slider ACF Blocks
add_action('init', 'register_acf_blocks_swiper_slider');
function register_acf_blocks_swiper_slider(){
    register_block_type(__DIR__ . '/blocks/swiper-slider');
}

// form-fillv2
add_action('init', 'register_acf_blocks_form_fillv2');
function register_acf_blocks_form_fillv2(){
    register_block_type(__DIR__ . '/blocks/form-fillv2');
}

// Events Slider ACF Blocks
add_action('init', 'register_acf_blocks_events_slider');
function register_acf_blocks_events_slider(){
    register_block_type(__DIR__ . '/blocks/events-slider');
}

// Hot Topics Slider ACF Blocks
add_action('init', 'register_acf_blocks_hot_topics_slider');
function register_acf_blocks_hot_topics_slider(){
    register_block_type(__DIR__ . '/blocks/hot-topics-slider');
}

// Related Posts ACF Blocks
add_action('init', 'register_acf_blocks__related_posts');
function register_acf_blocks__related_posts(){
    register_block_type(__DIR__ . '/blocks/related-posts');
}

// Four Column Logo / CTAs Slider ACF Blocks
add_action('init', 'register_acf_blocks__logo_cta_slider');
function register_acf_blocks__logo_cta_slider(){
    register_block_type(__DIR__ . '/blocks/logo-cta-slider');
}

// HEADER NAVBAR styles
function headernavbar_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'phf-headernavbar-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/_header-navbar.scss', 
        array(), 
        '1.0.0'
    );
}

function headernavbar_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'phf-headernavbar-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/_header-navbar.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'headernavbar_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'headernavbar_style_enqueue_editor_styles'); // Editor


// wp-block-button styles
function wp_block_button_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'custom-block-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_wp-block-button.scss', 
        array(), 
        '1.0.0'
    );
}

function wp_block_button_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'custom-block-editor-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_wp-block-button.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'wp_block_button_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'wp_block_button_enqueue_editor_styles'); // Editor


// Image with content aside styles
function image_with_content_aside_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'image-with-content-aside-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_image-with-content-aside.scss', 
        array(), 
        '1.0.0'
    );
}

function image_with_content_aside_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'image-with-content-aside-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_image-with-content-aside.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'image_with_content_aside_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'image_with_content_aside_enqueue_editor_styles'); // Editor


// formfill styles
function formfillstyle_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'formfill-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_form-fillv2.scss', 
        array(), 
        '1.0.0'
    );
}

function formfillstyle_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'formfill-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_form-fillv2.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'formfillstyle_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'formfillstyle_enqueue_editor_styles'); // Editor


// Add custom wrappers for gf_left_half and gf_rightcol classes in Block Editor and Frontend
function add_custom_wrappers_inline() {
    // Check if we are in the Block Editor or Frontend
    if (is_admin() || is_singular() || is_page()) {
        // Inline JavaScript
        $inline_script = "
            jQuery(document).ready(function ($) {
                $('#gform_fields_3.gform_fields').append('<div class=\"gf_rightcol-wrapper-leftcol\"></div>');
                $('#gform_fields_3.gform_fields').append('<div class=\"gf_rightcol-wrapper-rightcol\"></div>');
                $('#gform_fields_3.gform_fields > .gf_left_half').appendTo('div.gf_rightcol-wrapper-leftcol');
                $('#gform_fields_3.gform_fields > .gf_rightcol').appendTo('div.gf_rightcol-wrapper-rightcol');
            });
        ";

        // Enqueue the script inline
        wp_add_inline_script('jquery', $inline_script);
    }
}
add_action('enqueue_block_editor_assets', 'add_custom_wrappers_inline'); // For Block Editor
add_action('wp_enqueue_scripts', 'add_custom_wrappers_inline'); // For Frontend


// Form fill full page styles
function formfillfullpage_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'formfillfullpage-style', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_formfillfullpage.scss',
        array(), 
        '1.0.0'
    );
}

function formfillfullpage_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'formfillfullpage-style', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_formfillfullpage.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'formfillfullpage_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'formfillfullpage_style_enqueue_editor_styles'); // Editor


// 2/3 Blue Action Item styles
function twobythree_blue_action_item_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'twobythree_blue_action_item-style', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_2by3-blue-action-item.scss', 
        array(), 
        '1.0.0'
    );
}

function twobythree_blue_action_item_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'twobythree_blue_action_item-style', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_2by3-blue-action-item.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'twobythree_blue_action_item_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'twobythree_blue_action_item_style_enqueue_editor_styles'); // Editor


// 2/3 Yellow Action Item styles
function twobythree_yellow_action_item_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'twobythree_yellow_action_item-style', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_2by3-yellow-action-item.scss', 
        array(), 
        '1.0.0'
    );
}

function twobythree_yellow_action_item_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'twobythree_yellow_action_item-style', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_2by3-yellow-action-item.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'twobythree_yellow_action_item_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'twobythree_yellow_action_item_style_enqueue_editor_styles'); // Editor


// Add buttons to the MODULE: 3 Column Tiles Image/Text/CTA
function add_col_tiles_image_txt_cta_scripts() {
    // Check if we are in the Block Editor or Frontend
    if (is_admin() || is_singular() || is_page()) {
        // Inline JavaScript
        $inline_script = "
            jQuery(document).ready(function ($) {
                $('.phf-col-tiles-image-txt-cta-wrapper .wp-block-latest-posts__list').each(function () {
                    var posts = $(this).find('li');
                    posts.each(function () {
                        var link = $(this).find('a');
                        if (link.length > 0) {
                            // Create the button
                            var button = $('<a></a>', {
                                href: link.attr('href'),
                                text: 'Subscribe',
                                class: 'wp-block-button__link',
                            });

                            // Create the wrapper and append the button
                            var buttonWrapper = $('<div></div>', {
                                class: 'wp-block-buttons',
                            }).append(
                                $('<div></div>', { class: 'wp-block-button' }).append(button)
                            );

                            // Append the wrapper to the <li>
                            $(this).append(buttonWrapper);
                        }
                    });
                });
            });
        ";

        // Enqueue the script inline
        wp_add_inline_script('jquery', $inline_script);
    }
}
add_action('enqueue_block_editor_assets', 'add_col_tiles_image_txt_cta_scripts'); // For Block Editor
add_action('wp_enqueue_scripts', 'add_col_tiles_image_txt_cta_scripts'); // For Frontend


// Column Tiles Image/Text/CTA styles
function col_tiles_image_txt_cta_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'col-tiles-image-txt-cta-style', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_col-tiles-image-txt-cta.scss', 
        array(), 
        '1.0.0'
    );
}

function col_tiles_image_txt_cta_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'col-tiles-image-txt-cta-style', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_col-tiles-image-txt-cta.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'col_tiles_image_txt_cta_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'col_tiles_image_txt_cta_style_enqueue_editor_styles'); // Editor


// Add buttons to the MODULE: Related Articles with Testimonial
function add_related_articles_with_testimonial_scripts() {
    // Check if we are in the Block Editor or Frontend
    if (is_admin() || is_singular() || is_page()) {
        // Inline JavaScript
        $inline_script = "
            jQuery(document).ready(function ($) {
                $('.phf-related-articles-with-testimonial-wrapper .wp-block-latest-posts__list').each(function () {
                    var posts = $(this).find('li');
                    posts.each(function () {
                        var link = $(this).find('a');
                        if (link.length > 0) {
                            // Create the button
                            var button = $('<a></a>', {
                                href: link.attr('href'),
                                text: 'Learn more',
                                class: 'wp-block-button__link',
                            });

                            // Create the wrapper and append the button
                            var buttonWrapper = $('<div></div>', {
                                class: 'wp-block-buttons',
                            }).append(
                                $('<div></div>', { class: 'wp-block-button' }).append(button)
                            );

                            // Append the wrapper to the <li>
                            $(this).append(buttonWrapper);
                        }
                    });
                });
            });
        ";

        // Enqueue the script inline
        wp_add_inline_script('jquery', $inline_script);
    }
}
add_action('enqueue_block_editor_assets', 'add_related_articles_with_testimonial_scripts'); // For Block Editor
add_action('wp_enqueue_scripts', 'add_related_articles_with_testimonial_scripts'); // For Frontend


// Related Articles with Testimonial styles
function related_articles_with_testimonial_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'related-articles-with-testimonial', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_related-articles-with-testimonial.scss', 
        array(), 
        '1.0.0'
    );
}

function related_articles_with_testimonial_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'related-articles-with-testimonial', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_related-articles-with-testimonial.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'related_articles_with_testimonial_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'related_articles_with_testimonial_style_enqueue_editor_styles'); // Editor


// MODULE: Pop up styles
function phf_module_popup_wrapper_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'phf-module-popup-wrapper-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_phf-module-popup-wrapper.scss', 
        array(), 
        '1.0.0'
    );
}

function phf_module_popup_wrapper_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'phf-module-popup-wrapper-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_phf-module-popup-wrapper.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'phf_module_popup_wrapper_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'phf_module_popup_wrapper_style_enqueue_editor_styles'); // Editor


// Add Pop up close script
function add_popup_wrapper_scripts() {
    // Check if we are in the Block Editor or Frontend
    if (is_admin() || is_singular() || is_page()) {
        // Inline JavaScript
        $inline_script = "
            jQuery(document).ready(function ($) {
                // Check if the popup wrapper exists
                if ($('.phf-module-popup-wrapper').length) {
                    $('.phf-module-popup-wrapper__closebtn, .phf-module-popup-wrapper__closebtn a').click(function (event) {
                        event.preventDefault();
                        $('.phf-module-popup-wrapper').fadeOut(500);
                    });
                }
            });
        ";

        // Enqueue the script inline
        wp_add_inline_script('jquery', $inline_script);
    }
}
add_action('enqueue_block_editor_assets', 'add_popup_wrapper_scripts'); // For Block Editor
add_action('wp_enqueue_scripts', 'add_popup_wrapper_scripts'); // For Frontend


// Interior Hero MODULE: 2 Column Tiles - Headline and Text with Headline styles
function phf_interior_hero_module_2_column_tiles_headline_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'phf-interior-hero-module-2-column-tiles-headline-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_interior-hero-module-2-column-tiles-headline.scss', 
        array(), 
        '1.0.0'
    );
}

function phf_interior_hero_module_2_column_tiles_headline_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'phf-interior-hero-module-2-column-tiles-headline-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_interior-hero-module-2-column-tiles-headline.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'phf_interior_hero_module_2_column_tiles_headline_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'phf_interior_hero_module_2_column_tiles_headline_style_enqueue_editor_styles'); // Editor


// Image with content Right side styles
function image_with_content_right_side_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'phf-image-with-content-right-sidestyles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_image-with-content-right-side.scss', 
        array(), 
        '1.0.0'
    );
}

function image_with_content_right_side_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'phf-image-with-content-right-sidestyles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_image-with-content-right-side.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'image_with_content_right_side_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'image_with_content_right_side_style_enqueue_editor_styles'); // Editor


// Form MODULE: 3 Column Tiles - Link, Description Fill styles
function three_column_tiles_link_description_fill_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'three-column-tiles-link-description-fill-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_three-column-tiles-link-description-fill.scss', 
        array(), 
        '1.0.0'
    );
}

function three_column_tiles_link_description_fill_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'three-column-tiles-link-description-fill-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_three-column-tiles-link-description-fill.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'three_column_tiles_link_description_fill_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'three_column_tiles_link_description_fill_style_enqueue_editor_styles'); // Editor


// MODULE: 4 Column Logo/CTAs styles
function four_column_logo_ctas_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'four-column-logo-ctas-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_four-column-logo-ctas.scss', 
        array(), 
        '1.0.0'
    );
}

function four_column_logo_ctas_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'four-column-logo-ctas-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_four-column-logo-ctas.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'four_column_logo_ctas_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'four_column_logo_ctas_style_enqueue_editor_styles'); // Editor


//swiper slider for block
function enqueue_swiperslide_block() {
    if (is_singular() || is_page()) {
        $content = apply_filters('the_content', get_the_content());
        if (strpos($content, 'swiper-slider-slider') !== false) {
            wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), null);
            wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);
            wp_add_inline_script('swiper-js', "
                document.addEventListener('DOMContentLoaded', function() {
                    new Swiper('.phf-image-with-content-aside .phf-custom-swiperslider, .phf-related-articles-with-testimonial-wrapper_slider .phf-custom-swiperslider', {
                        autoplay: {
                            delay: 4000,
                            disableOnInteraction: false,
                        },
                        pagination: {
                            el: '.swiper-pagination',
                        },
                    });

                    new Swiper('.phf-four-column-logo-ctas-wrapper .phf-custom-swiperslider', {
                        slidesPerView: 1,
                        delay: 5000,
                        disableOnInteraction: false,
                        loop: false,
                        pagination: {
                            el: '.swiper-pagination',
                        },
                        breakpoints: {
                            640: {
                                slidesPerView: 1,
                                spaceBetween: 28,
                            },
                            768: {
                                slidesPerView: 2,
                                spaceBetween: 28,
                            },
                            1024: {
                                slidesPerView: 4,
                                spaceBetween: 28,
                            },
                        },
                    });

                    //MODULE: Video Course slider
                    // Initialize the secondary slider
                    var secondarySlider = new Swiper('.phf-module-video-course-wrapper__secondaryslider .swiper', {
                        spaceBetween: 10,
                        slidesPerView: 1,
                    });

                    // Initialize the main slider
                    var mainSlider = new Swiper('.phf-module-video-course-wrapper__slider', {
                        spaceBetween: 10,
                        pagination: {
                            clickable: true,
                            el: '.swiper-pagination',
                        },
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                        thumbs: {
                            swiper: secondarySlider, // Link the secondary slider
                        },
                    });

                    // Synchronize secondary slider's drag/swipe with the main slider
                    secondarySlider.on('slideChange', function () {
                        mainSlider.slideTo(secondarySlider.activeIndex); // Update main slider's active slide
                    });

                    // Synchronize main slider's drag/swipe with the secondary slider
                    mainSlider.on('slideChange', function () {
                        secondarySlider.slideTo(mainSlider.activeIndex); // Update secondary slider's active slide
                    });

                    //Events slider
                    new Swiper('.phf-events-swiper-slider', {
                        slidesPerView: 1,
                        spaceBetween: 28,
                        delay: 5000,
                        disableOnInteraction: false,
                        loop: true,
                        pagination: {
                            clickable: true,
                            el: '.swiper-pagination',
                        },
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                        breakpoints: {
                            640: {
                                slidesPerView: 1,
                            },
                            768: {
                                slidesPerView: 2,
                            },
                            1024: {
                                slidesPerView: 3,
                            },
                        },
                    });

                    //Hot Topics Slider
                    new Swiper('.phf-hot-topics-swiper-slider', {
                        slidesPerView: 1,
                        spaceBetween: 28,
                        delay: 5000,
                        disableOnInteraction: false,
                        loop: true,
                        pagination: {
                            clickable: true,
                            el: '.swiper-pagination',
                        },
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                        breakpoints: {
                            640: {
                                slidesPerView: 1,
                            },
                            768: {
                                slidesPerView: 2,
                            },
                            1024: {
                                slidesPerView: 3,
                            },
                        },
                    });
                });
            ");
        }
    }
}
add_action('wp_enqueue_scripts', 'enqueue_swiperslide_block');


// Header Navbar scripts
function header_navbarscript() {
    $inline_script = "
        jQuery(document).ready(function ($) {
            $('.phf-header-navbar').append('<div class=\"navbarsearch-btn\"></div>');
            $('.phf-header-navbar__secondrow').append('<button class=\"menuopen-btn\"></button>');

            $('.navbarsearch-btn').click(function() {
                $('.phf-header-navbar__searchfield.wp-block-search').toggleClass('phf-header-navbar__searchfield-active');
                $('.navbarsearch-btn').toggleClass('navbarsearch-btn-opened');
            });

            $('.menuopen-btn').click(function() {
                $(this).toggleClass('mobile-menu-open');
                $('.wp-block-navigation__responsive-container').toggleClass('fullmobilemenu-open');
            });

            // Adding three dots to the Search placeholder
            $('.phf-header-navbar__menunavigation .wp-block-search__input').attr('placeholder', 'Search...');

            // Fix for submenu toggle on click
            $('.wp-block-navigation__submenu-icon').click(function (e) {
                e.preventDefault();
                e.stopPropagation(); // Prevents event bubbling

                var \$submenu = $(this).closest('li').children('ul').first(); // Gets only the immediate child <ul>

                if (\$submenu.length) {
                    if (\$submenu.find('.backmenu-btn').length === 0) {
                        \$submenu.prepend('<button class=\"backmenu-btn\">Back</button>');
                    }
                    \$submenu.toggleClass('opensubmenu-level1');
                }
            });

            // Back button functionality
            $(document).on('click', '.backmenu-btn', function () {
                $(this).parent().removeClass('opensubmenu-level1');
            });

            //Add the wp-block-button__link__active class to the active link when the same webpage is opened
            // Get the current page URL
            var currentURL = window.location.href;

            // Loop through all button links and check if href matches current URL
            $('.wp-block-button a').each(function () {
                if ($(this).attr('href') === currentURL) {
                    $(this).addClass('wp-block-button__link__active');
                }
            });
        });
    ";

    // Enqueue the script inline
    wp_add_inline_script('jquery', $inline_script);
}
add_action('enqueue_block_editor_assets', 'header_navbarscript'); // For Block Editor
add_action('wp_enqueue_scripts', 'header_navbarscript'); // For Frontend



// MODULE: Video Course styles
function module_video_course_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'phf-module-video-course', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_module-video-course.scss', 
        array(), 
        '1.0.0'
    );
}

function module_video_course_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'phf-module-video-course', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_module-video-course.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'module_video_course_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'module_video_course_style_enqueue_editor_styles'); // Editor


// FOOTER styles
function footer_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'phf-footer-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/_footer.scss', 
        array(), 
        '1.0.0'
    );
}

function footer_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'phf-footer-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/_footer.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'footer_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'footer_style_enqueue_editor_styles'); // Editor


// 1/3 Quick Links styles
function one_three_quick_links_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'one-three-quick-links-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_one-three-quick-links.scss', 
        array(), 
        '1.0.0'
    );
}

function one_three_quick_links_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'one-three-quick-links-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_one-three-quick-links.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'one_three_quick_links_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'one_three_quick_links_style_enqueue_editor_styles'); // Editor


// 1/3 Image - 1/3 Copy
function one_three_image_one_three_copy_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'one-three-image-one-three-copy-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_one-three-image-one-three-copy.scss', 
        array(), 
        '1.0.0'
    );
}

function one_three_image_one_three_copy_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'one-three-image-one-three-copy-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_one-three-image-one-three-copy.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'one_three_image_one_three_copy_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'one_three_image_one_three_copy_style_enqueue_editor_styles'); // Editor


// 1/3 Copy - 1/3 Image
function one_three_copy_one_three_image_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'one-three-copy-one-three-image-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_one-three-copy-one-three-image.scss', 
        array(), 
        '1.0.0'
    );
}

function one_three_copy_one_three_image_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'one-three-copy-one-three-image-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_one-three-copy-one-three-image.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'one_three_copy_one_three_image_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'one_three_copy_one_three_image_style_enqueue_editor_styles'); // Editor


// 2/3 Copy
function two_three_copy_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'two-three-copy-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_two-three-copy.scss', 
        array(), 
        '1.0.0'
    );
}

function two_three_copy_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'two-three-copy-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_two-three-copy.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'two_three_copy_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'two_three_copy_style_enqueue_editor_styles'); // Editor


// MODULE: Full Width Text
function module_full_width_text_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'module-full-width-text-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_full-width-text.scss', 
        array(), 
        '1.0.0'
    );
}

function module_full_width_text_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'module-full-width-text-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_full-width-text.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'module_full_width_text_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'module_full_width_text_style_enqueue_editor_styles'); // Editor



// MODULE: Blog Template
function blog_template_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'blog-template-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_blog-template.scss', 
        array(), 
        '1.0.0'
    );
}

function blog_template_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'blog-template-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_blog-template.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'blog_template_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'blog_template_style_enqueue_editor_styles'); // Editor


// MODULE: Blog Template
function module_3_item_content_feature_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'module-3-item-content-feature-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_module-3-item-content-feature.scss', 
        array(), 
        '1.0.0'
    );
}

function module_3_item_content_feature_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'module-3-item-content-feature-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_module-3-item-content-feature.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'module_3_item_content_feature_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'module_3_item_content_feature_style_enqueue_editor_styles'); // Editor


// 2/3 Image
function two_three_image_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'two-three-imagestyles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_two-three-image.scss', 
        array(), 
        '1.0.0'
    );
}

function two_three_image_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'two-three-imagestyles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_two-three-image.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'two_three_image_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'two_three_image_style_enqueue_editor_styles'); // Editor



// Events Slider
function events_slider_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'events-slider-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_events-slider.scss', 
        array(), 
        '1.0.0'
    );
}

function events_slider_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'events-slider-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_events-slider.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'events_slider_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'events_slider_style_enqueue_editor_styles'); // Editor


// Register Custom Post Type Events
function create_events_cpt() {

    $labels = array(
        'name' => _x( 'Events', 'Post Type General Name', 'events' ),
        'singular_name' => _x( 'Event', 'Post Type Singular Name', 'events' ),
        'menu_name' => _x( 'Events', 'Admin Menu text', 'events' ),
        'name_admin_bar' => _x( 'Event', 'Add New on Toolbar', 'events' ),
        'archives' => __( 'Event Archives', 'events' ),
        'attributes' => __( 'Event Attributes', 'events' ),
        'parent_item_colon' => __( 'Parent Event:', 'events' ),
        'all_items' => __( 'All Events', 'events' ),
        'add_new_item' => __( 'Add New Event', 'events' ),
        'add_new' => __( 'Add New', 'events' ),
        'new_item' => __( 'New Event', 'events' ),
        'edit_item' => __( 'Edit Event', 'events' ),
        'update_item' => __( 'Update Event', 'events' ),
        'view_item' => __( 'View Event', 'events' ),
        'view_items' => __( 'View Events', 'events' ),
        'search_items' => __( 'Search Event', 'events' ),
        'not_found' => __( 'Not found', 'events' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'events' ),
        'featured_image' => __( 'Featured Image', 'events' ),
        'set_featured_image' => __( 'Set featured image', 'events' ),
        'remove_featured_image' => __( 'Remove featured image', 'events' ),
        'use_featured_image' => __( 'Use as featured image', 'events' ),
        'insert_into_item' => __( 'Insert into Event', 'events' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Event', 'events' ),
        'items_list' => __( 'Events list', 'events' ),
        'items_list_navigation' => __( 'Events list navigation', 'events' ),
        'filter_items_list' => __( 'Filter Events list', 'events' ),
    );
    $args = array(
        'label' => __( 'Event', 'events' ),
        'description' => __( 'Events for PHF', 'events' ),
        'labels' => $labels,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'author', 'comments', 'trackbacks', 'page-attributes', 'post-formats', 'custom-fields'),
        'taxonomies' => array(),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'exclude_from_search' => false,
        'show_in_rest' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type( 'events', $args );

}
add_action( 'init', 'create_events_cpt', 0 );



// Create Shortcode eventslider_shortcode
// Shortcode: [eventslider_shortcode]
function create_eventslider_shortcode($attr)
{
    ob_start();

    // Custom WP query for 'eventslider'
    $args_eventsliderquery = array(
        'post_type'      => 'events',
        'posts_per_page' => 20,
        'order'          => 'DESC',
    );

    $eventsliderquery = new WP_Query($args_eventsliderquery); ?>

    <section class="phf-events-slider-wrapper__swiper-slider">
        <div class="swiper-slider-slider">
            <div class="swiper phf-events-swiper-slider">
                <div class="swiper-wrapper">
                    <?php if ($eventsliderquery->have_posts()) : ?>
                        <?php while ($eventsliderquery->have_posts()) : $eventsliderquery->the_post(); ?>
                            <div class="swiper-slide">
                                <div class="phf-events-slider-wrapper__eventcard">
                                    <h3 class="phf-events-slider-wrapper__eventcard__title">
                                        <?php the_title(); ?>
                                    </h3>
                                    <div class="phf-events-slider-wrapper__dates-location">
                                        <div class="phf-events-slider-wrapper__location">
                                            <?php echo esc_html(get_field('location')); ?>
                                        </div>
                                        <div class="phf-events-slider-wrapper__dates">
                                            <h4><?php echo esc_html(get_field('month')); ?></h4>
                                            <h3><?php echo esc_html(get_field('event_dates')); ?></h3>
                                        </div>
                                    </div>
                                    <div class="phf-events-slider-wrapper__background">
                                        <?php $background = get_field('background'); ?>
                                        <?php if ($background) : ?>
                                            <img src="<?php echo esc_url($background['url']); ?>" alt="<?php echo esc_attr($background['alt']); ?>" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <p>No events found.</p>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
                <div class="swiper-pagination"></div>
                <div class="phf-events-slider-wrapper__navigations">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </section>

<?php
    return ob_get_clean();
}
add_shortcode('eventslider_shortcode', 'create_eventslider_shortcode');


// MODULE: In-Body Page NAV
function in_body_page_nav_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'in-body-page-nav-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_in-body-page-nav.scss', 
        array(), 
        '1.0.0'
    );
}

function in_body_page_nav_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'in-body-page-nav-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_in-body-page-nav.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'in_body_page_nav_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'in_body_page_nav_style_enqueue_editor_styles'); // Editor


// [alternating_list] shortcode
function alternating_list_shortcode() {
	ob_start();
	// get_template_part('alternating-list');
	?>

	<?php
	// Fetch posts with WP_Query
	$args = array(
		'post_type'      => 'post', // Change to custom post type if needed
		'posts_per_page' => 10, // Adjust as needed
		'orderby'        => 'date',
		'order'          => 'DESC',
	);
	$query = new WP_Query($args);
	?>

	<?php if ($query->have_posts()) : ?>
		<div class="phf-alternating-list-wrapper__container">
			<div class="phf-alternating-list-wrapper__categoryfilter">
                <h3>Categories</h3>
				<button class="filter-btn active" data-category="all">All</button>
				<?php
				$categories = get_categories(array('hide_empty' => false)); // Include categories with zero posts
				foreach ($categories as $category) {
					echo '<button class="filter-btn" data-category="' . $category->slug . '">' . $category->name . '</button>';
				}
				?>
			</div>

			<div id="post-list">
				<?php
				$count = 0;
				while ($query->have_posts()) : $query->the_post();
					$count++;
					$post_categories = get_the_category();
					$category_slug = !empty($post_categories) ? $post_categories[0]->slug : '';
					?>
					<div class="phf-alternating-list-wrapper__post-item post-item <?php echo $count % 2 == 0 ? 'even' : 'odd'; ?>" data-category="<?php echo $category_slug; ?>">
						<div class="phf-alternating-list-wrapper__post-meta">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p class="phf-alternating-list-wrapper__post-date"><?php echo get_the_date(); ?></p>
						</div>
						<div class="phf-alternating-list-wrapper__post-excerpt">
							<?php the_excerpt(); ?>
						</div>
						<a href="<?php the_permalink(); ?>" class="phf-alternating-list-wrapper__site-link">Continue Reading</a>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	<?php endif;
	wp_reset_postdata();
	?>


    <?php return ob_get_clean();
}
add_shortcode('alternating_list', 'alternating_list_shortcode');


// alternating_list attach inline JS script
function alternating_list_script() {
    // Register a new script handle
    wp_register_script('jscodescript', '', [], false, true);

    $inline_script = "
        document.addEventListener('DOMContentLoaded', function () {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const posts = document.querySelectorAll('.post-item');

            // Hide the 'All' button
            const allButton = document.querySelector(\".filter-btn[data-category='all']\");
            if (allButton) {
                allButton.style.display = 'none';
            }

            // Select the first category button and trigger click event
            if (filterButtons.length > 1) {
                let firstCategoryButton = filterButtons[1]; // Skip the 'All' button (index 0)
                firstCategoryButton.classList.add('active');
                let firstCategory = firstCategoryButton.getAttribute('data-category');

                // Show only posts from the first category
                posts.forEach(post => {
                    let postCategory = post.getAttribute('data-category');
                    post.style.display = postCategory === firstCategory ? 'block' : 'none';
                });
            }

            // Add event listener to filter buttons
            filterButtons.forEach(button => {
                button.addEventListener('click', function () {
                    let selectedCategory = this.getAttribute('data-category');

                    // Update active state for buttons
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    // Filter posts based on category
                    posts.forEach(post => {
                        let postCategory = post.getAttribute('data-category');
                        post.style.display = postCategory === selectedCategory ? 'block' : 'none';
                    });
                });
            });
        });
    ";

    // Enqueue the registered script
    wp_enqueue_script('jscodescript');

    // Attach inline script to the registered handle
    wp_add_inline_script('jscodescript', $inline_script);
}
add_action('wp_enqueue_scripts', 'alternating_list_script');


// MODULE: Alternating List
function alternating_list_style_enqueue() {
    // Frontend styles
    wp_enqueue_style(
        'alternating-list-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_alternating-list.scss', 
        array(), 
        '1.0.0'
    );
}

function alternating_list_style_enqueue_editor_styles() {
    // Editor styles
    wp_enqueue_style(
        'alternating-list-styles', 
        get_stylesheet_directory_uri() . '/src/sass/theme/blocks/_alternating-list.scss', 
        array(), 
        '1.0.0'
    );
}

add_action('wp_enqueue_scripts', 'alternating_list_style_enqueue'); // Frontend
add_action('enqueue_block_editor_assets', 'alternating_list_style_enqueue_editor_styles'); // Editor