<?php
// Ensure WordPress functions are available
if (!defined('ABSPATH')) exit;

// Custom WP query for 'eventslider'
$args_eventsliderquery = array(
    'post_type'      => 'eventslider',
    'posts_per_page' => 20,
    'order'          => 'DESC',
);

$eventsliderquery = new WP_Query($args_eventsliderquery); ?>

<section class="phf-events-slider-wrapper__swiper-slider">
    <div class="swiper-slider-slider">
        <div class="swiper phf-events-swiper-slider">
            <div class="swiper-wrapper">
                <?php if ($eventsliderquery->have_posts()) : ?>
                    <?php while ($eventsliderquery->have_posts()) : $eventsliderquery->the_post(); ?>
                        <div class="swiper-slide">
                            <div class="phf-events-slider-wrapper__eventcard">
                                <h3 class="phf-events-slider-wrapper__eventcard__title">
                                    <?php the_title(); ?>
                                </h3>
                                <div class="phf-events-slider-wrapper__dates-location">
                                    <div class="phf-events-slider-wrapper__location">
                                        <?php echo esc_html(get_field('location')); ?>
                                    </div>
                                    <div class="phf-events-slider-wrapper__dates">
                                        <h4><?php echo esc_html(get_field('month')); ?></h4>
                                        <h3><?php echo esc_html(get_field('event_dates')); ?></h3>
                                    </div>
                                </div>
                                <div class="phf-events-slider-wrapper__background">
                                    <?php $background = get_field('background'); ?>
                                    <?php if ($background) : ?>
                                        <img src="<?php echo esc_url($background['url']); ?>" alt="<?php echo esc_attr($background['alt']); ?>" />
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p>No events found.</p>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="phf-events-slider-wrapper__navigations">
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</section>