<?php

/**
 * Block template file: template-parts/blocks/interior-hero-image-with-headline.php
 *
 * Interior Hero Image With Headline Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'interior-hero-image-with-headline-' . $block['id'];
if (! empty($block['anchor'])) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-interior-hero-image-with-headline relative bg-blue-900 text-white alignfull mx-0 vw-mx-0 w-screen d';
if (! empty($block['className'])) {
  $classes .= ' ' . $block['className'];
}
if (! empty($block['align'])) {
  $classes .= ' align' . $block['align'];
}

// ACF Fields 
$title = get_field('title');
$background_image = get_field('background_image');
$size = 'full';
?>

<style type="text/css">
  <?php echo '#' . $id; ?> {
    /* Add styles that use ACF values here */
  }
</style>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?> mx-0 vw-mx-0 w-screen">
  <div class="hero-image-with-headline relative  text-white py-8 w-full">
    <?php if ($background_image): ?>
      <figure class="absolute inset-0 w-full">
        <?php echo wp_get_attachment_image($background_image, 'full', false, ['class' => 'object-cover w-full h-full']); ?>
      </figure>
    <?php endif; ?>

    <div class="  py-8 px-wp sm:p-10 md:p-12 lg:p-14">
      <div class="headline-cta relative w-full">
        <h1 class="wp-block-heading text-center w-full block mx-auto font-bold mb-4 font-h1">
          <?php echo esc_html($title); ?>
        </h1>
      </div>
    </div>
  </div>
</div>
