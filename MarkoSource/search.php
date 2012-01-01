<?php get_header(); ?>

		<div class="row" id="content">
		    <div class="span-two-thirds">
				<?php if ( have_posts() ) : ?>
					<h2><?php printf( __( 'Search Results for: %s', 'twentyeleven' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
					<?php while ( have_posts() ) : the_post(); ?>
						
						<div class="entry">
							<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								
								<?php
								if(get_bloginfo("language") == "fi"){
									$posttime = get_the_time('j. F') . "ta " . get_the_time('Y') . " kello " . get_the_time("H:i");
								}else{
									$posttime = get_the_time("d.m.Y - H:i");
								}
								?>
								<div class="postinfo">
									<span class="label info"><?php echo $posttime; ?></span>
									<span class="label info"><?php comments_popup_link( __("Comment" , "markosource"), __("1 comment" , "markosource"), '% ' . __("comments" , "markosource"), 'comments-link', __("Comments closed" , "markosource")); ?></span>
									<?php if(function_exists('the_views')) { ?><span class="label info"><?php the_views(); ?></span><?php } ?>
									<?php if(is_sticky()) { echo ' <span class="label important">' . __('sticky', "markosource") . '</span>'; } ?></div>
								
								<?php the_content(__("Read more", "markosource") ." &raquo;"); ?>
								
								<?php 
								if(get_option("markosource_hidecats") != "1"){
									if(has_category()){
										echo '<div class="cats">';
											the_category('');
										echo "</div>";
									}
								}
								if(get_option("markosource_hidetags") != "1"){
									if(has_tag()){
										echo '<div class="tagit">';
											the_tags('', ' ', '');
										echo '</div>';
									}
								}
									echo "<hr />";
								?>
							</div>
						</div>
						
						<?php 
						if(function_exists(wp_pagenavi)){
							wp_pagenavi();
						}else{ 
							echo '<div class="nav-previous">' . get_next_posts_link( "&larr; " . __( 'Older', "markosource" ) ).'</div><div class="nav-next">' . get_previous_posts_link( __( 'Newer', 'markosource' ) . ' &rarr;' ) . '</div>';
						}
						?>

					<?php endwhile; ?>
				<?php else : ?>
					<h2><?php _e( 'Nothing Found!', 'markosource' ); ?></h2>
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'markosource' ); ?></p>
					<?php get_search_form(); ?>
				<?php endif; ?>
			</div>
			
		    <div class="span-one-third" id="sidebar">
		    	<?php get_sidebar(); ?>
		    </div>

		</div>

<?php get_footer(); ?>