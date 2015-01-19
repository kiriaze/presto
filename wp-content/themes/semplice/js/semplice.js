/*
 * semplice custom js
 * semplice.theme
 */

(function ($) {
    "use strict";

    /* show thumbs */
    $.fn.showdelay = function(max){
        var delay = 0;
		var num = 0;
        return this.each(function(){
            $(this).delay(delay).transition({ opacity: '1' }, 700, 'ease');
            delay += 200;
			num++;
			if(num === max) {
				/* fade out progress bar */
				NProgress.done();
			}
        });
    };

    /* function for the menu fadein */
    function showNav(method) {
        var headerHeight = $('header').height();
        var headerBarHeight = $('#navbar').height();

        if (method === 'slide-up') {
            $("header").transition({ opacity: 1, top: -headerHeight, }, 900, 'snap'); 
        } else if (method === 'slide-down') {
            $("header").transition({ opacity: 1, top: 0, }, 900, 'snap');
        }
    }
	
	/* site transitions */
	var no_transitions = $('body').hasClass('no-transitions');
	
	/* image zoom */
	var imageZoom = $('.cover-image').data('image-zoom');
	
    $(document).ready(function () {   
        
		/* image lightbox */
		var showOverlay = function() {
			$('<div class="lightbox-overlay"></div>').appendTo('body');
		};
		
		var hideOverlay = function() {
			$('.lightbox-overlay').remove();
		}; 
		
		var $lightbox = $('a[data-rel^=lightbox]').imageLightbox(
		{
			selector:       'id="imagelightbox"',
			allowedTypes:   'png|jpg|jpeg|gif',
			animationSpeed: 250,
			preloadNext:    true,
			enableKeyboard: true,
			quitOnEnd:      false,
			quitOnImgClick: false,
			quitOnDocClick: true,
			onStart:        function() { showOverlay(); },
			onEnd:          function() { hideOverlay(); },
			onLoadStart:    false,
			onLoadEnd:      false
		});
		
		if(!no_transitions) {
		
			/* fade in Menu */
			var effect = 'slide-down';
			showNav(effect);
			
		}

		/* is mobile device or tablet? */
		function isMobile() {
			var check = false;
			(function(a){if(/(android|bb\d+|meego).+mobile|android|ipad|playbook|silk|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
			return check; 
		}

		/* header bar opacity and transparency mode */
		var headerBarOpacity = $('#navbar-bg').data('navbar-opacity');
		
		if ($(window).scrollTop() >= $('.fullscreen-cover').height() - ( $('#navbar-bg').height() + 20) ) {
			$('#navbar-bg').removeClass('transparent')
							.addClass('navbar')
							.css('opacity',headerBarOpacity);
		}
		
		var headerBarClass;
		var headerBarOpacity;
		
		/* open menu */
        $(document).on('click', 'div.controls a.menu span.open', function() {

			/* hide project panel button */
			$('.project-panel-button').hide();
			
			/* get header bar class */
			headerBarClass = $('#navbar-bg').attr('class');
			
			/* get header bar opacity */
			headerBarOpacity = $('#navbar-bg').css('opacity');
			
			/* hide follow links if empty */
			if($('.follow-links ul li').length === 0) {
				$('.follow-links').hide();
			}
			
			/* set non transparent class */
			$('#navbar-bg').attr('class', 'navbar').css('opacity', '1');
			
			/* switch menu button */
			$('.menu span.open').hide();
			$('.menu span.close').css('display','block');
			
			/* hide other menu icons */
			$('.menu-icon').stop().transition({ opacity: '0' }, 200, 'easeOutCubic');
			
			/* overlay position fixed */
			$('.overlay').css('position', 'fixed');
			
			/* add close-menu class to overlay */
			$('.overlay').css('display', 'block').transition({ opacity: '0.6' }, 300, 'ease').addClass('close-menu');
			
			/* bring header to front */
			$('header').css('z-index', 102);
			
			/* fade in fullscreen menu */
			$('#fullscreen-menu').stop().slideDown(800, 'easeOutExpo', function() {
				$('#fullscreen-menu').css('overflow-y', 'auto');
			});
		});
		
		/* close */
		$(document).on('click', '.close-menu, div.controls a.menu span.close', function() {
		
			/* hide project panel button */
			$('.project-panel-button').show();
		
			/* revert header Class */
			$('#navbar-bg').attr('class', headerBarClass).css('opacity', headerBarOpacity);
			
			/* switch menu button */
			$('.menu span.open').show();
			$('.menu span.close').hide();
			
			/* show other menu icons */
			$('.menu-icon').stop().transition({ opacity: '1' }, 200, 'easeOutCubic');
			
			/* remove close-menu class */
			$('.overlay').removeClass('close-menu');
			
			
			/* fade out overlay */
			$('.overlay').transition({ opacity: '0' }, 300, 'ease', function() {
				
				/* fade out overlay */
				$('.overlay').css({ display: 'none', position: 'absolute' });
				
				/* normal header z-index */
				$('header').css('z-index', 20);
				
			});
			
			/* fade out fullscreen menu */
			$('#fullscreen-menu').css('overflow-y', 'hidden').stop().slideUp(800, 'easeOutExpo');
			
		});
				
		/* advanced media querys */
		$('.content-container, .mc-sub-content-container, .spacer').each(function() {
			
			// reference
			var _this = $(this);
			
			var paddingTop = $(this).css('padding-top').replace('px','');
			var paddingRight = $(this).css('padding-right').replace('px','');
			var paddingBottom = $(this).css('padding-bottom').replace('px','');
			var paddingLeft = $(this).css('padding-left').replace('px','');
			
			// spacer
			var marginTop = $(this).css('margin-top').replace('px','');
			var marginBottom = $(this).css('margin-bottom').replace('px','');
			
			// divider
			var divider;
			
			function paddings(divider) {
			
				$(_this).css('padding-top', paddingTop / divider);
				$(_this).css('padding-right', paddingRight / divider);
				$(_this).css('padding-bottom', paddingBottom / divider);
				$(_this).css('padding-left', paddingLeft / divider);
				
				// spacer margins
				$(_this).css('margin-top', marginTop / divider);
				$(_this).css('margin-bottom', marginBottom / divider);
				
			}
			
			var nineSixty = {
			
				match : function() {
					divider = 1.2;
					paddings(divider);
				},      
											
				unmatch : function() {
					paddings(1);
				}
			}
			
			var tabletWide = {
			
				match : function() {
					divider = 1.4;
					paddings(divider);
				}
			}
			
			var tabletPortrait = {
			
				match : function() {
					divider = 1.6;
					paddings(divider);
				}
			}
			
			var mobile = {
				
				match : function() {
					divider = 1.8;
					paddings(divider);
				}  
			}
			
			/* register */
			enquire
			.register('(min-width: 980px) and (max-width: 1199px)', nineSixty)
			.register('(min-width: 768px) and (max-width: 979px)', tabletWide)
			.register('(max-width: 767px)', tabletPortrait)
			.register('(max-width: 567px)', mobile);
			
		});
		
        /* scale ratio */
        var scaleRatio;
        
        /* ios background cover viewport bugfix */
        if(isMobile() === true) {
            $('.cover-image, .cover-video-responsive').css('backgroundSize', 'cover');
            $('.cover-image, .cover-video-responsive').css('background-attachment', 'scroll');
            $('.controls a, .project-panel-button').addClass('ios-no-hover');
        }

		/* make blog videos responsive */
		if($('body').hasClass('is-blog')) {
			$('iframe').wrap('<div class="responsive-video"></div>');
			$('.wp-video, .wp-audio').css('width', '100%');
			$(".featured-video video, .featured audio").mediaelementplayer();
		}

		/* blog gallery */
        $('.gallery-icon a').each(function () {
		
			/* check if attachment or media file type */
			var isAttachment = $(this).attr('href').slice(-1);

			if(isAttachment !== '/') {
				$(this).attr('data-rel', 'lightbox');
			}
            
        });
		
        /* get bg img src */
        function getFullScreenImgSrc(input) {
            return input.replace(/"/g, "").replace(/url\(|\)$/ig, "");
        }
        
		/* get cover num */
		var covers_num = $('.fullscreen-cover').length;
		
        /* look if fullscreen cover exists */
        if(covers_num) {
			/* start nprogress if transitions enabled */
			if(!no_transitions) {
				NProgress.start();
			}
            /* get cover */
			if(covers_num > 1) {
				$('.fullscreen-cover').each(function(index) {
					index++;
					// call cover function
					cover($(this).data('cover-id'), index);
				});
			} else {
				cover($('.fullscreen-cover').data('cover-id'), 1);
			}
        } else {
            /* no fullscreen cover, start afterCover animations right away */
            afterCover();
        }
        
        /* after cover */
        function cover(id, index) {
			
            var cover = $('.cover-' + id);

            if($(cover).data('bg-type') === 'image') {

                $(cover).children('.cover-video').hide();
                
                /* get bg img src */
                var fullScreenImgSrc = getFullScreenImgSrc($(cover).children(".cover-image").css("background-image"));

                /* load bg and fade in */
                $.loadImages(fullScreenImgSrc, function () {
                    $(cover).transition({ opacity: 1 }, 1000, 'ease', function() {
                        afterCover(index);
                    });
					headline(id);
                });
				
            } else if($(cover).data('bg-type') === 'video') {
			
                $(cover).children('.cover-image').hide();
                $(cover).transition({ opacity: 1 }, 1000, 'ease', function() {
					
					$(cover).children('.cover-video').fadeIn(1000);
                    afterCover(index);
					
                });

                headline(id);
                
            } else {

                $(cover).transition({ opacity: 1 }, 1000, 'ease', function() {
                    afterCover(index);
                });
                headline(id);
            }
        }
        
        /* vertical align and display headline */
        function headline(id) {
            /* if is image, load it */
            if($('.cover-' + id + ' .cover-headline').data('headline-format') === 'image') {		
                imagesLoaded($('.cover-' + id + ' .cover-headline'), function() {
                    verticalMiddle($('.cover-' + id + ' .cover-headline'));
					$('.cover-' + id + ' .cover-headline').transition({ opacity: 1, delay: 300 }, 800, 'ease' );
                });
				
            } else {
                verticalMiddle($('.cover-' + id + ' .cover-headline'));
				$('.cover-' + id + ' .cover-headline').transition({ opacity: 1, delay: 300 }, 800, 'ease' );
            }
        }
        
        /* after cover content transitions */
        function afterCover(index) {
			/* is cover slider */
			if(index === covers_num && covers_num > 1) {
				/* fade out progress bar */
				NProgress.done();
			} else {
				if(!no_transitions && $('.fade-content').length > 0) {
					$('.fade-content').showdelay($('.fade-content').length);
				} else {
					NProgress.done();
				}
			}	
        }
        
		/* scroll to see more animation */
		$('.see-more').click(function() {
		
			var scrollHeaderHeight;
			/* is sticky? */
			if($('header').css('position') === 'absolute') {
				scrollHeaderHeight = 0;
			} else {
				scrollHeaderHeight = $('header').height() - 1;
			}
			
			/* is transparent? */
			if($('#navbar-bg').data('navbar-opacity') !== 1) {
				scrollHeaderHeight = 0;
			}
		
			var tabletPortrait = {
				match : function() {
					scrollHeaderHeight = 0;
				}
			}
			
			var mobile = {
				match : function() {
					scrollHeaderHeight = 0;
				}  
			}
			
			/* register */
			enquire
			.register('(max-width: 767px)', tabletPortrait)
			.register('(max-width: 567px)', mobile);
		
		
			$($.browser.webkit ? "body" : "html").animate({
                    scrollTop: $('.fullscreen-cover').height() - scrollHeaderHeight
            }, 1100, 'easeInOutExpo');
		});
		$(document).on('click', '.project-panel-button', function() {
			
			/* scroll top animation duration */
			var duration = 0;
			
			if($(window).scrollTop() === 0) {
				duration = 0;
			} else if($(window).scrollTop() > 0 && $(window).scrollTop() < 300) {
				duration = 300;
			} else {
				duration = 700;
			}

			/* fade in panel */
            $($.browser.webkit ? "body" : "html").animate({
                    scrollTop: 0
                }, duration, 'easeInOutExpo', function () {

				/* fade in overlay */
				$('.overlay').css('display', 'block').transition({ opacity: '0.6' }, 400, 'ease' ).addClass('close-panel').css('position', 'fixed');
                $('header').appendTo('#wrapper').css('position', 'absolute');
                $('.cover-image').css('background-attachment', 'scroll');
				$('#project-panel-header').slideDown( 600 , 'easeInOutExpo');
                $('body').addClass('project-panel-active');
            });
        });
        
        /* thumb nav close slide */
		$(document).on('click', '.close-project-panel, .close-panel', function() {
		
            $('.overlay').transition({ opacity: '0' }, 400, 'ease', function() {
				$('.overlay').css('display', 'none').removeClass('close-panel');
			});
            $('#project-panel-header').slideUp( 600, 'easeInOutExpo', function () {
                $('header').insertAfter('#project-panel-header');
				/* is sticky? */
				if(!$('header').hasClass('non-sticky-nav') && isMobile() !== true) {
					$('header').css('position', 'fixed');
				}
				/* make background unfixed */
				if(isMobile() !== true) {
					$('.cover-image').css('background-attachment', 'fixed');
				}
                $('.overlay').css('position', 'absolute');
                $('body').removeClass('project-panel-active');
            });
        });
        
        /* blog search */
        $('.search-button').click(function() {
            $($.browser.webkit ? "body" : "html").animate({
                scrollTop: 0
            }, 400, 'easeInOutExpo');
            $('.blog-search').transition({ height: 'auto' }, 700, 'easeOutExpo');
            $('.search-field').focus();
        });
        
        $('.search-close').click(function(){
            $('.blog-search').transition({ height: '0' }, 700, 'easeOutExpo');
        });
        
        /* archives and categories */
        $('.archives-button').click(function() {
            $($.browser.webkit ? "body" : "html").animate({
                scrollTop: 0
            }, 400, 'easeInOutExpo');
            $('#category-archives').transition({ height: 'auto' }, 700, 'easeOutExpo');
        });
        
        $('.archives-close').click(function(){
            $('#category-archives').transition({ height: '0' }, 700, 'easeOutExpo');
        });
        
        /* vertical align fwt titles */
        $('.fwt-inner').each(function () {
            verticalMiddle($(this)); 
        });
        
        /* vertical align fwt images */
        $('.fwt-solo-img img').each(function () {
            verticalMiddle($(this)); 
        });

        /* slow bg scrolling */
        var $bgobj = $('.cover-image'); // assigning the object
        
        function verticalMiddle(element) {
            /* vertical align title is set */
            if ($(element).hasClass('middle')) {
                var titleMargin = $(element).height() / 2;
                $(element).css('margin-top', '-' + titleMargin + 'px');
                $(window).resize(function () { 
                    var titleMargin = $(element).height() / 2;
                    $(element).css('margin-top', '-' + titleMargin + 'px');
                });
            }
        }
        
		// thanks to seron from stack.overflow for this script
		
		var min_w = 300;
		var vid_w_orig;
		var vid_h_orig;

		vid_w_orig = parseInt($('#fs-video').attr('width'));
		vid_h_orig = parseInt($('#fs-video').attr('height'));

		$(window).resize(function () { resizeToCover(); });
		$(window).trigger('resize');

		function resizeToCover() {

			$('.cover-video').width($(window).width());
			$('.cover-video').height($(window).height());

			var scale_h = $(window).width() / vid_w_orig;
			var scale_v = $(window).height() / vid_h_orig;
			var scale = scale_h > scale_v ? scale_h : scale_v;

			if (scale * vid_w_orig < min_w) {scale = min_w / vid_w_orig;};

			$('#fs-video').width(scale * vid_w_orig);
			$('#fs-video').height(scale * vid_h_orig);

			$('.cover-video').scrollLeft(($('#fs-video').width() - $(window).width()) / 2);
			$('.cover-video').scrollTop(($('#fs-video').height() - $(window).height()) / 2);
		};
		
        function onWindowScroll(_event) {
            
            if(isMobile() !== true && imageZoom !== 'zoom') {
                var bgAlignment;
                var yPos;
                var coords;
                var actualPosX;
                var actualPosY;
                
                /* get alignment */
                if ($('.cover-image').data('bg-align')) {
                    bgAlignment = $('.cover-image').data('bg-align').split(' ');
                    actualPosX = parseInt(bgAlignment[0].replace('%', ''));
                    actualPosY = parseInt(bgAlignment[1].replace('%', '')); 
                } else {
                    bgAlignment = 'none';
                }
                
                /* slow bg scrolling */
                if (bgAlignment != 'none') {
                    yPos = -($(window).scrollTop() / 5) + actualPosY;
                    if (actualPosY === 0) {
                        coords = actualPosX + '% '+ yPos + 'px';
                    } else {
                        coords = actualPosX + '% '+ yPos + '%'; 
                    }
                    $bgobj.css({ backgroundPosition: coords });
                } else {
               
                    yPos = -($(window).scrollTop() / 5);
                    coords = '50% '+ yPos + 'px';
                    $bgobj.css({ backgroundPosition: coords });
                }
            }
            
            /* fade in navbar bg */
            if ($('#navbar-bg').data('transparent-bar') === true) {
				if(!$('#fullscreen-menu').is(':visible')) {
					/* get opacity */
					var headerBarOpacity = $('#navbar-bg').data('navbar-opacity');
					if ($(this).scrollTop() >= $('.fullscreen-cover').height() - ( $('#navbar-bg').height() + 20) ) {
						$('#navbar-bg').removeClass('transparent')
										   .addClass('navbar')
										   .css('opacity',headerBarOpacity);
					} else {
						$('#navbar-bg').addClass('transparent')
										   .removeClass('navbar');
					}
				}
            }
            
            /* beam me up */
            if ($(this).scrollTop() > 400) {
                $('.to-the-top').fadeIn(700);
                
            } else {
                $('.to-the-top').fadeOut(700);
            }
        }

        /* Beam me up */
        $('.top-button').click(function () {
            $($.browser.webkit ? "body" : "html").animate({
                scrollTop: 0
            }, 900, 'easeInOutExpo');
        });
				
		$(window).scroll(onWindowScroll);
		
        /* fade out everything on url change */
		if(!no_transitions) {
			$('.logo a, .title h1 a, .title a, .thumb a, li.menu-item a, h2 a, a.more-link, .meta a, .project-panel-link, .fullscreen-cover a, .fwt-link, .secondary a, .featured a, #fullscreen-menu a, a.ce-image-link, a.cover-slider-link').click(function (a) {
			
				/* no animation on ios devices */
				if($(this).attr('target') !== '_blank') {
					if(isMobile() !== true && !a.ctrlKey) {
						var delay;
						
						if ($(this).data('project-panel') === true) {
							$('#project-panel-header').slideUp(800, 'easeInOutExpo', function () {
								$('header').css('position', 'fixed');
								$('.overlay').css('position', 'absolute');
								$('body').removeClass('project-panel-active');
								$('.overlay').fadeOut('slow');
							});
							delay = 800;
						} else {
							delay = 0;
						}
						
						var href = $(this).attr('href');
						
						var effect = 'slide-up';
						showNav(effect);
						if($('#fullscreen-menu').is(':visible')) {
						
							// fade out menu
							$('#fullscreen-menu').transition({ opacity: 0 }, 500, 'ease', function() {
							
								// fade out overlay
								$('.overlay').transition({ opacity: 0 }, 500, 'ease');
								
								$('#content').transition({ opacity: 0 }, 700, 'ease', function() {
									window.location = href;
								});
							});
							
							
						} else {
							$('#content').transition({ opacity: 0, delay: delay }, 700, 'ease', function() {
								window.location = href;
							});
						}
					
						return false;
					}
				}
			});
		}

        /* show hidden element if user using the browser back button */
        window.onunload = function(){};
    });
})(jQuery); 