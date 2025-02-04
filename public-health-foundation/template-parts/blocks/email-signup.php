<?php
/**
 * Block template file: template-parts/blocks/email-signup.php
 *
 * Email Signup Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Block ID and Classes
$id = 'email-signup-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

$classes = 'email-signup flex items-center px-6';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}

$image = get_field('image');
$title = get_field('title');
$copy = get_field('copy');
$form_shortcode = get_field('form_shortcode');
$disclaimer = get_field('disclaimer');
$show_disclaimer = get_field('show_disclaimer');
?>

<div id="<?php echo esc_attr($id); ?>" class="w-screen  alignfull <?php echo esc_attr($classes); ?>">
  <div class="max-w-[1440px] mx-auto w-full grid grid-cols-12 gap-6 items-center">
    <!-- Left Section -->
    <div class="col-span-12 lg:col-start-1 lg:col-span-5">
      <?php if ($image): ?>
        <img src="<?php echo esc_url($image); ?>" alt="Image" class="w-full rounded-lg" />
      <?php endif; ?>
    </div>

    <!-- Right Section -->
    <div class="col-span-12 lg:col-start-7 lg:col-span-6">
      <?php if ($title): ?>
        <h1 class="text-3xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
          <?php echo esc_html($title); ?>
        </h1>
      <?php endif; ?>

      <?php if ($copy): ?>
        <div class="text-lg text-gray-700 mb-6">
          <?php echo wp_kses_post($copy); ?>
        </div>
      <?php endif; ?>

      <?php if ($form_shortcode): ?>
        <div class="mb-6">
          <?php echo do_shortcode($form_shortcode); ?>
        </div>
      <?php endif; ?>

      <?php if ($show_disclaimer && $disclaimer): ?>
        <p class="text-xs text-gray-500 mt-4">
          <?php echo wp_kses_post($disclaimer); ?>
        </p>
      <?php endif; ?>
    </div>
  </div>
</div>