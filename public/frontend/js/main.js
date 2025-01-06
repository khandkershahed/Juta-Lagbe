(function ($) {
    "use strict";

    function owlCarouselConfig() {
        var target = $(".owl-carousel-banner");
        if (target.length > 0) {
            target.each(function () {
                var el = $(this),
                    dataAuto = el.data("owl-auto"),
                    dataLoop = el.data("owl-loop"),
                    dataSpeed = el.data("owl-speed"),
                    dataGap = el.data("owl-gap"),
                    dataNav = el.data("owl-nav"),
                    dataDots = el.data("owl-dots"),
                    dataAnimateIn = el.data("owl-animate-in")
                        ? el.data("owl-animate-in")
                        : "",
                    dataAnimateOut = el.data("owl-animate-out")
                        ? el.data("owl-animate-out")
                        : "",
                    dataDefaultItem = el.data("owl-item"),
                    dataItemXS = el.data("owl-item-xs"),
                    dataItemSM = el.data("owl-item-sm"),
                    dataItemMD = el.data("owl-item-md"),
                    dataItemLG = el.data("owl-item-lg"),
                    dataItemXL = el.data("owl-item-xl"),
                    dataNavLeft = el.data("owl-nav-left")
                        ? el.data("owl-nav-left")
                        : "<i class='fa fa-chevron-left'></i>",
                    dataNavRight = el.data("owl-nav-right")
                        ? el.data("owl-nav-right")
                        : "<i class='fa fa-chevron-right'></i>",
                    duration = el.data("owl-duration"),
                    datamouseDrag =
                        el.data("owl-mousedrag") == "on" ? true : false,
                    center = el.data("owl-center");
                if (
                    target.children("div, span, a, img, h1, h2, h3, h4, h5, h5")
                        .length >= 2
                ) {
                    el.owlCarousel({
                        animateIn: "fadeIn", // Animation when slide appears
                        animateOut: "fadeOut", // Animation when slide disappears
                        margin: 10, // Space between items in pixels
                        autoplay: true, // Enables automatic sliding
                        autoplayTimeout: 5000, // Time between slides in milliseconds (5 seconds)
                        autoplayHoverPause: true, // Pauses autoplay on mouse hover
                        loop: true, // Enables infinite loop
                        nav: true, // Displays next/prev navigation buttons
                        mouseDrag: true, // Allows sliding by dragging with the mouse
                        touchDrag: true, // Allows sliding by dragging with touch
                        autoplaySpeed: 1000, // Speed of autoplay transition
                        navSpeed: 800, // Speed of navigation button transitions
                        dotsSpeed: 800, // Speed of dots/pagination transitions
                        dragEndSpeed: 600, // Speed when dragging ends
                        navText: [
                            '<i class="fa fa-chevron-left"></i>',
                            '<i class="fa fa-chevron-right"></i>',
                        ],
                        dots: false, // Shows pagination dots
                        items: 3, // Number of items displayed per slide
                        center: true, // Center the active item
                        responsive: {
                            0: {
                                items: 1,
                            },
                            480: {
                                items: 1,
                            },
                            768: {
                                items: 1,
                            },
                            992: {
                                items: 1,
                            },
                            1200: {
                                items: 1,
                            },
                            1680: {
                                items: 1,
                            },
                        },
                    });

                    // el.on('change.owl.carousel', function (event) {
                    //     var $currentItem = $('.owl-item', el).eq(event.item.index);
                    //     var $elemsToanim = $currentItem.find("[data-animation-out]");
                    //     setAnimation($elemsToanim, 'out');
                    // });

                    // el.on('changed.owl.carousel', function (event) {
                    //     var $currentItem = $('.owl-item', el).eq(event.item.index);
                    //     var $elemsToanim = $currentItem.find("[data-animation-in]");
                    //     setAnimation($elemsToanim, 'in');
                    // });
                }
            });
        }
    }

    function common() {
        $(".ps-single-no-search").select2({
            minimumResultsForSearch: -1,
            dropdownCssClass: "ps-dropdown-single",
        });
        $(".ps-rating").each((index, value) => {
            var rate = $(value).attr("value");
            if ($(value).attr("value") === 0) {
                rate = "0";
            }
            $(value).barrating({
                theme: "fontawesome-stars",
                initialRating: rate,
                readonly: "true",
            });
        });
        $(".ps-rating--form").each((index, value) => {
            var rate = $(value).attr("data-value");
            if ($(value).attr("data-value") === 0) {
                rate = "0";
            }
            $(value).barrating({
                theme: "fontawesome-stars",
                initialRating: rate,
            });
        });
        $(".ps-noti__close").on("click", function (event) {
            event.preventDefault();
            $(".ps-noti").hide();
        });

        $(".ps-header__search .ps-input").on("change paste keyup", function () {
            if ($(this).val()) {
                $(".ps-search--result").addClass("active");
            } else {
                $(".ps-search--result").removeClass("active");
            }
        });

        $(".ps-search--result").on("mouseleave", function (e) {
            $(this).removeClass("active");
        });

        $(".open-search").on("click", function (event) {
            event.preventDefault();
            $(".ps-search").addClass("active");
        });

        $("#close-search").on("click", function (event) {
            event.preventDefault();
            $(".ps-search").removeClass("active");
        });

        $(".ps-search--mobile .ps-input").on("change paste keyup", function () {
            if ($(this).val()) {
                $(".ps-search--mobile .ps-search__result").addClass("active");
            } else {
                $(".ps-search--mobile .ps-search__result").removeClass(
                    "active"
                );
            }
        });

        $("[data-toggle=tooltip]").tooltip();

        $(".ps-section__toggle").on("click", function (event) {
            event.preventDefault();
            $(".ps-section--review-product .ps-form--review").slideToggle();
        });

        $(".ps-select--feature a").on("click", function (event) {
            event.preventDefault();
            var parent = $(this).parent();
            parent.find("a").removeClass("active");
            $(this).addClass("active");
        });

        $(".ps-block-control").on("click", function (event) {
            event.preventDefault();
            var parent = $(this).parent();
            parent.find(".ps-widget__content").slideToggle();
            $(this).toggleClass("active");
        });

        $("#collapse-filter").on("click", function (event) {
            event.preventDefault();
            $(this).toggleClass("active");
            $(".ps-categogy__main").toggleClass("active");
        });

        $("#close-widget-product").on("click", function (event) {
            event.preventDefault();
            $(this).removeClass("active");
            $(".ps-categogy__main").removeClass("active");
        });

        $(".js-example-basic-single").select2({
            dropdownCssClass: "ps-dropdown-input",
        });

        $(".ps-shopping__toggle").on("click", function (event) {
            event.preventDefault();
            $(".ps-shopping__form").slideToggle();
        });

        $(".toogle-password").on("click", function (event) {
            event.preventDefault();
            $(this).toggleClass("fa-eye");
            $(this).toggleClass("fa-eye-slash");
            var parent = $(this).parent().parent();
            var type =
                parent.find("input").attr("type") == "password"
                    ? "text"
                    : "password";
            parent.find("input").attr("type", type);
        });

        $("#create-account").on("click", function (event) {
            $('.ps-hidden[data-for="create-account"]').slideToggle();
        });

        $("#ship-address").on("click", function (event) {
            $('.ps-hidden[data-for="ship-address"]').slideToggle();
        });
    }

    function openModal() {
        // For cart mini
        $("#cart-mini").click(function (e) {
            e.stopPropagation(); // Prevents the event from bubbling up to other elements

            // Hide any other open modal
            $(".ps-login--modal").removeClass("active");

            // Toggle the cart mini modal
            $(".ps-cart--mini").toggleClass("active");
        });

        // For login modal
        $("#login-modal").click(function (e) {
            e.stopPropagation();

            // Hide any other open modal
            $(".ps-cart--mini").removeClass("active");

            // Toggle the login modal
            $(".ps-login--modal").toggleClass("active");
        });

        // Close any open modal when clicking outside of it
        $(document).click(function (e) {
            if (
                !$(e.target).closest(
                    "#cart-mini, .ps-cart--mini, #login-modal, .ps-login--modal"
                ).length
            ) {
                $(".ps-cart--mini, .ps-login--modal").removeClass("active");
            }
        });
    }

    function getTimeRemaining(endtime) {
        var t = Date.parse(endtime) - Date.parse(new Date());
        var seconds = Math.floor((t / 1000) % 60);
        var minutes = Math.floor((t / 1000 / 60) % 60);
        var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
        var days = Math.floor(t / (1000 * 60 * 60 * 24));

        return {
            total: t,
            days: days,
            hours: hours,
            minutes: minutes,
            seconds: seconds,
        };
    }

    function initializeClock(endtime) {
        var daysSpan = $(".ps-countdown__days");
        var hoursSpan = $(".ps-countdown__hours");
        var minutesSpan = $(".ps-countdown__minutes");
        var secondsSpan = $(".ps-countdown__seconds");

        if (hoursSpan && minutesSpan && secondsSpan) {
            updateClock();
            var timeinterval = setInterval(updateClock, 1000);
        }

        function updateClock() {
            var t = getTimeRemaining(endtime);

            var hoursText = ("0" + t.hours).slice(-2);
            var minutesText = ("0" + t.minutes).slice(-2);
            var secondsText = ("0" + t.seconds).slice(-2);
            var daysText = ("00" + t.days).slice(-3);

            daysSpan.each(function (index) {
                if (daysText >= 100) {
                    $(this).find(".first-1st").text(daysText.slice(0, 1));
                    $(this).find(".first-1st").css("display", "inline-block");
                }
                $(this).find(".first").text(daysText.slice(1, 2));
                $(this).find(".last").text(daysText.slice(-1));
            });

            hoursSpan.each(function (index) {
                $(this).find(".first").text(hoursText.slice(0, 1));
                $(this).find(".last").text(hoursText.slice(-1));
            });

            minutesSpan.each(function (index) {
                $(this).find(".first").text(minutesText.slice(0, 1));
                $(this).find(".last").text(minutesText.slice(-1));
            });

            secondsSpan.each(function (index) {
                $(this).find(".first").text(secondsText.slice(0, 1));
                $(this).find(".last").text(secondsText.slice(-1));
            });

            if (t.total <= 0) {
                clearInterval(timeinterval);
            }
        }
    }

    function countDown() {
        var deadline = new Date(Date.parse(new Date()) + 300 * 60 * 60 * 1000);
        initializeClock(deadline);
    }

    function stickyMenu() {
        // $(window).scroll(function () {
        //     var scroll = $(window).scrollTop();
        //     var innerWidth = $(window).innerWidth();

        //     if (scroll > 100 && innerWidth > 760) {
        //         $(".ps-header").addClass("ps-header--sticky");
        //         setTimeout(function () {
        //             $(".ps-header").addClass("active"); // For smooth transition
        //         }, 10);
        //     } else if (scroll > 600 && innerWidth < 660) {
        //         $(".ps-header").addClass("ps-header--sticky");
        //         setTimeout(function () {
        //             $(".ps-header").addClass("active");
        //         }, 10);
        //         $(".ps-search--result").removeClass("active");
        //     } else {
        //         $(".ps-header").removeClass("active");
        //         setTimeout(function () {
        //             $(".ps-header").removeClass("ps-header--sticky");
        //         }, 500);
        //     }

        //     // Scroll top button functionality
        //     if (scroll > 100) {
        //         $(".scroll-top").fadeIn(1000); // Show button with fade-in effect
        //     } else {
        //         $(".scroll-top").fadeOut(1000); // Hide button with fade-out effect
        //     }
        // });

        $(".ps-menu--sticky").on("click", function (event) {
            event.preventDefault();
            $(".ps-navigation").slideToggle();
        });

        // Scroll to top functionality
        $(".scroll-top").on("click", function (e) {
            e.preventDefault();
            $("html,body").animate({ scrollTop: 0 }, 500); // Smooth scroll to the top
        });

        $('a[href="#home-block"]').on("click", function (event) {
            smoothScrollingTo(this.hash);
        });
    }

    function smoothScrollingTo(target) {
        if (target) {
            $("html, body").animate(
                {
                    scrollTop: $(target).offset().top,
                },
                500
            );
        }
    }

    function subMenuToggle() {
        $(".menu--mobile .sub-toggle").on("click", function (e) {
            e.preventDefault();
            var current = $(this).parent("li");

            current.children(".sub-menu").slideToggle(350);
            current.siblings().find(".sub-menu").slideUp(350);
            current.toggleClass("active");
        });

        $(".ps-language-currency .sub-toggle").on("click", function (e) {
            e.preventDefault();
            var current = $(this).parent("li");

            current.children(".sub-menu").slideToggle(350);
            current.toggleClass("active");
        });

        $("#open-menu").on("click", function (e) {
            e.preventDefault();
            $(".ps-menu--slidebar").addClass("active");
            $(this).parent().addClass("active");
        });

        $("#close-menu").on("click", function (e) {
            e.preventDefault();
            $(".ps-menu--slidebar").removeClass("active");
            $(this).parent().removeClass("active");
        });

        // $('.ps-menu__sticky #menu-slide').on('click', function (e) {
        //     e.preventDefault();
        //     $('.ps-menu--slidebar').addClass('active');
        //     $('#open-menu').parent().addClass('active');
        // });

        $(".menu-slide").on("click", function (e) {
            e.preventDefault();
            $(".ps-menu--slidebar").addClass("active");
            $("#open-menu").parent().addClass("active");
        });

        $("#open-menu-top").on("click", function (e) {
            e.preventDefault();
            $(".ps-menu--slidebar").addClass("active");
            $(this).parent().addClass("active");
            $(".ps-header--mobile").addClass("slidebar-active");
        });

        $("#close-menu-top").on("click", function (e) {
            e.preventDefault();
            $(".ps-menu--slidebar").removeClass("active");
            $(this).parent().removeClass("active");
            $(".ps-header--mobile").removeClass("slidebar-active");
        });
    }

    function slickCarousel() {
        if ($(".ps-product--gallery .ps-product__thumbnail").length) {
            $(".ps-product--gallery .ps-product__thumbnail")
                .on("init", function (slick) {
                    $(".ps-product--gallery .ps-product__thumbnail").fadeIn(
                        1000
                    );
                })
                .slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: false,
                    lazyLoad: "ondemand",
                    asNavFor: ".ps-gallery--image",
                });

            $(".ps-gallery--image")
                .on("init", function (slick) {
                    $(".ps-gallery--image").fadeIn(1000);
                })
                .slick({
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    lazyLoad: "ondemand",
                    asNavFor: ".ps-product--gallery .ps-product__thumbnail",
                    dots: false,
                    arrows: false,
                    focusOnSelect: true,
                });

            //remove active class from all thumbnail slides
            $(".ps-gallery--image .slick-slide").removeClass("slick-active");
            //         //remove active class from all thumbnail slides
            //         $('.ps-gallery--image .slick-slide').removeClass('slick-active');

            //set active class to first thumbnail slides
            $(".ps-gallery--image .slick-slide").eq(0).addClass("slick-active");
            //         //set active class to first thumbnail slides
            //         $('.ps-gallery--image .slick-slide').eq(0).addClass('slick-active');

            // On before slide change match active thumbnail to current slide
            $(".ps-product--gallery .ps-product__thumbnail").on(
                "beforeChange",
                function (event, slick, currentSlide, nextSlide) {
                    var mySlideNumber = nextSlide;
                    $(".ps-gallery--image .slick-slide").removeClass(
                        "slick-active"
                    );
                    $(".ps-gallery--image .slick-slide")
                        .eq(mySlideNumber)
                        .addClass("slick-active");
                }
            );
        }

        $(".modal").on("shown.bs.modal", function (e) {
            $(".ps-product--gallery .ps-product__thumbnail").slick(
                "setPosition"
            );
            $(".ps-gallery--image").slick("setPosition");
            $(".wrap-modal-slider").addClass("open");
        });
    }

    // function slickCarousel() {
    //     if ($('.ps-product--gallery .ps-product__thumbnail').length) {
    //         $('.ps-product--gallery .ps-product__thumbnail')
    //         .on('init', function (slick) {
    //             $('.ps-product--gallery .ps-product__thumbnail').fadeIn(1000);
    //         })
    //         .slick({
    //             slidesToShow: 1,
    //             slidesToScroll: 1,
    //             arrows: false,
    //             dots: false,
    //             lazyLoad: 'ondemand',
    //             asNavFor: '.ps-gallery--image'
    //         });

    //         $('.ps-gallery--image')
    //         .on('init', function (slick) {
    //             $('.ps-gallery--image').fadeIn(1000);
    //         })
    //         .slick({
    //             slidesToShow: 5,
    //             slidesToScroll: 1,
    //             lazyLoad: 'ondemand',
    //             asNavFor: '.ps-product--gallery .ps-product__thumbnail',
    //             dots: false,
    //             arrows: false,
    //             focusOnSelect: true
    //         });

    //         //remove active class from all thumbnail slides
    //         $('.ps-gallery--image .slick-slide').removeClass('slick-active');

    //         //set active class to first thumbnail slides
    //         $('.ps-gallery--image .slick-slide').eq(0).addClass('slick-active');

    //         // On before slide change match active thumbnail to current slide
    //         $('.ps-product--gallery .ps-product__thumbnail').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
    //             var mySlideNumber = nextSlide;
    //             $('.ps-gallery--image .slick-slide').removeClass('slick-active');
    //             $('.ps-gallery--image .slick-slide').eq(mySlideNumber).addClass('slick-active');
    //         });
    //     }

    //     $('.modal').on('shown.bs.modal', function (e) {
    //         $('.ps-product--gallery .ps-product__thumbnail').slick('setPosition');
    //         $('.ps-gallery--image').slick('setPosition');
    //         $('.wrap-modal-slider').addClass('open');
    //     })
    // }

    // function slickCarousel() {
    //     if ($(".ps-product--gallery .ps-product__thumbnail").length) {
    //         setTimeout(function () {
    //             $(".ps-product--gallery .ps-product__thumbnail")
    //                 .on("init", function (event, slick) {
    //                     $(".ps-product--gallery .ps-product__thumbnail").fadeIn(
    //                         1000
    //                     );
    //                 })
    //                 .slick({
    //                     slidesToShow: 1,
    //                     slidesToScroll: 1,
    //                     arrows: false,
    //                     dots: false,
    //                     lazyLoad: "ondemand",
    //                     asNavFor: ".ps-gallery--image",
    //                 });

    //             $(".ps-gallery--image")
    //                 .on("init", function (event, slick) {
    //                     $(".ps-gallery--image").fadeIn(1000);
    //                 })
    //                 .slick({
    //                     slidesToShow: 5,
    //                     slidesToScroll: 1,
    //                     lazyLoad: "ondemand",
    //                     asNavFor: ".ps-product--gallery .ps-product__thumbnail",
    //                     dots: false,
    //                     arrows: false,
    //                     focusOnSelect: true,
    //                 });

    //             // Ensure the first slide is active on initialization
    //             $(".ps-gallery--image .slick-slide")
    //                 .eq(0)
    //                 .addClass("slick-active");

    //             // On slide change, match active thumbnail with the current slide
    //             $(".ps-product--gallery .ps-product__thumbnail").on(
    //                 "beforeChange",
    //                 function (event, slick, currentSlide, nextSlide) {
    //                     $(".ps-gallery--image .slick-slide").removeClass(
    //                         "slick-active"
    //                     );
    //                     $(".ps-gallery--image .slick-slide")
    //                         .eq(nextSlide)
    //                         .addClass("slick-active");
    //                 }
    //             );
    //         }, 100); // Add a slight delay before initializing
    //     }

    //     // Recalculate slider dimensions when the modal is shown
    //     $(".modal").on("shown.bs.modal", function (e) {
    //         $(".ps-product--gallery .ps-product__thumbnail").slick(
    //             "setPosition"
    //         );
    //         $(".ps-gallery--image").slick("setPosition");
    //         $(".wrap-modal-slider").addClass("open");
    //     });
    // }

    // // Call the function after document is fully loaded
    // $(window).on("load", function () {
    //     slickCarousel();
    //     $(window).on("resize", function () {
    //         $(".ps-product--gallery .ps-product__thumbnail").slick(
    //             "setPosition"
    //         );
    //         $(".ps-gallery--image").slick("setPosition");
    //     });
    //     $(window).trigger("resize"); // Trigger resize on load
    // });

    // function slidePriceWidget() {
    //     var rangeSlider = document.getElementById('slide-price');
    //     if (rangeSlider) {
    //         var input0 = document.getElementById('slide-price-min');
    //         var input1 = document.getElementById('slide-price-max');
    //         var inputs = [input0, input1];
    //         noUiSlider.create(rangeSlider, {
    //             start: [0, 820],
    //             connect: true,
    //             step: 1,
    //             range: {
    //                 min: [1],
    //                 max: [1000]
    //             }
    //         });

    //         rangeSlider.noUiSlider.on("update", function(values, handle) {
    //             inputs[handle].textContent  = '$' + values[handle];
    //         });
    //     }
    // }

    function lightgalleryVideos() {
        $("#ps-video-gallery").lightGallery();
    }

    function backgroundImage() {
        var databackground = $("[data-background]");
        databackground.each(function () {
            if ($(this).attr("data-background")) {
                var image_path = $(this).attr("data-background");
                $(this).css({
                    backgroundImage: "url(" + image_path + ")",
                });
            }
        });
    }

    $(function () {
        common();
        openModal();
        countDown();
        stickyMenu();
        owlCarouselConfig();
        subMenuToggle();
        slickCarousel();
        // slidePriceWidget();
        lightgalleryVideos();
        smoothScrollingTo(location.hash);
        backgroundImage();
    });

    $(window).on("load", function () {});
})(jQuery);
