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
        get_stylesheet_directory_uri() . '/datatables/js/jquery.dataTables.min.js',
        array('jquery')
    );

    wp_enqueue_script(
        'directory_engine',
        get_stylesheet_directory_uri() . '/includes/directory-engine.js',
        array('jquery')
    );

    wp_enqueue_style(
        'datatables_css',
        get_stylesheet_directory_uri() . '/datatables/css/jquery.dataTables.css'
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
                $dataTable .= "<th>Name</th>";
                $dataTable .= "<th>Description</th>";
                $dataTable .= "<th>Created</th>";
                $dataTable .= "<th>Updated</th>";
            $dataTable .= "</tr>";
        $dataTable .= "</thead>";

        $dataTable .= "<tbody>";

            foreach ($blogs as $blog){
                $dataTable .= "<tr>";
                    $dataTable .= "<td>" . "<a href='" . get_blog_details($blog)->path . "'>" . get_blog_option($blog, "blogname") . "</a>" . "</td>";
                    $dataTable .= "<td>" . get_blog_option($blog, "blogdescription") . "</td>";
                    $dataTable .= "<td>" . get_blog_details($blog)->registered . "</td>";
                    $dataTable .= "<td>" . get_blog_details($blog)->last_updated . "</td>";
                $dataTable .= "</tr>";
            }

        $dataTable .= "</tbody>";

    $dataTable .= "</table>";

    return $dataTable;
}
add_shortcode( 'directory', 'network_directory_handler' );

?>