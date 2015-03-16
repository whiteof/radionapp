<?php
/**
 * List of available shortcodes
 */
 
function su_shortcodes( $shortcode = false ) {
	global $shortcodes;
	$shortcodes = array(
		# basic shortcodes - start
		'basic-shortcodes-open' => array(
			'name' => __( 'Theme Shortcodes', 'themo-shortcodes' ),
			'type' => 'opengroup'
		),


/*
==========================================================
Accordion Group
==========================================================
*/
		'accordion_group' => array(
			'name' => 'Accordion Group',
			'type' => 'wrap',
			'atts' => array( ),
			'usage' => 'Content is optional.',
			'content' => '',
			'desc' => __( 'Accordion Group', 'themo-shortcodes' ),
			'help' => __( 'Multiple Accordions are grouped with this shortcode.', 'themo-shortcodes' ),
		),
		
/*
==========================================================
Accordion
==========================================================
*/
		'accordion' => array(
			'name' => 'Accordion',
			'type' => 'wrap',
			'atts' => array(
					'title' => array(
						'values' => array( ),
						'default' => 'Box Title here',
						'desc' => __( 'Box Title', 'themo-shortcodes' ),
					),
			),
			'content' => __( 'Content goes here', 'themo-shortcodes' ),
			'textarea' => 'on',
			'desc' => __( 'Collapsible content areas.', 'themo-shortcodes' ),
			'help' => __( 'Multiple Accordions should be grouped with the Accordion Group shortcode first.', 'themo-shortcodes' ),
		),

 
/*
==========================================================
Alert
==========================================================
*/			
		'alert' => array(
			'name' => 'Alert',
			'type' => 'wrap',
			'atts' => array(
			
				'heading' => array(
					'values' => array( ),
					'default' => 'Alert Heading',
					'desc' => __( 'Alert Heading', 'themo-shortcodes' )
				),
				'type' => array(
					'values' => array(
						'alert-success',
						'alert-info',
						'alert-error',
						'alert-danger',
					),
					'default' => 'alert-info',
					'desc' => __( 'Alert Style', 'themo-shortcodes' )
				),
				'block' => array(
					'values' => array(
						'true',
						'false'
					),
					'default' => 'false',
					'desc' => __( 'Block Padding', 'themo-shortcodes' )
				),
				'close' => array(
					'values' => array(
						'true',
						'false'
					),
					'default' => 'true',
					'desc' => __( 'Close Button', 'themo-shortcodes' )
				)
			),
			//'usage' => '[alert type="alert-info" heading="Alert Heading" block="false" close="false"]Content[/alert]',
			'content' => __( 'Content goes here', 'themo-shortcodes' ),
			'desc' => __( 'Alert box with optional padding and close button', 'themo-shortcodes' )
		),

/*
==========================================================
Blockquote
==========================================================
*/			
		'blockquote' => array(
			'name' => 'Blockquote',
			'type' => 'wrap',
			'atts' => array(
			
				'cite' => array(
					'values' => array( ),
					'default' => 'Cite Title',
					'desc' => __( 'Cite Title', 'themo-shortcodes' )
				),
				'name' => array(
					'values' => array( ),
					'default' => 'Cite Name',
					'desc' => __( 'Cite Name', 'themo-shortcodes' )
				),
				'align' => array(
					'values' => array(
						'left',
						'right',
					),
					'default' => 'left',
					'desc' => __( 'Blockquote Alignment', 'themo-shortcodes' )
				),
				'reverse' => array(
					'values' => array(
						'on',
						'off'
					),
					'default' => 'off',
					'desc' => __( 'Reverse Display', 'themo-shortcodes' )
				),
				
			),
			//'usage' => "[blockquote name='R Labelle' cite='Themovation' ]Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.[/blockquote]",
			'content' => __( 'Content goes here', 'themo-shortcodes' ),
			'desc' => __( 'For quoting blocks of content from another source within your document.', 'themo-shortcodes' )
		),		

/*
==========================================================
Theme Buttons
==========================================================
*/			
		'themo_button' => array(
			'name' => 'Button',
			'type' => 'single',
			'atts' => array(
				'text' => array(
					'values' => array( ),
					'default' => 'Button Text',
					'desc' => __( 'Button Text', 'themo-shortcodes' )
				),
				'url' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Button Link', 'themo-shortcodes' )
				),
				'type' => array(
					'values' => array(
						'standard',
						'ghost',
						'cta',
					),
					'default' => 'standard',
					'desc' => __( 'Button Style', 'themo-shortcodes' )
				),
				'target' => array(
					'values' => array(
						'',
						'_self',
						'_blank'
					),
					'default' => '',
					'desc' => __( 'Button Link Target', 'themo-shortcodes' )
				),
			),
			'usage' => '',
			'desc' => __( 'Theme Buttons in 3 Styles: Standard, Ghost and Call to Action', 'themo-shortcodes' ),
			'help' => __( '', 'themo-shortcodes' ),
		),		

/*
==========================================================
Bootstrap Button Group
==========================================================
*/
		'button_group' => array(
			'name' => 'Bootstrap | Button Group',
			'type' => 'wrap',
			'atts' => array(
				'variation' => array(
					'values' => array(
						'none',
						'justified',
					),
					'default' => 'none',
					'desc' => __( 'Button Group Justified', 'themo-shortcodes' )
				),
			),
			'usage' => 'Optional: Add button shortcode to content field or use the Button Shortcode Generator.',
			'content' => '',
			'desc' => __( 'Button Group', 'themo-shortcodes' ),
			'help' => __( 'Group multiple buttons with this shortcode.', 'themo-shortcodes' ),
		),
		
/*
==========================================================
Bootstrap Buttons
==========================================================
*/			
		'button' => array(
			'name' => 'Bootstrap | Button',
			'type' => 'wrap',
			'atts' => array(
				'text' => array(
					'values' => array( ),
					'default' => 'Button Text',
					'desc' => __( 'Button Text', 'themo-shortcodes' )
				),
				'url' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Button Link', 'themo-shortcodes' )
				),
				'size' => array(
					'values' => array(
						'',
						'xs',
						'sm',
						'default',
						'large'
					),
					'default' => 'default',
					'desc' => __( 'Button Size', 'themo-shortcodes' )
				),
				'type' => array(
					'values' => array(
						'',
						'primary',
						'default',
						'info',
						'success',
						'danger',
						'warning',
						'inverse'
					),
					'default' => 'default',
					'desc' => __( 'Button Style (color)', 'themo-shortcodes' )
				),
				'target' => array(
					'values' => array(
						'',
						'_self',
						'_blank'
					),
					'default' => '',
					'desc' => __( 'Button Link Target', 'themo-shortcodes' )
				),
				'dropdown-help' => __( '<strong>Dropdowns:</strong> Use the shortcode generator to add dropdown buttons after you add at least one button.', 'themo-shortcodes' ),
				'dropdown' => array(
					'values' => array(
						'no',
						'yes',
					),
					'default' => 'no',
					'desc' => __( 'Is this the top of a button dropdown?', 'themo-shortcodes' )
				),
				'split' => array(
					'values' => array(
						'no',
						'yes',
					),
					'default' => 'no',
					'desc' => __( 'Button dropdown split style?', 'themo-shortcodes' )
				),
				'icon-help' => __( '<strong>Icons:</strong> Use any Glyphicon, Halfling, Social or Filetype. Add the icon name (e.g.: camera, time, facebook) in the appropriate text field below. Find the <a href="http://glyphicons.com/" target="_blank">full list here</a>.', 'themo-shortcodes' ),
				'icon' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Glyphicon', 'themo-shortcodes' )
				),
				'icon_halflings' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Halfling', 'themo-shortcodes' )
				),
				'icon_social' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Social', 'themo-shortcodes' )
				),
				'icon_filetype' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Filetype', 'themo-shortcodes' )
				),
			),
			'content' => '',
			'usage' => '',
			'desc' => __( '4 sizes, 7 colors and 500+ icons', 'themo-shortcodes' ),
			'help' => __( 'Multiple buttons need to be wrapped in a [button_group][/button_group], single buttons do not.', 'themo-shortcodes' ),
		),

/*
==========================================================
Bootstrap Button Dropdown
==========================================================
*/			
		'dropdown' => array(
			'name' => 'Bootstrap | Button Dropdown',
			'type' => 'wrap',
			'atts' => array(
				'link' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Dropdown Link', 'themo-shortcodes' )
				),
				'target' => array(
					'values' => array(
						'',
						'_self',
						'_blank'
					),
					'default' => '',
					'desc' => __( 'Dropdown Target', 'themo-shortcodes' )
				),
				'divder' => array(
					'values' => array(
						'no',
						'yes',
					),
					'default' => 'no',
					'desc' => __( 'Dropdown Divder', 'themo-shortcodes' )
				),
				
				'help' => __( '<strong>Icons:</strong> Use any Glyphicon, Halfling, Social or Filetype. Add the icon name (e.g.: camera, time, facebook) in the appropriate text field below. Find the <a href="http://glyphicons.com/" target="_blank">full list here</a>', 'themo-shortcodes' ),
				'icon' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Glyphicon', 'themo-shortcodes' )
				),
				'icon_halflings' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Halfling', 'themo-shortcodes' )
				),
				'icon_social' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Social', 'themo-shortcodes' )
				),
				'icon_filetype' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Filetype', 'themo-shortcodes' )
				),
			),
			'content' => 'Button Text',
			'usage' => "",
			'desc' => __( '4 sizes, 7 colors and 500+ icons', 'themo-shortcodes' ),
			'help' => __( 'Used in conjunction with the Button Shortcode and Button Group Shortcode.<br>This Shortcode requires a Button Shortcode AND a Button Group Shortcode Wrapper', 'themo-shortcodes' ),
		),

/*
==========================================================
Carousel
==========================================================
*/			
		'slider_gallery' => array(
			'name' => 'Carousel / Slider Gallery',
			'type' => 'single',
			'atts' => array(
				'ids' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Include specific image IDs', 'themo-shortcodes' )
				),
				'width' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Carousel width e.g. 600', 'themo-shortcodes' )
				),
			),
			'help' => __( 'Simular to the <a href="http://codex.wordpress.org/Gallery_Shortcode" target="_blank">WordPress [gallery] shortcode</a>. Takes image IDs and converts into a carousel gallery.', 'themo-shortcodes' ),
			'desc' => __( 'A Carousel of your gallery\'s images', 'themo-shortcodes' )
		),

/*
==========================================================
Code
==========================================================
*/	
		'code' => array(
			'name' => 'Code',
			'type' => 'wrap',
			'atts' => array(
				'scroll' => array(
					'values' => array(
						'on',
						'off'
					),
					'default' => 'off',
					'desc' => __( 'Scroll - for large blocks', 'themo-shortcodes' )
				),
				'inline' => array(
					'values' => array(
						'on',
						'off'
					),
					'default' => 'off',
					'desc' => __( 'Inline with text', 'themo-shortcodes' )
				)
			),
			'content' => __( 'Code goes here', 'themo-shortcodes' ),
			'textarea' => 'on',
			'desc' => __( 'Code box for showing code.', 'themo-shortcodes' )
		),

/*
==========================================================
Column
==========================================================
*/
		'column' => array(
			'name' => 'Column',
			'type' => 'wrap',
			'atts' => array(
				'span' => array(
					'values' => array(
						'1',
						'2',
						'3',
						'4',
						'5',
						'6',
						'7',
						'8',
						'9',
						'10',
						'11',
						'12'
					),
					'default' => '',
					'desc' => __( 'Column Span.', 'themo-shortcodes' )
				)
			),
			'help' => __( 'The column shortcode is a grid of up to 12 columns. If you want two equal columns, create two columns, with a span of 6 each.', 'themo-shortcodes' ),
			'content' => __( 'Content goes here', 'themo-shortcodes' ),
			'textarea' => 'on',
			'desc' => __( 'Grid systems are used for creating page layouts through a series of rows and columns that house your content.', 'themo-shortcodes' )
		),

/*
==========================================================
Column Row
==========================================================
*/
		'row' => array(
			'name' => 'Column Row',
			'type' => 'wrap',
			'atts' => array( ),
			//'usage' => '[row][/row]',
			'content' => '',
			'desc' => __( 'Row', 'themo-shortcodes' ),
			'help' => __( 'For each column row, use this row shortcode generator to wrap.', 'themo-shortcodes' ),
		),

/*
==========================================================
Dropcaps
==========================================================
*/
		'dropcaps' => array(
			'name' => 'Dropcaps',
			'type' => 'wrap',
			'atts' => array(
				'style' => array(
					'values' => array(
						'box',
						'circle',
						'book',
					),
					'default' => 'book',
					'desc' => __( 'Style', 'themo-shortcodes' )
				),
			),
			'content' => '',
		),
		
/*
==========================================================
Google Map
==========================================================
*/			
		'google_map' => array(
			'name' => 'Google Map',
			'type' => 'single',
			'atts' => array(
				'title' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Title', 'themo-shortcodes' )
				),
				'location' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Location', 'themo-shortcodes' )
				),
				'width' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Width', 'themo-shortcodes' )
				),
				'height' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Height', 'themo-shortcodes' )
				),
				'zoom' => array(
					'values' => range(1,19),
					'default' => 8,
					'desc' => __( 'Zoom level', 'themo-shortcodes' )
				),
				'align' => array(
					'values' => array(
						'default',
						'left',
						'center',
						'right'
					),
					'default' => '',
					'desc' => __( 'Alignment', 'themo-shortcodes' )
				),
				'class' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Class', 'themo-shortcodes' )
				),
			),
		),




/*
==========================================================
Highlight
==========================================================
*/			
		'highlight' => array(
			'name' => 'Highlight',
			'type' => 'wrap',
			'atts' => array(
				'color' => array(
					'values' => array(
						'primary',
						'info',
						'success',
						'danger',
						'warning',
					),
					'default' => 'default',
					'desc' => __( 'Color', 'themo-shortcodes' )
				),
				'class' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Class', 'themo-shortcodes' )
				),
				
			),
			'content' => '',
		),


/*
==========================================================
Horizontal Description Group
==========================================================
*/
		'hr_list_wrap' => array(
			'name' => 'Horizontal Description Group',
			'type' => 'wrap',
			'atts' => array( ),
			'content' => '',
			//'desc' => __( 'Make terms and descriptions line up side-by-side.', 'themo-shortcodes' ),
			'help' => __( 'Group / wrap a horizontal description list together.', 'themo-shortcodes' ),
		),

/*
==========================================================
Horizontal Description List
==========================================================
*/
		'hr_list' => array(
			'name' => 'Horizontal Description List',
			'type' => 'wrap',
			'atts' => array(
					'title' => array(
						'values' => array( ),
						'default' => 'Enter title here',
						'desc' => __( 'List Title', 'themo-shortcodes' ),
					),
			),
			'content' => '',
			'textarea' => 'on',
			'help' => __( 'Make terms and descriptions line up side-by-side.', 'themo-shortcodes' ),
		),

/*
==========================================================
Icons
==========================================================
*/			
		'glyphicon' => array(
			'name' => 'Icon',
			'type' => 'single',
			'atts' => array(
				/*'type' => array(
					'values' => array(
						'none','glass','music','search','envelope','heart','star','star-empty','user','film','th-large','th','th-list','ok','remove','zoom-in','zoom-out','off','signal','cog','trash','home','file','time','road','download-alt','download','upload','inbox','play-circle','repeat','refresh','list-alt','lock','flag','headphones','volume-off','volume-down','volume-up','qrcode','barcode','tag','tags','book','bookmark','print','camera','icon-font','bold','italic','text-height','text-width','align-left','align-center','align-right','align-justify','list','indent-left','indent-right','facetime-video','picture','pencil','map-marker','adjust','tint','edit','share','check','move','step-backward','fast-backward','backward','play','pause','stop','forward','fast-forward','step-forward','eject','chevron-left','chevron-right','plus-sign','minus-sign','remove-sign','ok-sign','question-sign','info-sign','screenshot','remove-circle','ok-circle','ban-circle','arrow-left','arrow-right','arrow-up','arrow-down','share-alt','resize-full','resize-small','plus','minus','asterisk','exclamation-sign','gift','leaf','fire','eye-open','eye-close','warning-sign','plane','calendar','random','comment','magnet','chevron-up','chevron-down','retweet','shopping-cart','folder-close','folder-open','resize-vertical','resize-horizontal','hdd','bullhorn','bell','certificate','thumbs-up','thumbs-down','hand-right','hand-left','hand-up','hand-down','circle-arrow-right','circle-arrow-left','circle-arrow-up','circle-arrow-down','globe','wrench','tasks','filter','briefcase','fullscreen'
					),
					'default' => 'default',
					'desc' => __( 'Icon', 'themo-shortcodes' )
				),*/
				
				'size' => array(
					'values' => array(
						'med-icon',
					),
					'default' => 'med-icon',
					'desc' => __( 'Size', 'themo-shortcodes' )
				),
				'wrapper' => array(
					'values' => array(
						'i',
						'button',
						'span',
					),
					'default' => 'i',
					'desc' => __( 'Wrapper', 'themo-shortcodes' )
				),
				'style' => array(
					'values' => array(
						'accent',
					),
					'default' => 'accent',
					'desc' => __( 'Style', 'themo-shortcodes' )
				),
				'help' => __( '<strong>Icons:</strong> Use any Glyphicon, Halfling, Social or Filetype. Add the icon name (e.g.: camera, time, facebook) in the appropriate text field below. Find the <a href="http://glyphicons.com/" target="_blank">full list here</a>', 'themo-shortcodes' ),
				'icon' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Glyphicon', 'themo-shortcodes' )
				),
				'icon_halflings' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Halfling', 'themo-shortcodes' )
				),
				'icon_social' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Social', 'themo-shortcodes' )
				),
				'icon_filetype' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Filetype', 'themo-shortcodes' )
				),
				
			),
			//'usage' => '[icon type="music" size="24"]',
			//'desc' => __( '210 icons', 'themo-shortcodes' )
		),
		
/*
==========================================================
Image shapes
==========================================================
*/
		'shape' => array(
			'name' => 'Image Shapes',
			'type' => 'wrap',
			'atts' => array(
				'src' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Image src', 'themo-shortcodes' ),
				),
				'shape' => array(
					'values' => array(
						'thumbnail',
						'rounded',
						'circle'
					),
					'default' => 'img-circle',
					'desc' => __( 'Image shape', 'themo-shortcodes' )
				),
				'link' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Image link', 'themo-shortcodes' ),
				),
				'target' => array(
					'values' => array(
						'',
						'_self',
						'_blank'
					),
					'default' => '',
					'desc' => __( 'Image link target', 'themo-shortcodes' )
				),
				'class' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Image class', 'themo-shortcodes' ),
				),
				'alt' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Image alt text', 'themo-shortcodes' ),
				),
				'width' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Image width', 'themo-shortcodes' ),
				),
				'height' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Image height', 'themo-shortcodes' ),
				),
			),
			'content' => '',
			'help' => __( 'Apply mages styles: rounded, circle or thumbnail.', 'themo-shortcodes' ),
		),

/*
==========================================================
Jumbotron
==========================================================
*/
		'jumbotron' => array(
			'name' => 'Jumbotron',
			'type' => 'wrap',
			'atts' => array(
					'background' => array(
						'values' => array( ),
						'default' => '#f6f6f6',
						'desc' => __( 'Background color', 'themo-shortcodes' ),
						'type' => 'color'
					),
					'color' => array(
						'values' => array( ),
						'default' => '#000',
						'desc' => __( 'Text Color', 'themo-shortcodes' ),
						'type' => 'color'
					)
			),
			'content' => __( 'Content goes here', 'themo-shortcodes' ),
			'textarea' => 'on',
			'desc' => __( 'A lightweight, flexible component that can optionally extend the entire viewport to showcase key content on your site.', 'themo-shortcodes' )
		),

/*
==========================================================
Labels
==========================================================
*/			
		'label' => array(
			'name' => 'Label',
			'type' => 'single',
			'atts' => array(
				'type' => array(
					'values' => array(
						'',
						'primary',
						'default',
						'info',
						'success',
						'danger',
						'warning',
						'inverse'
					),
					'default' => '',
					'desc' => __( 'Label Style (color)', 'themo-shortcodes' )
				),
				'text' => array(
					'values' => array( ),
					'default' => 'Label Text',
					'desc' => __( 'Label Text', 'themo-shortcodes' )
				),
			),
			'desc' => __( 'Text surrounded by a solid color for importance.', 'themo-shortcodes' )
		),				

/*
==========================================================
Lead
==========================================================
*/
		'lead' => array(
			'name' => 'Lead Paragraph',
			'type' => 'wrap',
			'atts' => array(
				'align' => array(
					'values' => array(
						'default',
						'left',
						'center',
						'right'
					),
					'default' => '',
					'desc' => __( 'text alignment', 'themo-shortcodes' )
				),
			),
			'content' => __( 'Content goes here', 'themo-shortcodes' ),
			'desc' => __( 'Lead Paragraph', 'themo-shortcodes' )
		),

/*
==========================================================
Modals
==========================================================
*/
		'modal' => array(
			'name' => 'Modal Window',
			'type' => 'wrap',
			'atts' => array(
				'title' => array(
						'values' => array( ),
						'default' => 'Modal Title here',
						'desc' => __( 'Modal', 'themo-shortcodes' ),
					),
				'button_type' => array(
					'values' => array(
						'',
						'primary',
						'default',
						'info',
						'success',
						'danger',
						'warning',
						'inverse'
					),
					'default' => 'default',
					'desc' => __( 'Button Style (color)', 'themo-shortcodes' )
				),
				'button_text' => array(
					'values' => array( ),
					'default' => 'Button Text',
					'desc' => __( 'Button Text', 'themo-shortcodes' )
				),
				'button_size' => array(
					'values' => array(
						'',
						'xs',
						'sm',
						'default',
						'large'
					),
					'default' => 'default',
					'desc' => __( 'Button Size', 'themo-shortcodes' )
				),
				
				'footer' => array(
					'values' => array(
						'on',
						'off'
					),
					'default' => 'off',
					'desc' => __( 'Display footer', 'themo-shortcodes' )
				),
				
			),
			'content' => __( 'Content goes here', 'themo-shortcodes' ),
			'textarea' => 'on',
			'desc' => __( 'Lead Paragraph', 'themo-shortcodes' )
		),		


/*
==========================================================
Page Header
==========================================================
*/			
		'header' => array(
			'name' => 'Page Header',
			'type' => 'single',
			'atts' => array(
				'text' => array(
					'values' => array( ),
					'default' => 'Heading Text',
					'desc' => __( 'Heading Text', 'themo-shortcodes' )
				),
				'subtext' => array(
					'values' => array( ),
					'default' => 'Sub Text',
					'desc' => __( 'Sub Text', 'themo-shortcodes' ),
				),
			),
			'desc' => __( 'Page Header.', 'themo-shortcodes' )
		),

/*
==========================================================
Panel with Heading
==========================================================
*/			
		'panel' => array(
			'name' => 'Panel with Heading',
			'type' => 'wrap',
			'atts' => array(
				'type' => array(
					'values' => array(
						'',
						'primary',
						'default',
						'info',
						'success',
						'danger',
						'warning',
						'inverse'
					),
					'default' => 'default',
					'desc' => __( 'Style (color)', 'themo-shortcodes' )
				),
				'heading' => array(
					'values' => array( ),
					'default' => 'Heading',
					'desc' => __( 'Heading', 'themo-shortcodes' ),
				),
			),
			'content' => __( 'Content goes here', 'themo-shortcodes' ),
			'textarea' => 'on',
			'desc' => __( 'Page Header.', 'themo-shortcodes' )
		),


/*
==========================================================
Popovers
==========================================================
*/			
		'popover' => array(
			'name' => 'Popover',
			'type' => 'wrap',
			'atts' => array(
				'popover_title' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Popover Title', 'themo-shortcodes' )
				),
				'popover_placement' => array(
					'values' => array(
						'left',
						'top',
						'right',
						'bottom'
					),
					'default' => 'top',
					'desc' => __( 'Popover Placement', 'themo-shortcodes' )
				),
				'button_text' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Button Text', 'themo-shortcodes' )
				),
				'button_type' => array(
					'values' => array(
						'primary',
						'default',
						'info',
						'success',
						'danger',
						'warning',
						'inverse'
					),
					'default' => '1',
					'desc' => __( 'Button Style (color)', 'themo-shortcodes' )
				),
				'button_size' => array(
					'values' => array(
						'',
						'xs',
						'sm',
						'default',
						'large'
					),
					'default' => 'default',
					'desc' => __( 'Button Size', 'themo-shortcodes' )
				),
				'link' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Link Url', 'themo-shortcodes' )
				),
				'target' => array(
					'values' => array(
						'_self',
						'_blank'
					),
					'default' => '_self',
					'desc' => __( 'Link Target', 'themo-shortcodes' )
				),
				
			),
			'content' => __( 'Content goes here', 'themo-shortcodes' ),
			'textarea' => 'on',
		),

/*
==========================================================
Popover Text
==========================================================
*/			
		'popover_text' => array(
			'name' => 'Popover Text',
			'type' => 'wrap',
			'atts' => array(
				'popover_title' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Popover Title', 'themo-shortcodes' )
				),
				'popover_content' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Popover Text', 'themo-shortcodes' ),
					'textarea' => 'on'
				),
				'popover_placement' => array(
					'values' => array(
						'left',
						'top',
						'right',
						'bottom'
					),
					'default' => 'top',
					'desc' => __( 'Popover Placement', 'themo-shortcodes' )
				),
				'link' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Link Url', 'themo-shortcodes' )
				),
				'target' => array(
					'values' => array(
						'_self',
						'_blank'
					),
					'default' => '_self',
					'desc' => __( 'Link Target', 'themo-shortcodes' )
				),
			),
			'content' => __( 'Content goes here', 'themo-shortcodes' ),
			'usage' => __( 'The content you enter above will activate the popover text and will be displayed inline.', 'themo-shortcodes' ),
		),

/*
==========================================================
Progress Bar
==========================================================
*/			
		'progress' => array(
			'name' => 'Progress Bar',
			'type' => 'single',
			'atts' => array(
				'label' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Label', 'themo-shortcodes' )
				),
				'type' => array(
					'values' => array(
						'primary',
						'info',
						'success',
						'warning',
						'danger'
					),
					'default' => 'info',
					'desc' => __( 'Style (color)', 'themo-shortcodes' )
				),
				'progress' => array(
					'values' => array( ),
					'default' => '25',
					'desc' => __( 'Percentage of Progress', 'themo-shortcodes' )
				),
				'striped' => array(
					'values' => array(
						'on',
						'off'
					),
					'default' => 'off',
					'desc' => __( 'Striped', 'themo-shortcodes' )
				),
				'animate' => array(
					'values' => array(
						'on',
						'off'
					),
					'default' => 'off',
					'desc' => __( 'Animate (requires striped)', 'themo-shortcodes' )
				),
				
			),
			
		),


/*
==========================================================
Tabs / Wrap
==========================================================
*/			
		'tabwrap' => array(
			'name' => 'Tab Wrap / Group',
			'type' => 'wrap',
			'atts' => array( ),
			'usage' => 'Content is optional, however you can place a [tab][/tab] shortcode in here. We will wrap it for you.',
			'content' => '',
			'help' => __( 'Togglable Tabs need to be wrapped in [tabwrap][/tabwrap] tags. Use this shortcode to output the wrapper tags.', 'themo-shortcodes' ),
		),

/*
==========================================================
Tabs / Togglable
==========================================================
*/			
		'tab' => array(
			'name' => 'Tab',
			'type' => 'wrap',
			'atts' => array(
				'title' => array(
					'values' => array( ),
					'default' => 'Tab label goes here',
					'desc' => __( 'Tab Label', 'themo-shortcodes' )
				),
			),
			'content' => __( 'Tab content goes here', 'themo-shortcodes' ),
			'textarea' => 'on',
		),

/*
==========================================================
Tooltip
===========================================d===============
*/			
		'tooltip' => array(
			'name' => 'Tooltip',
			'type' => 'single',
			'atts' => array(
				'tooltip_text' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Tooltip Text', 'themo-shortcodes' )
				),
				'tooltip_placement' => array(
					'values' => array(
						'left',
						'top',
						'right',
						'bottom'
					),
					'default' => 'top',
					'desc' => __( 'Popover Placement', 'themo-shortcodes' )
				),
				'button_text' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Button Text', 'themo-shortcodes' )
				),
				'button_type' => array(
					'values' => array(
						'primary',
						'default',
						'info',
						'success',
						'danger',
						'warning',
						'inverse'
					),
					'default' => '1',
					'desc' => __( 'Button Style (color)', 'themo-shortcodes' )
				),
				'button_size' => array(
					'values' => array(
						'',
						'xs',
						'sm',
						'default',
						'large'
					),
					'default' => 'default',
					'desc' => __( 'Button Size', 'themo-shortcodes' )
				),
				'link' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Link Url', 'themo-shortcodes' )
				),
				'target' => array(
					'values' => array(
						'_self',
						'_blank'
					),
					'default' => '_self',
					'desc' => __( 'Link Target', 'themo-shortcodes' )
				),
				
			),
		),

/*
==========================================================
Tooltip Text
==========================================================
*/			
		'tooltip_text' => array(
			'name' => 'Tooltip Text',
			'type' => 'wrap',
			'atts' => array(
				'tooltip_text' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Tooltip Text', 'themo-shortcodes' ),
				),
				'tooltip_placement' => array(
					'values' => array(
						'left',
						'top',
						'right',
						'bottom'
					),
					'default' => 'top',
					'desc' => __( 'Tooltip Placement', 'themo-shortcodes' )
				),
				'link' => array(
					'values' => array( ),
					'default' => '',
					'desc' => __( 'Link Url', 'themo-shortcodes' )
				),
				'target' => array(
					'values' => array(
						'_self',
						'_blank'
					),
					'default' => '_self',
					'desc' => __( 'Link Target', 'themo-shortcodes' )
				),
			),
			'content' => __( 'Content goes here', 'themo-shortcodes' ),
			'usage' => __( 'The content you enter above will activate the tooltip text and will be displayed inline.', 'themo-shortcodes' ),
		),



/*
==========================================================
End Shortcodes
==========================================================
*/
				'basic-shortcodes-close' => array(
			'type' => 'closegroup'
		),
	);


do_action('add_to_shortcode_generator');
		
	if ( $shortcode )
		return $shortcodes[$shortcode];
	else
		return $shortcodes;
}


/*
==========================================================
Divider
==========================================================
*/
		/*'divider' => array(
			'name' => 'Divider',
			'type' => 'single',
			'atts' => array( ),
			'usage' => '[divider]',
			'content' => '',
			'desc' => __( 'Divider', 'themo-shortcodes' )
		),*/
?>