(function ($) {
    $(document).ready(function () {
        //------------------------------------//
        //Navbar//
        //------------------------------------//
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

        $('.carousel a[href*=#]').on('click', function (evt) {
            evt.preventDefault();
        });

        //------------------------------------//
        //Scroll To//
        //------------------------------------//
        $('a[href*=#]').on('click', function (evt) {
            if ($(this.hash).length > 0 && evt.isDefaultPrevented() == false) {
                evt.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 500);
                window.location.hash = this.hash;
            }
        });

        ////------------------------------------//
        ////Wow Animation//
        ////------------------------------------//
        //wow = new WOW(
        //    {
        //        boxClass:     'wow',      // animated element css class (default is wow)
        //        animateClass: 'animated', // animation css class (default is animated)
        //        offset:       0,          // distance to the element when triggering the animation (default is 0)
        //        mobile:       false        // trigger animations on mobile devices (true is default)
        //    }
        //);
        //wow.init();
        //
        //

    });

})(jQuery);