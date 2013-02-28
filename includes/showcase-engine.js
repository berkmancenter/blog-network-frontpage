jQuery(document).ready(function (){
    jQuery('.showcase').masonry({
        itemSelector: '.showcase_item',
        isResizable: true,
        animationOptions: {
            duration: 200
        }
    });
});