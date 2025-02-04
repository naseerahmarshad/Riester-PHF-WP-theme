<?php
add_action('acf/init', 'register_custom_blocks');

function register_custom_blocks()
{
    if (!function_exists('acf_register_block_type')) {
        return;
    }

    // Register Hero block
    acf_register_block_type([
        'name' => 'hero-image-with-headline-and-cta',
        'title' => esc_html__('Hero Image with Headline and CTA', 'your-text-domain'),
        'description' => esc_html__('A custom Hero Image with Headline and CTA block.', 'your-text-domain'),
        'category' => 'formatting',
        'icon' => 'layout',
        'keywords' => ['hero', 'image', 'headline', 'cta'],
        'post_types' => ['post', 'page'],
        'mode' => 'auto',
        'render_template' => 'template-parts/blocks/hero-image-with-headline-and-cta.php',
        'supports'              => array(
            'align' => false, // Disables all alignment options
        ),
    ]);

    // Register Fifty-Fifty block
    acf_register_block_type([
        'name' => 'fifty-fifty-image-content-aside',
        'title' => esc_html__('50/50 Image Content Aside', 'your-text-domain'),
        'description' => esc_html__('A custom 50/50 image and content block.', 'your-text-domain'),
        'category' => 'formatting',
        'icon' => 'layout',
        'keywords' => ['fifty', 'image', 'content', 'aside'],
        'post_types' => ['post', 'page'],
        'mode' => 'auto',
        'render_template' => 'template-parts/blocks/fifty-fifty-image-content-aside.php',
    ]);

    // Register Form Fill block
    acf_register_block_type(array(
        'name'                     => 'form-fill',
        'title'                 => __('Form Fill'),
        'description'             => __('A custom Form Fill block.'),
        'category'                 => 'formatting',
        'icon'                    => 'layout',
        'keywords'                => array('form', 'fill'),
        'post_types'            => array('post', 'page'),
        'mode'                    => 'auto',
        'render_template'        => 'template-parts/blocks/form-fill.php',
        'supports'              => array(
            'align' => false, // Disables all alignment options
        ),
    ));

    // Register Accordion block
    // acf_register_block_type(array(
    //     'name'                     => 'accordion',
    //     'title'                 => __('Accordion'),
    //     'description'             => __('A custom Accordion block.'),
    //     'category'                 => 'formatting',
    //     'icon'                    => 'layout',
    //     'keywords'                => array('accordion'),
    //     'post_types'            => array('post', 'page'),
    //     'mode'                    => 'auto',
    //     // 'align'				=> 'wide',
    //     'render_template'        => 'template-parts/blocks/accordion.php',
    //     // 'render_callback'	=> 'accordion_block_render_callback',
    //     // 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/accordion/accordion.css',
    //     // 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/accordion/accordion.js',
    //     // 'enqueue_assets' 	=> 'accordion_block_enqueue_assets',
    // ));
    acf_register_block_type(array(
        'name'                     => 'interior-hero-image-with-headline',
        'title'                 => __('Interior Hero Image with Headline'),
        'description'             => __('A custom Interior Hero Image with Headline block.'),
        'category'                 => 'formatting',
        'icon'                    => 'layout',
        'keywords'                => array('interior', 'hero', 'image', 'with', 'headline'),
        'post_types'            => array('post', 'page'),
        'mode'                    => 'auto',
        // 'align'				=> 'wide',
        'render_template'        => 'template-parts/blocks/interior-hero-image-with-headline.php',
        // 'render_callback'	=> 'interior_hero_image_with_headline_block_render_callback',
        // 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/interior-hero-image-with-headline/interior-hero-image-with-headline.css',
        // 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/interior-hero-image-with-headline/interior-hero-image-with-headline.js',
        // 'enqueue_assets' 	=> 'interior_hero_image_with_headline_block_enqueue_assets',
        'supports'              => array(
            'align' => false, // Disables all alignment options)
        ),
    ));

    acf_register_block_type(array(
        'name'              => 'email-signup',
        'title'             => __('Email Signup'),
        'description'       => __('A block for email signup layout.'),
        'render_template'   => 'template-parts/blocks/email-signup.php',
        'category'          => 'layout',
        'icon'              => 'email-alt',
        'keywords'          => array('email', 'signup', 'form'),
        'supports'          => array(
            'align' => false, // Disable user alignment controls
        ),
        'align'             => 'full', // Set default alignment to full
    ));


    // Register Icon Content Callout block
    acf_register_block_type(array(
        'name'                     => 'icon-content-callout',
        'title'                 => __('Icon Content Callout'),
        'description'             => __('A custom Icon Content Callout block.'),
        'category'                 => 'formatting',
        'icon'                    => 'layout',
        'keywords'                => array('icon', 'content', 'callout'),
        'post_types'            => array('post', 'page'),
        'mode'                    => 'auto',
        'align'                => 'full',
        'render_template'        => 'template-parts/blocks/icon-content-callout.php',
        'supports'          => array(
            'align' => false, // Disable user alignment controls
        ),
    ));
}
