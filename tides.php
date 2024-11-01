<?php
/*
 * Plugin Name: Tides
 * Plugin URI: http://the-artifice.com
 * Description: Adds a Tides submit link whenever a post is published
 * Version: 1.0
 * Author: The Artifice
 * Author URI: http://the-artifice.com
*/

// encrypt
function obfuscate_tide_pid($id) {
    $code = md5($id.AUTH_SALT);
    $code = substr($code, 0, 6);
    return $code;
}

// output 
add_action( 'edit_form_after_title', 'tides_edit_form_after_title' );
function tides_edit_form_after_title() {

  global $post;

  if ($post->post_type!== 'post')
    return;

  if ($post->post_status!== 'publish')
    return;

  $code = obfuscate_tide_pid($post->ID); 
  $title = urlencode($post->post_title);
  $url = urlencode(get_permalink());

  echo '<div class="postbox" style="margin-bottom:0px;margin-top:5px;padding:10px;"><p style="margin:0;">Submit this post to the tides on <a href="http://the-artifice.com">The Artifice</a>. Use <a target="_blank" href="http://the-artifice.com/tides/?ref='. $code .'&amp;title='. $title .'&amp;url='. $url .'">this link</a> with ref code <strong>'. $code .'</strong> to boost your post to the top. </p></div>';

}


