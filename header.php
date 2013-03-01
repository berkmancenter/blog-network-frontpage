<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<hgroup>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav><!-- #site-navigation -->

		<nav class="nav-right">
			<?php global $current_user, $blog_id;
			if (!is_user_logged_in()) { ?>
				<a href="#login" class="fancybox">Login</a>
				<div class="fancybox-hidden" style="display:none">
					<div id="login" style="width:300px;height:200px">
						<form name="loginform" id="loginform" action="wp-login.php" method="post">
						<h2>Already a blogger?</h2>
							<ul>
								<li><strong>Username:</strong></li>
								<li><input type="text" name="log" id="log" value="" size="20" tabindex="1" /></li>
								<li><strong>Password:</strong></li>
								<li><input type="password" name="pwd" id="pwd" value="" size="20" tabindex="2" /></li>
								<li><input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="3" /> Remember me</li>
								<li style="text-align: right; margin-right: 8px"><input type="submit" name="submit" id="submitform" value="Login &raquo;" tabindex="4" /></li>
								<input type="hidden" name="redirect_to" value="'<?php echo $_SERVER["REQUEST_URI"] ?>'" />
							</ul>
						</form>
					</div>
				</div>
			<?php
			} 
			else {
				$blogs = get_blogs_of_user($current_user->ID);
				$username = $current_user->user_login;
			?>
				<h2>Hi <?php echo $username; ?>! <span class="logout">(<a href="<?php echo wp_logout_url($_SERVER["REQUEST_URI"]) ?>">Logout</a>)</h2>
			<?php
			}
			?> 

			<input type=button onClick="parent.location='<?php echo site_url('wp-signup.php','login') ?>'" value='Register'>
						
			<?php get_search_form(true); ?>
		</nav>

		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="main" class="wrapper">