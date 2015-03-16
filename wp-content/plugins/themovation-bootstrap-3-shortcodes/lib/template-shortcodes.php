<?php
/*
==========================================================
Default Settings for Shortcodes
==========================================================
*/
//Add our custom action that all shortcodes will use
add_action( 'init', 'themo_register_shortcodes');
//Enable shortcodes in widgets
add_filter('widget_text', 'do_shortcode');


/**
* Add the stylesheet
*/
function themo_shortcodes_stylesheet() {
 
	// Register scripts
	wp_register_script( 'gpp_sc_googlemap_api', 'https://maps.googleapis.com/maps/api/js?sensor=false', array( 'jquery' ), '1.0.3', true );

	// Enque scripts
	wp_enqueue_script( 'gpp_sc_googlemap_api' );
}
add_action( 'wp_enqueue_scripts', 'themo_shortcodes_stylesheet' );

function themo_register_shortcodes() {
	
	/*
	==========================================================
	Accordion
	==========================================================
	*/
	function themo_accordion( $atts, $content ){
	extract( shortcode_atts( array(
		'title' => ''
		), $atts ) );
	
		$content = wp_kses_post($content); 
	
		global $group_ID, $accordion_count;
		
		$collapse_ID = themo_randomString();
		$accordion_count++;
		
		if ($accordion_count == 1){
			$in = 'in';
		}else{
			$in = '';
		}
		
		$output = 		'<div class="panel panel-default">';
		$output .= 			'<div class="panel-heading">';
		$output .= 				'<h4 class="panel-title">';
		$output .= 					'<a class="accordion-toggle" data-toggle="collapse" data-parent="#'.$group_ID.'" href="#'.$collapse_ID.'">'.$title.'</a>';
		$output .= 				'</h4>';
		$output .= 			'</div><!-- end heading -->';
		$output .= 			'<div id="'.$collapse_ID.'" class="panel-collapse collapse '.$in.'">';
		$output .= 				'<div class="panel-body">';
		$output .= 					do_shortcode( $content );
		$output .= 				'</div>';
		$output .= 			'</div><!-- end body -->';
		$output .= 		'</div><!-- end panel -->';
		
		return $output;
	}

	add_shortcode( 'accordion', 'themo_accordion' );
	
	/*
	==========================================================
	Accordion Group
	==========================================================
	*/
	function themo_accordion_group( $atts, $content ) {
	
		global $group_ID, $accordion_count;
		$group_ID = themo_randomString();
		
		
		$output = '<div class="panel-group" id="'.$group_ID.'">';
		$output .= do_shortcode( $content );
		$output .= '</div><!-- end group -->';		
			
		return $output;
	}
		
	add_shortcode('accordion_group', 'themo_accordion_group');
	
	/*
	==========================================================
	Alerts
	==========================================================
	*/
	function themo_alerts( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'type' => 'alert-info', /* alert-info, alert-success, alert-danger, alert-warning */
		'block' => 'false',
		'close' => 'false', /* display close link */
		'heading' => ''
		), $atts ) );
		
		// sanitize
		$type = sanitize_html_class($type);
		$block = sanitize_html_class($block);
		$close = sanitize_html_class($close);
		$heading = sanitize_text_field($heading);
		$content = wp_kses_post($content); 
		
		if($block == 'true') {$alertblock = 'alert-block';}
		$output = '<div class="fade in alert '. $type . ' '. $block . '">';
		if($close == 'true') {
			$icon = do_shortcode('[glyphicon icon="glyphicons remove" wrapper=i]');
			$output .= '<a class="close" data-dismiss="alert">'.$icon.'</a>';
		}
		if($heading <> '') {
			$output .= '<h4 class="alert-heading">'.$heading.'</h4>';
		}
		$output .= do_shortcode( $content );
		$output .= '</div>';
		
		return $output;
	}
	
	add_shortcode('alert', 'themo_alerts');
	
	/*
	==========================================================
	Blockquotes
	==========================================================
	*/
	function themo_blockquotes( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'reverse' => '', /* on, off */
		'cite' => '', /* text for cite */
		'align' => '', /* left, right */
		'name' => '', // Person's Name
		), $atts ) );
		
		// sanitize
		$content = wp_kses_post($content); 
		$name = sanitize_text_field($name);
		$cite = sanitize_text_field($cite);
		$reverse = sanitize_html_class($reverse);
		$align = sanitize_html_class($align);
		
		
		$output = '<blockquote class="';
		if($reverse == 'on') {
			$output .= 'blockquote-reverse ';
		}
		
		if($align == 'left') {
			$output .= 'text-left ';
		}
		elseif($align == 'right'){
			$output .= 'text-right ';
		}
		
		$output .= '"><p>'.$content.'</p>';
		
		$space = "";
		
		if ($cite > ""){
			$cite = '<cite class="blockquote-space" title="'.$cite.'">'.$cite.'</cite>';
		}
		
		if($name > "" || $cite > ""){
			$output .= '<footer>'.$name.$cite.'</footer>';
		}
		
		$output .= '</blockquote>';
		
		return $output;
	}
	
	add_shortcode('blockquote', 'themo_blockquotes');
	
	
	/*
	==========================================================
	Button Group
	==========================================================
	*/
	function themo_button_group( $atts, $content ) {
		extract( shortcode_atts( array(
			'variation' => '',
			), $atts ) );
		
		$variation = sanitize_html_class($variation); // sanitize
		
		if($variation == "justified" ){
			$variation = "btn-group-justified";
		}
	
		$output = '<div class="btn-group '.$variation.'">';
		$output .= do_shortcode( $content );
		$output .= '</div>';	
		return $output;}
	
	add_shortcode('button_group', 'themo_button_group');
	
	/*
	==========================================================
	Buttons
	==========================================================
	*/
	function themo_buttons( $atts, $content = null) {
		extract( shortcode_atts( array(
		'type' => 'default', /* primary, default, info, success, danger, warning, inverse, cta */
		'size' => '', /* lg, sm, xs */
		'url'  => '',
		'text' => '',
		'icon' => '',
		'icon_halflings' => '',
		'icon_social' => '',
		'icon_filetype' => '',
		'iconcolor' => '',
		'target' => '_self',
		'dropdown' => '',
		'split' => '',
		'title' => '',
		'rel' => '',
		'role' => '',
		'data_toggle' => '',
		'data_target' => '',
		'data_placement' => '',
		'data_content' => '',
		'data_trigger' => '',
		'extra_classes' => '',
		), $atts ) );
		
		
		
		// sanitize
		$type = sanitize_html_class($type);
		$size = sanitize_html_class($size);
		$url = esc_url($url);
		$text = sanitize_text_field($text);
		$icon = sanitize_text_field($icon);
		$icon_halflings = sanitize_text_field($icon_halflings);
		$icon_social = sanitize_text_field($icon_social);
		$icon_filetype = sanitize_text_field($icon_filetype);		
		$iconcolor = sanitize_html_class($iconcolor);
		
		
		$target_attr = "";
		if($target > ""){
			$target_attr = "target='".sanitize_html_class($target)."'";
		}
		
		$dropdown = sanitize_html_class($dropdown);
		$split = sanitize_html_class($split);
		$title = sanitize_text_field($title);
		$rel = sanitize_html_class($rel);
		$role = sanitize_html_class($role);
		$data_toggle = sanitize_html_class($data_toggle);
		$data_target = sanitize_text_field($data_target);
		$data_placement = sanitize_html_class($data_placement);
		$data_content = wp_kses_post($data_content);
		$data_trigger = sanitize_html_class($data_trigger);
		$extra_classes = sanitize_html_class($extra_classes);
		
		// If this is a dropdown button, then insert dropdown-toggle class and also data-toggle
		if($dropdown == 'yes'){
			$dropdown = "dropdown-toggle";
			$data_toggle = "dropdown";
			$dropdown_before = "<ul class='dropdown-menu' role='menu'>";
			$dropdown_after = "</ul>";
		}else{ 
			$dropdown = '';
			$dropdown_before = '';
			$dropdown_after = '';
		}
		
		if($data_toggle > ""){
			$data_toggle = "data-toggle='$data_toggle'";
		}
		if ($data_target > ""){
			$data_target = "data-target='$data_target'";
		}
		if ($data_placement > ""){
			$data_placement = "data-placement='$data_placement'";
		}
		
		if ($data_content > ""){
			$data_content = "data-content='$data_content'";
		}
		
		if($role > ""){
			$role = "role='$role'";
		}
		if($title > ""){
			$title = "title='$title'";
		}
		
		if($rel > ""){
			$rel = "rel='$rel'";
		}
		if ($data_trigger > ""){
			$data_trigger = "data-trigger='$data_trigger'";
		}
		
		if($type == "default" || $type == ""){
			$type = "btn-default";
		}
		else{ 
			$type = "btn-" . $type;
		}
		
		if($size == "default" || $size == ""){
			$size = "";
		}
		else{
			$size = "btn-" . $size;
		}
		
		if($icon > ""){
			$icon = do_shortcode('[glyphicon icon="glyphicons '.$icon.'" wrapper=i] ');
		}elseif($icon_halflings > ""){
			$icon = do_shortcode('[glyphicon icon="halflings '.$icon_halflings.'" wrapper=i] ');
		}elseif($icon_social > ""){
			$icon = do_shortcode('[glyphicon icon="social '.$icon_social.'" wrapper=i] ');
		}elseif($icon_filetype > ""){
			$icon = do_shortcode('[glyphicon icon="filetype '.$icon_filetype.'" wrapper=i] ');
		}else{
			$icon = "";
		}
		
		if ($split == 'yes'){
			$output = "<button type=\"button\" class=\"btn $type $size\">".$icon . $text."</button>";
			$output .= "<button type=\"button\" class=\"btn $type $size dropdown-toggle\" data-toggle=\"dropdown\">";
			$output .= "<span class=\"caret\"></span>";
			$output .= "<span class=\"sr-only\">Toggle Dropdown</span>";
			$output .= "</button>";
		}else{
			$output = '<a href="' . $url . '" ' . $target_attr . ' class="btn '. $type .' '. $size .' '. $dropdown .' '. $extra_classes.'" '. $data_toggle . ' '. $data_target.' ' .$data_placement.' ' .$title.' ' .$rel. ' ' .$data_trigger.' ' .$role.' ' .$data_content.'>';
			$output .= $icon;
			$output .= $text;
			$output .= '</a>';
		}
		
		$output .=  $dropdown_before;
		$output .= do_shortcode( $content );
		$output .= $dropdown_after;
		
		return $output;
	}
	
	add_shortcode('button', 'themo_buttons'); 
	add_shortcode('themo_button', 'themo_buttons'); 
	
	/*
	==========================================================
	Buttons Dropdown Items
	==========================================================
	*/
	function themo_button_dropdown_item( $atts, $content = null) {
		extract( shortcode_atts( array(
		'link' => '#',
		'target' => '_self', // blank, self, parent, top
		'divider' => '', // yes / no
		'icon' => '',
		'icon_halflings' => '',
		'icon_social' => '',
		'icon_filetype' => '',
		
		), $atts ) );
		
		// sanitize
		$link = esc_url($link);
		$target = sanitize_html_class($target);
		$divider = sanitize_html_class($divider);
		$icon = sanitize_text_field($icon);
		$icon_halflings = sanitize_text_field($icon_halflings);
		$icon_social = sanitize_text_field($icon_social);
		$icon_filetype = sanitize_text_field($icon_filetype);		
		
		$targetList = array("blank", "self", "parent", "top");
		if (in_array($target, $targetList)) {
			$target = "_".$link;
		}else{
			$target = "#";
		}
		
		if($icon > ""){
			$icon = do_shortcode('[glyphicon icon="glyphicons '.$icon.'" wrapper=i] ');
		}elseif($icon_halflings > ""){
			$icon = do_shortcode('[glyphicon icon="halflings '.$icon_halflings.'" wrapper=i] ');
		}elseif($icon_social > ""){
			$icon = do_shortcode('[glyphicon icon="social '.$icon_social.'" wrapper=i] ');
		}elseif($icon_filetype > ""){
			$icon = do_shortcode('[glyphicon icon="filetype '.$icon_filetype.'" wrapper=i] ');
		}else{
			$icon = "";
		}
		
		
		if ($divider == 'yes') {
			$output = "<li class=\"divider\"></li>";
		}else{
			$output = '<li><a href="' . $link . '" target="' . $target . '">';
			$output .= $icon;
			//$output .= $text;
			$output .=  $content;
			$output .= '</a></li>';	
		}
		
		return $output;
	}
	
	add_shortcode('dropdown', 'themo_button_dropdown_item'); 
	
	/*
	==========================================================
	Carousel / Flex Slider
	==========================================================
	*/
	function themo_slider_gallery( $atts, $content = null ) {
		
		
		if (!empty($atts['ids'])) {
			if (empty($atts['orderby'])) {
			  $atts['orderby'] = 'post__in';
			}
			$atts['include'] = $atts['ids'];
		}
		
		
		if (isset($atts['orderby'])) {
			$atts['orderby'] = sanitize_sql_orderby($atts['orderby']);
			if (!$atts['orderby']) {
			  unset($atts['orderby']);
			}
		}
		  
		extract( shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'ids' => '',
		'exclude' => '',
		'width' => '',
		'image_size' => '',
		'image_size_large' => 'themo_full_width',
		), $atts ) );
		
		// sanitize
		$ids = sanitize_text_field($ids);
		$exclude = sanitize_text_field($exclude);
		$width = sanitize_text_field($width);
		$image_size = sanitize_text_field($image_size);
		$image_size_large = sanitize_text_field($image_size_large);
		
		$order = sanitize_text_field($order);
		$orderby = sanitize_text_field($orderby);
		
		if ($order === 'RAND') {
			$orderby = 'none';
		}
				
		if($width > ""){
			$width = "width: $width";
			$width .= "px";
		}
		if ( function_exists( 'ot_get_option' ) ) {
			$themo_flex_animation  = ot_get_option( 'themo_flex_animation', "fade" );
			$themo_flex_easing  = ot_get_option( 'themo_flex_easing', "swing" );
			$themo_flex_animationloop  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_animationloop', 'on' ));
			$themo_flex_smoothheight  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_smoothheight', 'off' ));
			$themo_flex_slideshowspeed  = ot_get_option( 'themo_flex_slideshowspeed', 7000 );
			$themo_flex_animationspeed  = ot_get_option( 'themo_flex_animationspeed', 600 );
			$themo_flex_randomize  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_randomize', 'off' ));
			$themo_flex_pauseonhover  =themo_return_on_off_boolean( ot_get_option( 'themo_flex_pauseonhover', 'on' ));
			$themo_flex_touch  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_touch', 'on' ));
			$themo_flex_directionnav  = themo_return_on_off_boolean(ot_get_option( 'themo_flex_directionnav', 'on' ));
			} 
		$themo_flex_settings = "'$themo_flex_animation', '$themo_flex_easing',
							$themo_flex_animationloop, $themo_flex_smoothheight, $themo_flex_slideshowspeed, $themo_flex_animationspeed,
							$themo_flex_randomize, $themo_flex_pauseonhover, $themo_flex_touch, $themo_flex_directionnav";
		
		$flex_ID = themo_randomString();
		
		global $post;
		$id = $post->ID;
	    if ( !empty($ids) ) {
	        $include = preg_replace( '/[^0-9,]+/', '', $ids );
	        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	
	
	        $attachments = array();
	        foreach ( $_attachments as $key => $val ) {
	            $attachments[$val->ID] = $_attachments[$key];
	        }
	    } elseif ( !empty($exclude) ) {
	        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
	        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	    } else {
	        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	    }
		
		$output = 	"<script>\n jQuery(window).load(function($) { \n
						start_flex_slider('#$flex_ID', $themo_flex_settings ); \n
						}); \n
					</script>\n";
		$output .= "<div id='$flex_ID' class='flexslider' style='$width'>";
    	$output .= "<ul class='slides'>";		
	
		foreach ( $attachments as $id => $attachment ) {
	        $link = wp_get_attachment_url( $id );
	
			$output .='<li>';
			
			$image_large_attributes = wp_get_attachment_image_src( $attachment->ID, $image_size_large) ;
			
			if( $image_large_attributes ) {
				$image_large_src = $image_large_attributes[0];
			}else{
				$image_large_src = wp_get_attachment_url( $attachment->ID );
			}
			
			$image_attributes = wp_get_attachment_image_src( $attachment->ID, $image_size) ;
			
			
			$alt_text = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
			if ($alt_text > ""){
				$alt_text = "alt='".$alt_text."'";
			}
			
			if( $image_attributes ) {
				//echo $image_size;
				$image_src = $image_attributes[0];
				//echo $image_src;
			}else{
				$image_src = wp_get_attachment_url( $attachment->ID );
			}
			
			$output .= "<a href='".$image_large_src."' data-toggle='lightbox' data-gallery='multiimages'>";
			$output .= "<img src='".$image_src."' $alt_text />";
			$output .= "</a>";
			$output .= "</li>";
		}
		
		$output .= "</ul><!--  END FLEX UL -->";
		$output .= "</div><!--  END FLEX DIV -->";
		return $output;
	}
	
	add_shortcode('slider_gallery', 'themo_slider_gallery');
	
	/*
	==========================================================
	Code Inline
	==========================================================
	*/
	function themo_code( $atts, $content ) {
		extract( shortcode_atts( array(
		'scroll' => 'off',
		'inline' => 'off'
		), $atts ) );
		
		// sanitize
		$content = wp_kses_post($content);
		$content = esc_html($content); 
		
		$scroll = sanitize_html_class($scroll);
		$inline = sanitize_html_class($inline);
		
		
		if($scroll == "on"){
			$scroll = "class='pre-scrollable'";
		}
		else{ 
			$scroll = "";
		}
		
		if($inline == 'on'){
			$output = '<code>'.  $content . '</code>';
		}else{
			$output = '<pre '. $scroll . '>'. $content . '</pre>';
		}
		
		return $output;
	}
	
	add_shortcode('code', 'themo_code');
	
	/*
	==========================================================
	Columns
	==========================================================
	*/
	function themo_columns( $atts, $content ) {
		extract( shortcode_atts( array(
		'span' => '12',
		), $atts ) );
		
		// sanitize
		$content = wp_kses_post($content);
		$span = intval($span);
		
		$output = '<div class="col-md-'.$span.'">';
		$output .= do_shortcode( $content );
		$output .= '</div>';	
		return $output;}
	
	add_shortcode('column', 'themo_columns');
	
	/*
	==========================================================
	Column Row
	==========================================================
	*/
	function themo_row( $atts, $content ) {
		
		// sanitize
		$content = wp_kses_post($content);
		
		$output = '<div class="row">';
		$output .= do_shortcode( $content );
		$output .= '</div>';
		return $output;}
	
	add_shortcode('row', 'themo_row');
	
	/*
	==========================================================
	Divider
	==========================================================
	*/

	function themo_ruler($atts) {
		extract(shortcode_atts(array(
			'top' => 'false',
			'bottom'=> 'false',
			'margins'=> '10',
		), $atts));
		$percent = '';
		$styles = array();
		
		if($top!== 'false'){
			$top = intval($top );
			$styles[] = 'padding-top:'.$top.'px';
		}
		if($bottom!== 'false'){
			$bottom = intval($bottom );
			$styles[] = 'margin-bottom:'.$bottom.'px';
		}
		if($percent!== 'false'){
			$margins = intval($margins );
			$styles[] = 'margin-left:'.$margins.'px';
			$styles[] = 'margin-right:'.$margins.'px';
		}
		if(!empty($styles)){
			$style = ' style="'.implode(';', $styles).'"';
		}else{
			$style = '';
		}
		return '<div class="ruler" '.$style.'></div>';
	}
	
	add_shortcode('ruler', 'themo_ruler');
	
	/*
	==========================================================
	Dropcaps
	==========================================================
	*/
	function themo_dropcaps( $atts, $content ) {
		extract( shortcode_atts( array(
		'style' => 'book',  // box, circle, book
		), $atts ) );
	
		// sanitize
		$content = wp_kses_post($content);
		$style = wp_kses_post($style);
		
		$styles = array("box", "circle", "book");
			if (in_array($style, $styles)) {
				$style = "dropcap-" . $style;;
			}else{
				$style = "dropcap-book";
			}  
		
		
		$output = "<span class='dropcap $style'>";
		$output .= do_shortcode( $content );
		$output .= '</span>';
		return $output;}
	
	add_shortcode('dropcaps', 'themo_dropcaps');
	
	/*
	==========================================================
	Icon / Glyphicons
	==========================================================
	*/
	function themo_glyphicon( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'icon' => 'glyphicon sign',
		'icon_halflings' => '',
		'icon_social' => '',
		'icon_filetype' => '',
		'wrapper' => 'i', // span | i (default)
		'size' => '',
		'style' => ''
		), $atts ) );
		
		// sanitize
		$icon = sanitize_text_field($icon);
		$icon_halflings = sanitize_text_field($icon_halflings);
		$icon_social = sanitize_text_field($icon_social);
		$icon_filetype = sanitize_text_field($icon_filetype);
		$wrapper = sanitize_html_class($wrapper);
		$size = sanitize_html_class($size);
		$style = sanitize_html_class($style);
		
		//list($glyhicon_library, $glyhicon_icon) = explode(' ', "$icon ", 2);
		
		if($icon > ""){
			$glyphicon_sets = array("glyphicons","halflings","social","filetype");
			if(!themo_string_contains($icon, $glyphicon_sets)){
				$icon = "glyphicons $icon";
			}
		}elseif($icon_halflings > ""){
			$icon = "halflings $icon_halflings";
		}elseif($icon_social > ""){
			$icon = "social $icon_social";
		}elseif($icon_filetype > ""){
			$icon = "filetype icon_filetype";
		}else{
			$icon = "";
		}
	
		$output = "<$wrapper class='$size $style $icon'></$wrapper>";

		return $output;
	}
	
	add_shortcode('glyphicon', 'themo_glyphicon');
	
	/*
	==========================================================
	Horizontal description Group
	==========================================================
	*/
	function themo_horizontal_description_group( $atts, $content ) {
	
		// sanitize
		$output = '<dl class="dl-horizontal">';
		$output .= do_shortcode( $content );
		$output .= '</dl><!-- end Horizontal Description Group -->';		
			
		return $output;
	}
		
	add_shortcode('hr_list_wrap', 'themo_horizontal_description_group');
	
	
	/*
	==========================================================
	Horizontal description
	==========================================================
	*/
	function themo_horizontal_description( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'title' => '',
		), $atts ) );
		
		// sanitize
		$title = sanitize_text_field($title);
		$content = wp_kses_post($content);
		
		$output = "<dt>$title</dt>";
		$output .= "<dd>$content</dd>";
		
		return $output;
	}
	
	add_shortcode('hr_list', 'themo_horizontal_description');
	
	
	/*
	==========================================================
	Image shapes
	==========================================================
	*/
	function themo_image_shapes( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'src' => '',
		'link' => '',
		'target' => '',
		'class' => '',
		'alt' => '',
		'width' => '',
		'height' => '',
		'shape' => 'img-rounded', /* img-rounded, img-circle, img-thumbnail*/
		), $atts ) );
		
		
		// sanitize
		$src = esc_url($src);
		$link = esc_url($link);
		$target = sanitize_html_class($target);
		$class = sanitize_text_field($class);
		$alt = sanitize_text_field($alt);
		$width = sanitize_text_field($width);
		$height = sanitize_text_field($height);
		$shape = "img-".sanitize_html_class($shape);
		
		if($width > ""){
			$width = "width='$width'";;
		}
		if($height > ""){
			$height = "height='$height'";;
		}
		if($target > ""){
			$target="target='$target'";
		}
		$img_tag = "<img class='$shape $class' alt='$alt' src='$src' $width $height />";
		
		if($link > ""){
			$output = "<a href='$link' $target>";
			$output .= $img_tag;
			$output .= "</a>";
		}else{
			$output = $img_tag;
		}
		
		return $output;
	}
	
	add_shortcode('shape', 'themo_image_shapes');
	
	
	/*
	==========================================================
	Jumbotron
	==========================================================
	*/
	function themo_jumbotron( $atts, $content ) {
		extract( shortcode_atts( array(
		'background' => '', /* alert-info, alert-success, alert-error */ 
		'color' => '',
		), $atts ) );
		
		// sanitize
		$background = sanitize_text_field($background);
		$color = sanitize_text_field($color);
		
		$output = '<div style="background-color:'.$background.';color:'.$color.';" class="jumbotron">';
		$output .= do_shortcode( $content );
		$output .= '</div>';
		return $output;}
	
	add_shortcode('jumbotron', 'themo_jumbotron');
	
	/*
	==========================================================
	Labels
	==========================================================
	*/
	function skematik_shortcode_labels( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'type' => 'default', /* primary, default, info, success, danger, warning, inverse */
		'text' => '',
		), $atts ) );
		
		$type = strtolower($type);

		// sanitize
		$type = sanitize_html_class($type);
		$text = sanitize_text_field($text);
		
		$types = array("default", "primary", "success", "info", "warning", "danger");
		if (in_array($type, $types)) {
			$type = "label-" . $type;;
		}else{
			$type = "label-default";
		}
		
		$output = '<span class="label ' . $type . '">';
		$output .= $text;
		$output .= '</span>';
		
		return $output;
	}
	
	add_shortcode('label', 'skematik_shortcode_labels');
	
	/*
	==========================================================
	Lead
	==========================================================
	*/
	
	function themo_lead( $atts, $content ) {
		extract( shortcode_atts( array(
		'align' => '',  // Left, Center, Right
		), $atts ) );
		
		// sanitize
		$content = sanitize_text_field($content);
		$align = sanitize_text_field($align);
		
		switch ($align) {
			case 'left':
				$align = 'pull-left';
				break;
			case 'right':
				$align = 'pull-right';
				break;
			case 'center':
				$align = 'text-center';
				break;
			default:
			$align = '';
		}
		
	
		$output = "<p class='lead $align'>";
		$output .= do_shortcode( $content );
		$output .= '</p>';	
		return $output;}
	
	add_shortcode('lead', 'themo_lead');
	
	/*
	==========================================================
	Link
	==========================================================
	*/
	function themo_link( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'url' => '#', 
		'target' => '',	// _blank, _self, _parent, _top
		'class' => '',
		'title' => '',
		'rel' => '',
		'data_placement' => '',
		'data_trigger' => '',
		'data_content' => '',
		), $atts ) );
		
		// sanitize
		$url = esc_url($url);
		
		$target_attr = "";
		if($target > ""){
			$target_attr = "target='".sanitize_html_class($target)."'";
		}
		
		$class = sanitize_text_field($class);
		$title = sanitize_text_field($title);
		$rel = sanitize_html_class($rel);
		$data_placement = sanitize_html_class($data_placement);
		$data_trigger = sanitize_html_class($data_trigger);
		$data_content = wp_kses_post($data_content);
		$content = wp_kses_post($content);
		
		
		
		if ($data_placement > ""){
			$data_placement = "data-placement='$data_placement'";
		}
		if($title > ""){
			$title = "title='$title'";
		}
		
		if($rel > ""){
			$rel = "rel='$rel'";
		}
		
		if ($data_trigger > ""){
			$data_trigger = "data-trigger='$data_trigger'";
		}

		if ($data_content > ""){
			$data_content = "data-content='$data_content'";
		}

		$output = "<a href='$url' $target_attr class='$class' $data_placement $rel $title $data_trigger $data_content>";
		$output .= do_shortcode( $content );
		$output .= "</a>";		
		
		return $output;
	}
	
	add_shortcode('link', 'themo_link');
	
	
	/*
	==========================================================
	Modals 
	==========================================================
	*/
	function wt_modal_window($atts, $content = null){
		extract(shortcode_atts( array(
			'button_type' => 'info',  /* primary, default, info, success, danger, warning, inverse, cta */
			'button_text' => 'More',
			'button_size' => 'lg',  /* lg, sm, xs */
			'title'		=> '',
			'footer' => 'on' // on / off
			), $atts ));

		// sanitize
		$button_type = sanitize_html_class($button_type);
		$button_text = sanitize_text_field($button_text);
		$button_size = sanitize_html_class($button_size);
		$title = sanitize_text_field($title);
		$footer = sanitize_html_class($footer);
		$content = wp_kses_post($content);

		$modal_ID = themo_randomString();	
		// $modal_ID = "modal";
		$button = "<!-- Button trigger modal -->";
		$button .= do_shortcode("[button text='$button_text' type='$button_type' size='$button_size' data_toggle='modal' data_target='#$modal_ID']");

		$modal = $button;
		$modal .= "<div id='$modal_ID' class='modal fade' tabindex='1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
		
		$modal .= "<div class='modal-dialog'>";
		$modal .= "<div class='modal-content'>";
		$modal .= 	"<div class='modal-header'>";
		$modal .=		"<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>";
		$modal .=		"<h4>$title</h4>";
		$modal .=   "</div>";
		$modal .=	"<div class='modal-body'>";
		$modal .=		do_shortcode($content);
		$modal .=   "</div>";
		if($footer == 'on'){
		$modal .=   "<div class='modal-footer'>";
		$modal .=   	"<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>";
		$modal .= 	"</div>";
		}
		$modal .= "</div><!-- /.modal-content -->";
		$modal .= "</div><!-- /.modal-dialog -->";
	    $modal .= "</div><!-- /.modal -->";
		 
		return $modal;
	}
	
	add_shortcode("modal", "wt_modal_window");
	
	/*
	==========================================================
	Page Header
	==========================================================
	*/
	function themo_page_header( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'text' => '', 
		'subtext' => '',
		), $atts ) );
		
		// sanitize
		$text = sanitize_text_field($text);
		$subtext = sanitize_text_field($subtext);
		$content = wp_kses_post($content);
		
		if($subtext > ""){
			$subtext = ' <small>'. $subtext . '</small>';
		}
		
		$output = '<div class="page-header"><h1>'.$text.'';
		$output .= $subtext;
		$output .= '</h1></div>';
		return $output;
	}
	
	add_shortcode('header', 'themo_page_header');
	
	/*
	==========================================================
	Panel with Heading
	==========================================================
	*/
	
	function themo_panel( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'type' => 'default', //deafult, primary, success, info, warning, danger
		'heading' => '',
		), $atts ) );
		
		// sanitize
		$type = sanitize_html_class($type);
		$heading = sanitize_text_field($heading);
		$content = wp_kses_post($content);
		
		$output =  "<div class='panel panel-$type'>";
		if ($heading > ""){
			$output .= "<div class='panel-heading'>$heading</div>";
		}
		$output .= "<div class='panel-body'>";
		$output .= do_shortcode( $content );
		$output .= "</div>";
		$output .= "</div>";
		
		return $output;
	}
	
	add_shortcode('panel', 'themo_panel');
	
	/*
	==========================================================
	Popovers
	==========================================================
	*/
	function themo_popover( $atts, $content = null) {
		extract( shortcode_atts( array(
		'button_text' => '',
		'button_type' => '',
		'button_size' => '',
		'popover_title' => '',
		'popover_placement' => 'top',
		'link' => '',
		'target' => '_self'
		), $atts ) );
	
		// sanitize
		$button_text = sanitize_text_field($button_text);
		$button_type = sanitize_html_class($button_type);
		$button_size = sanitize_html_class($button_size);
		$popover_title = sanitize_text_field($popover_title);
		$popover_placement = sanitize_html_class($popover_placement);
		$link = esc_url($link);
		$target = sanitize_html_class($target);
		$content = wp_kses_post($content);
		
		$button = do_shortcode("[button url='$link' target='$target' text='$button_text' type='$button_type' size='$button_size' title='$popover_title' rel='popover' data_content='$content' data_placement='$popover_placement' data_trigger='hover']");
		
		return $button;}
	
	add_shortcode('popover', 'themo_popover');
	
	
	/*
	==========================================================
	Popover Text
	==========================================================
	*/
	function themo_popover_text( $atts, $content = null) {
		extract( shortcode_atts( array(
		'popover_title' => '',
		'popover_content' => '',
		'popover_placement' => 'top',
		'link' => '',
		'target' => '_self'
		), $atts ) );
		
		// sanitize
		$popover_title = sanitize_text_field($popover_title);
		$popover_content = wp_kses_post($popover_content);
		$popover_placement = sanitize_html_class($popover_placement);
		$link = esc_url($link);
		$target = sanitize_html_class($target);
		$content = wp_kses_post($content);		
	
		$link = do_shortcode("[link url='$link' target='$target'  title='$popover_title' rel='popover' data_content='$popover_content' data_placement='$popover_placement' data_trigger='hover']".$content."[/link]");
		
		return $link;}
	
	add_shortcode('popover_text', 'themo_popover_text');
	
	/*
	==========================================================
	Progress Bar
	==========================================================
	*/
	function skematik_shortcode_progress_bar( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'animate' => 'off',
		'type' => 'default', // success,  info,  warning,  danger
		'striped' => 'off',
		'progress' =>'20',
		'label' => ''
		), $atts ) );
		
		// sanitize
		$animate = sanitize_html_class($animate);
		$type = sanitize_html_class($type);
		$striped = sanitize_html_class($striped);
		$progress = sanitize_html_class($progress);
		$label = sanitize_text_field($label);	
		
		
		if($animate == "on"){
			$animate = "active";
		}
		else{
		$animate = '';
		}
		if($striped == "on"){
			$striped = "progress-striped";
		}
		else{
		$striped = '';
		}
		if($type == "default"){
			$type = "";
		}
		else{
		$type = 'progress-bar-'.$type.'';
		}
	
		
		if($label > ""){
			$label = "<span >$progress% $label</span>";
		}else{
			$label = "<span class='sr-only'>$progress% $label</span>";
		}
		
		$output = '<div class="progress '.$striped.' '.$animate.'"><div class="progress-bar '.$type.'" role="progressbar" style="width:'.$progress.'%;">'.$label.'</div></div>';
		return $output;}
	
	add_shortcode('progress', 'skematik_shortcode_progress_bar');
	
	
	/*
	==========================================================
	Tabs / Togglable
	==========================================================
	*/
	function themo_tab_wrap( $atts, $content ){
	
			
		$return = '';
		$GLOBALS['tab_count'] = 0;
		$iCount = 0;
		$tagGroup = themo_RandNumber(3);
		$iCount = $tagGroup + $iCount;
		$isActive = "active";
		$fade = 'fade in';
		
		do_shortcode( $content );
		
		if( is_array( $GLOBALS['tabs'] ) ){
			$headings[] = '<ul class="nav nav-tabs">';
			$panes[] = '<div class="tab-content">';
			foreach( $GLOBALS['tabs'] as $tab ){
				
				// sanitize
				$tab['title'] = sanitize_text_field($tab['title']);
				$tab['content'] = wp_kses_post($tab['content']);
				
				// unique $iCount
				$headings[] = "<li class='$isActive'><a href='#tab$iCount' data-toggle='tab'>".$tab['title']."</a></li>";
				$panes[] = "<div class='tab-pane $isActive $fade' id='tab$iCount'>\n".$tab['content']."</div>";
				$iCount++;
				$isActive = '';	
				$fade = 'fade';
			}
		$headings[] = "</ul>";
		$panes[] = '</div>';
		$return = $return . "\n".'<!-- the tabs -->'.implode( "\n", $headings )."\n".implode( "\n", $panes )."\n";
		}
	
	return $return;
	}
	
	add_shortcode( 'tabwrap', 'themo_tab_wrap' );
	
	function themo_tab( $atts, $content ){
		extract(shortcode_atts(array(
			'title' => 'Tab %d'
		), $atts));
		
		// sanitize
		$content = wp_kses_post($content); 
	
		$x = $GLOBALS['tab_count'];
		$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  do_shortcode($content) );
	
		$GLOBALS['tab_count']++;
	}

	add_shortcode( 'tab', 'themo_tab' );
	
	
	
	
	
	/*
	==========================================================
	Tooltip
	==========================================================
	*/
	function themo_tooltip( $atts, $content = null) {
		extract( shortcode_atts( array(
		'button_text' => '',
		'button_type' => '',
		'button_size' => '',
		'tooltip_text' => '',
		'tooltip_placement' => 'top',
		'link' => '',
		'target' => '_self'
		), $atts ) );
	
		// sanitize
		$button_text = sanitize_text_field($button_text);
		$button_type = sanitize_html_class($button_type);
		$button_size = sanitize_html_class($button_size);
		$tooltip_text = sanitize_text_field($tooltip_text);
		$tooltip_placement = sanitize_html_class($tooltip_placement);
		$link = esc_url($link);
		$target = sanitize_html_class($target);
		$content = wp_kses_post($content);
		
		$button = do_shortcode("[button text='$button_text' type='$button_type' size='$button_size' title='$tooltip_text' rel='tooltip' data_placement='$tooltip_placement' url='$link' target='$target']");
		
		return $button;}
	
	add_shortcode('tooltip', 'themo_tooltip');
	
	
	/*
	==========================================================
	Tooltip Text
	==========================================================
	*/
	function themo_tooltip_text( $atts, $content = null) {
		extract( shortcode_atts( array(
		'tooltip_text' => '',
		'tooltip_placement' => 'top',
		'link' => '',
		'target' => '_self'
		), $atts ) );
		
		$tooltip_text = sanitize_text_field($tooltip_text);
		$tooltip_placement = sanitize_html_class($tooltip_placement);
		$link = esc_url($link);
		$target = sanitize_html_class($target);
	
		$link = do_shortcode("[link title='$tooltip_text' rel='tooltip' data_placement='$tooltip_placement' url='$link' target='$target']".$content."[/link]");
		
		return $link;}
	
	add_shortcode('tooltip_text', 'themo_tooltip_text');
	
	/*
	==========================================================
	Google Map 
	==========================================================
	*/

	if ( ! function_exists( 'themo_googlemaps' ) ) {
		function themo_googlemaps( $atts, $content = null ) {
	
			extract(shortcode_atts(array(
					'title'		=> '',
					'location'	=> '',
					'width'		=> '',
					'height'	=> '300',
					'zoom'		=> 8,
					'align'		=> '',
					'class'		=> '',
			), $atts));
	
	
		$title = sanitize_text_field($title);
		$location = sanitize_text_field($location);
		$width = intval($width);
		$height = intval($height);
		$zoom = intval($zoom);
		$align = sanitize_html_class($align);
		$class = sanitize_html_class($class);
	
		switch ($align) {
			case 'left':
				$align = 'pull-left';
				break;
			case 'right':
				$align = 'pull-right';
				break;
			case 'center':
				//$align = 'text-center';
				$align = 'center-block';
				break;
			default:
			$align = '';
		}
	
		if($width > ""){
			$width = "width:".$width."px";
		}else{
			$width = "width:100%";
		}
		
		if($height > ""){
			$height = "height:".$height."px";
		}else{
			$height = "height:300px";
		}
		
		$output = '<div id="map_canvas_' . rand(1, 100) . '" class="googlemap ' . $class . ' '. $align .'" style="' . $height . ';' . $width . '">';
				$output .= ( !empty($title) ) ? '<input class="title" type="hidden" value="'.$title.'" />' : '';
				$output .= '<input class="location" type="hidden" value="' . $location . '" />';
				$output .= '<input class="zoom" type="hidden" value="' . $zoom . '" />';
				$output .= '<div class="map_canvas"></div>';
			$output .= '</div>';
	
			return $output;
	
		}
		add_shortcode( 'google_map', 'themo_googlemaps' );
	}


	/*
	==========================================================
	Highlights
	==========================================================
	*/
	
	if ( !function_exists( 'themo_highlight' ) ) {
		function themo_highlight( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'color'	=> 'primary',
				'class'	=> '',
			  ), $atts ) );
			  
			$color = sanitize_html_class($color);
			$class = sanitize_html_class($class);
			
			$colors = array("primary", "success", "info", "warning", "danger");
			if (in_array($color, $colors)) {
				$color = "bg-" . $color;;
			}else{
				$color = "bg-primary";
			}  
			return "<span class='$color $class'>" . do_shortcode( $content ) . "</span>";
	
		}
		add_shortcode( 'highlight', 'themo_highlight' );
	}	
	
} /* End themo_register_shortcodes function */

//======================================================================
// WISH LIST
//======================================================================

	/*
	==========================================================
	Badges
	==========================================================
	
	function skematik_shortcode_badges( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'type' => 'default', // primary, default, info, success, danger, warning, inverse 
		'text' => '',
		), $atts ) );
		
		$output = '<span class="badge ' . $type . ' pull-right">';
		$output .= $content;
		$output .= '</span>';
		
		return $output;
	}
	
	add_shortcode('badge', 'skematik_shortcode_badges'); */
	
	
	
	
	
	
	/*
	==========================================================
	Carousel
	==========================================================
	
	function skematik_shortcode_carousel_gallery( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'include' => '',
		'exclude' => '',
		), $atts ) );
		
		// sanitize
		$include = sanitize_text_field($include);
		$exclude = sanitize_text_field($exclude);
		
		$output = '<div id="myCarousel" class="carousel slide"><div class="carousel-inner">';
	
		global $post;
		$id = $post->ID;
	    if ( !empty($include) ) {
	        $include = preg_replace( '/[^0-9,]+/', '', $include );
	        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'title') );
	
	        $attachments = array();
	        foreach ( $_attachments as $key => $val ) {
	            $attachments[$val->ID] = $_attachments[$key];
	        }
	    } elseif ( !empty($exclude) ) {
	        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
	        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'title') );
	    } else {
	        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'title') );
	    }		
	
		foreach ( $attachments as $id => $attachment ) {
	        $link = wp_get_attachment_url( $id );
	
			$output .='<div class="item';
			if ($attachment === reset($attachments)) {$output .=' active';}
			$output .='"><a href="'.wp_get_attachment_url( $attachment->ID ).'" rel="lightbox[carousel]">';
			$output .='<img src="'.wp_get_attachment_url( $attachment->ID ).'" alt="">';
			$output .='<div class="carousel-caption"><h4>'.$attachment->post_title.'</h4><p>'.$attachment->post_excerpt.'</p></div></a>';
			$output .='</div>';
		}
		
		$output .= '</div><a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a><a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a></div>';
		
		return $output;
	}
	
	add_shortcode('carousel_gallery', 'skematik_shortcode_carousel_gallery');*/
	
	
		/*
	==========================================================
	Icon
	==========================================================
	
	function skematik_shortcode_icon( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'type' => 'glass', // primary, default, info, success, danger, warning, inverse 
		'size' => '', // small, medium, large 
		'color'  => '',
		'float'  => 'none',
		), $atts ) );
		
		if($size == "default"){
			$size = "";
		}
		else{ 
			$size = "font-size:" . $size."px;";
		}
		
		if($color == "default"){
			$color = "";
		}
		else{ 
			$color = "color:" . $color.";";
		}

		if($float == "none"){
			$float = "";
		}
		elseif($float == "left"){ 
			$float = "float:" . $float.";margin-right:8px";
		}
		else{ 
			$float = "float:" . $float.";margin-left:8px";
		}
		
		$output = '<i class="icon-'. $type . '" style="'.$color.' '.$size.' '.$float.'"></i> ';
		
		return $output;
	}
	
	add_shortcode('icon', 'skematik_shortcode_icon');*/
	
	
	/*
	==========================================================
	List group
	==========================================================
	
	function themo_shortcode_list_group( $atts, $content = null ) {
		extract( shortcode_atts( array(
		'name' => ''
		), $atts ) );
				
		$class = 'list-group';
		
		$output = "COMING SOON";
		
		return $output;
	}
	add_shortcode('list_group', 'themo_shortcode_list_group');*/