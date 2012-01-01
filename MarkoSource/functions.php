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

add_filter('get_comments_number', 'comment_count', 0);
function comment_count( $count ) {
	global $id;
	$comments_by_type = &separate_comments(get_comments('post_id=' . $id));
	return count($comments_by_type['comment']);
}
add_theme_support("automatic-feed-links");

function markosource_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comm">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 60 ); ?>
			<?php printf( ( '%s <span class="says">'.__("says", "markosource").':</span>'), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Comment is waiting approval' , "markosource"); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a rel="nofollow" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s clock %2$s', "markosource"), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(edit)', "markosource" ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="pingback">
		<p><strong><?php _e( 'Pingback:', 'markosource' ); ?></strong> <?php comment_author_link(); ?><?php edit_comment_link( __('(edit)', 'markosource'), ' ' ); ?></p>

	<?php
			break;
	endswitch;
}

function setup_theme_admin_menus() {
    add_menu_page('MarkoSource settings', 'MarkoSource', 'manage_options', 'markosource_theme_general', 'theme_settings_page');

    add_submenu_page('markosource_theme_settings', 'General settins', 'General', 'manage_options', 'markosource_theme_general', 'theme_general_settings');
    
    add_submenu_page('markosource_theme_general', 'About', 'About', 'manage_options', 'markosource_theme_about', 'theme_about_settings');
}

function theme_settings_page() {
}

function theme_general_settings(){
	echo '<div class="wrap">';
	screen_icon('themes');
	echo "<h2>".__("MarkoSource - General settings", "markosource")."</h2>";
	echo "<p>".__("Some settings for MarkoSource. Use these settings to mess the theme. Here are some basic functions and things that you can edit.", "markosource")."</p>";
	
	if (isset($_POST["update_settings"])) {  
		// Do the saving
		update_option("markosource_hidecats", esc_attr($_POST["hidecats"]));
		update_option("markosource_hidetags", esc_attr($_POST["hidetags"]));
		update_option("markosource_postadbox", esc_attr($_POST["postadbox"]));
		echo '<div id="message" class="updated">'.__("Settings saved!", "markosource").'</div> ';
	}
	
	//get some defaults
	$hidecats = get_option("markosource_hidecats");
	$hidetags = get_option("markosource_hidetags");
	$postadbox = get_option("markosource_postadbox");
	?>
	<form method="POST" action="">
		<h3><?php _e("Theme options", "markosource"); ?></h3>
		<p><input type="checkbox" name="hidecats" id="hidecats" value="1"<?php if($hidecats == "1"){ echo ' checked="checked"'; } ?> /><label for="hidecats"> <?php _e("Hide categories", "markosource"); ?></label></p>
		<p><input type="checkbox" name="hidetags" id="hidetags" value="1"<?php if($hidetags == "1"){ echo ' checked="checked"'; } ?> /><label for="hidetags"> <?php _e("Hide tags", "markosource"); ?></label></p>
		
		<h3><?php _e("Ad options", "markosource"); ?></h3>
		<p><?php _e("Posts ad box", "markosource"); ?> <small><?php _e("(Insert code here)", "markosource"); ?></small><br />
		<textarea name="postadbox" cols="40" rows="6"><?php echo $postadbox; ?></textarea></p>
		<input type="hidden" name="update_settings" value="1" />  
		<input type="submit" value="<?php _e("Save settings", "markosource"); ?>" class="button-primary" />
	</form>
	<?php
	echo "</div>";
}

function theme_about_settings(){
	echo '<div class="wrap">';
	screen_icon('themes');
	echo "<h2>About MarkoSource</h2>";
	echo '<p>MarkoSource is made by <a href="http://markokaartinen.net" target="_blank">Marko Kaartinen</a>. MarkoSource uses <a href="http://twitter.github.com/bootstrap/" target="_blank">Bootstrap</a> by Twitter as a base.<br />Theme has some settings and few features like support for WP-PageNavi and WP-PostViews.</p>
	
	<p>You can suggest features and report bugs in <a href="https://github.com/MarkoKaartinen/WPThemes/tree/master/MarkoSource" target="_blank">Github</a> where the whole theme is available.</p>
	
	<p><strong>ToDo list for next version</strong><br />
	&raquo; Post formats<br />
	</p>';
	echo "</div>";
}

add_action("admin_menu", "setup_theme_admin_menus");

?>