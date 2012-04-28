<?php
//add_theme_support('post-formats', array( 'link', 'image', 'quote', 'status', 'video', 'audio' ));

register_nav_menus( array(
	'primary' => 'Navigation',
) );

register_sidebar(array(
	'name' => 'Sidebar (top)',
	'id' => 'widget-area-4',
	'before_widget' => '<div class="alert alert-info">',
	'after_widget' => '<div class="clear"></div></div>',
	'before_title' => '<h3 class="sidetitle">',
	'after_title' => '</h3>',
));

register_sidebar(array(
	'name' => 'Sidebar, no styles (center)',
	'id' => 'widget-area-3',
	'before_widget' => '<div class="nostyleside">',
	'after_widget' => '<div class="clear"></div></div>',
	'before_title' => '<h3 class="sidetitle">',
	'after_title' => '</h3>',
));

register_sidebar(array(
	'name' => 'Sidebar (center)',
	'id' => 'widget-area-1',
	'before_widget' => '<div class="alert alert-info">',
	'after_widget' => '<div class="clear"></div></div>',
	'before_title' => '<h3 class="sidetitle">',
	'after_title' => '</h3>',
));

register_sidebar(array(
	'name' => 'Sidebar, no styles (bottom)',
	'id' => 'widget-area-2',
	'before_widget' => '<div class="nostyleside">',
	'after_widget' => '<div class="clear"></div></div>',
	'before_title' => '<h3 class="sidetitle">',
	'after_title' => '</h3>',
));

register_sidebar(array(
	'name' => 'Frontpage',
	'id' => 'widget-area-5',
	'before_widget' => '<hr /><div>',
	'after_widget' => '<div class="clear"></div></div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>',
));

add_editor_style('editor.css');

load_theme_textdomain('markosource', get_template_directory() . '/languages');
add_action('after_setup_theme', 'markosource_my_theme_setup');
function markosource_my_theme_setup(){
	load_theme_textdomain('markosource', get_template_directory() . '/languages');
}

add_filter('get_comments_number', 'markosource_comment_count', 0);
function markosource_comment_count( $count ) {
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
	<div class="clear"></div>


	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="pingback">
		<p><strong><?php _e( 'Pingback:', 'markosource' ); ?></strong> <?php comment_author_link(); ?><?php edit_comment_link( __('(edit)', 'markosource'), ' ' ); ?></p>
		<div class="clear"></div>


	<?php
			break;
	endswitch;
}

function markosource_setup_theme_admin_menus() {
    add_theme_page('MarkoSource Settings', 'MarkoSource', 'edit_theme_options', 'markosource_theme_general', 'markosource_theme_general');
}


function markosource_theme_general(){
	echo '<div class="wrap">';
	screen_icon('themes');
	echo "<h2>".__("MarkoSource - General settings", "markosource")."</h2>";
	
	echo __('<p>MarkoSource is made by <a href="http://markokaartinen.net" target="_blank">Marko Kaartinen</a>. MarkoSource uses <a href="http://twitter.github.com/bootstrap/" target="_blank">Bootstrap</a> by Twitter as a base.<br />Theme has some settings and few features like support for WP-PageNavi and WP-PostViews.</p>
	
	<p>You can suggest features and report bugs in <a href="https://github.com/MarkoKaartinen/WPThemes/issues" target="_blank">Github</a> where the whole theme is available.</p>', "markosource");
	
	echo "<p>".__("Some settings for MarkoSource. Use these settings to mess the theme. Here are some basic functions and things that you can edit.", "markosource")."</p>";
	
	if (isset($_POST["update_settings"])) {  
		// Do the saving
		update_option("markosource_hidesearch", esc_attr($_POST["hidesearch"]));
		update_option("markosource_hidecats", esc_attr($_POST["hidecats"]));
		update_option("markosource_hidetags", esc_attr($_POST["hidetags"]));
		update_option("markosource_postadbox", stripcslashes($_POST["postadbox"]));
		echo '<div id="message" class="updated">'.__("Settings saved!", "markosource").'</div> ';
	}
	
	//get some defaults
	$hidesearch = get_option("markosource_hidesearch");
	$hidecats = get_option("markosource_hidecats");
	$hidetags = get_option("markosource_hidetags");
	$postadbox = get_option("markosource_postadbox");
	?>
	<form method="POST" action="">
		<h3><?php _e("Theme options", "markosource"); ?></h3>
		<p><input type="checkbox" name="hidesearch" id="hidesearch" value="1" <?php checked($hidesearch, 1); ?> /><label for="hidesearch"> <?php _e("Hide search box in the navbar", "markosource"); ?></label></p>
		<p><input type="checkbox" name="hidecats" id="hidecats" value="1" <?php checked($hidecats, 1); ?> /><label for="hidecats"> <?php _e("Hide categories", "markosource"); ?></label></p>
		<p><input type="checkbox" name="hidetags" id="hidetags" value="1" <?php checked($hidetags, 1); ?><label for="hidetags"> <?php _e("Hide tags", "markosource"); ?></label></p>
		
		<h3><?php _e("Ad options", "markosource"); ?></h3>
		<p><?php _e("Posts ad box", "markosource"); ?> <small><?php _e("(Insert code here)", "markosource"); ?></small><br />
		<textarea name="postadbox" cols="40" rows="6"><?php echo $postadbox; ?></textarea></p>
		<input type="hidden" name="update_settings" value="1" />  
		<input type="submit" value="<?php _e("Save settings", "markosource"); ?>" class="button-primary" />
	</form>
	<?php
	echo "</div>";
}

function markosource_nav_fallback(){
	echo '<ul class="nav nav-pills">';
		wp_list_pages(array('depth' => 1, 'title_li' => ''));
	echo '</ul>';
}

add_action("admin_menu", "markosource_setup_theme_admin_menus");

function markosource_add_oembed_slideshare(){
	wp_oembed_add_provider( 'http://www.slideshare.net/*', 'http://api.embed.ly/v1/api/oembed');
}
add_action('init','markosource_add_oembed_slideshare');
?>