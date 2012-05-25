<?php get_header(); ?>

		<div class="row" id="content">
		    <div class="span8">
				<?php 
				if(is_front_page()){
					get_template_part( 'frontpage', 'index' ); 
				}else{
					get_template_part( 'loop', 'index' ); 
				}
				?>
				<div class="clear"></div>
			</div>
		    <div class="span4" id="sidebar">
		    	<?php get_sidebar(); ?>
		    </div>

		</div>

<!-- 
  <div class="row show-grid" title="One-third and two-thirds layout">
  </div>
-->

<?php get_footer(); ?>