<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'swiper-slider-' . $block['id'];
if (! empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-swiper-slider';
if (! empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (! empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}
?>
<section class="swiper-slider-section">
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
        <div class="swiper-slider-slider">
            <?php if (have_rows('swiper_slider')) : ?>
                <div class="swiper phf-custom-swiperslider">
                    <div class="swiper-wrapper">
                        <?php while (have_rows('swiper_slider')) : the_row(); ?>
                            <div class="swiper-slide">
                                <?php the_sub_field('slide_item'); ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>