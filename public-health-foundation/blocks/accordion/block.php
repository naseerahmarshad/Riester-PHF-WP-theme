<?php
    // Block Alignment
    // if( !empty($block['align']) ) {
    //     $alignClass = ' align' . $block['align'];
    // }
?>

<?php if( have_rows('accordion') ): ?>
    <section class="phf-accordion-container <?php //echo esc_attr( $alignClass );?>">
        <ul class="phf-accordion">
        <?php while( have_rows('accordion') ): the_row(); 
            $heading = get_sub_field('heading');
            $text = get_sub_field('text');
            ?>
            <li>
                <div class="phf-accordion__title"><?php echo acf_esc_html( get_sub_field('heading') ); ?></div>
                <div class="phf-accordion__content"><?php echo acf_esc_html( get_sub_field('text') ); ?></div>
            </li>
        <?php endwhile; ?>
        </ul>
    </section>
<?php endif; ?>



