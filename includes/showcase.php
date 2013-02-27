<?php 
    
/* 
 * showcase.php
 *
 * Adds the showcase shortcode that allows the creation of the showcase.
 *
 * [showcase number=":NUMBER-OF-BLOGS-TO-DISPLAY"]
 *
 */

function network_showcase_handler( $atts ) {

    global $wpdb;

    // Extract attributes

    extract( shortcode_atts( array(
        'number' => '5'
    ), $atts ) );

    // Echo necessary scripts

    wp_enqueue_script(
        'showcase_masonry_js',
        get_stylesheet_directory_uri() . '/vendor/jquery.masonry.min.js',
        array('jquery')
    );

    wp_enqueue_script(
        'showcase_engine',
        get_stylesheet_directory_uri() . '/includes/showcase-engine.js',
        array('jquery')
    );

    wp_enqueue_style(
        'showcase_css',
        get_stylesheet_directory_uri() . '/includes/showcase.css'
    );

    // Get blogs to show 

    // TODO - Add filters
    // TODO - Use number attribute ($number) as limit

    $blogs = $wpdb->get_col(
            $wpdb->prepare("SELECT blog_id FROM " . $wpdb->base_prefix . "blogs LIMIT 5", array())
        );

    // Prepare HTML

    $showcase_html = "";

    $showcase_html .= "<div class='showcase'>";
        foreach ($blogs as $blog){

            $blogusers = get_users(array(
                    'blog_id' => $blog,
                    'who' => 'authors'
                ));
            $first_author = true;

            $showcase_html .= "<div class='showcase_box'>";
                $showcase_html .= "<div>" . "<a href='" . get_blog_details($blog)->path . "'>" . get_blog_option($blog, "blogname") . "</a>" . "</div>";
                $showcase_html .= "<div class='showcase_authors'>By ";
                    foreach ($blogusers as $user) {
                        if (!$first_author){
                            $showcase_html .= ", ";
                        }
                        $first_author = false;
                        $showcase_html .= "<a href='" . $user->user_url . "'>" . $user->display_name . "</a>";
                    }
                $showcase_html .= "</div>";
                $showcase_html .= "<div>" . get_blog_option($blog, "blogdescription") . "</div>";
                $showcase_html .= "<div>Registered " . get_blog_details($blog)->registered . "</div>";
                $showcase_html .= "<div>Updated " . get_blog_details($blog)->last_updated . "</div>";
            $showcase_html .= "</div>";
        }
    $showcase_html .= "</div>";

    // Return 

    return $showcase_html;
}
add_shortcode( 'showcase', 'network_showcase_handler' );

?>