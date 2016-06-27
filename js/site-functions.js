(function ($) {
    $(document).ready(function () {
        var navbar = $('.home .navbar');
        if (navbar.length > 0) {
            navbar.addClass('closed');

            setTimeout(function () {
                navbar.css('transition', 'top 0.5s');
            }, 100);

            $(window).on('scroll', function (e) {
                if ($(window).scrollTop() > 140) {
                    if (navbar.hasClass('closed')) {
                        navbar.removeClass('closed');
                    }
                } else {
                    if (!navbar.hasClass('closed')) {
                        navbar.addClass('closed');
                    }
                }
            });
            navbar.addClass('closed');
        }

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