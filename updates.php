<?php
/*
Template Name: Updates
*/
?>
<?php get_header(); ?>
    <h3><?php the_title(); ?></h3>
	<p style="font-size: 80%">This list shows the 50 most recently updated blogs (where a new post or comment has been made).</p>
<style type="text/css">
	table#updates td {
		border-bottom: 1px dotted #eee;
		padding: 3px;
	}
</style>
<div class="postentry">
<table border="0" id="updates" cellpadding="0" cellspacing="0">
<?php
$output = "";
$latest_updates = berkman_get_last_updated(50);
foreach($latest_updates as $updated) {
		list($path, $title, $time) = $updated;
		$output .= "<tr><td width=\"95%\"><a href=\"$path\">" . (($title == '') ? 'untitled' : $title) . "</a></td><td nowrap=\"nowrap\" align=\"right\">$time</td></tr>\n";
}
echo $output;
?>
</table>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>

