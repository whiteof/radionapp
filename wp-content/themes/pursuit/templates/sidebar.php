<?php if ($page_layout === 'left' || $page_layout === 'right') { ?>
<?php 
// Main Class for sidebar support.
if($page_layout == 'right'){
	$sidebar_push_pull = '';
}elseif($page_layout == 'left'){
	$sidebar_push_pull = 'col-sm-pull-8';
}else{
	$sidebar_push_pull = '';
}
?>
    <aside class="sidebar side-<?php echo $page_layout ; ?> col-sm-4 <?php echo $sidebar_push_pull; ?>" role="complementary">
	<?php dynamic_sidebar('sidebar-primary'); ?>
    </aside><!-- /.sidebar -->
<?php } ?> 