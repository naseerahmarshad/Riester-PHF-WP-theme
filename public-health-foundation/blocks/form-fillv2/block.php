<?php

/**
 * Block template file: block.php
 *
 * Form Fillv2 Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'form-fillv2-' . $block['id'];
if (! empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-form-fillv2';
if (! empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (! empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}
?>
<section class="phf-formfill-groupwrapper">
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
        <div class="phf-formfill-group-columns">
            <div class="phf-formfill-group-column-one">
                <div class="phf-formfill-bubble-svg">
                    <svg width="384" height="384" viewBox="0 0 384 384" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle opacity="0.0786365" cx="192" cy="192" r="192" fill="#C7C7C7" />
                        <circle opacity="0.0786365" cx="192" cy="192" r="117.125" fill="#C2C2C2" />
                        <circle opacity="0.0786365" cx="192" cy="192" r="64.7131" fill="#1C3F63" />
                        <path d="M193.007 164.831C175.504 164.831 161.308 176.235 161.308 190.324C161.308 204.412 175.504 215.817 193.007 215.817C195.763 215.817 198.658 215.549 201.414 214.878L217.264 221.05C217.401 221.05 217.539 221.184 217.815 221.184C218.091 221.184 218.366 221.05 218.642 220.916C219.055 220.648 219.193 220.111 219.193 219.708L217.677 206.291C222.225 201.863 224.706 196.093 224.706 190.324C224.706 176.235 210.51 164.831 193.007 164.831Z" fill="#294884" />
                    </svg>
                </div>
                <div class="phf-formfill-heading">
                    <h2>
                        <?php the_field('title'); ?>
                    </h2>
                </div>
                <div class="phf-formfill-copy">
                    <?php the_field('copy'); ?>
                </div>
            </div>
            <div class="phf-formfill-group-column-two">
                <div class="phf-formfill-group-column-formcol">
                    <?php the_field('shortcode'); ?>
                </div>
            </div>
        </div>
    </div>
</section>