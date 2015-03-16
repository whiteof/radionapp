<?php
/*
Plugin Name: Themovation Bootstrap 3 Shortcodes
Plugin URI: http://plugins.themovation.com/bootstrap-3-shortocdes
Description: This is a plugin for WordPress that adds shortcodes for easier use of the Bootstrap 3 elements in your content.
Version: 1.0
Author: Themovation
Author URI: http://themovation.com
License: GPL2
*/

/*  Copyright 2014  Themovation  (email : themovation@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Load libs
require_once( dirname( __FILE__ ) . '/lib/template-shortcodes.php' );
require_once( dirname( __FILE__ ) .  '/lib/available.php' );

/*
==========================================================
Setup the Shortcodes Engine
==========================================================
*/
	function su_plugin_init() {

		// Register styles
		wp_register_style( 'themo-shortcodes', su_plugin_url() . 'css/style.css', false, su_get_version(), 'all' );
		wp_register_style( 'themo-shortcodes-generator', su_plugin_url() . 'css/generator.css', false, su_get_version(), 'all' );
		wp_register_style( 'chosen', su_plugin_url() . 'css/chosen.css', false, su_get_version(), 'all' );

		// Register scripts
		wp_register_script( 'themo-shortcodes', su_plugin_url() . 'js/init.js', array( 'jquery' ), su_get_version(), true );
		wp_register_script( 'themo-shortcodes-generator', su_plugin_url() . 'js/generator.js', array( 'jquery' ), su_get_version(), true );
		wp_register_script( 'chosen', su_plugin_url() . 'js/chosen.js', false, su_get_version(), true );


		// Front-end scripts and styles
		if ( !is_admin() ) {

			if ( !isset( $disabled_styles['style'] ) ) {
				wp_enqueue_style( 'themo-shortcodes' );
			}

			if ( !isset( $disabled_scripts['init'] ) ) {
				wp_enqueue_script( 'themo-shortcodes' );
			}
		}

		// Scipts and stylesheets for editing pages (shortcode generator popup)
		elseif ( is_admin() ) {

			// Get current page type
			global $pagenow;

			// Pages for including
			$su_generator_includes_pages = array( 'post.php', 'edit.php', 'post-new.php', 'index.php', 'edit-tags.php', 'widgets.php' );

			if ( in_array( $pagenow, $su_generator_includes_pages ) ) {
				// Enqueue styles
				wp_enqueue_style( 'chosen' );
				wp_enqueue_style( 'themo-shortcodes-generator' );

				// Enqueue scripts
				wp_enqueue_script( 'chosen' );
				wp_enqueue_script( 'themo-shortcodes-generator' );
			}
		}
	}

	add_action( 'init', 'su_plugin_init' );

	/**
	 * Returns current plugin version.
	 * @return string Plugin version
	 */
	function su_get_version() {return '1';}

	/**
	 * Returns current plugin url
	 * @return string Plugin url
	 */
	function su_plugin_url() {
		//return get_template_directory_uri() . '/lib/shortcodes';
		//return plugins_url( 'images/wordpress.png' , __FILE__ );
		return plugin_dir_url( __FILE__ );
	}

	/**
	 * Shortcode names prefix in compatibility mode
	 * @return string Special prefix
	 */
	function su_compatibility_mode_prefix() {
		$prefix = ( get_option( 'su_compatibility_mode' ) == 'on' ) ? 'gn_' : '';
		return $prefix;
	}

	/*
	 * Custom shortcode function for nested shortcodes support
	 */
	function su_do_shortcode( $content, $modifier ) {
		if ( strpos( $content, '[_' ) !== false ) {
			$content = preg_replace( '@(\[_*)_(' . $modifier . '|/)@', "$1$2", $content );
		}
		return do_shortcode( $content );
	}

	/**
	 * Disable auto-formatting for shortcodes
	 *
	 * @param string $content
	 * @return string Formatted content with clean shortcodes content
	 */
	function su_custom_formatter( $content ) {
		$new_content = '';

		// Matches the contents and the open and closing tags
		$pattern_full = '{(\[raw\].*?\[/raw\])}is';

		// Matches just the contents
		$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';

		// Divide content into pieces
		$pieces = preg_split( $pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE );

		// Loop over pieces
		foreach ( $pieces as $piece ) {

			// Look for presence of the shortcode
			if ( preg_match( $pattern_contents, $piece, $matches ) ) {

				// Append to content (no formatting)
				$new_content .= $matches[1];
			} else {

				// Format and append to content
				$new_content .= wptexturize( wpautop( $piece ) );
			}
		}

		return $new_content;
	}

/*
==========================================================
Add generator button to Upload/Insert Buttons
==========================================================
*/
	function su_add_generator_button( $target = null ) {
		echo '<a href="#TB_inline?width=640&height=600&inlineId=su-generator-wrap" class="thickbox button" title="' . __( 'Insert shortcode', 'themo-shortcodes' ) . '" data-page="themo_shortcode_button" data-target="' . $target . '"><img src="' . su_plugin_url() . 'images/admin/media-icon.png"  alt="" /> Add Shortcode</a>';
	}

	add_action( 'media_buttons', 'su_add_generator_button', 100);

/*
==========================================================
Generator Popup Box
==========================================================
*/
	function su_generator_popup() {
		?>
		<div id="su-generator-wrap" style="display:none">
			<div id="su-generator">
				<div id="su-generator-shell">
					<div id="su-generator-header">
						<select id="su-generator-select" data-placeholder="<?php _e( 'Select shortcode', 'themo-shortcodes' ); ?>" data-no-results-text="<?php _e( 'Shortcode not found', 'themo-shortcodes' ); ?>">
							<option value="raw"></option>
							<?php
							foreach ( su_shortcodes() as $name => $shortcode ) {

								// Open optgroup
								if ( $shortcode['type'] == 'opengroup' )
									echo '<optgroup label="' . $shortcode['name'] . '">';

								// Close optgroup
								elseif ( $shortcode['type'] == 'closegroup' )
									echo '</optgroup>';

								// Option
								else
									echo '<option value="' . $name . '">' . $shortcode['name'] . /*':&nbsp;&nbsp;' . $shortcode['desc'] .*/ '</option>';
							}
							
							/* custom shortcodes can be registered with the action hook below */
							do_action('themo_add_shortcode_init');
	
							?>
						</select>
						<div id="su-generator-tools">
							<a href="<?php _e( 'http://docs.themovation.com/pursuit/#shortcodes', 'themo' ); ?>" target="_blank" title="<?php _e( 'Help', 'themo-shortcodes' ); ?>"><?php _e( 'Help', 'themo-shortcodes' ); ?></a>
						</div>
					</div>
					<div id="su-generator-settings"></div>
					<input type="hidden" name="su-generator-url" id="su-generator-url" value="<?php echo su_plugin_url(); ?>" />
					<input type="hidden" name="su-compatibility-mode-prefix" id="su-compatibility-mode-prefix" value="<?php echo su_compatibility_mode_prefix(); ?>" />
				</div>
			</div>
		</div>
		<?php
	}
add_action( 'admin_footer', 'su_generator_popup' );


/*
==========================================================
Remove unwanted <P> and <BR> tags from shortcodes.
==========================================================
*/

function shortcode_empty_paragraph_fix($content){   
   
$shortcode_names = su_shortcodes();

	if(is_array($shortcode_names)){
		$block = implode("|",array_keys($shortcode_names));
		// opening tag
		$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
		
		// closing tag
		$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)/","[/$2]",$rep);
		
		return $rep;	
	}else{
		return $contnet;
	}

}

// Filter for Empty paragraphy fix

add_filter('the_content', 'shortcode_empty_paragraph_fix');

//add_filter('themo_cleanup_shortcode', 'shortcode_empty_paragraph_fix');

//-----------------------------------------------------
// the_content - filter
// Strip <p> and <br> that are injected by WordPress
// from shortocdes
//-----------------------------------------------------

/*if( !function_exists('themo_fix_shortcodes') ) {
	add_filter('the_content', 'themo_fix_shortcodes');
	
	function themo_fix_shortcodes($content){   
		$array = array (
			'<p>[' => '[', 
			']</p>' => ']', 
			']<br />' => ']'
		);
		$content = strtr($content, $array);
		return $content;
	}
}*/	 