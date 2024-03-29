<?php 
global $masonry, $masonry_template_key,$more,$automatic_post_excerpts;
if(!is_single()){
	$more = 0;
}
$video_embed = get_post_meta( get_the_ID(), '_format_video_embed', true); 
$video_shortcode = get_post_meta( get_the_ID(), '_format_video_shortcode', true); 


$video_container_class = "";
if ($video_embed > ""){
	$embed_code = wp_oembed_get($video_embed);
	$video_container_class = "video-container";
}elseif($video_shortcode > "" && strpos($video_shortcode, '[embed]') !== FALSE){
	global $wp_embed;
	$embed_code = $wp_embed->run_shortcode($video_shortcode);
	$embed_code = do_shortcode($embed_code);
	$video_container_class = "video-container";
}
elseif($video_shortcode > ""){
	$embed_code = do_shortcode($video_shortcode);
	$video_container_class = "wp-hosted-video";
}
?> 

<?php
if (isset($embed_code) && $embed_code > ""){ ?>
    <div class="<?php echo $video_container_class; ?>">
        <?php echo $embed_code;?>
    </div>
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
                    
                    
