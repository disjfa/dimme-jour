(function ($) {
    $(document).ready(function () {
        $('.carousel a[href*=\\#]').on('click', function (evt) {
            evt.preventDefault();
        });

        $('a[href*=\\#]').on('click', function (evt) {
            if ($(this.hash).length > 0 && evt.isDefaultPrevented() == false) {
                evt.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 500);
                window.location.hash = this.hash;
            }
        });

        var googlemapDiv = $('.googlemaps');
        $(document).on('click', '.googlemap-show-list', function () {
            googlemapDiv.removeClass('googlemap-map');
            googlemapDiv.addClass('googlemap-list');
        });
        $(document).on('click', '.googlemap-show-map', function () {
            googlemapDiv.removeClass('googlemap-list');
            googlemapDiv.addClass('googlemap-map');
        });
    });

})(jQuery);