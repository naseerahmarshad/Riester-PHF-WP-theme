<?php

/**
 * Block template file: template-parts/blocks/hero-image-with-headline-and-cta.php
 *
 * Hero Image With Headline And Cta Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'hero-image-with-headline-and-cta-' . $block['id'];
if (! empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-hero-image-with-headline-and-cta';
if (! empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (! empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}
$id = esc_attr($id);
$classes = esc_attr($classes);

$hero_background_image = get_field('hero_background_image');
$size = 'full';
$hero_background_image = $hero_background_image ? wp_get_attachment_image($hero_background_image, $size, false, ['class' => 'object-cover w-full h-full']) : '';

$title = get_field('title');
$copy = get_field('copy', false, false); // Added false, false to prevent formatting
$button_label = get_field('button_label');
$button_url = get_field('button_url');
?>

<style type="text/css">
    <?php echo '#' . $id; ?> {
        /* Add styles that use ACF values here */
    }
</style>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?> mx-0 vw-mx-0 w-screen">
    <div class="hero-image-with-headline-and-cta relative my-test-block bg-gray-900 text-white py-8 w-full">
        <?php if ($hero_background_image): ?>
            <figure class="absolute inset-0 w-full h-full min-h-[600px]">
                <?php echo $hero_background_image; ?>
            </figure>
        <?php endif; ?>

        <div class=" container py-8 px-wp sm:p-10 md:p-12 lg:p-14">
            <div class="headline-cta relative w-full sm:w-8/12">
                <h1 class="wp-block-heading text-left font-bold mb-4 font-h1">
                    <?php echo esc_html($title); ?>
                </h1>

                <div class="hero-copy text-white text-normal mb-6" style="font-size:clamp(14.642px, 0.915rem + ((1vw - 3.2px) * 0.812), 22px);font-style:normal;font-weight:300;line-height:1.5">
                    <?php echo wp_kses_post($copy); ?>
                </div>
                <div class="phf-button phf-button--yellow">
                <a href="<?php echo esc_url($button_url); ?>" class="text-black no-underline">
                    <?php echo esc_html($button_label); ?>
                </a>
                </div>
            </div>
        </div>
    </div>
</div>
