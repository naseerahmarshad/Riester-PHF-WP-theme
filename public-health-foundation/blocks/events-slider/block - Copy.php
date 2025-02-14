<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'events-slider-' . $block['id'];
if (! empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-events-slider';
if (! empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (! empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}
?>
<section class="phf-events-slider-wrapper__swiper-slider">
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
        <div class="swiper-slider-slider">
            <?php if (have_rows('events_slider')) : ?>
                <div class="swiper phf-events-swiper-slider">
                    <div class="swiper-wrapper">
                        <?php while (have_rows('events_slider')) : the_row(); ?>
                            <div class="swiper-slide">
                                <div class="phf-events-slider-wrapper__eventcard">
                                    <h3 class="phf-events-slider-wrapper__eventcard__title">
                                        <?php the_sub_field('title'); ?>
                                    </h3>
                                    <div class="phf-events-slider-wrapper__dates-location">
                                        <div class="phf-events-slider-wrapper__location">
                                            <?php the_sub_field('location'); ?>
                                        </div>
                                        <div class="phf-events-slider-wrapper__dates">
                                            <h4><?php the_sub_field('month'); ?></h4>
                                            <h3><?php the_sub_field('event_dates'); ?></h3>
                                        </div>
                                    </div>
                                    <div class="phf-events-slider-wrapper__background">
                                        <?php $background = get_sub_field('background'); ?>
                                        <?php if ($background) : ?>
                                            <img src="<?php echo esc_url($background['url']); ?>" alt="<?php echo esc_attr($background['alt']); ?>" />
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="phf-events-slider-wrapper__navigations">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>