(function ($) {

    "use strict";

    // progress bar script starts
    function animatedProgressbar(id, type, value, strokeColor, trailColor, strokeWidth, strokeTrailWidth) {
        var triggerClass = '.stonex-progress-bar-' + id;
        if ('function' === typeof ldBar) {
            if ('line' === type) {
                new ldBar(triggerClass, {
                    'type': 'stroke',
                    'path': 'M0 10L100 10',
                    'aspect-ratio': 'none',
                    'stroke': strokeColor,
                    'stroke-trail': trailColor,
                    'stroke-width': strokeWidth,
                    'stroke-trail-width': strokeTrailWidth
                }).set(value);
            }
            if ('line-bubble' === type) {
                new ldBar(triggerClass, {
                    'type': 'stroke',
                    'path': 'M0 10L100 10',
                    'aspect-ratio': 'none',
                    'stroke': strokeColor,
                    'stroke-trail': trailColor,
                    'stroke-width': strokeWidth,
                    'stroke-trail-width': strokeTrailWidth
                }).set(value);
                $($('.stonex-progress-bar-' + id).find('.ldBar-label')).animate({
                    left: value + '%'
                }, 1000, 'swing');
            }
            if ('circle' === type) {
                new ldBar(triggerClass, {
                    'type': 'stroke',
                    'path': 'M50 10A40 40 0 0 1 50 90A40 40 0 0 1 50 10',
                    'stroke-dir': 'normal',
                    'stroke': strokeColor,
                    'stroke-trail': trailColor,
                    'stroke-width': strokeWidth,
                    'stroke-trail-width': strokeTrailWidth
                }).set(value);
            }
            if ('fan' === type) {
                new ldBar(triggerClass, {
                    'type': 'stroke',
                    'path': 'M10 90A40 40 0 0 1 90 90',
                    'stroke': strokeColor,
                    'stroke-trail': trailColor,
                    'stroke-width': strokeWidth,
                    'stroke-trail-width': strokeTrailWidth
                }).set(value);
            }
        }
    }

    var STONEXProgressBar = function ($scope, $) {
        var progressBarWrapper = $scope.find('[data-progress-bar]').eq(0);
        if ($.isFunction($.fn.waypoint)) {
            progressBarWrapper.waypoint(function () {
                var element = $(this.element),
                    id = element.data('id'),
                    type = element.data('type'),
                    value = element.data('progress-bar-value'),
                    strokeWidth = element.data('progress-bar-stroke-width'),
                    strokeTrailWidth = element.data('progress-bar-stroke-trail-width'),
                    color = element.data('stroke-color'),
                    trailColor = element.data('stroke-trail-color');
                animatedProgressbar(id, type, value, color, trailColor, strokeWidth, strokeTrailWidth);
                this.destroy();
            }, {
                offset: 'bottom-in-view'
            });
        }
    }
    // progress bar script ends


    // animated text script starts
    var STONEXAnimatedText = function ($scope, $) {

        var animatedWrapper = $scope.find('.stonex-typed-strings').eq(0),
            animateSelector = animatedWrapper.find('.stonex-animated-text-animated-heading'),
            animationType = animatedWrapper.data('heading_animation'),
            animationStyle = animatedWrapper.data('animation_style'),
            animationSpeed = animatedWrapper.data('animation_speed'),
            typeSpeed = animatedWrapper.data('type_speed'),
            startDelay = animatedWrapper.data('start_delay'),
            backTypeSpeed = animatedWrapper.data('back_type_speed'),
            backDelay = animatedWrapper.data('back_delay'),
            loop = animatedWrapper.data('loop') ? true : false,
            showCursor = animatedWrapper.data('show_cursor') ? true : false,
            fadeOut = animatedWrapper.data('fade_out') ? true : false,
            smartBackspace = animatedWrapper.data('smart_backspace') ? true : false,
            id = animateSelector.attr('id');

        if ('function' === typeof Typed) {
            if ('stonex-typed-animation' === animationType) {
                var typed = new Typed('#' + id, {
                    strings: animatedWrapper.data('type_string'),
                    loop: loop,
                    typeSpeed: typeSpeed,
                    backSpeed: backTypeSpeed,
                    showCursor: showCursor,
                    fadeOut: fadeOut,
                    smartBackspace: smartBackspace,
                    startDelay: startDelay,
                    backDelay: backDelay
                });
            }
        }


        if ($.isFunction($.fn.Morphext)) {
            if ('stonex-morphed-animation' === animationType) {
                $(animateSelector).Morphext({
                    animation: animationStyle,
                    speed: animationSpeed
                });
            }
        }
    }
    // animated text script ends

    //Nav menu
    // Main Menu
    var navMenu = function ($scope, $) {
        $scope
          .find(".stonex-mega-menu")
          .closest(".elementor-container")
          .addClass("megamenu-full-container");
        var count = 0;
        $scope
          .find(".main-navigation ul.navbar-nav>li.stonex-mega-menu>.sub-menu>li")
          .each(function (index) {
            count++;
            if ($(this).is("li:last-child")) {
              $(this)
                .parent()
                .addClass("mg-column-" + count);
              count = 0;
            }
          });
        $scope.find(".main-navigation ul.navbar-nav>li").each(function (i, v) {
          $scope
            .find(v)
            .find("a")
            .contents()
            .wrap('<span class="menu-item-text"/>');
        });
        $scope
          .find(".menu-item-has-children > a")
          .append(
            '<span class="dropdownToggle"><i aria-hidden="true" class="cj cj-minimal-down"></i></span>'
          );
    
        function navMenu() {
          $scope
            .find(".navbar.mobile-menu-style-1")
            .closest("body")
            .addClass("mobile-menu-style-1");
          $scope
            .find(".navbar.mobile-menu-style-2")
            .closest("body")
            .addClass("mobile-menu-style-2");
          $scope
            .find(".navbar.mobile-menu-style-3")
            .closest("body")
            .addClass("mobile-menu-style-3");
    
          if ($scope.find(".stonex-main-menu-wrap").hasClass("menu-style-inline")) {
            if ($(window).width() < 1025) {
              $scope.find(".stonex-main-menu-wrap").addClass("menu-style-flyout");
              $scope.find(".stonex-main-menu-wrap").removeClass("menu-style-inline");
            } else {
              $scope.find(".stonex-main-menu-wrap").removeClass("menu-style-flyout");
              $scope.find(".stonex-main-menu-wrap").addClass("menu-style-inline");
            }
            $(window).resize(function () {
              if ($(window).width() < 1025) {
                $scope.find(".stonex-main-menu-wrap").addClass("menu-style-flyout");
                $scope
                  .find(".stonex-main-menu-wrap")
                  .removeClass("menu-style-inline");
              } else {
                $scope
                  .find(".stonex-main-menu-wrap")
                  .removeClass("menu-style-flyout");
                $scope.find(".stonex-main-menu-wrap").addClass("menu-style-inline");
              }
            });
          }
          // main menu toggleer icon (Mobile site only)
          $scope.find('[data-toggle="navbarToggler"]').on("click", function (e) {
            $scope.find(".navbar").toggleClass("active");
            $scope.find(".navbar-toggler-icon").toggleClass("active");
            $("body").toggleClass("offcanvas--open");
    
            e.stopPropagation();
            e.preventDefault();
          });
          $scope.find(".navbar-inner").on("click", function (e) {
            e.stopPropagation();
          });
          // Remove class when click on body
          $("body").on("click", function () {
            $scope.find(".navbar").removeClass("active");
            $scope.find(".navbar-toggler-icon").removeClass("active");
            $("body").removeClass("offcanvas--open");
          });
          $scope
            .find(".main-navigation ul.navbar-nav li.menu-item-has-children>a")
            .on("click", function (e) {
              e.preventDefault();
              $(this).siblings(".sub-menu").toggle();
              $scope
                .find("ul.navbar-nav> li.menu-item-has-children> .sub-menu")
                .not($(this).siblings())
                .not($(this).parents(".sub-menu"))
                .hide();
              $(this).parent("li").toggleClass("dropdown-active");
            });
          $scope.find(".stonex-mega-menu> ul.sub-menu > li > a").unbind("click");
        }
        navMenu();
      };


    var stonex_modal_popup = function ($scope, $) {

        $('.popup-menubar').on('click', function () {
            $('.stonex-popup-content').addClass('show')
        })

        $('#offset-menu-close-btn').on('click', function () {
            $('.stonex-popup-content').removeClass('show')
        });
    }

    /*---------------------------------------------------
                    video popup BUTTON
    ----------------------------------------------------*/
    var Fbth_Modal_Popup = function($scope, $) {

        var modalWrapper = $scope.find('.stonex-modal').eq(0),
            modalOverlayWrapper = $scope.find('.stonex-modal-overlay'),
            modalItem = $scope.find('.stonex-modal-item'),
            modalAction = modalWrapper.find('.stonex-modal-image-action'),
            closeButton = modalWrapper.find('.stonex-close-btn');

        modalAction.on('click', function(e) {
            e.preventDefault();
            var modalOverlay = $(this).parents().eq(1).next();
            var modal = $(this).data('stonex-modal');

            var overlay = $(this).data('stonex-overlay');
            modalItem.css('display', 'block');
            setTimeout(function() {
                $(modal).addClass('active');
            }, 100);
            if ('yes' === overlay) {
                modalOverlay.addClass('active');
            }

        });

        closeButton.click(function() {
            var modalOverlay = $(this).parents().eq(3).next();
            var modalItem = $(this).parents().eq(2);
            modalOverlay.removeClass('active');
            modalItem.removeClass('active');

            var modal_iframe = modalWrapper.find('iframe'),
                $modal_video_tag = modalWrapper.find('video');

            if (modal_iframe.length) {
                var modal_src = modal_iframe.attr('src').replace('&autoplay=1', '');
                modal_iframe.attr('src', '');
                modal_iframe.attr('src', modal_src);
            }
            if ($modal_video_tag.length) {
                $modal_video_tag[0].pause();
                $modal_video_tag[0].currentTime = 0;
            }

        });

        modalOverlayWrapper.click(function() {
            var overlay_click_close = $(this).data('stonex_overlay_click_close');
            if ('yes' === overlay_click_close) {
                $(this).removeClass('active');
                $('.stonex-modal-item').removeClass('active');

                var modal_iframe = modalWrapper.find('iframe'),
                    $modal_video_tag = modalWrapper.find('video');

                if (modal_iframe.length) {
                    var modal_src = modal_iframe.attr('src').replace('&autoplay=1', '');
                    modal_iframe.attr('src', '');
                    modal_iframe.attr('src', modal_src);
                }
                if ($modal_video_tag.length) {
                    $modal_video_tag[0].pause();
                    $modal_video_tag[0].currentTime = 0;
                }
            }
        });
    }


    //Creative Button
    var STONEX_Creative_Button = function ($scope) {

        var btn_wrap = $scope.find('.stonex-creative-btn-wrap');
        var magnetic = btn_wrap.data('magnetic');
        var btn = btn_wrap.find('a.stonex-creative-btn');
        if ('yes' == magnetic) {
            btn_wrap.on('mousemove', function (e) {
                var x = e.pageX - (btn_wrap.offset().left + (btn_wrap.outerWidth() / 2));
                var y = e.pageY - (btn_wrap.offset().top + (btn_wrap.outerHeight() / 2));
                btn.css("transform", "translate(" + x * 0.3 + "px, " + y * 0.5 + "px)");
            });
            btn_wrap.on('mouseout', function (e) {
                btn.css("transform", "translate(0px, 0px)");
            });
        }
        //For expandable button style only
        var expandable = $scope.find('.stonex-eft--expandable');
        var text = expandable.find('.text');
        if (expandable.length > 0 && text.length > 0) {
            text[0].addEventListener("transitionend", function () {
                if (text[0].style.width) {
                    text[0].style.width = "auto";
                }
            });
            expandable[0].addEventListener("mouseenter", function (e) {
                e.currentTarget.classList.add('hover');
                text[0].style.width = "auto";
                var predicted_answer = text[0].offsetWidth;
                text[0].style.width = "0";
                window.getComputedStyle(text[0]).transform;
                text[0].style.width = "".concat(predicted_answer, "px");

            });
            expandable[0].addEventListener("mouseleave", function (e) {
                e.currentTarget.classList.remove('hover');
                text[0].style.width = "".concat(text[0].offsetWidth, "px");
                window.getComputedStyle(text[0]).transform;
                text[0].style.width = "";
            });
        }
    };

    // accordion script starts
    var stonexAccordion = function ($scope, $) {
        var accordionTitle = $scope.find('.stonex-accordion-title');

        var accmin = $scope.find('.stonex-accordion-single-item');

        accmin.each(function () {
            if ($(this).hasClass('yes')) {
                $(this).addClass('wraper-active');
            }
        });

        accordionTitle.each(function () {
            if ($(this).hasClass('active-default')) {
                $(this).addClass('active');
                $(this).next('.stonex-accordion-content').slideDown(300);
            }
        });

        // Remove multiple click event for nested accordion
        accordionTitle.unbind('click');

        //$accordionWrapper.children('.stonex-accordion-content').first().show();
        accordionTitle.click(function (e) {
            e.preventDefault();

            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
                $(this).next().slideUp(400);
                $(this).parent().removeClass('wraper-active');

            } else {
                $(this).parent().parent().find('.stonex-accordion-title').removeClass('active');

                accmin.removeClass('wraper-active');

                $(this).parent('.yes').removeClass('wraper-active');

                $(this).parent().parent().find('.stonex-accordion-content').slideUp(300);

                $(this).parent().addClass('wraper-active');

                $(this).toggleClass('active');
                $(this).next().slideToggle(400);

            }
        });
    }
    // accordion script ends

    // animated text script starts
    var stonex_AnimatedText = function ($scope, $) {
        var animatedWrapper = $scope.find('.stonex-typed-strings').eq(0),
            animateSelector = animatedWrapper.find('.stonex-animated-text-animated-heading'),
            animationType = animatedWrapper.data('heading_animation'),
            animationStyle = animatedWrapper.data('animation_style'),
            animationSpeed = animatedWrapper.data('animation_speed'),
            typeSpeed = animatedWrapper.data('type_speed'),
            startDelay = animatedWrapper.data('start_delay'),
            backTypeSpeed = animatedWrapper.data('back_type_speed'),
            backDelay = animatedWrapper.data('back_delay'),
            loop = animatedWrapper.data('loop') ? true : false,
            showCursor = animatedWrapper.data('show_cursor') ? true : false,
            fadeOut = animatedWrapper.data('fade_out') ? true : false,
            smartBackspace = animatedWrapper.data('smart_backspace') ? true : false,
            id = animateSelector.attr('id');
        if ('function' === typeof Typed) {
            if ('stonex-typed-animation' === animationType) {
                var typed = new Typed('#' + id, {
                    strings: animatedWrapper.data('type_string'),
                    loop: loop,
                    typeSpeed: typeSpeed,
                    backSpeed: backTypeSpeed,
                    showCursor: showCursor,
                    fadeOut: fadeOut,
                    smartBackspace: smartBackspace,
                    startDelay: startDelay,
                    backDelay: backDelay
                });
            }
        }
        if ($.isFunction($.fn.Morphext)) {
            if ('stonex-morphed-animation' === animationType) {
                $(animateSelector).Morphext({
                    animation: animationStyle,
                    speed: animationSpeed
                });
            }
        }
    }
    /* Search widget js */
    var STONEX_Search_bos = function () {
        $('#search_icon').click(function () {
            $('.stonex-search-button-wrapper').show("slow");
            $('.stonex-search-overly').addClass('search-body-bg');
            $('.search-main-wrapper').addClass('cross-menu');
        });

        $('#cross_icon').click(function () {
            $('.stonex-search-button-wrapper').hide("slow");
            $('.stonex-search-overly').removeClass('search-body-bg');
            $('.search-main-wrapper').removeClass('cross-menu');
        });
    }

    var STONEX_Advance_Slide_Js = function ($scope, $) {
        var wrapper = $scope.find(".stonex--slide-content-wrap");
        if (wrapper.length === 0)
            return;
        var settings = wrapper.data('settings');
        wrapper.slick({
            infinite: true,
            speed: 900,
            slidesToShow: settings['per_coulmn'],
            slidesToScroll: 1,
            autoplay: settings['autoplay'],
            autoplaySpeed: settings['autoplaytimeout'],
            arrows: settings['nav'],
            draggable: settings['mousedrag'],
            dots: settings['dots'],
            lazyLoad: 'ondemand',
            dotsClass: "stonex-testimonial-slider-dot-list",
            swipe: true,
            vertical: settings['show_vertical'],
            appendArrows: '.team-slider-arrow',
            prevArrow: $('.prev'),
            nextArrow: $('.next'),
            responsive: [{
                breakpoint: 1600,
                settings: {
                    slidesToShow: settings['per_coulmn'],
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: settings['per_coulmn_tablet'],
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: settings['per_coulmn_mobile'],
                    slidesToScroll: 1,
                    vertical: false,
                },
            },
            ],
        });
    }

    var stonex_Testimonial_Js = function ($insurancepe, $) {
		var wrapper = $insurancepe.find(".stonex-testimonial-slider");
		if (wrapper.length === 0)
			return;
		var settings = wrapper.data('settings');
		wrapper.slick({
			infinite: true,
			speed: 900,
			slidesToShow: settings['per_coulmn'],
			slidesToScroll: 1,
			autoplay: settings['autoplay'],
			autoplaySpeed: settings['autoplaytimeout'],
			arrows: settings['nav'],
			draggable: settings['mousedrag'],
			dots: settings['dots'],
			lazyLoad: 'ondemand',
			dotsClass: "stonex-testimonial-slider-dot-list",
			swipe: true,
			vertical: settings['show_vertical'],
			appendArrows: '.team-slider-arrow',
			prevArrow: $('.prev'),
			nextArrow: $('.next'),
			responsive: [{
				breakpoint: 1600,
				settings: {
					slidesToShow: settings['per_coulmn'],
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: 1025,
				settings: {
					slidesToShow: settings['per_coulmn_tablet'],
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: 767,
				settings: {
					slidesToShow: settings['per_coulmn_mobile'],
					slidesToScroll: 1,
					vertical: false,
				},
			},
			],
		});
	}

    var STONEX_Brand_Slider_Js = function ($scope, $) {
		var wrapper = $scope.find(".stonex-brand-carousel-wrap");
		if (wrapper.length === 0)
			return;
		var settings = wrapper.data('settings');
		wrapper.slick({
			infinite: true,
			speed: 900,
			slidesToShow: settings['per_coulmn'],
			slidesToScroll: 1,
			autoplay: settings['autoplay'],
			autoplaySpeed: settings['autoplaytimeout'],
			arrows: settings['nav'],
			draggable: settings['mousedrag'],
			dots: settings['dots'],
			lazyLoad: 'ondemand',
            centerMode: settings['center'],
			dotsClass: "brand-slick-slide-dot-list",
			swipe: true,
			vertical: settings['show_vertical'],
			appendArrows: '.brand-slider-arrow',
			prevArrow: $('.prev'),
			nextArrow: $('.next'),
			responsive: [{
				breakpoint: 1600,
				settings: {
					slidesToShow: settings['per_coulmn'],
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: 1025,
				settings: {
					slidesToShow: settings['per_coulmn_tablet'],
					slidesToScroll: 1,
				},
			},
			{
				breakpoint: 767,
				settings: {
					slidesToShow: settings['per_coulmn_mobile'],
					slidesToScroll: 1,
					vertical: false,
				},
			},
			],
		});
	}

       // price table
    var STONEX_Pricing_Table = function($scope, $) {
        var monthly = $(".stonex-btn-wrapper a").data("monthly");
        var yearly = $(".stonex-btn-wrapper a").data("yearly");
        console.log(yearly);
        $scope.find("[data-pricing-trigger]").on("click", function (e) {
            $scope.find(e.target).toggleClass("active");
            var target = $scope.find(e.target).attr("data-target");
            if ($scope.find(target).attr("data-value-active") == "monthly") {
                $scope.find(target).attr("data-value-active", "yearly");
                $scope.find(".stonex-btn-wrapper a").attr("href",yearly);
            } else {
                $scope.find(target).attr("data-value-active", "monthly");
                $scope.find(".stonex-btn-wrapper a").attr("href",monthly);
            }
        })
        // Classic tab switcher
        $scope.find("[data-pricing-tab-trigger]").on("click", function (e) {
            $scope.find('[data-pricing-tab-trigger]').removeClass("active");
            $scope.find(this).addClass("active");
            var target = $scope.find(e.target).attr("data-target");
            if ($scope.find(target).attr("data-value-active") == "monthly") {
                $scope.find(target).attr("data-value-active", "yearly");
                $scope.find(".stonex-btn-wrapper a").attr("href",yearly);
            } else {
                $scope.find(target).attr("data-value-active", "monthly");
                $scope.find(".stonex-btn-wrapper a").attr("href",monthly);
            }
        })
    }

    // Testimonial
    var STONEX_Testimonial = function($scope,$) {

        if ($.fn.isotope) {
            var gridMas = $('.tm-masonary');

            gridMas.isotope({
                itemSelector: '.scalo-addons-post-widget-wrap',
                percentPosition: true,
                layoutMode: 'packery',
            }).resize();

            gridMas.imagesLoaded().progress(function() {
                gridMas.isotope()
            });
        }
    }

	/*
	*
	This code use Tab Widget
	*
	*/
	var stonexTab = function ($insurancepe, $) {
		$insurancepe.find('ul.tabs li').on('click', function () {
			var tab_id = $(this).attr('data-tab');
			$insurancepe.find('ul.tabs li').removeClass('current');
			$insurancepe.find('.stonex-tab-content-single').removeClass('current');
			$(this).addClass('current');
			$("#" + tab_id).addClass('current');
		})
	};
	var stonex_Adv_Tab = function ($insurancepe, $) {
		$insurancepe.find('ul.tabs li').on('click', function () {
			var tab_id = $(this).attr('data-tab');
			$insurancepe.find('ul.tabs li').removeClass('current');
			$insurancepe.find('.stonex-tab-content-single').removeClass('current');
			$(this).addClass('current');
			$insurancepe.find("#" + tab_id).addClass('current');
		})
		if ($.fn.magnificPopup) {
			$('.stonex-elm-edit').magnificPopup({
				type: 'iframe',
				mainClass: 'mfp-fade stonex-elm-edit-popup',
				callbacks: {
					open: function () {
						// Will fire when this exact popup is opened
						// this - is Magnific Popup object
					},
					close: function () {
						location.reload();
					}
					// e.t.c.
				}
			});
			console.log('helw')
		}
	};



    // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction('frontend/element_ready/stonex-progress-bar.default', STONEXProgressBar);
        elementorFrontend.hooks.addAction("frontend/element_ready/stonex-main-menu.default", navMenu);
        elementorFrontend.hooks.addAction('frontend/element_ready/stonex-animated.default', STONEXAnimatedText);
        elementorFrontend.hooks.addAction('frontend/element_ready/stonex-advance-slide.default', STONEX_Advance_Slide_Js);
        elementorFrontend.hooks.addAction('frontend/element_ready/stonex-popup.default', stonex_modal_popup);
        elementorFrontend.hooks.addAction('frontend/element_ready/stonex-modal-popup.default', Fbth_Modal_Popup);
        elementorFrontend.hooks.addAction('frontend/element_ready/stonex-creative-button.default', STONEX_Creative_Button);
        elementorFrontend.hooks.addAction('frontend/element_ready/stonex-accordion.default', stonexAccordion);
        elementorFrontend.hooks.addAction('frontend/element_ready/stonex-animated.default', stonex_AnimatedText);
        elementorFrontend.hooks.addAction('frontend/element_ready/stonex-search-form.default', STONEX_Search_bos);
        elementorFrontend.hooks.addAction('frontend/element_ready/stonex-testimonial-loop.default', stonex_Testimonial_Js);
        elementorFrontend.hooks.addAction('frontend/element_ready/stonex-brand-carousel.default', STONEX_Brand_Slider_Js);
        elementorFrontend.hooks.addAction('frontend/element_ready/stonex-price-table.default', STONEX_Pricing_Table);
        elementorFrontend.hooks.addAction('frontend/element_ready/stonex-testimonial-loop.default', STONEX_Testimonial);
        elementorFrontend.hooks.addAction("frontend/element_ready/stonex-tab.default", stonexTab);
        elementorFrontend.hooks.addAction('frontend/element_ready/stonex-advance-tab.default', stonex_Adv_Tab);

    });

})(jQuery);