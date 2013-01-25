<?php
/*
Template Name: JSON blog list
*/
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
global $wpdb;
$siteurl = get_site_url();
$blogs = $wpdb->get_col( "SELECT concat(\"$siteurl\",path,'feed/') FROM $wpdb->blogs WHERE site_id = '$wpdb->siteid' AND blog_id != '1' AND public = '1' AND archived = '0' AND mature = '0' AND spam = '0' AND deleted = '0' ORDER BY registered DESC");

echo json_encode($blogs);

