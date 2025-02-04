<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'hot-topics-slider-' . $block['id'];
if (! empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-hot-topics-slider';
if (! empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (! empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}
?>
<section class="phf-hot-topics-slider-wrapper__swiper-slider">
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
        <div class="swiper-slider-slider">
            <?php if (have_rows('hot_topics_slider')) : ?>
                <div class="swiper phf-hot-topics-swiper-slider">
                    <div class="swiper-wrapper">
                        <?php while (have_rows('hot_topics_slider')) : the_row(); ?>
                            <div class="swiper-slide">
                                <div class="phf-hot-topics-slider-wrapper__eventcard">
                                    <h3 class="phf-hot-topics-slider-wrapper__eventcard__title">
                                        <?php $link = get_sub_field('link'); ?>
                                        <?php if ($link) : ?>
                                            <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo esc_attr($link['target']); ?>"><?php echo esc_html($link['title']); ?>
                                                <?php the_sub_field('title'); ?></a>
                                        <?php endif; ?>
                                    </h3>
                                    <div class="phf-hot-topics-slider-wrapper__topic">
                                        <span>
                                            <?php the_sub_field('main_topic_subject'); ?>
                                        </span>
                                    </div>
                                    <div class="phf-hot-topics-slider-wrapper__background">
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
                    <div class="phf-hot-topics-slider-wrapper__navigations">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>