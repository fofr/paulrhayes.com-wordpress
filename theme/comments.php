<?php if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) ) { die ( 'Please do not load this page directly. Thanks.' ); } ?>
<section id="comments" class="comments">
    <div class="comments-wrapper">

        <?php

        $ping_count = $comment_count = 0;
        $previous_comment_date = null;
        foreach ( $comments as $comment ) {
            get_comment_type() == "comment" ? ++$comment_count : ++$ping_count;
        }

        ?>

        <div id="comments-list" class="comments-list" role="complementary">
            <?php if ( $comment_count > 0 ) { ?>
                <h3 class="main-content-title">
                    Discussion
                </h3>
                <ol>
                    <?php foreach ($comments as $comment) { ?>
                        <?php if ( get_comment_type() == "comment" ) { ?>
                        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
                            <time class="comment-timestamp <?php if ($previous_comment_date == get_comment_date()) { ?>rm<?php } ?>" datetime="<?php comment_time('Y-m-d\TH:i:sP'); ?>">
                                <span class="day"><?php comment_time('jS'); ?></span>
                                <span class="month"><?php comment_time('F'); ?></span>
                                <span class="year"><?php comment_time('Y'); ?></span>
                            </time>
                            <?php $previous_comment_date = get_comment_date(); ?>
                            <div class="media">
                                <div class="media-pull-left comment-author vcard">
                                    <div class="media">
                                        <?php commenter_link(); ?>
                                    </div>
                                </div>
                                <?php if ($comment->comment_approved == '0') { ?>
                                    <p class='unapproved'>Your comment is awaiting moderation.</p>
                                <?php } ?>
                                <div class="media-body comment-content">
                                    <?php comment_text(); ?>
                                </div>
                            </div>
                        </li>
                        <?php } ?>
                    <?php } ?>
                </ol>
            <?php } ?>
        </div>

        <?php if ( 'open' == $post->comment_status ) { ?>
            <?php $req = get_option('require_name_email'); ?>
            <h3 class="main-content-title">
                Comment
            </h3>
            <form class="comment-form" action="<?php bloginfo('wpurl') ?>/wp-comments-post.php" method="post">
                <fieldset>
                    <legend>Post a comment</legend>
                    <?php if ( $user_ID ) { ?>
                        <p class="logged-in-as">
                            <?php printf( __( '<span class="loggedin">Logged in as <a href="%1$s" title="Logged in as %2$s">%2$s</a>.</span> <span class="logout"><a href="%3$s" title="Log out of this account">Log out?</a></span>' ),
                        get_bloginfo('wpurl') . '/wp-admin/profile.php',
                        esc_html( $user_identity ),
                        get_bloginfo('wpurl') . '/wp-login.php?action=logout&amp;redirect_to=' . get_permalink() ) ?>
                        </p>

                    <?php } else { ?>
                        <div class="form-row">
                            <label for="author">Name</label>
                            <input id="author" name="author" class="text<?php if ($req) { echo ' required'; } ?>" type="text" value="<?php echo $comment_author ?>" size="30" maxlength="50" tabindex="3" placeholder="Your name" />
                        </div>
                        <div class="form-row">
                            <label for="email">Email</label>
                            <input id="email" name="email" class="text<?php if ($req) { echo ' required'; } ?>" type="email" value="<?php echo $comment_author_email ?>" size="30" maxlength="50" tabindex="4" placeholder="Your email" />
                        </div>
                    <?php } ?>
                    <div class="form-row">
                        <label for="comment">Comment</label>
                        <textarea id="comment" name="comment" class="textarea text required" cols="45" rows="8" tabindex="5" placeholder="Your witty, insightful or interesting comment"></textarea>
                    </div>
                </fieldset>
                <fieldset>
                    <input type="hidden" name="comment_post_ID" value="<?php echo $id ?>" />
                    <input id="submit" name="submit" class="submit" type="submit" value="Post Comment" tabindex="6" />
                    <?php do_action( 'comment_form', $post->ID ); ?>
                </fieldset>
            </form>
        <?php } ?>

    </div>
</section>