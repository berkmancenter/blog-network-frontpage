<?php 
    
/* 
 * network-search.php
 *
 * Adds the network_search shortcode that allows the creation of the network search page.
 *
 * [network_search]
 *
 */

function network_search_handler( $atts ) {

   $network_search = <<<'EOT'

<script>
  (function() {
    var cx = '015658917605275914309:iyvebm56d6q';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//www.google.com/cse/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<div class="gcse-searchbox"></div>
<div class="gcse-searchresults"></div>

EOT;

    return $network_search;
}
add_shortcode( 'network_search', 'network_search_handler' );

?>