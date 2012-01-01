<?php get_header(); ?>

		<div class="row" id="content">
		    <div class="span-two-thirds">
		    	<h2><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', "markosource" ); ?></h2>
		    	<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'markosource' ); ?></p>

				<?php get_search_form(); ?>
				
				<?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 5 ), array( 'widget_id' => '404' ) ); ?>
				
				<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
				
				<?php echo get_option("markosource_postadbox"); ?>

			</div>
			
		    <div class="span-one-third" id="sidebar">
		    	<?php get_sidebar(); ?>
		    </div>

		</div>

<?php get_footer(); ?>