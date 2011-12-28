<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title(); ?> <?php bloginfo( 'name' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<!--[if lt IE 9]>
		<script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/bootstrap.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="screen" />
	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS" href="<?php bloginfo('rss2_url'); ?>" /> 
	
	<link rel="shortcut icon" href="<?php bloginfo("template_url"); ?>/favicons/favicon.ico">
	<link rel="apple-touch-icon" href="<?php bloginfo("template_url"); ?>/favicons/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo("template_url"); ?>/favicons/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo("template_url"); ?>/favicons/apple-touch-icon-114x114.png">

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_enqueue_script("jquery"); ?>
	<?php wp_head(); ?>
</head>
<body>
	<div class="container">
	
		<div class="hero-unit head">
			<h1><?php bloginfo( 'name' ); ?></h1>
			<p><?php bloginfo( 'description' ); ?></p>
			<p><?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => '' ) ); ?></p>
			<div class="clear"></div>
		</div>
