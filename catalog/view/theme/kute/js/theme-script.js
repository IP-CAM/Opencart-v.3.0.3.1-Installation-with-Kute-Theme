window.kutetheme_script = null;
window.smarttab_owl = [];
window.contenhomeslider = null;
window.tiker_countdown = null;
(function($){
    "use strict"; // Start of use strict
    /* ---------------------------------------------
     Scripts initialization
     --------------------------------------------- */
    $(window).load(function() {
        // auto width megamenu
        auto_width_megamenu();
        resizeTopmenu();
    });
    /* ---------------------------------------------
     Scripts ready
     --------------------------------------------- */
    $(document).ready(function(){
        //
        $(".product-onsale").bind("appear", function(){
            var element = $(this);

            element.find(".owl-carousel").each(function(index, el) {
                var config = $(this).data();
                config.nav = false;
                if(direction == 'rtl'){
                    config.rtl = true;
                }
                config.navText = ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'];
                config.smartSpeed="300";
                if($(this).hasClass('owl-style2')){
                    config.animateOut="fadeOut";
                    config.animateIn="fadeIn";
                    config.autoplayHoverPause=false;
                }
                $(this).owlCarousel(config);
            });
        });
        $(".product-list.owl-carousel").each(function(index, el) {
          var config = $(this).data();
          config.navText = ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'];
          config.smartSpeed="300";
          if($(this).hasClass('owl-style2')){
            config.animateOut="fadeOut";
            config.animateIn="fadeIn";    
          }
          $(this).owlCarousel(config);
        });
        
        $(".category-featured").bind('appear', function(){
            var element = $(this);
            /** OWL CAROUSEL**/
            if(typeof smarttab_owl[element.find(".floor-elevator").attr("id")] == 'undefined'){
                smarttab_owl[element.find(".floor-elevator").attr("id")] = element.find(".owl-carousel").each(function(index, el) {
                    var config = $(this).data();
                    config.nav = false;
                    if(direction == 'rtl'){
                        config.rtl = true;
                    }
                    config.navText = ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'];
                    config.smartSpeed="300";
                    if($(this).hasClass('owl-style2')){
                        config.animateOut="fadeOut";
                        config.animateIn="fadeIn";
                        config.autoplayHoverPause=false;
                    }
                    $(this).owlCarousel(config);
                });
            }else{
                smarttab_owl[element.find(".floor-elevator").attr("id")].trigger('play.owl.autoplay');
            }
        });
        $(".category-featured").bind('disappear', function(){
            var element = $(this);
            smarttab_owl[element.find(".floor-elevator").attr("id")].trigger('stop.owl.autoplay');
        });

        $(".popular-tabs").bind("appear", function(){
            var element = $(this);
            kutetheme_script.initLoadOwlCarousel(element);
        });

        var list_box_owl = ".latest-deal-content, .latest-deals-product, .blog-list-wapper, .brand-showcase-box, .product-related-list, .box-advanced-modules, .category-slider";

        $(list_box_owl).bind("appear", function(){
            var element = $(this);
            kutetheme_script.initLoadOwlCarousel(element);

            if(tiker_countdown != null){
                return;
            }

            /** COUNT DOWN **/
            element.find('[data-countdown]').each(function() {
                var $this = $(this), finalDate = $(this).data('countdown');
                window.tiker_countdown = $this.countdown(finalDate, function(event) {
                    var fomat ='<span>%H</span><b></b><span>%M</span><b></b><span>%S</span>';
                    $this.html(event.strftime(fomat));
                });
            });
        });

        $(list_box_owl).bind("disappear", function(){
            if(tiker_countdown != null){
                tiker_countdown.countdown('pause');
            }
        });

        $(".product-img-thumb").bind("appear", function(){
            var element = $(this);
            kutetheme_script.initLoadOwlCarousel(element);
            kutetheme_script.initProductDetail();
        });
        window.kutetheme_script = {
            init: function(){
                this.initProductDetail();
            },
            initLoadOwlCarousel: function(element){
                element.find(".owl-carousel").each(function(index, el) {
                    var config = $(this).data();
                    config.nav = true;
                    if(direction == 'rtl'){
                        config.rtl = true;
                    }
                    config.navText = ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'];
                    config.smartSpeed="300";
                    if($(this).hasClass('owl-style2')){
                        config.animateOut="fadeOut";
                        config.animateIn="fadeIn";
                        config.autoplayHoverPause=false;
                    }
                    $(this).owlCarousel(config);
                });
            },
            initProductZoom: function(){
                /* Zoom image */
                if($('#product-zoom').length >0){
                    if($("#gallery_01").length > 0){
                        $('#product-zoom').elevateZoom({
                            //zoomType: "outer",
                            cursor: "crosshair",
                            zoomWindowFadeIn: 500,
                            zoomWindowFadeOut: 750,
                            gallery: 'gallery_01'
                        });
                    }else{
                        $('#product-zoom').elevateZoom({
                            zoomType: "inner",
                            cursor: "crosshair",
                            zoomWindowFadeIn: 500,
                            zoomWindowFadeOut: 750
                        });
                    }

                }
            },
            initProductDetail: function(){
                this.initProductZoom();
                this.changeImageAdditional();
                this.changeProductOptionColor();
            },
            changeImageAdditional: function(){
                return false;
                var self = this;
                var container_product_zoom = $("#product-zoom");
                var container_thumb = $(".product-img-thumb").find(".owl-item");
                container_thumb.find("li > a").on("click", function(){
                    var image_zoom = $(this).data('zoom-image');
                    container_product_zoom.attr('src', image_zoom);
                    container_product_zoom.attr('data-zoom-image', image_zoom);
                    container_product_zoom.imagesLoaded().always( function( instance ) {
                        $('#product-zoom').elevateZoom({
                            zoomType: "inner",
                            cursor: "crosshair",
                            zoomWindowFadeIn: 500,
                            zoomWindowFadeOut: 750,
                            onZoomedImageLoaded: function(){
                                $(".zoomWindowContainer").find(">div").css('background-image', 'url('+image_zoom+')');
                            }
                        });
                    });
                });
            },
            changeProductOptionColor: function(){
                var self = this;
                var container_box = $(".product-option-color");
                container_box.find(".list-color").find("li").on("click", function(){
                    var product_option_id = $(this).closest(".list-color").data('product-option-id');
                    var product_option_value_id = $(this).data('product-option-value-id');
                    var container_input = 'input-option'+product_option_id;

                    $(this).siblings("li").removeClass("active");
                    $(this).addClass('active');

                    $("#"+container_input).val(product_option_value_id);
                });
            }
        }

        kutetheme_script.init();
    });

    if($('.countdown-lastest').length >0){
        var labels = ['Years', 'Months', 'Weeks', 'Days', 'Hrs', 'Mins', 'Secs'];
        var layout = '<span class="box-count"><span class="number">{dnn}</span> <span class="text">Days</span></span><span class="dot">:</span><span class="box-count"><span class="number">{hnn}</span> <span class="text">Hrs</span></span><span class="dot">:</span><span class="box-count"><span class="number">{mnn}</span> <span class="text">Mins</span></span><span class="dot">:</span><span class="box-count"><span class="number">{snn}</span> <span class="text">Secs</span></span>';
        $('.countdown-lastest').each(function() {

            var austDay = new Date($(this).data('y'),$(this).data('m') - 1,$(this).data('d'),$(this).data('h'),$(this).data('i'),$(this).data('s'));

            $(this).countdown({
                until: austDay,
                labels: labels,
                layout: layout
            });
        });
    }
    /* Trigger top cart has change */
    // #THEME 1
    $('#cart #cart-total').on('DOMSubtreeModified propertychange', function() {
        try{
            var text_total = /([0-9]+) ([a-zA-Z]+)/ig.exec($('#cart #cart-total').text())[1];
        }catch(e){}
        $('#cart').find('.cart-link').find('.notify.notify-left').text(text_total);
    });

    // # THEME 2
    $('#cart-block .cart-block').on('DOMSubtreeModified propertychange', function() {
        try{
            var text_total = /([0-9]+) ([a-zA-Z]+)/ig.exec($('.cart-block .cart-title').text())[1];
        }catch(e){}

        $('#cart-block').find('.notify.notify-right').text(text_total);
    });

    $('[data-toggle="tooltip"]').tooltip();
    /* Resize top menu*/
    resizeTopmenu();

    /* Popup sizechart */
    if($('#size_chart').length >0){
        $('#size_chart').fancybox();
    }

    $(".owl-carousel-vertical").each(function(index, el) {
        var config = $(this).data();
        config.navText = ['<span class="icon-up"></spam>','<span class="icon-down"></span>'];
        config.smartSpeed="900";
        config.animateOut="";
        config.animateIn="fadeInUp";
        $(this).owlCarousel(config);
    });

    /* Close top banner*/
    $(document).on('click','.btn-close',function(){
        $(this).closest('.top-banner').animate({ height: 0, opacity: 0 },1000);
        return false;
    })
    /** SELECT CATEGORY **/
    $('.select-category').select2();
    /* Toggle nav menu*/
    $(document).on('click','.toggle-menu',function(){
        $(this).closest('.nav-menu').find('.navbar-collapse').toggle();
        return false;
    })
    /** HOME SLIDE**/
    $('#home-slider').bind("appear", function(){
        var element = $(this);
        if(contenhomeslider != null){
            return true;
        }

        if($('#home-slider').length >0 && $('#contenhomeslider').length >0){
            $('#home-slider').imagesLoaded().always( function( instance ) {
                contenhomeslider = $('#contenhomeslider').bxSlider(
                    {
                        nextText:'<i class="fa fa-angle-right"></i>',
                        prevText:'<i class="fa fa-angle-left"></i>',
                        auto: true,
                        onSliderLoad: function(){
                            // do funky JS stuff here
                            $('#contenhomeslider').find(".item").show();
                        },
                    }
                );
            });
        }
    });

    $('#home-slider').bind("disappear", function(){
        var element = $(this);
    });

    /** Custom page sider**/
    if($('#home-slider').length >0 && $('#contenhomeslider-customPage').length >0){
        var slider = $('#contenhomeslider-customPage').bxSlider(
            {
                nextText:'<i class="fa fa-angle-right"></i>',
                prevText:'<i class="fa fa-angle-left"></i>',
                auto: true,
                pagerCustom: '#bx-pager',
                nextSelector: '#bx-next',
                prevSelector: '#bx-prev',
            }

        );
    }

    if($('#home-slider').length >0 && $('#slide-background').length >0){
        var slider = $('#slide-background').bxSlider(
            {
                nextText:'<i class="fa fa-angle-right"></i>',
                prevText:'<i class="fa fa-angle-left"></i>',
                auto: true,
                onSlideNext: function ($slideElement, oldIndex, newIndex) {
                    var corlor = $($slideElement).data('background');
                    $('#home-slider').css('background',corlor);
                },
                onSlidePrev: function ($slideElement, oldIndex, newIndex) {
                    var corlor = $($slideElement).data('background');
                    $('#home-slider').css('background',corlor);
                }
            }

        );
        //slider.goToNextSlide();
    }

    /* elevator click*/
    $(document).on('click','a.btn-elevator',function(e){
        e.preventDefault();
        var target = this.hash;
        if($(document).find(target).length <=0){
            return false;
        }
        var $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top-50
        }, 500);
        return false;
    })
    /* scroll top */
    $(document).on('click','.scroll_top',function(){
        $('body,html').animate({scrollTop:0},400);
        return false;
    })
    /** #brand-showcase */
    $(document).on('click','.brand-showcase-logo li',function(){
        var id = $(this).data('tab');
        $(this).closest('.brand-showcase-logo').find('li').each(function(){
            $(this).removeClass('active');
        });
        $(this).closest('li').addClass('active');
        $('.brand-showcase-content').find('.brand-showcase-content-tab').each(function(){
            $(this).removeClass('active');
        })
        $('#'+id).addClass('active');
        return false;
    })

    /** ALL CAT **/
    $(document).on('click','.open-cate',function(){
        $(this).closest('.vertical-menu-content').find('li.cat-link-orther').each(function(){
            $(this).slideDown();
        });
        $(this).addClass('colse-cate').removeClass('open-cate').html('Close');
    })
    /* Close category */
    $(document).on('click','.colse-cate',function(){
        $(this).closest('.vertical-menu-content').find('li.cat-link-orther').each(function(){
            $(this).slideUp();
        });
        $(this).addClass('open-cate').removeClass('colse-cate').html('All Categories');
        return false;
    })
    // bar ontop click
    $(document).on('click','.vertical-megamenus-ontop-bar',function(){
        $('#vertical-megamenus-ontop').find('.box-vertical-megamenus').slideToggle();
        $('#vertical-megamenus-ontop').toggleClass('active');
        return false;
    })
    // View grid list product
    $(document).on('click','.display-product-option .view-as-grid',function(){
        $(this).closest('.display-product-option').find('li').removeClass('selected');
        $(this).addClass('selected');
        $(this).closest('#view-product-list').find('.product-list').removeClass('list').addClass('grid');
        return false;
    })
    // View list list product
    $(document).on('click','.display-product-option .view-as-list',function(){
        $(this).closest('.display-product-option').find('li').removeClass('selected');
        $(this).addClass('selected');
        $(this).closest('#view-product-list').find('.product-list').removeClass('grid').addClass('list');
        return false;
    })
    /// tre menu category
    $(document).on('click','.tree-menu li span',function(){
        $(this).closest('li').children('ul').slideToggle();
        if($(this).closest('li').haschildren('ul')){
            $(this).toggleClass('open');
        }
        return false;
    })
    /* Open menu on mobile */
    $(document).on('click','.btn-open-mobile',function(){
        var width = $(window).width();
        if(width >1024){
            if($('body').hasClass('home')){
                if($('#nav-top-menu').hasClass('nav-ontop')){
                }else{
                    return false;
                }
            }
        }
        $(this).closest('.box-vertical-megamenus').find('.vertical-menu-content').slideToggle();
        $(this).closest('.title').toggleClass('active');
        $(this).closest('.box-vertical-megamenus').find("#box-vertical-megamenus").show();
        return false;
    })
    /* Product qty */
    $(document).on('click','.btn-plus-down',function(){
        var value = parseInt($('#option-product-qty').val());
        value = value -1;
        if(value <=0) return false;
        $('#option-product-qty').val(value);
        return false;
    })
    $(document).on('click','.btn-plus-up',function(){
        var value = parseInt($('#option-product-qty').val());
        value = value +1;
        if(value <=0) return false;
        $('#option-product-qty').val(value);
        return false;
    })
    /* Close vertical */
    $(document).on('click','*',function(e){
        var container = $("#box-vertical-megamenus");
        if (!container.is(e.target) && container.has(e.target).length === 0){
            if($('body').hasClass('home')){
                if($('#nav-top-menu').hasClass('nav-ontop')){
                }else{
                    return;
                }
            }
            //container.find('.vertical-menu-content').hide();
            //container.find('.title').removeClass('active');
        }
    })
    /* Send conttact*/
    $(document).on('click','#btn-send-contact',function(){
        var subject = $('#subject').val(),
            email   = $('#email').val(),
            order_reference = $('#order_reference').val(),
            message = $('#message').val();
        var data = {
            subject:subject,
            email:email,
            order_reference:order_reference,
            message:message
        }
        $.post('ajax_contact.php',data,function(result){
            if(result.trim()=="done"){
                $('#email').val('');
                $('#order_reference').val('');
                $('#message').val('');
                $('#message-box-conact').html('<div class="alert alert-info">Your message was sent successfully. Thanks</div>');
            }else{
                $('#message-box-conact').html(result);
            }
        })
    });
    /* ---------------------------------------------
     Scripts resize
     --------------------------------------------- */
    $(window).resize(function(){
        // auto width megamenu
        auto_width_megamenu();
        // Remove menu ontop
        remove_menu_ontop();
        // resize top menu
        resizeTopmenu();
    });
    /* ---------------------------------------------
     Scripts scroll
     --------------------------------------------- */
    // Leak memory here :(
    $(window).scroll(function(){
        resizeTopmenu();
        /* Show hide scrolltop button */
        if( $(window).scrollTop() == 0 ) {
            $('.scroll_top').stop(false,true).fadeOut(600);
        }else{
            $('.scroll_top').stop(false,true).fadeIn(600);
        }
        /* Main menu on top */
        var h = $(window).scrollTop();
        var max_h = $('#header').height() + $('#top-banner').height();
        var width = $(window).width();
        if(width > 767){
            if( h > (max_h + vertical_menu_height)-50){
                // fix top menu
                $('#nav-top-menu').addClass('nav-ontop');
                //$('#nav-top-menu').find('.vertical-menu-content').hide();
                //$('#nav-top-menu').find('.title').removeClass('active');
                // add cart box on top menu
                $('#cart-block .cart-block').appendTo('#shopping-cart-box-ontop .shopping-cart-box-ontop-content');
                $('#shopping-cart-box-ontop').fadeIn();
                $('#user-info-top').appendTo('#user-info-opntop');
                $('#header .header-search-box form').appendTo('#form-search-opntop');
            }else{
                $('#nav-top-menu').removeClass('nav-ontop');
                if($('body').hasClass('home')){
                    $('#nav-top-menu').find('.vertical-menu-content').removeAttr('style');
                    if(width > 1024)
                        $('#nav-top-menu').find('.vertical-menu-content').show();
                    else{
                        $('#nav-top-menu').find('.vertical-menu-content').hide();
                    }
                     $('#nav-top-menu').find('.vertical-menu-content').removeAttr('style');
                }
                ///
                $('#shopping-cart-box-ontop .cart-block').appendTo('#cart-block');
                $('#shopping-cart-box-ontop').fadeOut();
                $('#user-info-opntop #user-info-top').appendTo('.top-header .container .row .top-link');
                $('#form-search-opntop form').appendTo('#header .header-search-box');
            }
        }
    });
    var vertical_menu_height = $('#box-vertical-megamenus .box-vertical-megamenus').innerHeight();
    /**==============================
    ***  Auto width megamenu
    ===============================**/
    function auto_width_megamenu(){
        var full_width = parseInt($('.container').innerWidth());
        //full_width = $( document ).width();
        var menu_width = parseInt($('.vertical-menu-content').actual('width'));
        $('.vertical-menu-content').find('.vertical-dropdown-menu').each(function(){
            $(this).width((full_width - menu_width)-2);
        });
    }
    /**==============================
    ***  Remove menu on top
    ===============================**/
    function remove_menu_ontop(){
        var width = parseInt($(window).width());
        if(width < 768){
            $('#nav-top-menu').removeClass('nav-ontop');
            if($('body').hasClass('home')){
                if(width > 1024)
                    $('#nav-top-menu').find('.vertical-menu-content').show();
                else{
                    $('#nav-top-menu').find('.vertical-menu-content').hide();
                }
            }
            ///
            $('#shopping-cart-box-ontop .cart-block').appendTo('#cart-block');
            $('#shopping-cart-box-ontop').fadeOut();
            $('#user-info-opntop #user-info-top').appendTo('.top-header .container');
            $('#form-search-opntop form').appendTo('#header .header-search-box');
        }
    }
    /* Top menu*/
    function scrollCompensate(){
        var inner = document.createElement('p');
        inner.style.width = "100%";
        inner.style.height = "200px";
        var outer = document.createElement('div');
        outer.style.position = "absolute";
        outer.style.top = "0px";
        outer.style.left = "0px";
        outer.style.visibility = "hidden";
        outer.style.width = "200px";
        outer.style.height = "150px";
        outer.style.overflow = "hidden";
        outer.appendChild(inner);
        document.body.appendChild(outer);
        var w1 = parseInt(inner.offsetWidth);
        outer.style.overflow = 'scroll';
        var w2 = parseInt(inner.offsetWidth);
        if (w1 == w2) w2 = outer.clientWidth;
        document.body.removeChild(outer);
        return (w1 - w2);
    }

    function resizeTopmenu(){
        if($(window).width() + scrollCompensate() >= 768){
            var main_menu_w = $('#main-menu .navbar').innerWidth();

            $("#main-menu ul.mega_dropdown").each(function(){
                var menu_width = $(this).innerWidth();
                var offset_left = $(this).position().left;
                if(menu_width > main_menu_w){
                    $(this).css('width',main_menu_w+'px');
                    $(this).css('left','0');
                }else{
                    if((menu_width + offset_left) > main_menu_w){
                        var t = main_menu_w-menu_width;
                        var left = parseInt((t/2));
                        $(this).css('left',left);
                    }
                }
            });
        }

        if($(window).width()+scrollCompensate() < 1025){
            $("#main-menu li.dropdown:not(.active) >a").attr('data-toggle','dropdown');
        }else{
            $("#main-menu li.dropdown >a").removeAttr('data-toggle');
        }
    }
})(jQuery); // End of use strict