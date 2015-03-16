<?php
//======================================================================
// Service Blocks - Careers
//======================================================================
?>
<?php
function print_service_blocks($box,$key,$first_class,$block_style_class,$icon_style_class,$themo_enable_animate,$themo_animation_style){ ?>
	<div class="service-block-col <?php echo $first_class; ?> col-sm-4">
		<?php
		$i=1;
		foreach($box as $value => $element){
			/* Get Formatted Link */
			list($a_href,$a_href_text,$a_href_close) = return_formatted_link($element,$key);
			
			// ICONS
			$glyphicon = false;
			$glyphicon_class = "";
			if(isset($element[$key.'_glyphicons_icon_set'])){
				if($element[$key.'_glyphicons_icon_set'] > "" && $element[$key.'_glyphicons_icon_set'] != 'none'){
					$glyphicon_class = $element[$key.'_glyphicons_icon_set']." ".$element[$key.'_glyphicons-icon'];
					$glyphicon = true;
				}
			}?>
                
            <div class="service-block service-block-<?php echo $i;?> <?php echo $block_style_class; ?> <?php echo themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .service-block-'.$i); ?>">
                <?php if($glyphicon){ ?>
                    <div class="<?php echo $icon_style_class; ?>">
                        <?php echo $a_href; ?><i class="accent <?php echo esc_attr($glyphicon_class); ?>"></i><?php echo $a_href_close; ?>
                    </div>
                <?php } ?>
                <div class="service-block-text ">
                    <h3><?php echo $a_href . $element['title'] . $a_href_close;?></h3>
                    <?php echo themo_content($element[$key.'_text']); ?>
                </div>
            </div>
    <?php 
	$i++;
    } // end inner loop ?>
	</div>
<?php } // end function

?>

<?php
//-----------------------------------------------------
// GET BACKGROUND
//-----------------------------------------------------
$partName = 'background';
include( locate_template('templates/meta-part-' . $partName . '.php') );
?>

<?php
//-----------------------------------------------------
// GET BORDER
//-----------------------------------------------------
$partName = 'border';
include( locate_template('templates/meta-part-' . $partName . '.php') );
?>


<?php
//-----------------------------------------------------
// Preloader, Section, Container Open
//-----------------------------------------------------
$partName = 'preload-container';
$section_template_class = 'service-blocks-horiz';
include( locate_template('templates/meta-part-' . $partName . '.php') );
?>

<?php
//-----------------------------------------------------
// Meta Box Header / Subtext
//-----------------------------------------------------
$partName = 'header';
include( locate_template('templates/meta-part-' . $partName . '.php') );
?>

		
<?php
//-----------------------------------------------------
// Service Blocks - Careers
//-----------------------------------------------------	
if ($show == 'on'){ 
	$service_boxes = get_post_meta($post->ID, $key, array() );
	
	// Animation
	$themo_enable_animate = get_post_meta($post->ID, $key.'_animate', true );
	$themo_animation_style = get_post_meta($post->ID, $key.'_animate_style', true );
	
	// Icon Style
	$icon_style = get_post_meta($post->ID, $key."_icon_style", true);
	if($icon_style == 'standard'){
		$icon_style_class = 'med-icon';
		$block_style_class = 'standard-block';
	}else{
		$icon_style_class = 'circle-med-icon';
		$block_style_class = 'circle-block';
	}

	
	

	if (!empty( $service_boxes ) ) { ?>
            <div class="row">
				<?php
                foreach( $service_boxes as $box ) {
					$len = count($box);
					$firsthalf = array_slice($box, 0, round($len / 2));
					$secondhalf = array_slice($box, round($len / 2));
					$first_class = "first";
					print_service_blocks($firsthalf,$key,$first_class,$block_style_class,$icon_style_class,$themo_enable_animate,$themo_animation_style);
					
					$image = get_post_meta($post->ID, $key.'_image', true );
					if(isset($image) && $image > ""){
						$img_src = return_metabox_image($image, null, "themo_team", true, $alt); ?>
						<div class="service-block-img col-sm-4 <?php echo themo_return_entrance_animation_class($themo_enable_animate,$themo_animation_style,'#'.$key.' .service-block-img'); ?>">
						<img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr($alt);?>">
						</div>
					<?php 
					}
					
					
					$first_class = "";
					print_service_blocks($secondhalf,$key,$first_class,$block_style_class,$icon_style_class,$themo_enable_animate,$themo_animation_style);
					// divide box_ccount, making two groups with remainder rounded up in group A and down and group B
					// Start both groups off with col-sm-4, end both wtih closing div.
					// inbetween output image.
					
                } // end outer loop ?>
			</div><!--/row-->
	<?php } // end inner if / then ?>
<?php } // end outer if / then  ?>	

<?php
//-----------------------------------------------------
// Preloader, Section, Container Close
//-----------------------------------------------------
$partName = 'preload-container-close';
include( locate_template('templates/meta-part-' . $partName . '.php') );
?>

<?php
//-----------------------------------------------------
// GET BORDER CLOSE
//-----------------------------------------------------
$partName = 'border-close';
include( locate_template('templates/meta-part-' . $partName . '.php') );
?>