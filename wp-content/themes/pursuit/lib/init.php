<?php
/**
 * Initial setup and constants
 *
 * @author     @retlehs
 * @link 	   http://roots.io
 * @editor     Themovation <themovation@gmail.com>
 * @version    1.0
 */

//-----------------------------------------------------
// after_setup_theme
// Perform basic setup, registration, and init actions
// for this theme.
//-----------------------------------------------------


add_action('after_setup_theme', 'themo_setup');
 
function themo_setup() {
	// Make theme available for translation
	load_theme_textdomain(THEMO_TEXT_DOMAIN, get_template_directory() . '/lang');

	// Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
	register_nav_menus(array(
	'primary_navigation' => __('Primary Navigation', THEMO_TEXT_DOMAIN),
	));

	// Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
	add_theme_support('post-thumbnails');
	// set_post_thumbnail_size(150, 150, false);

	if ( function_exists( 'add_image_size' ) ) { 
		// Set Image Size for Logo
		if ( function_exists( 'ot_get_option' ) ) {
			$logo_height = ot_get_option( 'themo_logo_height', 100 );
			add_image_size('themo-logo', 9999, $logo_height); //  (unlimited width, user set height)	
		}else{
			add_image_size('themo-logo', 9999, 100); // (unlimited width, 100px high)	
		}	
		
		// Set our custom images sizes
		add_image_size('themo_full_width', 1140, 900); // General Full Width Images - 1140 wide
		add_image_size('themo_thumbnail_slider', 255, 170, array( 'center', 'center' )); // Thumbnail Slider - 255 wide, high, cropped center by center.
		add_image_size('themo_thumbnail_slider_portrait', 255, 0); // Thumbnail Slider Portrait - 255 wide, unlimited height.
		add_image_size('themo_brands', 0, 80); // Brands - 80 wide
		add_image_size('themo_testimonials', 60, 60, array( 'center', 'top' ) ); // Testimonial Headshot - 60 wide, 60 high, cropped center and top.
		add_image_size('themo_featured', 555, 290, array( 'center', 'center' ) ); // Featured image - 440 wide, 300 high, cropped center by center.
		add_image_size('themo_team', 360); // Meet the Team - 360 wide.
		add_image_size('themo_showcase', 500); // Showcase - 500 wide.
		//add_image_size('themo_tour', 350); // Tour - 350 wide.
		add_image_size('themo_page_header', 1920); // Page Header / BG - 1920 wide.
		add_image_size('themo_blog_standard', 750); // Blog for Standard post with Sidebar - 750 wide.
		add_image_size('themo_blog_masonry', 360); // Blog for Masonry - 360 wide.
		
	}

	
  
	// Add post formats (http://codex.wordpress.org/Post_Formats)
	add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio'));

	// Tell the TinyMCE editor to use a custom stylesheet
	add_editor_style('/assets/css/editor-style.css');
}

// Backwards compatibility for older than PHP 5.3.0
if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }
if (!defined('THEMEO_OT_DEFAULTS')) {
	define('THEMEO_OT_DEFAULTS', 'YTo0ODp7czoxMzoidGhlbW9fZmF2aWNvbiI7czowOiIiO3M6MTc6InRoZW1vX2xvZ29faGVpZ2h0IjtzOjM6IjEwMCI7czoxMDoidGhlbW9fbG9nbyI7czowOiIiO3M6MzY6InRoZW1vX2xvZ29fdHJhbnNwYXJlbnRfaGVhZGVyX2VuYWJsZSI7czoyOiJvbiI7czoyOToidGhlbW9fbG9nb190cmFuc3BhcmVudF9oZWFkZXIiO3M6MDoiIjtzOjIwOiJ0aGVtb19uYXZfdG9wX21hcmdpbiI7czoyOiIxMiI7czoxNjoidGhlbW9fY3VzdG9tX2NzcyI7czowOiIiO3M6MzY6InRoZW1vX2dvb2dsZV9hbmFseXRpY3NfdHJhY2tpbmdfY29kZSI7czowOiIiO3M6NDk6InRoZW1vX21ldGFfYm94X2J1aWxkZXJfbWV0YV9ib3hfbWFudWFsX3NvcnRfb3JkZXIiO3M6Mzoib2ZmIjtzOjQ0OiJ0aGVtb19tZXRhX2JveF9idWlsZGVyX21ldGFfYm94X21heF9xdWFudGl0eSI7czoxOiI1IjtzOjI5OiJ0aGVtb19hdXRvbWF0aWNfcG9zdF9leGNlcnB0cyI7czoyOiJvbiI7czoxOToidGhlbW9fc21vb3RoX3Njcm9sbCI7czoyOiJvbiI7czoxOToidGhlbW9fY29sb3JfcHJpbWFyeSI7czowOiIiO3M6MTg6InRoZW1vX2NvbG9yX2FjY2VudCI7czowOiIiO3M6MTU6InRoZW1vX2JvZHlfZm9udCI7czowOiIiO3M6MTU6InRoZW1vX21lbnVfZm9udCI7czowOiIiO3M6MTk6InRoZW1vX2hlYWRpbmdzX2ZvbnQiO2E6NDp7czoxMDoiZm9udC1jb2xvciI7czowOiIiO3M6MTE6ImZvbnQtZmFtaWx5IjtzOjA6IiI7czoxMDoiZm9udC1zdHlsZSI7czowOiIiO3M6MTE6ImZvbnQtd2VpZ2h0IjtzOjY6Im5vcm1hbCI7fXM6Mjc6InRoZW1vX3NvY2lhbF9tZWRpYV9hY2NvdW50cyI7YTozOntpOjA7YTozOntzOjU6InRpdGxlIjtzOjg6IkZhY2Vib29rIjtzOjIyOiJ0aGVtb19zb2NpYWxfZm9udF9pY29uIjtzOjg6ImZhY2Vib29rIjtzOjE2OiJ0aGVtb19zb2NpYWxfdXJsIjtzOjM2OiJodHRwczovL3d3dy5mYWNlYm9vay5jb20vdGhlbW92YXRpb24iO31pOjE7YTozOntzOjU6InRpdGxlIjtzOjc6IlR3aXR0ZXIiO3M6MjI6InRoZW1vX3NvY2lhbF9mb250X2ljb24iO3M6NzoidHdpdHRlciI7czoxNjoidGhlbW9fc29jaWFsX3VybCI7czozMDoiaHR0cDovL3R3aXR0ZXIuY29tL3RoZW1vdmF0aW9uIjt9aToyO2E6Mzp7czo1OiJ0aXRsZSI7czo5OiJJbnN0YWdyYW0iO3M6MjI6InRoZW1vX3NvY2lhbF9mb250X2ljb24iO3M6OToiaW5zdGFncmFtIjtzOjE2OiJ0aGVtb19zb2NpYWxfdXJsIjtzOjE6IiMiO319czoxOToidGhlbW9fc3RpY2t5X2hlYWRlciI7czoyOiJvbiI7czoyNDoidGhlbW9fdHJhbnNwYXJlbnRfaGVhZGVyIjtzOjI6Im9uIjtzOjE3OiJ0aGVtb193aWRlX2xheW91dCI7czoyOiJvbiI7czoyOToidGhlbW9fYm94ZWRfbGF5b3V0X2JhY2tncm91bmQiO3M6MDoiIjtzOjE3OiJ0aGVtb19iYWNrc3RyZXRjaCI7czoyOiJvbiI7czoyMDoidGhlbW9fcmV0aW5hX3N1cHBvcnQiO3M6Mzoib2ZmIjtzOjIyOiJ0aGVtb19mb290ZXJfY29weXJpZ2h0IjtzOjE3OiLCoMKpIDIwMTQgUHVyc3VpdCI7czoxOToidGhlbW9fZm9vdGVyX2NyZWRpdCI7czo3NDoiVGhlbWUgYnkgPGEgdGFyZ2V0PSJfYmxhbmsiIGhyZWY9Imh0dHA6Ly90aGVtb3ZhdGlvbi5jb20vIj5UaGVtb3ZhdGlvbjwvYT4iO3M6MjY6InRoZW1vX2Zvb3Rlcl93aWRnZXRfc3dpdGNoIjtzOjI6Im9uIjtzOjIwOiJ0aGVtb19mb290ZXJfY29sdW1ucyI7czoxOiI0IjtzOjIwOiJ0aGVtb19mbGV4X2FuaW1hdGlvbiI7czo0OiJmYWRlIjtzOjE3OiJ0aGVtb19mbGV4X2Vhc2luZyI7czo1OiJzd2luZyI7czoyNDoidGhlbW9fZmxleF9hbmltYXRpb25sb29wIjtzOjI6Im9uIjtzOjIzOiJ0aGVtb19mbGV4X3Ntb290aGhlaWdodCI7czoyOiJvbiI7czoyNToidGhlbW9fZmxleF9zbGlkZXNob3dzcGVlZCI7czo0OiI0MDAwIjtzOjI1OiJ0aGVtb19mbGV4X2FuaW1hdGlvbnNwZWVkIjtzOjM6IjU1MCI7czoyMDoidGhlbW9fZmxleF9yYW5kb21pemUiO3M6Mzoib2ZmIjtzOjIzOiJ0aGVtb19mbGV4X3BhdXNlb25ob3ZlciI7czoyOiJvbiI7czoxNjoidGhlbW9fZmxleF90b3VjaCI7czoyOiJvbiI7czoyMzoidGhlbW9fZmxleF9kaXJlY3Rpb25uYXYiO3M6Mjoib24iO3M6MzU6InRoZW1vX2Jsb2dfaW5kZXhfbGF5b3V0X3Nob3dfaGVhZGVyIjtzOjI6Im9uIjtzOjM2OiJ0aGVtb19ibG9nX2luZGV4X2xheW91dF9oZWFkZXJfZmxvYXQiO3M6ODoiY2VudGVyZWQiO3M6MzE6InRoZW1vX2Jsb2dfaW5kZXhfbGF5b3V0X3NpZGViYXIiO3M6NToicmlnaHQiO3M6MzE6InRoZW1vX2Jsb2dfaW5kZXhfbGF5b3V0X21hc29ucnkiO3M6Mzoib2ZmIjtzOjM2OiJ0aGVtb19zaW5nbGVfcG9zdF9sYXlvdXRfc2hvd19oZWFkZXIiO3M6Mjoib24iO3M6Mzc6InRoZW1vX3NpbmdsZV9wb3N0X2xheW91dF9oZWFkZXJfZmxvYXQiO3M6ODoiY2VudGVyZWQiO3M6MzI6InRoZW1vX3NpbmdsZV9wb3N0X2xheW91dF9zaWRlYmFyIjtzOjU6InJpZ2h0IjtzOjMyOiJ0aGVtb19kZWZhdWx0X2xheW91dF9zaG93X2hlYWRlciI7czoyOiJvbiI7czozMzoidGhlbW9fZGVmYXVsdF9sYXlvdXRfaGVhZGVyX2Zsb2F0IjtzOjg6ImNlbnRlcmVkIjtzOjI4OiJ0aGVtb19kZWZhdWx0X2xheW91dF9zaWRlYmFyIjtzOjU6InJpZ2h0Ijt9');
	}
if (!defined('THEMO_TEXT_DOMAIN')) { define('THEMO_TEXT_DOMAIN', 'PURSUIT'); }
if (!defined('THEMO_COLOR_PRIMARY')) { define('THEMO_COLOR_PRIMARY', '#2b8dd6'); }
if (!defined('THEMO_COLOR_ACCENT')) { define('THEMO_COLOR_ACCENT', '#00d148'); }