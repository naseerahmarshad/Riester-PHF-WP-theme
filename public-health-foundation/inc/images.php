<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Registers custom image sizes for the Public Health Foundation theme.
 *
 * This function defines various image sizes used throughout the theme and
 * supports both mobile and desktop layouts.
 *
 * @return void
 */
function phf_image_sizes()
{   
    add_image_size('hero-2xsm', 480, 726, true);  // 480x726    hero vertical format (mobile)
    add_image_size('hero-xsm', 640, 968, true);   // 640x968    hero vertical format (mobile)
    add_image_size('hero-sm', 640, 400, true);    // 640×400    (sm: 640px) hero landscape format (tablet)
    add_image_size('hero-md', 768, 40, true);     // 768×400    (md: 768px) hero landscape format (tablet)
    add_image_size('hero-lg', 1024, 480, true);   // 1024×480   (lg: 1024px) hero landscape format (tablet)
    add_image_size('hero-xl', 1280, 600, true);   // 1280×600   (xl: 1280px) hero landscape format (desktop)
    add_image_size('hero-2xl', 1536, 720, true);  // 1536×720   (2xl: 1536px) hero landscape format (desktop)
    add_image_size('hero-full', 1920, 900, true); // 1920×900   (1537px and up) hero landscape format (desktop)
}
add_action('after_setup_theme', 'phf_image_sizes');
