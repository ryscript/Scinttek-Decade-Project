<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
*/
 
if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) : ?>  	
	<?php die('You can not access this page directly!'); ?>  
<?php endif; ?>

<?php if(!empty($post->post_password)) : ?>
  	<?php if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
		<p>This post is password protected. Enter the password to view comments.</p>
  	<?php endif; ?>
<?php endif; ?>

<div class="comment-wrapper">
<?php if($comments) : ?>
	<h3 id="comments" class="comment_heading">
		<?php comments_number('No comments', 'One comment', '% comments'); ?>
	</h3>
  	<ol class="comment-list">
		<?php wp_list_comments(array('callback' => 'get_comment_list')); ?>
	</ol>
	
	<div class="navigation">
		<div class="nav-previous"><?php previous_comments_link() ?></div>
		<div class="nav-next"><?php next_comments_link() ?></div>
	</div>
	
	<?php if ( ! empty($comments_by_type['pings']) ) : ?>
		<div id="trackbacks">
			<h3 id="pings"><?php _e('Trackbacks/Pingbacks', THEME_DOMAIN); ?></h3>
			<ol class="pinglist">
				<?php wp_list_comments('type=pings&callback=list_pings'); ?>
			</ol>
		</div>
	<?php endif; ?>
	
<?php else : ?>

	<!--No comments-->
	<?php if ( 'open' == $post->comment_status ) : ?>
		<p class="nocomments">No comment added yet, be the first one to share your idea.</p>
	<?php else : // comments are closed ?>
		<div id="respond">
			<p class="comments-close"><?php _e('Comments are closed. If you have something really important to add, <a href="'. get_bloginfo('url').'/contact-me/">contact me</a>. Thank you!', THEME_DOMAIN) ?></p>
		</div>
	<?php endif; ?>
	
<?php endif; ?>

	<div class="comment-data">
		<?php if ('open' == $post->comment_status) : ?>
			<div id="respond">
				<div class="cancel-comment-reply"> 
					<?php cancel_comment_reply_link(); ?>
				</div>
				<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
					<p><?php _e('You must be', THEME_DOMAIN)?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in', THEME_DOMAIN) ?></a> <?php _e('to post a comment.', THEME_DOMAIN) ?></p>
				<?php else :
					
					
					$comment_form = array( 
						'fields' => apply_filters( 'comment_form_default_fields', array(
							
							'author' => '<div class="comment-form-author">' .
											'<label for="author">' . __( 'Name', THEME_DOMAIN ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
											'<input id="author" name="author" type="text" value="' .esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1" />' .
										'</div>',
							'email' => '<div class="comment-form-email">' .
											'<label for="email">' . __( 'Email', THEME_DOMAIN ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label>'.
											'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2" />' .
										'</div>',
							'url'  => '<div class="comment-form-url">' .
											'<label for="url">' . __( 'Website', THEME_DOMAIN ) . '</label>' .
											'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3" />' .
										'</div>' ) 
							),
							'class_submit' => 'btn',
							'comment_field' => '<div class="comment-form-comment">' .
										'<textarea id="comment" name="comment" aria-required="true" tabindex="4"></textarea>' .
									'</div>',
						'comment_notes_before' => '',
						'comment_notes_after' => '',
						'title_reply' => 'Leave a Comment',
					);
					comment_form( $comment_form, $post->ID ); 
	
					
				endif; // If registration required and not logged in ?>
			</div>
		<?php else: ?>
		<?php endif; // if you delete this the sky will fall on your head ?>
	</div>

</div>