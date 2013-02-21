<?php 
    
/* 
 * directory.php
 *
 * Adds the directory shortcode that allows the creation of the directory.
 *
 * [directory perpage=":NUMBER-OF-BLOGS-TO-DISPLAY-PER-PAGE" search=":QUERY" orderby=":ORDER-BY" page=":PAGE-TO_DISPLAY"]
 *
 */

function network_directory_handler( $atts ) {
    extract( shortcode_atts( array(
        'perpage' => '30',
        'search' => '',
        'orderby' => 'name',
        'page' => '1'

    ), $atts ) );

    return "";
}
add_shortcode( 'directory', 'network_directory_handler' );

?>