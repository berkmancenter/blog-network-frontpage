<?php
function berkman_get_last_updated($num = 10) {
	global $wpdb;
	date_default_timezone_set('America/New_York');
	$blogs = $wpdb->get_results( "SELECT blog_id, path, CONVERT_TZ(last_updated,'GMT','America/New_York') as last_updated FROM $wpdb->blogs WHERE site_id = '$wpdb->siteid' AND blog_id != '1' AND public = '1' AND archived = '0' AND mature = '0' AND spam = '0' AND deleted = '0' AND last_updated != '0000-00-00 00:00:00' AND (last_updated - registered) > 30 ORDER BY last_updated DESC limit 0,$num", ARRAY_A );

	foreach($blogs as $blog) {
		$updated_name = get_blog_option($blog['blog_id'], "blogname");
		$updated_time = strtotime($blog['last_updated']);
		if(date("Y-m-d") == date("Y-m-d", $updated_time)) {
				$updated_date = date("g:i a", $updated_time); 
		} elseif(date("Y-m-d") == date("Y-m-d", $updated_time-86400)) {
				$updated_date = "Yesterday";
		} else {
				$updated_date = date("M j", $updated_time);
		}

		$berkman_last_updated[] = array($blog['path'], stripslashes($updated_name), $updated_date . "<!-- $updated_time -->");
	}
	return array_slice($berkman_last_updated, 0, $num);
}
?>
