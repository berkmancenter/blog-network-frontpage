<?php

require("includes/network-search.php");

add_action( 'init', 'register_my_menus' );
add_action( 'signup_extra_fields', 'registration_text' );

function register_my_menus() {
	register_nav_menus(
		array(
			'footer' => __( 'Footer Menu' )
		)
	);
}

function registration_text() {
	echo "<label>Registration Type:</label>
		<p><b><u>Gimme a site!</u></b> - This option creates an account and blog site for the user. The user is set as the administrator of their new blog with full control over the layout and content. In addition to having their own blog the user will have all the same privileges and features that the <i>'Just a username, please'</i> option grants.</p>
		<p><b><u>Just a username, please.</u></b>  - This option creates an account for the user but does not provide the user with a blog site of their own. An account allows a user to subscribe to individual blogs and/or categories, receive email updates from the the network administrator, and to be added as a collaborator to other blogs by administrators.</p>";
}

function faq_all_categories( $atts ) {
    if (strpos($_SERVER['REQUEST_URI'], '/faqs/category') !== false) {
    	return '<a href=' . get_page_link(52) . '>Return to all categories</a>';
    }
    else {
    	return null;
    }
}
add_shortcode( 'faq_all_cat', 'faq_all_categories' );

?>
