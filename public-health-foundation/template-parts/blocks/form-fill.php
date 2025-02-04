<?php

/**
 * Block template file: template-parts/blocks/form-fill.php
 *
 * Form Fill Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'form-fill-' . $block['id'];
if (! empty($block['anchor'])) {
  $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-form-fill';
if (! empty($block['className'])) {
  $classes .= ' ' . $block['className'];
}
if (! empty($block['align'])) {
  $classes .= ' align' . $block['align'];
}
?>

<style type="text/css">
  <?php echo '#' . $id; ?> {
    /* Add styles that use ACF values here */
  }
</style>
<?php
$title = get_field('title');
$copy = get_field('copy');
$shortcode = get_field('shortcode');
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
  <div class="  mx-auto ">
    <div class="flex flex-col sm:flex-row justify-between">
      <!-- Left Content Section -->
      <div class="w-full sm:w-5/12">
        <!-- Corner Graphic -->
        <div class="relative flex flex-col justify-center">
          <div class="talk-bubble-wrapper">
            <svg class="talk-bubble" width="384" height="384" viewBox="0 0 384 384" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle opacity="0.0786365" cx="192" cy="192" r="192" fill="#C7C7C7" />
              <circle opacity="0.0786365" cx="192" cy="192" r="117.125" fill="#C2C2C2" />
              <circle opacity="0.0786365" cx="192" cy="192" r="64.7131" fill="#1C3F63" />
              <path d="M193.007 164.83C175.504 164.83 161.308 176.235 161.308 190.324C161.308 204.412 175.504 215.817 193.007 215.817C195.763 215.817 198.658 215.549 201.414 214.878L217.264 221.05C217.401 221.05 217.539 221.184 217.815 221.184C218.091 221.184 218.366 221.05 218.642 220.916C219.055 220.647 219.193 220.111 219.193 219.708L217.677 206.291C222.225 201.863 224.706 196.093 224.706 190.324C224.706 176.235 210.51 164.83 193.007 164.83Z" fill="#294884" />
            </svg>
          </div>
          <div class="content-section-wrapper flex flex-col gap-6">
            <h2 class="font-h2 font-bold "><?= esc_html($title); ?></h2>
            <div class="mt-4 text-black">
              <?= wp_kses_post($copy); ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Form Section -->
      <div class="form-section w-full sm:w-6/12 md:w-5/12 mt-8 lg:ml-12">
        <?= do_shortcode($shortcode); ?>
      </div>
    </div>
  </div>
</div>