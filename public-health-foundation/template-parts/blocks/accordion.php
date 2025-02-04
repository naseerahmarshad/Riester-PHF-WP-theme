<?php

/**
 * Block template file: template-parts/blocks/accordion.php
 *
 * Accordion Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'accordion-' . $block['id'];
if (! empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-accordion';
if (! empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (! empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}
$title  = get_field('title');
$hide_title  = get_field('hidetitle');
$tab_panels = get_field('tab_panels');

?>

<style type="text/css">
    <?php echo '#' . $id; ?> {
        /* Add styles that use ACF values here */
    }
</style>

<div id="<?php echo esc_attr($id); ?>" class="gap-36-24 <?php echo esc_attr($classes); ?>">

    <?php if (($hide_title) == null) : ?>
        <h3 class="pb-32-16 text-balance"><?php echo $title; ?></h3>
    <?php endif; ?>

    <div class="accordion-container w-full flex flex-col gap-3">
        <?php if ($tab_panels): ?>
            <?php foreach ($tab_panels as $index => $tab): ?>
                <?php
                // Assign variables for each repeater sub field
                $tab_heading = isset($tab['tab_heading']) ? $tab['tab_heading'] : '';
                $tab_content = isset($tab['tab_content']) ? $tab['tab_content'] : '';
                ?>
                <details <?php echo $index === 0 ? 'open' : ''; ?>>
                    <summary class="tab-heading-wrapper">
                        <div class="tab-heading font-sans font-bold text-balance">
                            <?php echo $tab_heading; ?>
                        </div>
                        <svg 
                            class="accordion-caret" 
                            width="20" 
                            height="17" 
                            fill="none" 
                            xmlns="http://www.w3.org/2000/svg" 
                            viewBox="0 0 20 17">
                                <path d="m10 0 10 10v7L10 7 0 17v-7z" fill="black" />
                            </svg>
                    </summary>
                    <div class="tab-content">
                        <?php echo $tab_content; ?>
                    </div>
                </details>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const accordionItems = document.querySelectorAll('.block-accordion .accordion-container details');
    
    accordionItems.forEach(item => {
        item.addEventListener('toggle', function() {
            if (this.open) {
                accordionItems.forEach(otherItem => {
                    if (otherItem !== this) {
                        otherItem.open = false;
                    }
                });
            }
        });
    });
});
</script>
