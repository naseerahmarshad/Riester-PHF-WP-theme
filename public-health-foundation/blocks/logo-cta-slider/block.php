<?php

/**
 * Block template file: block.php
 *
 * Logo Cta Slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'logo-cta-slider-' . $block['id'];
if (! empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-logo-cta-slider';
if (! empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (! empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}
?>

<section class="<?php echo esc_attr($classes); ?> swiper-slider-section" id="<?php echo esc_attr($id); ?>">
    <div class="phf-four-column-logo-ctas-wrapper__slider">
        <div class="swiper-slider-slider">
            <div class="swiper phf-custom-swiperslider">
                <div class="swiper-wrapper">
                    <?php if (have_rows('logo_cta_slider')) : ?>
                        <?php while (have_rows('logo_cta_slider')) : the_row(); ?>
                            <div class="swiper-slide">
                                <div class="phf-four-column-logo-ctas-wrapper__slideblock">
                                    <div class="phf-four-column-logo-ctas-wrapper__slideblockimage">
                                        <?php $image = get_sub_field('image'); ?>
                                        <?php if ($image) : ?>
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                        <?php endif; ?>
                                    </div>
                                    <p>
                                        <a href="<?php the_sub_field('link'); ?>" target="_blank" rel="noopener">
                                            <?php the_sub_field('text'); ?>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <?php // No rows found 
                        ?>
                    <?php endif; ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>