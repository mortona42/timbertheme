jQuery(document).ready(function( $ ) {

    // Fixed Sticky
    $( '#header' ).fixedsticky();

    // PhotoSwipe
    var getItems = function() {
        var items = [];
    
        $('main#main article img').each( function($index) {
            var $pic = $(this);
            var item = {
                src : $pic.attr("original-image"),
                w   : $pic.attr("original-width"),
                h   : $pic.attr("original-height")
            }
    
            items.push(item);

            var startPhotoSwipe = function(event) {
                event.preventDefault();

                var options = {
                    index: $index,
                    bgOpacity: 0.7,
                    showHideOpacity: true
                }

                // Initialize PhotoSwipe
                var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
                lightBox.init();
            }
            
            var $pswp = $('.pswp')[0];
            $pic.on('click', startPhotoSwipe);
            
            var $parent = $pic.parent();
            if ($parent.hasClass('sily-image_image')) {
                $parent = $parent.parent();


                if ($parent.hasClass('sily-image--single')) {
                    $text = $parent.find('.sily-image_text');
                    $text.on('click', startPhotoSwipe);
                }
                
                // if ($parent.hasClass('sily-image--double')) {
                //     $text = $parent.find('.sily-image_text');
                //     $test.on('click', startPhotoSwipe);
                // }

            }
        
        });
        return items;
    }

    var items = getItems();

    // Contributors.
    var slideout = new Slideout({
        'panel': document.getElementById('page'),
        'menu': document.getElementById('contributors'),
        'padding': 256,
        'tolerance': 70
    });
    // Toggle button
    document.querySelector('.toggle-button').addEventListener('click', function() {
        slideout.toggle();
    });
});