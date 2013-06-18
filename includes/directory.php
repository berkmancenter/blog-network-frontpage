<?php 
    
/* 
 * directory.php
 *
 * Adds the directory shortcode that allows the creation of the directory.
 *
 * [directory]
 *
 */

function network_ajax_handler(){

    global $wpdb;

    // Get MySQL data

    $blogs = $wpdb->get_col(
        $wpdb->prepare("SELECT blog_id FROM " . $wpdb->base_prefix . "blogs", array())
    );

    echo '{"aaData": [';

        $first_item = true;

        foreach ($blogs as $blog){

            if (!$first_item){
                echo ", ";
            }
            else {
                $first_item = false;
            }

            $blogusers = get_users(array(
                'blog_id' => $blog,
                'role' => 'administrator'
            ));

            $blogusers_string = "";

            foreach ($blogusers as $user) {
                $blogusers_string .= "<div>" . $user->display_name . "</div>";
            }

            $row = array(
                "<a href='" . get_blog_details($blog)->path . "'>" . get_blog_option($blog, "blogname") . "</a>",
                "<div class='directory_description' title='" . get_blog_option($blog, "blogdescription") . "'>" . get_blog_option($blog, "blogdescription") . "</div>",
                $blogusers_string,
                date("n/j/Y", strtotime(get_blog_details($blog)->registered)),
                date("n/j/Y", strtotime(get_blog_details($blog)->last_updated))
            );
            
            echo json_encode($row);

            flush();

            unset($blogusers);
            unset($blogusers_string);
            unset($row);

        }

    echo ']}';

    die();
}

add_action('wp_ajax_populate_directory', 'network_ajax_handler');
add_action('wp_ajax_nopriv_populate_directory', 'network_ajax_handler');

function network_directory_handler( $atts ) {

    // Extract attributes

    extract( shortcode_atts( array(
        'perpage' => false,
        'search' => false,
        'orderby' => false,
        'page' => false

    ), $atts ) );

    // Echo necessary scripts

    wp_enqueue_script(
        'datatables_js',
        get_stylesheet_directory_uri() . '/vendor/datatables/js/jquery.dataTables.min.js',
        array('jquery')
    );

    wp_enqueue_script(
        'directory_engine',
        get_stylesheet_directory_uri() . '/includes/directory-engine.js',
        array('jquery')
    );

    wp_localize_script(
        'directory_engine',
        'ajax_object',
        array('ajax_url' => admin_url( 'admin-ajax.php' ))
    );

    wp_enqueue_style(
        'directory_css',
        get_stylesheet_directory_uri() . '/includes/directory.css'
    );

    wp_enqueue_style(
        'datatables_css',
        get_stylesheet_directory_uri() . '/vendor/datatables/css/jquery.dataTables.css'
    );

    // Construct table HTML

    $dataTable = "";

    $dataTable .= "<table class='datatable'>";
        $dataTable .= "<thead>";
            $dataTable .= "<tr>";
                $dataTable .= "<th>Blog</th>";
                $dataTable .= "<th>Description</th>";
                $dataTable .= "<th>Owner</th>";
                $dataTable .= "<th>Created</th>";
                $dataTable .= "<th>Updated</th>";
            $dataTable .= "</tr>";
        $dataTable .= "</thead>";

        $dataTable .= "<tbody>";

            // populate with AJAX

        $dataTable .= "</tbody>";

    $dataTable .= "</table>";

    return $dataTable;
}
add_shortcode( 'directory', 'network_directory_handler' );

?>