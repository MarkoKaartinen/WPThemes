<?php while ( have_posts() ) : the_post(); ?>

<div class="entry">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		
		<?php if(!is_page()){ ?>
			<?php
			if(get_bloginfo("language") == "fi"){
				$posttime = get_the_time('j. F') . "ta " . get_the_time('Y') . " kello " . get_the_time("H:i");
			}else{
				$posttime = get_the_time("d.m.Y - H:i");
			}
			?>
			<div class="postinfo"><span class="label info"><?php echo $posttime; ?></span> <span class="label info"><?php comments_popup_link( __("Comment" , "markosource"), __("1 comment" , "markosource"), __("%s comments" , "markosource"), 'comments-link', __("Comments closed" , "markosource")); ?></span> <?php if(function_exists('the_views')) { ?><span class="label info"><?php the_views(); ?></span><?php } ?></div>
		<?php } ?>
		
		<?php the_content(__("Read more", "markosource") ." &raquo;"); ?>
		
		<?php 
		if(!is_page()){
			if(has_tag()){
				the_tags('<div id="tags">', ' ', '</div>');
			}
		}
		if(!is_page() && !is_single()){
			echo "<hr />";
		}
		?>
	</div>
</div>

<?php endwhile; // End the loop. Whew. ?>

<?php 
if(function_exists(wp_pagenavi)){
	wp_pagenavi();
}else{ 
	echo '<div class="nav-previous">' . get_next_posts_link( "&larr; " . __( 'Older' ) ).'</div>
	<div class="nav-next">' . get_previous_posts_link( __( 'Newer' ) . ' &rarr;' ) . '</div>';
}
?>
<div class="clear"></div>