<?php
// Create id attribute allowing for custom "anchor" value.
$id = 'related-posts-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-related-posts';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}

?>
<div class="phf-relatedposts-wrapper">
    <?php
    global $post;

    // Ensure global post context is available
    if (!isset($post) || empty($post->ID)) {
        echo '<p>No related posts found (no global post context).</p>';
        return;
    }

    // Get current post's categories
    $categories = wp_get_post_categories($post->ID);

    if (!empty($categories)) {
        // Query related posts
        $related_posts = new WP_Query(array(
            'category__in'   => $categories,
            'posts_per_page' => 3,
            'post__not_in'   => array($post->ID),
        ));

        // Output related posts
        if ($related_posts->have_posts()) {
            echo '<ul class="wp-block-latest-posts__list is-grid columns-3 alignwide phf-related-articles-with-testimonial-wrapper_list wp-block-latest-posts">';
            while ($related_posts->have_posts()) {
                $related_posts->the_post(); ?>
                <li>
                    <div class="wp-block-latest-posts__featured-image aligncenter">
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>" alt="<?php the_title(); ?>" />
                        </a>
                    </div>
                    <a class="wp-block-latest-posts__post-title" href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                    <div class="wp-block-latest-posts__post-excerpt">
                        <?php the_excerpt(); ?>
                        <a class="wp-block-latest-posts__read-more" href="<?php the_permalink(); ?>" rel="noopener noreferrer">Read more</a>
                    </div>
                    <div class="wp-block-buttons">
                        <div class="wp-block-button">
                            <a href="<?php the_permalink(); ?>" class="wp-block-button__link">
                                Learn more
                            </a>
                        </div>
                    </div>
                </li>
        <?php
            }
            echo '</ul>'; // Close the <ul> tag
        } else {
            echo '<p>No related posts found.</p>';
        }

        wp_reset_postdata();
    } else {
        echo '<p>No related posts found (no categories).</p>';
    }
    ?>
</div>