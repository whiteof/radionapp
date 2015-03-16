<?php 
global $masonry_template_key, $image_size,$more,$automatic_post_excerpts;
if(!is_single()){
	$more = 0;
}
$gallery_shortcode = get_post_meta( get_the_ID(), '_format_gallery', true); 

if($gallery_shortcode > ""){
	$gallery_shortcode = str_replace("[gallery","[slider_gallery image_size='$image_size' ",$gallery_shortcode);
	$embed_code = do_shortcode($gallery_shortcode);
}else{
	$embed_code = "";
}
?> 
<?php
	if ($embed_code > ""){ ?>
    	<?php echo $embed_code;?>
<?php } ?>
<div class="post-inner">   
	<?php 
	if (!is_single()){ ?>
    <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <?php }?>
    <?php get_template_part('templates/entry-meta'.$masonry_template_key); ?>
    <?php
	if (is_single() || (!is_single() && $automatic_post_excerpts === 'off')){
			$content = apply_filters( 'the_content', get_the_content() );
			$content = str_replace( ']]>', ']]&gt;', $content );
			if($content != ""){ ?>
            	<div class="entry-content">
					<?php echo $content; ?>	
                </div>
			<?php }
	}else{ 
		$excerpt = apply_filters( 'the_excerpt', get_the_excerpt() );
		$excerpt = str_replace( ']]>', ']]&gt;', $excerpt );
			if($excerpt != ""){ ?>
            	<div class="entry-content post-excerpt">            
					<?php echo $excerpt; ?>	
                </div>
			<?php }
    } ?>
	<?php get_template_part('templates/entry-meta-footer'.$masonry_template_key); ?>
</div>