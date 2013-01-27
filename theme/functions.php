<?php

// Produces an avatar image with the hCard-compliant photo class
// Pulled from Sandbox: http://www.plaintxt.org/themes/sandbox/
function commenter_link() {
    $avatar_email = get_comment_author_email();
    $avatar_size = apply_filters( 'avatar_size', '60' ); // Available filter: avatar_size
    $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, $avatar_size ) );
    echo $avatar . ' <span class="fn n">' . get_comment_author() . '</span>';
}

?>