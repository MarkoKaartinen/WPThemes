<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php bloginfo( 'name' ); ?> <?php wp_title(); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<!--[if lt IE 9]>
		<script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<?php
	$markosource_info = get_theme_data(get_stylesheet_uri());
	$markosource_version = $markosource_info['Version'];
	?>
	
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri() ?>?v=<?php echo $markosource_version; ?>" type="text/css" media="screen" />
		
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS" href="<?php bloginfo('rss2_url'); ?>" /> 
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_enqueue_script("jquery"); ?>

	<?php wp_head(); ?>

	<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
</head>
<body <?php body_class() ?>>
<?php
if ( ! isset( $content_width ) ) $content_width = 620;
?>
	<div class="container">
	
		<div id="header">
			<h1 id="logo"><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<p><?php bloginfo( 'description' ); ?></p>
			<div class="subnav">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '', 'container_class' => '', 'menu_class' => 'nav nav-pills', 'depth' => 0, 'fallback_cb' => 'markosource_nav_fallback' ) ); ?>
				<?php if(get_option("markosource_hidesearch") != "1"){ ?>
					<div class="pull-right navihakulomake">
						<div class="control-group">
							<div class="controls">
								<div class="input-prepend">
									<form action="<?php echo home_url( '/' ); ?>" method="post">
										<span class="add-on" style="float:left;"><i class="icon-search"></i></span>
										<input class="span2" style="float:left;" id="inputIcon" type="text" placeholder="<?php _e("Search...", "markosource"); ?>" name="s">
									</form>
								</div>
							</div>
						</div>
					</div><!-- /navihakulomake -->
				<?php } ?>
			</div>
			<div class="clear"></div>
		</div>
