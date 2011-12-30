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
		<p><?php _e( 'Pingback:', 'markosource' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(edit)', 'markosource'), ' ' ); ?></p>

	<?php
			break;
	endswitch;
}?>