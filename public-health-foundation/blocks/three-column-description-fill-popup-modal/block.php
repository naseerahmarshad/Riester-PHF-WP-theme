<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'three-column-description-fill-popup-modal-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-three-column-description-fill-popup-modal';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?> phf-three-column-description-fill-popup-modal-wrapper__columns">
    <?php if (have_rows('team_fields')) : ?>
        <?php while (have_rows('team_fields')) : the_row(); ?>
            <div class="phf-three-column-description-fill-popup-modal-wrapper__block">
                <div class="phf-three-column-description-fill-popup-modal-wrapper__blockcard">
                    <div class="wp-block-column">
                        <div class="wp-block-group">
                            <p><strong><?php the_sub_field('title'); ?></strong></p>
                            <p><?php the_sub_field('qualification'); ?></p>
                        </div>
                        <p><?php the_sub_field('designation'); ?></p>
                    </div>
                </div>
                <div class="phf-module-popup-wrapper">
                    <div class="wp-block-columns">
                        <div class="phf-module-popup-wrapper__col1">
                            <figure class="wp-block-image size-full">
                                <?php $image = get_sub_field('image'); ?>
                                <?php if ($image) : ?>
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                <?php endif; ?>
                            </figure>
                            <p>Email: <a href="mailto:<?php the_sub_field('email'); ?>"><?php the_sub_field('email'); ?></a></p>
                            <p>Phone Number:&nbsp;<a href="tel:<?php the_sub_field('phone_number'); ?>"><?php the_sub_field('phone_number'); ?></a></p>
                            <div class="phf-module-popup-wrapper__linkedin">
                                <a href="<?php the_sub_field('linkedin_url'); ?>" target="_blank" rel="noreferrer noopener">LinkedIn</a>
                            </div>
                        </div>
                        <div class="phf-module-popup-wrapper__col2">
                            <p class="phf-module-popup-wrapper__closebtn"><a href="#">Close</a></p>
                            <h3 class="wp-block-heading phf-module-popup-wrapper__title"><strong><?php the_sub_field('title'); ?></strong></h3>
                            <p class="phf-module-popup-wrapper__subtitle"><?php the_sub_field('designation'); ?></p>
                            <div class="phf-module-popup-wrapper__copy">
                                <?php the_sub_field('copy'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Closing block div moved inside loop -->
        <?php endwhile; ?>
    <?php else : ?>
        <p>No rows found</p>
    <?php endif; ?>
</div>