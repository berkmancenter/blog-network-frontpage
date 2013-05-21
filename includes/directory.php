<?php 
    
/* 
 * directory.php
 *
 * Adds the directory shortcode that allows the creation of the directory.
 *
 * [directory]
 *
 */

function network_directory_handler( $atts ) {

    global $wpdb;

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

    wp_enqueue_style(
        'directory_css',
        get_stylesheet_directory_uri() . '/includes/directory.css'
    );

    wp_enqueue_style(
        'datatables_css',
        get_stylesheet_directory_uri() . '/vendor/datatables/css/jquery.dataTables.css'
    );

    // Get MySQL data

    $blogs = $wpdb->get_col(
            $wpdb->prepare("SELECT blog_id FROM " . $wpdb->base_prefix . "blogs", array())
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

            foreach ($blogs as $blog){

                $blogusers = get_users(array(
                    'blog_id' => $blog,
                    'role' => 'administrator'
                ));

                $dataTable .= "<tr>";
                    $dataTable .= "<td>" . "<a href='" . get_blog_details($blog)->path . "'>" . get_blog_option($blog, "blogname") . "</a>" . "</td>";
                    $dataTable .= "<td><div class='directory_description' title='" . get_blog_option($blog, "blogdescription") . "'>" . get_blog_option($blog, "blogdescription") . "</div></td>";
                    foreach ($blogusers as $user) {
                        $dataTable .= "<td>" . "<div>" . $user->display_name . "</div>" . "</td>";
                    }
                    $dataTable .= "<td>" . date("n/j/Y", strtotime(get_blog_details($blog)->registered)) . "</td>";
                    $dataTable .= "<td>" . date("n/j/Y", strtotime(get_blog_details($blog)->last_updated)) . "</td>";
                $dataTable .= "</tr>";
            }

        $dataTable .= "</tbody>";

    $dataTable .= "</table>";

    return $dataTable;
}
add_shortcode( 'directory', 'network_directory_handler' );

?>