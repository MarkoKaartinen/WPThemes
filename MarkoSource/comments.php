	<hr />
	<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'markosource' ); ?></p>
	</div><!-- #comments -->
	<?php
			/* Stop the rest of comments.php from being processed,
			 * but don't kill the script entirely -- we still have
			 * to fully load the template.
			 */
			return;
		endif;
	?>

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 id="comments-title" style="margin-bottom:10px;">
			<?php echo get_comments_number() . " " . __("comments at the moment", "markosource"); ?>
		</h2>
		<hr />
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older', 'markosource' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer &rarr;', 'markosource' ) ); ?></div>
		</nav>
		<div class="clear"></div>
		<hr />
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php
				wp_list_comments( array( 'callback' => 'markosource_comment' ) );
			?>
		</ol>
		<hr />
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<div class="clear"></div>
		<nav id="comment-nav-below">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older', 'markosource' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer &rarr;', 'markosource' ) ); ?></div>
		</nav>
		<div class="clear"></div>
		<hr />
		<?php endif; // check for comment navigation ?>
	<?php
		/* If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'markosource' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
