<?php
/**
 * Block template file: template-parts/blocks/fifty-fifty-image-content-aside.php
 *
 * Fifty Fifty Image Content Aside Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.

// Get ACF fields
$image = get_field('image');
$image_placement = get_field( 'image_placement' ); 
$size = 'full';
$title = get_field('title');
$copy = get_field('copy');
$button_label = get_field('button_label');
$button_url = get_field('button_url');

$id = 'fifty-fifty-image-content-aside-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-fifty-fifty-image-content-aside  items-center py-8 bg-white alignwide';
if ($image_placement === 'right') {
    $classes .= ' sm:flex-row-reverse';
}
if (!empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}


?>

<div id="<?php echo esc_attr($id); ?>" class=" flex flex-col sm:flex-row   <?php echo esc_attr($classes); ?>">
    <!-- Image Section -->
    <?php if ($image) : ?>
    <div class="flex w-full sm:w-1/2">
        <div class="relative flex max-sm:justify-end ">
            <!-- Corner Decoration -->
            <div class="corner-decoration <?php echo ($image_placement === 'right') ? ' right-corner' : ''; ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 62 62"><path fill="#eda621" d="M50.1 0H0v50.7L11.9 62V11.9H62z"/></svg></div>
            <?php echo wp_get_attachment_image($image, $size, false, array(
                'class' => 'block-fifty-fifty-image  object-cover w-full',
            )); ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Content Section -->
    <div class="flex flex-col gap-4 w-full sm:w-1/2 mt-8 lg:mt-0 ">
        <?php if ($title) : ?>
            <h4 class="font-bold text-balance"><?php echo esc_html($title); ?></h4>
        <?php endif; ?>

        <?php if ($copy) : ?>
            <div class="text-gray-600 space-y-2">
                <?php echo wp_kses_post($copy); ?>
            </div>
        <?php endif; ?>

        <?php if ($button_label && $button_url) : ?>
            <div class="phf-button phf-button--blue">
                <a href="<?php echo esc_url($button_url); ?>" class="text-black no-underline">
                    <?php echo esc_html($button_label); ?>
                </a>
                </div>
            
        <?php endif; ?>
    </div>
</div>