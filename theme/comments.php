<?php
	if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) )
		die ( 'Please do not load this page directly. Thanks.' );
?>
			<section id="comments">
				<div class="grid">
<?php
	if ( !empty($post->post_password) ) :
		if ( $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) :
?>
					<div class="nopassword"><?php _e( 'This post is protected. Enter the password to view any comments.' ); ?></div>
				</div>
			</section>
<?php
		return;
	endif;
endif;
?>

<?php // Number of pings and comments
$ping_count = $comment_count = 0;
foreach ( $comments as $comment )
	get_comment_type() == "comment" ? ++$comment_count : ++$ping_count;
?>

				<div id="comments-list" class="comments">
					<h3><?php printf($comment_count != 1 ? __('<span>%d</span> Comments') : __('<span>One</span> Comment'), $comment_count); ?>
						<?php if ( 'open' == $post->comment_status ) { ?>
							<a href="#respond" class="respond sans">Post your own</a>
						<?php } ?>
					</h3>
										
					<?php if ( $comment_count > 0 ) { ?>					
						<ol>
	<?php foreach ($comments as $comment) : ?>
	<?php if ( get_comment_type() == "comment" ) : ?>
							<li id="comment-<?php comment_ID(); ?>" <?php comment_class('clearfix'); ?>>
								<div class="comment-author vcard g3"><?php commenter_link(); ?> <time datetime="<?php comment_time('Y-m-d\TH:i:sP'); ?>"><?php printf(__('%1$s'),
											get_comment_date(),
											get_comment_time(),
											'#comment-' . get_comment_ID() );
								?></time></div>
								
	<?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n"); ?>
								<div class="comment-content g8">
									<?php comment_text(); ?>
								</div>
							</li>
	<?php endif; // REFERENCE: if ( get_comment_type() == "comment" ) ?>
	<?php endforeach; ?>
	
						</ol>
						<?php if ( 'open' == $post->comment_status && $comment_count > 2 ) { ?>
						<div class="bottomComment">
							<a href="#respond" class="respond">Post a comment</a>
						</div>
						<?php } ?>
					<?php } ?>
				</div>


<?php if ( 'open' == $post->comment_status ) : ?>
<?php $req = get_option('require_name_email'); ?>

				<section id="respond" class="modal">
					<div>
						<h3><?php _e( 'Comment' ); ?></h3>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
						<p id="login-req"><?php printf(__('You must be <a href="%s" title="Log in">logged in</a> to post a comment.'),
					get_bloginfo('wpurl') . '/wp-login.php?redirect_to=' . get_permalink() ) ?></p>

<?php else : ?>

						<form id="commentform" action="<?php bloginfo('wpurl') ?>/wp-comments-post.php" method="post">
							<fieldset>
								<legend>Post a comment</legend>
<?php if ( $user_ID ) : ?>
								<p id="login"><?php printf( __( '<span class="loggedin">Logged in as <a href="%1$s" title="Logged in as %2$s">%2$s</a>.</span> <span class="logout"><a href="%3$s" title="Log out of this account">Log out?</a></span>' ),
									get_bloginfo('wpurl') . '/wp-admin/profile.php',
									esc_html( $user_identity ),
									get_bloginfo('wpurl') . '/wp-login.php?action=logout&amp;redirect_to=' . get_permalink() ) ?></p>
	
<?php else : ?>
								<div>
									<label for="author"><?php _e( 'Name' ); ?></label>
									<input id="author" name="author" class="text<?php if ($req) echo ' required'; ?>" type="text" value="<?php echo $comment_author ?>" size="30" maxlength="50" tabindex="3" placeholder="Name" />
								</div>
	
								<div>
									<label for="email"><?php _e( 'Email' ); ?></label>
									<input id="email" name="email" class="text<?php if ($req) echo ' required'; ?>" type="text" value="<?php echo $comment_author_email ?>" size="30" maxlength="50" tabindex="4" placeholder="Email" />
								</div>
	
<?php endif // REFERENCE: * if ( $user_ID ) ?>
	
								<div>
									<label for="comment"><?php _e( 'Comment' ); ?></label>
									<textarea id="comment" name="comment" class="text required" cols="45" rows="8" tabindex="5" placeholder="Comment"></textarea>
								</div>
							</fieldset>
							<fieldset class="submit">
								<input type="hidden" name="comment_post_ID" value="<?php echo $id ?>" />
								<input id="submit" name="submit" class="submit" type="submit" value="<?php _e( 'Post Comment' ); ?>" tabindex="6" />
								<a href="#close" class="close" title="Close" tabindex="7"><span>Cancel</span></a>

								<?php do_action( 'comment_form', $post->ID ); ?>
							</fieldset>
						</form>
<?php endif // REFERENCE: if ( get_option('comment_registration') && !$user_ID ) ?>
					</div>
				</section>
<?php endif // REFERENCE: if ( 'open' == $post->comment_status ) ?>

				</div>
			</section><!-- #comments -->
