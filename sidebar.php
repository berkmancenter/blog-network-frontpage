	</div><!-- End Content -->
	
	<div id="sidebar">
		<ul>
			<li class="start"><a href="<?php echo site_url('wp-signup.php','login') ?>" title="Create a weblog">Create a weblog &rarr;</a></li>
			<li id="support">
				<h2>Blogging at Berkman</h2>
				<ul>
					<li><a href="/blog/tags/news">Server News</a></li>
					<li><a href="/updates">Recently Updated Blogs</a></li>
				</ul>
				<h2>How To Guides</h2>
				<ul>
					<li><a href="/getting-started">Getting Started</a>&nbsp;&nbsp;blogging basics</li>
					<li><a href="/customizing-your-blog">Customizing Your Blog</a>&nbsp;&nbsp;themes and sidebar widgets</li>
					<li><a href="/extending-your-blog">Extending Your Blog</a>&nbsp;&nbsp;using plugins</li>
				</ul>
			</li>
			<li id="blogs">
<?php
global $current_user, $blog_id;
if (!is_user_logged_in()) { ?>
			<form name="loginform" id="loginform" action="wp-login.php" method="post">
			<h2>Already a blogger?</h2>
			<ul>
			<li><strong>Username:</strong></li>
			<li><input type="text" name="log" id="log" value="" size="20" tabindex="1" /></li>
			<li><strong>Password:</strong></li>
			<li><input type="password" name="pwd" id="pwd" value="" size="20" tabindex="2" /></li>
			<li><input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="3" /> Remember me</li>
			<li style="text-align: right; margin-right: 8px"><input type="submit" name="submit" id="submitform" value="Login &raquo;" tabindex="4" /></li>
			<input type="hidden" name="redirect_to" value="/" />
			</form>
			<?php
} else {
	$blogs = get_blogs_of_user($current_user->ID);
	$username = $current_user->user_login;
?>
			<h2>Hi there, <?php echo $username; ?>! <span class="logout">(<a href="<?php echo wp_logout_url() ?>">Logout</a>)
			</h2>
			<ul>
<?php if(!empty($blogs)) {
	echo "<li>Here are your blogs:</li>";
	foreach ($blogs as $blog) {
		if($blog->path == "/")
			$blog->path = "/home/";
		echo "<li>&#8227; <a href=\"" . $blog->path . "\">" . substr($blog->path, 1, -1) . "</a> (<a href=\"" . $blog->path . "wp-admin/\">admin</a>)</li>";
		}
	}
}
?>
			</ul>
			</li>
			<li id="terms">
				<ul>
					<li><a href="/project-info">Project Info</a></li>
					<li><a href="/blog/2011/01/31/about-our-wordpress-deployment/">Technical FAQ</a></li>
					<li><a href="/terms-of-use">Terms of Use</a></li>
					<li><a href="/privacy-policy">Privacy Policy</a></li>
					<li><a href="/legal-faq">Legal FAQ</a></li>
				</ul>
			</li>
			</ul>
		</ul>
<?php if(!is_home()): ?>
		<h3>Brought to you by</h3>
		<a href="http://cyber.law.harvard.edu/" title="Berkman Center for Internet &amp; Society at Harvard University"><img src="<?php bloginfo('template_directory'); ?>/images/Berkman-HU-full-180px.png" alt="Berkman Center for Internet &amp; Society at Harvard University" style="width:180px;height:40px;border:none;margin:5px 0 40px 10px;" /></a>
<?php endif; ?>
	</div>
</div><!-- End Middle -->
