(function($){
    $(function(){
        var height = $(window).height();
        $('.parallax').parallax();

        $("#owl-demo").owlCarousel({
            slideSpeed : 300,
            autoPlay : 3000,
            singleItem:true,
            navigation: false,
            autoHeight : true,
            transitionStyle:"fadeUp",
            mouseDrag : false,
            touchDrag : false
        });
        $("#owl-gallery").owlCarousel({
            slideSpeed : 300,
            autoPlay : 3000,
            singleItem:true,
            navigation: false,
            mouseDrag : false,
            touchDrag : false
        });


    }); // end of document ready
})(jQuery); // end of jQuery name space
