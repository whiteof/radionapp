<?php
/**
 * Enable theme features
 *
 * @author     @retlehs
 * @link 	   http://roots.io
 * @editor     Themovation <themovation@gmail.com>
 * @version    1.0
 */
 
add_theme_support('bootstrap-top-navbar');  // Enable Bootstrap's top navbar
add_theme_support('bootstrap-gallery');     // Enable Bootstrap's thumbnails component on [gallery]
//add_theme_support('jquery-cdn');            // Enable to load jQuery from the Google CDN
add_theme_support('automatic-feed-links'); // Enable post and comment RSS feed links to head.

/**
 * Configuration values
 */
define('POST_EXCERPT_LENGTH', 40); // Length in words for excerpt_length filter (http://codex.wordpress.org/Plugin_API/Filter_Reference/excerpt_length)

/**
 * $content_width is a global variable used by WordPress for max image upload sizes
 * and media embeds (in pixels).
 *
 * Example: If the content area is 640px wide, set $content_width = 620; so images and videos will not overflow.
 * Default: 940px is the default Bootstrap container width.
 */
if (!isset($content_width)) { $content_width = 1140; }

/**
 * Define helper constants
 */
$get_theme_name = explode('/themes/', get_template_directory());

define('RELATIVE_PLUGIN_PATH',  str_replace(home_url() . '/', '', plugins_url()));
define('RELATIVE_CONTENT_PATH', str_replace(home_url() . '/', '', content_url()));
define('THEME_NAME',            next($get_theme_name));
define('THEME_PATH',            RELATIVE_CONTENT_PATH . '/themes/' . THEME_NAME);