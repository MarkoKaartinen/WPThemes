<?php
add_theme_support( 'post-thumbnails', array( 'post' ) );
add_theme_support('post-formats', array( 'link', 'image', 'quote', 'status', 'video', 'audio' ));

if (function_exists('register_nav_menu')) {
	register_nav_menus( array(
		'primary' => 'Navigation',
	) );
}

if ( function_exists('register_sidebar') ){
	register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'widget-area-1',
		'before_widget' => '<div class="well">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="sidetitle">',
		'after_title' => '</h3>',
	));
}
add_editor_style('editor.css');

load_theme_textdomain('markosource', get_template_directory() . '/languages');
add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
	load_theme_textdomain('markosource', get_template_directory() . '/languages');
}

?>