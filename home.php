<?php get_header(); ?>

<div class="post">
				
	<h2>Free blogs for the Harvard community</h2>

	<div class="postentry">
		<p>
		Weblogs at Harvard Law is provided by the <a href="http://cyber.law.harvard.edu/">Berkman Center for
		Internet & Society</a> at Harvard University  as a free service to the Harvard community.  Anyone with an email address at harvard.edu, radcliffe.edu, or hbs.edu can sign up instantly and be blogging in minutes.</p>
	</div>
	
	<hr noshade size="1" />

    <div class="provided">
        <h3>Brought to you by</h3>
        <a href="http://cyber.law.harvard.edu/" title="Berkman Center for Internet &amp; Society at Harvard University"><img src="<?php bloginfo('template_directory'); ?>/images/Berkman-HU-full-180px.png" alt="Berkman Center for Internet &amp; Society at Harvard University
" style="width:180px;height:40px;border:none;margin:0;" /></a>
        <br />
        <p>The Berkman Center for Internet &amp; Society at Harvard University</p>
    </div>
	
	<div class="postentry">
	<h3 class="updated">Recently Updated Blogs</h3>
	<table border="0" cellspacing="2" width="55%">
<?php
$output = "";
$latest_updates = berkman_get_last_updated(5);
foreach($latest_updates as $updated) {
		list($path, $title, $time) = $updated;
		$output .= "<tr><td><a href=\"$path\">$title</a></td><td nowrap=\"nowrap\">$time</td></tr>\n";
}
echo $output;
?>
</table>

<hr noshade size="1" />

	<h3 class="updated">Why blog at Harvard?</h3>
	<ul>
		<li>Choose from over 100 themes to make your blog unique.</li>
		<li>Customize your blog quickly and easily with widgets.</li>
		<li>It's easy to create a podcast, just upload mp3 files!</li>
		<li>Sophisticated spam protection with Akismet keeps out undesirables.</li>
	</ul>
	<div class="start"><a href="<?php echo site_url('wp-signup.php','login') ?>" title="Create a weblog">Create a weblog &rarr;</a></div>
	</div>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
