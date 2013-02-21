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
    extract( shortcode_atts( array(
        'number' => '5'
    ), $atts ) );

    return "";
}
add_shortcode( 'showcase', 'network_showcase_handler' );

?>