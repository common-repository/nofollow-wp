<?php
/*
Plugin Name: NoFollow WP
Plugin URI: http://plugins.sonicity.eu/nofollow-plugin
Description: This plugin allows you to enable/disable the NoFollow attribute on your blog.
Version: 1.0.2
Author: Sonicity
Author URI: http://plugins.sonicity.eu
*/

/*  Copyright 2010 Sonicity - support@sonicity.eu

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Hook for adding admin menus
add_action('admin_menu', 'nofollow_add_pages');

if (get_option("mt_nofollow_author")=="Yes") {
add_filter('get_comment_author_link', 'enable_nofollow_link');
}

if (get_option("mt_nofollow_text")=="Yes") {
add_filter('comment_text', 'enable_nofollow_text');
}

if (get_option("mt_nofollow_type")=="Yes") {
add_filter('get_comment_type', 'enable_nofollow_type');
}

if (get_option("mt_nofollow_posts")=="Yes") {
add_filter('the_content', 'enable_nofollow_posts');
}

if (get_option("mt_nofollow_plugin_support")=="Yes" || get_option("mt_nofollow_plugin_support")=="") {
add_action('comment_form', 'nofollow_plugin_support');
}

// action function for above hook
function nofollow_add_pages() {
    add_options_page('NoFollow WP', 'NoFollow WP', 'administrator', 'nofollow', 'nofollow_options_page');
}

// nofollow_options_page() displays the page content for the Test Options submenu
function nofollow_options_page() {

    // variables for the field and option names 
    $opt_name_2 = 'mt_nofollow_text';
    $opt_name_3 = 'mt_nofollow_author';
	$opt_name_4 = 'mt_nofollow_sites';
	$opt_name_5 = 'mt_nofollow_ip';
    $opt_name_6 = 'mt_nofollow_plugin_support';
	$opt_name_7 = 'mt_nofollow_posts';
	$opt_name_8 = 'mt_nofollow_users';
    $hidden_field_name = 'mt_nofollow_submit_hidden';
    $data_field_name_2 = 'mt_nofollow_text';
    $data_field_name_3 = 'mt_nofollow_author';
	$data_field_name_4 = 'mt_nofollow_sites';
	$data_field_name_5 = 'mt_nofollow_ip';
    $data_field_name_6 = 'mt_nofollow_plugin_support';
	$data_field_name_7 = 'mt_nofollow_posts';
	$data_field_name_8 = 'mt_nofollow_users';

    // Read in existing option value from database
    $opt_val_2 = get_option( $opt_name_2 );
    $opt_val_3 = get_option( $opt_name_3 );
	$opt_val_4 = get_option( $opt_name_4 );
	$opt_val_5 = get_option( $opt_name_5 );
    $opt_val_6 = get_option( $opt_name_6 );
	$opt_val_7 = get_option( $opt_name_7 );
	$opt_val_8 = get_option( $opt_name_8 );
	
    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val_2 = $_POST[ $data_field_name_2 ];
        $opt_val_3 = $_POST[ $data_field_name_3 ];
		$opt_val_4 = $_POST[ $data_field_name_4 ];
		$opt_val_5 = $_POST[ $data_field_name_5 ];
        $opt_val_6 = $_POST[$data_field_name_6];
		$opt_val_7 = $_POST[$data_field_name_7];
		$opt_val_8 = $_POST[$data_field_name_8];

        // Save the posted value in the database
        update_option( $opt_name_2, $opt_val_2 );
        update_option( $opt_name_3, $opt_val_3 );
		update_option( $opt_name_4, $opt_val_4 );
		update_option( $opt_name_5, $opt_val_5 );
        update_option( $opt_name_6, $opt_val_6 );  
		update_option( $opt_name_7, $opt_val_7 );
		update_option( $opt_name_8, $opt_val_8 );

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Settings saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php

    }

    // Now display the options editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'NoFollow WP Plugin Options', 'mt_trans_domain' ) . "</h2>";

    // options form
    
    $change4 = get_option("mt_nofollow_users");
    $change5 = get_option("mt_nofollow_plugin_support");
    $change6 = get_option("mt_nofollow_text");
    $change7 = get_option("mt_nofollow_author");
	$change8 = get_option("mt_nofollow_sites");
	$change9 = get_option("mt_nofollow_ip");
	$change10 = get_option("mt_nofollow_posts");

if ($change4=="Yes" || $change4=="") {
$change4="checked";
$change41="";
} else {
$change4="";
$change41="checked";
}

if ($change5=="Yes" || $change5=="") {
$change5="checked";
$change51="";
} else {
$change5="";
$change51="checked";
}

if ($change6=="Yes" || $change6=="") {
$change6="checked";
$change61="";
} else {
$change6="";
$change61="checked";
}

if ($change7=="Yes" || $change7=="") {
$change7="checked";
$change71="";
} else {
$change7="";
$change71="checked";
}

if ($change10=="Yes" || $change10=="") {
$change10="checked";
$change101="";
} else {
$change10="";
$change101="checked";
}
    ?>
<form name="form1" method="post" action="">
<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

<p><?php _e("Links in the main comment are...", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_2; ?>" value="Yes" <?php echo $change6; ?>>DoFollow
<input type="radio" name="<?php echo $data_field_name_2; ?>" value="No" <?php echo $change61; ?>>NoFollow
</p><hr />

<p><?php _e("Links in the Website URL field are...", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_3; ?>" value="Yes" <?php echo $change7; ?>>DoFollow
<input type="radio" name="<?php echo $data_field_name_3; ?>" value="No" <?php echo $change71; ?>>NoFollow
</p><hr />

<p><?php _e("Links in Blog Posts are...", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_7; ?>" value="Yes" <?php echo $change10; ?>>DoFollow
<input type="radio" name="<?php echo $data_field_name_7; ?>" value="No" <?php echo $change101; ?>>NoFollow
</p><hr />

<p><?php _e("Only these sites are DoFollow (Leave blank to disable), one per line:", 'mt_trans_domain' ); ?> 
<textarea name="<?php echo $data_field_name_4; ?>" rows="5" cols="50"><?php echo $change8; ?></textarea>
</p><hr />

<p><?php _e("Only these IPs can post DoFollow comments (Leave blank to disable), one per line:", 'mt_trans_domain' ); ?> 
<textarea name="<?php echo $data_field_name_5; ?>" rows="5" cols="50"><?php echo $change9; ?></textarea>
</p><hr />

<p><?php _e("Logged in users who are logged in are DoFollow?", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_8; ?>" value="Yes" <?php echo $change4; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_8; ?>" value="No" <?php echo $change41; ?>>No
</p><hr />

<p><?php _e("Support this Plugin?", 'mt_trans_domain' ); ?> 
<input type="radio" name="<?php echo $data_field_name_6; ?>" value="Yes" <?php echo $change5; ?>>Yes
<input type="radio" name="<?php echo $data_field_name_6; ?>" value="No" <?php echo $change51; ?>>No
</p><hr />

<p class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'mt_trans_domain' ) ?>" />
</p>

</form>
<?php
}

function enable_nofollow_link($comment2) {
$allowedsites2=get_option("mt_nofollow_sites");
$option_nofollow2=get_option("mt_nofollow_on");
$plugin_support2=get_option("mt_nofollow_plugin_support");
$option_ip2=get_option("mt_nofollow_ip");

if (!$option_ip2=="") {
$authorip=get_comment_author_IP();

if ($authorip=="") {
$authorip="192.168.1.1";
}

$pos=strpos($option_ip2, $authorip);

if (is_int($pos)) {
$comment2 = preg_replace("/(<a[^>]*[^\s])(\s*nofollow\s*)/i", "$1", $comment2);
$comment2 = preg_replace("/(<a[^>]*[^\s])(\s*rel=[\"\']\s*[\"\'])/i", "$1", $comment2);
}
}

if (!$allowedsites2=="") {
preg_match('/http:\/\/[A-Za-z0-9\-_]+\\.+[A-Za-z0-9\.\/%&=\?\-_]+/', $comment2, $domainname2);
preg_match('@^(?:http://)?([^/]+)@i', $domainname2[0], $matches2);
$pos2=strpos($allowedsites2, $matches2[1]);

if ($pos2=="" || $pos2=="false") {
} else {
$comment2 = preg_replace("/(<a[^>]*[^\s])(\s*nofollow\s*)/i", "$1", $comment2);
$comment2 = preg_replace("/(<a[^>]*[^\s])(\s*rel=[\"\']\s*[\"\'])/i", "$1", $comment2);
}
}

if ($allowedsites2=="" && $option_ip2=="") {
$comment2 = preg_replace("/(<a[^>]*[^\s])(\s*nofollow\s*)/i", "$1", $comment2);
$comment2 = preg_replace("/(<a[^>]*[^\s])(\s*rel=[\"\']\s*[\"\'])/i", "$1", $comment2);
}

if (get_option("mt_nofollow_users")=="Yes") {
global $comment;
if ($comment['user_id']==0 || $comment['user_id']=="") {
$comment2 = preg_replace("/(<a[^>]*[^\s])(\s*nofollow\s*)/i", "$1", $comment2);
$comment2 = preg_replace("/(<a[^>]*[^\s])(\s*rel=[\"\']\s*[\"\'])/i", "$1", $comment2);
}
}

return $comment2;
}

function enable_nofollow_posts($comment) {
$allowedsites=get_option("mt_nofollow_sites");
$option_nofollow=get_option("mt_nofollow_on");
$plugin_support=get_option("mt_nofollow_plugin_support");

if (!$allowedsites=="") {
$i=preg_match_all('/http:\/\/[A-Za-z0-9\-_]+\\.+[A-Za-z0-9\.\/%&=\?\-_]+/', $comment, $domainname);
$j=0;

while ($j<$i) {
$pos=strpos($allowedsites, $domainname[0][$j]);
if ($pos=="") {
} else {
$comment = preg_replace("/(<a[^>]*[^\s])(\s*nofollow\s*)/i", "$1", $comment);
$comment = preg_replace("/(<a[^>]*[^\s])(\s*rel=[\"\']\s*[\"\'])/i", "$1", $comment);
}
$j ++;
}
}

if ($allowedsites=="") {
$comment = preg_replace("/(<a[^>]*[^\s])(\s*nofollow\s*)/i", "$1", $comment);
$comment = preg_replace("/(<a[^>]*[^\s])(\s*rel=[\"\']\s*[\"\'])/i", "$1", $comment);
}

return $comment;
}

function enable_nofollow_text($comment) {
$allowedsites=get_option("mt_nofollow_sites");
$option_nofollow=get_option("mt_nofollow_on");
$plugin_support=get_option("mt_nofollow_plugin_support");
$option_ip=get_option("mt_nofollow_ip");

if (!$option_ip=="") {
$authorip=get_comment_author_IP();

if ($authorip=="") {
$authorip="192.168.1.1";
}

$pos=strpos($option_ip, $authorip);

if (is_int($pos)) {
$comment = preg_replace("/(<a[^>]*[^\s])(\s*nofollow\s*)/i", "$1", $comment);
$comment = preg_replace("/(<a[^>]*[^\s])(\s*rel=[\"\']\s*[\"\'])/i", "$1", $comment);
} else {
}
}

if (!$allowedsites=="") {
$i=preg_match_all('/http:\/\/[A-Za-z0-9\-_]+\\.+[A-Za-z0-9\.\/%&=\?\-_]+/', $comment, $domainname);
$j=0;

while ($j<$i) {
$pos=strpos($allowedsites, $domainname[0][$j]);
if ($pos=="") {
} else {
$comment = preg_replace("/(<a[^>]*[^\s])(\s*nofollow\s*)/i", "$1", $comment);
$comment = preg_replace("/(<a[^>]*[^\s])(\s*rel=[\"\']\s*[\"\'])/i", "$1", $comment);
}
$j ++;
}
}

if ($allowedsites=="" && $option_ip=="") {
$comment = preg_replace("/(<a[^>]*[^\s])(\s*nofollow\s*)/i", "$1", $comment);
$comment = preg_replace("/(<a[^>]*[^\s])(\s*rel=[\"\']\s*[\"\'])/i", "$1", $comment);
}

return $comment;
}

function nofollow_plugin_support() {
global $single, $feed, $post;

if (!$feed && $single) {
echo "<p style='font-size:x-small'>NoFollow Plugin made by <a href='http://www.xeromi.net'>Web Hosting</a></p>";
}
}

?>