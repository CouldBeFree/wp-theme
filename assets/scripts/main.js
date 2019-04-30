(function($) {

    // Variables
    var video = $('#myVideo');
    var header = $('.page-header');
    var videoSection = $('.video-section');
    var videoWrap = $('.video-wrap');
    var is_safari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);

    // Scroll on video end
    if(!is_safari){
        video.bind('ended', function () {
            /*var fuller = $(this).closest('.fullscreen').next();
            var section = $(this).closest('.page-main');
            var self = $(this);

            $('html, body').animate({
                scrollTop: section.scrollTop() + fuller.offset().top
            }, 700);

            // videoSection.fadeOut("slow")

            videoSection.animate({
                height: '0px'
            }, 900);*/

            var position = videoSection.height() + 45;

            $("body, html").animate({
                scrollTop: position
            }, 1200, function () {
                videoSection.remove();
                $("body, html").scrollTop(45);
            });
        });
    } else{
        // videoSection.css('background-color', 'f6c523');
        console.log('Safari');
    }

    var lastScrollTop = 0;
    var flag = false;
    var slider = $('#slider').offset();

    // Sticky header
    $(window).scroll(function() {
        var scroll = $(this).scrollTop();
        var section = videoSection.height();
        var body = $('html, body');
        var headerTop = $('#slider').scrollTop();
        var icon = $('.icon-up-chevron-button');

        if(scroll > 1 ) {
            header.addClass('small');
        } else if(scroll < 1) {
            header.removeClass('small');
        }

        if(!is_safari){
            if(scroll > ( section + 110)) {//110
                videoSection.animate({
                    height: '0px'
                }, 1000, function () {
                    videoSection.remove();
                });
            }
        }

        if(($(window).width()) > 667) {
            if(scroll > 350) {
                icon.css(
                    'opacity', '1'
                )
            } else{
                icon.css(
                    'opacity', '0'
                )
            }
        } else {
            if(scroll > 500) {
                icon.css(
                    'opacity', '1'
                )
            } else{
                icon.css(
                    'opacity', '0'
                )
            }
        }
    });

    $('.slider img').addClass('hidden');

    $('.slider').on('init', function(){
        $('.slider-holder').removeClass('hidden');
    });

    // Slick slider
    $('.slider-holder').slick({
        arrows: false,
        adaptive: true,
        autoplay: false,
        centerMode: true,
        draggable: true,
        infinite: true,
        pauseOnHover: true,
        arrows: true,
        slidesToShow: 3,
        respondTo: 'window',
        adaptiveHeight: false,
        // variableWidth: true,
        prevArrow: $('.previous-slide'),
        nextArrow: $('.next-slide'),
        responsive: [
            {
                breakpoint: 1025,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    $('.slick-slide img').removeClass('hidden');

    // Customising input type file

    var input = $('.wpcf7 input[type="file"]');
    var label = $('.label-select');
    label.after('<div class="filename"></div>');

    // validation file type
    $.fn.checkFileType = function(options) {
        var defaults = {
            allowedExtensions: [],
            success: function() {},
            error: function() {}
        };
        options = $.extend(defaults, options);

        return this.each(function() {

            $(this).on('change', function() {
                var value = $(this).val(),
                    file = value.toLowerCase(),
                    extension = file.substring(file.lastIndexOf('.') + 1);

                if ($.inArray(extension, options.allowedExtensions) == -1) {
                    options.error();
                    $(this).focus();
                } else {
                    options.success();
                }
            });
        });
    };

    input.checkFileType({
        allowedExtensions: ['jpg', 'jpeg', 'ai', 'doc', 'docx', 'idml', 'indd', 'otf', 'pdf', 'png', 'ppt', 'pptx', 'psd', 'pub', 'qxp', 'ttf', 'zip'],
        success: function() {

        },
        error: function() {
            var nameTarget = $('.filename');
            nameTarget.after('<span role="alert" class="wpcf7-not-valid-tip type">You are not allowed to upload files of this type.</span>');
            input.val('');
            nameTarget.text('');
        }
    });

    input.change(function() {
        var filename = this.files[0].name;
        var nameTarget = $('.filename');
        nameTarget.text(filename);
        var filesize = ((this.files[0].size/1024) / 1024).toFixed(4);
        $('.oversized').remove();
        input.next('.wpcf7-not-valid-tip').remove();
        if(filesize > 50) {
            var files = this.files;
            nameTarget.after('<span role="alert" class="wpcf7-not-valid-tip oversized">This file is more than 50MB</span>');
            input.val('');
            nameTarget.text('');
        }
    });

    label.on('click', function () {
        input.trigger('click');
    });

    // Restrict number of values

    var name = $('.wpcf7-form input[name="maxlength:100"]');
    var company = $('.wpcf7-form input[name="maxlength:300"]');
    var common = $('.wpcf7-form input[name="maxlength:1000"]');
    var textarea = $('.wpcf7-form textarea[name="maxlength:10000"]');

    name.keydown( function(){
        var max_chars = 100;

        if ($(this).val().length >= max_chars) {
            $(this).val($(this).val().substr(0, max_chars));
        }
    });

    company.keydown( function(){
        var max_chars = 300;

        if ($(this).val().length >= max_chars) {
            $(this).val($(this).val().substr(0, max_chars));
        }
    });

    textarea.keydown( function(){
        var max_chars = 10000;

        if ($(this).val().length >= max_chars) {
            $(this).val($(this).val().substr(0, max_chars));
        }
    });

    common.keydown(function () {
        var max_chars = 1000;

        if ($(this).val().length >= max_chars) {
            $(this).val($(this).val().substr(0, max_chars));
        }
    });

    // CF7
    var requestForm = $('.request-form');

    $('.page-contact .wpcf7 br').remove();

    $(".wpcf7").on('wpcf7:invalid', function(){
        var inputText = $('.submit-art .wpcf7-form-control');
        var inputTextarea = $('.wpcf7 textarea');
        inputText.closest("p").not(':last').addClass('offset');
        inputTextarea.next('.wpcf7-not-valid-tip').css(
            "bottom", "10px"
        );
        if(!input.val()){
            input.next('.wpcf7-not-valid-tip').text('The file is not selected');
        }
    });

    var testButton = $('.test');
    var message = $('.message-success');
    var closeMessage = $('#close-message');

    $(".wpcf7").on('wpcf7mailsent ', function () {
        if($('.content div').hasClass('request-form')){
            $('.content, .additional-content').toggleClass('hidden');
            $('.message-wrap').toggleClass('visible');
            $("html, body").animate({ scrollTop: 0 }, 2000);

        } else if($('.form-wrapper div').hasClass('submit-art')) {
            message.fadeIn('slow');
            scrollToResult();
            setTimeout(function () {
                message.fadeOut('slow');
            }, 4000);
        } else {
            message.fadeIn('slow', function () {
                scrollToResult();
            });
            setTimeout(function () {
                message.fadeOut('slow');
            }, 7000);
            setTimeout(function () {
                $("html, body").animate({ scrollTop: 0 }, 2500);
            }, 8000)
        }
        $('.filename').remove();
    });

    testButton.on('click', function(){
        if($('.content div').hasClass('request-form')){
            $('.content, .additional-content').toggleClass('hidden');
            $('.message-wrap').toggleClass('visible');
            $("html, body").animate({ scrollTop: 0 }, 2000);

        } else if($('.form-wrapper div').hasClass('submit-art')) {
            message.fadeIn('slow');
            scrollToResult();
            setTimeout(function () {
                message.fadeOut('slow');
            }, 4000);
        } else {
            message.fadeIn('slow', function () {
                scrollToResult();
            });
            setTimeout(function () {
                message.fadeOut('slow');
            }, 7000);
            setTimeout(function () {
                $("html, body").animate({ scrollTop: 0 }, 2500);
            }, 8000)
        }
    });

    closeMessage.click(function (e) {
        e.preventDefault();
        $('.content, .additional-content').toggleClass('hidden');
        $('.message-wrap').toggleClass('visible');
    });

    // var submitSelect = $('.wpcf7 input[type="sumbit"]');
    $('.wpcf7-submit').parent().addClass('flex align-center');

    var infoSection = $('.info').height();
    $('.triangle').css('height', infoSection);

    // Search label shapes and sizes

    var radioVal = 'rectangles';
    var widthInput = $('#width');
    var lengthInput = $('#length');
    var diameter = $('#diameter');

    $('.radio-wrap input').on('change', function() {
        radioVal = $('input[name=shape]:checked', '.radio-wrap').val();
        clearErrors();
        widthInput.val('');
        lengthInput.val('');
        diameter.val('');

        if(radioVal === 'rectangles' || radioVal === 'ovals'){
            widthInput.removeClass('hidden');
            lengthInput.removeClass('hidden');
            diameter.addClass('hidden');
        } else  {
            diameter.removeClass('hidden');
            widthInput.addClass('hidden');
            lengthInput.addClass('hidden');
        }
    });

    // Validation

    function clearErrors() {
        $(".error").remove();
        widthInput.removeClass('required');
        lengthInput.removeClass('required');
    }

    $.fn.inputFilter = function(inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            }
        });
    };

    // Ajax for labels and shapes

    function isEmpty() {
        var target = $('.result');
        target.remove();
    }

    function sortData() {
        var result = $('.inner-wrap');
        var initialWidth = $('#width').val();
        var initialLength = $('#length').val();
        var initialDiameter = $('#diameter').val();
        var rangeData = $('.result__item');

        if (initialLength % 1 === 0 || initialWidth % 1 === 0) {
            initialLength = parseFloat(Math.round(initialLength * 100) / 100).toFixed(2);
            initialWidth = parseFloat(Math.round(initialWidth * 100) / 100).toFixed(2);
            initialDiameter = parseFloat(Math.round(initialDiameter * 100) / 100).toFixed(2);
        }

        initialWidth = parseFloat(initialWidth);
        initialLength = parseFloat(initialLength);
        initialDiameter = parseFloat(initialDiameter);

        rangeData.removeClass('hidden');

        result.each(function () {
            var target = $('.entry');
            var findWidth = $(this).find('.width-result').text();
            var findLength = $(this).find('.length-result').text();
            var findDiameter = $(this).find('.diameter-result').text();
            findWidth = parseFloat(findWidth);
            findLength = parseFloat(findLength);
            findDiameter = parseFloat(findDiameter);

            if((!findDiameter.isNumeric) && (findWidth === initialWidth && findLength === initialLength)) {
                target.append($(this));
                target.addClass('visible');
                rangeData.addClass('hidden');
            } else if(findDiameter === initialDiameter) {
                target.append($(this));
                target.addClass('visible');
                rangeData.addClass('hidden');
            }
        });

        $('.search').addClass('visible');
    }

    widthInput.inputFilter(function (value) {
        return /^(?!\.)?\d*[.]?\d*$/.test(value)
    });

    lengthInput.inputFilter(function (value) {
        return /^(?!\.)?\d*[.]?\d*$/.test(value)
    });

    diameter.inputFilter(function (value) {
        return /^(?!\.)?\d*[.]?\d*$/.test(value)
    });

    function prependHeadline() {
        var target = $('.result');
        var capitalized = radioVal.charAt(0).toUpperCase() + radioVal.slice(1);
        return target.prepend("<h2>" + capitalized + ':' + ' ' + "Search Results</h2>")
    }

    function scrollToResult() {
        var scrollTarget = $('#scroll-target');
        $('html, body').animate({
            scrollTop: ((scrollTarget.offset().top) - 140)
        },1500);
    }

    $('.select-shape').submit(function(e){
        var width = parseFloat($('#width').val());
        var length = parseFloat($('#length').val());
        var diameterVal = parseFloat($('#diameter').val());
        var bias = 0.25;
        var widthMin = width - bias;
        var widthMax = width + bias;
        var lengthMin = length - bias;
        var lengthMax = length + bias;
        var diameterMax = diameterVal + bias;
        var diameterMin = diameterVal - bias;
        var submit = $('#submit');
        e.preventDefault();
        var preloader = $('.preloader');

        var data = {
            'action': 'loadmore',
            'width': width,
            'length': length,
            'maxWidth': widthMax,
            'minWidth': widthMin,
            'minLength': lengthMin,
            'maxLength': lengthMax,
            'diameter' : diameterVal,
            'shape' : radioVal,
            'diameterMax' : diameterMax,
            'diameterMin' : diameterMin
        };
        clearErrors();

        if(radioVal === 'rectangles' || radioVal === 'ovals'){
            if(!width) {
                widthInput.addClass('required');
                widthInput.after('<span class="error">This field is required</span>');
            }
            if (!length) {
                lengthInput.addClass('required');
                lengthInput.after('<span class="error last">This field is required</span>');
            }
        }

        if(radioVal === 'circles') {
            if(!diameterVal) {
                diameter.addClass('required');
                diameter.after('<span class="error last">This field is required</span>');
            }
        }

        if(width && length || diameterVal) {
            submit.attr('value', 'loading');
            // preloader.addClass('visible');
            $.ajax({
                url:ajaxurl,
                data:data,
                type:'POST',
                success:function(data){
                    if( data ) {
                        console.log('Success');
                        isEmpty();
                        $('#target').append(data);
                        submit.attr('value', 'submit');
                        sortData();
                        prependHeadline();
                        preloader.removeClass('visible');
                        scrollToResult();
                    } else {
                        console.log('Error');
                        isEmpty();
                        submit.attr('value', 'submit');
                        prependHeadline();
                        $('.search').addClass('visible');
                    }
                }
            });
        }
    });

    // Triger Olark Chat
    $('.chat').click(function (e) {
        e.preventDefault();
        $('.olark-launch-button').trigger('click')
    });

    // Samples library
    var $grid = $('.grid');
    var preloader = $('.preloader');
    var result = $('.result-block');

    $grid.masonry({
        itemSelector: '.grid-item',
        percentPosition: true
    });

    var paginationItem = $('#pagination');

    function paginationInit(pages) {

        var number = pages;
        var target = $('#label-search');

        function initClick() {
            var active = $('.paginationjs-pages .active').text();
            current = +active;
            index = current - 1;
            target.trigger('submit');
            $('html, body').animate({
                scrollTop: ((target.offset().top) - 100)
            },1500);
        }

        pagination.pagination({
            dataSource: function(done){
                var result = [];
                for (var i = 0; i < number; i++) {
                    result.push(i);
                }
                done(result);
            },
            pageRange: 1,
            pageSize: 1,
            autoHidePrevious: true,
            autoHideNext: true,
            pageNumber: current,
            afterPageOnClick: function(){
                initClick()
            },
            afterPreviousOnClick: function () {
                initClick()
            },
            afterNextOnClick: function () {
                initClick()
            }
        });
    }

    function initialiceMasonry(){
        var $container = $('.grid');
        var paginationCount = 0;
        $container.imagesLoaded(function() {
            $container.masonry('reloadItems');
            $container.masonry({
                isInitLayout : true,
                itemSelector: '.grid-item',
                gutter: '.gutter-sizer',
                percentPosition: true
            });
            paginationCount = $('.grid-item').attr("data-size");
            // pagination.empty();
            /*if(paginationCount > 1) {
                for(i = 1; i <= paginationCount; i++) {
                    var node = "<li>" + i + "</li>";
                    pagination.append(node)
                }
                var items = pagination.find("li").eq(index);
                items.addClass('active');
            }*/
        });
        $container.on( 'layoutComplete', function () {
            preloader.addClass('hidden');
            $grid.removeClass('visible');
            result.removeClass('loading');
            getHeight();
            // paginationItem.twbsPagination('destroy');
            paginationInit(paginationCount);
            var length = $('.grid-item').length;
            console.log(length + ' ' + 'items');
        });
    }

    // $('.icon-holder').trigger("submit");
    $('.icon-holder').click(function () {
        $(this).trigger('submit');
    });

    $('.icon-arrow-point-to-right').click(function () {
        selectInput.trigger('click');
    });

    function ifEmpty() {
        var target = $('.background-target');
        if($grid.find('div.grid-item').length !== 0){
            $grid.removeClass('offset');
            target.addClass('hidden');
            pagination.removeClass('hidden');
        } else {
            $grid.addClass('offset');
            target.removeClass('hidden');
            target.addClass('hidden');
            $('.pagination').remove();
            pagination.addClass('hidden');
            selectInput.prop('selectedIndex',0);
            $('#keywords').val('');
        }
    }

    var selectInput = $('#select');
    selectInput.change(function (e) {
        var target = $('#label-search');
        var value = e.target.value;
        if(value === 'empty'){
            $(this).prop('selectedIndex', 0);
        }
        current = 1;
        index = 0;
        target.trigger('submit');
    });

    var testFlag = '';

    $('#label-search').submit(function (e) {
        e.preventDefault();
        var container = $('.form-wrap');
        var industryVal = $('#select').val();
        var keywords = $('#keywords').val();
        var items = $('.grid-item');
        var empty = $('.empty');
        $('.gutter-sizer').remove();
        $('.test').remove();
        $('.search-result').remove();

        if(testFlag != keywords) {
            current = 1;
            index = 0;
        }

        testFlag = keywords;

        var data = {
            'action': 'search',
            'industry': industryVal,
            'keywords': keywords,
            'index': index
        };

        if(industryVal && keywords) {
            container.append("<p class='search-result'>Industry:" + ' ' + industryVal + "</p>");
            container.append("<p class='search-result keyword'>Keyword:" + ' ' + keywords + "</p>");
        } else if(industryVal){
            container.append("<p class='search-result'>Industry:" + ' ' + industryVal + "</p>");
        } else if(keywords){
            container.append("<p class='search-result keyword'>Keyword:" + ' ' + keywords + "</p>");
        }

        if(industryVal || keywords) {
            $('#select, #keywords').removeClass('invalid');
            result.addClass('loading');
            // $('.background-target').removeClass('hidden');
            $('.background-target').css({
                "background-image": "unset"
            });
            preloader.removeClass('hidden');
            items.remove();
            empty.remove();
            $grid.addClass('visible');
            // $('#keywords').val('');
            $grid.css({
                'height': '0'
            });

            $.ajax({
                url:url,
                data:data,
                type:'POST',
                success:function(content){
                    var $content = $( content );
                    if( $content ) {
                        empty.remove();
                        $grid.append( $content );
                        initialiceMasonry();
                        ifEmpty();
                    } else {
                        console.log('Error');
                        preloader.removeClass('hidden');
                        result.removeClass('loading');
                    }
                }
            });
        } else {
            $('#select, #keywords').addClass('invalid');
        }
    });

    var pagination = $('#pagination');
    var index = 0;
    var appendPagination = true;
    var current = 1;
    var heightResult = ($('#result').outerHeight()) + 80;

    /*pagination.find('li').off().click(function (e) {
        e.preventDefault();
        alert('True');
    });*/

    /*pagination.on('click', 'li', function () {
        alert('True');
        /!*var target = $('#label-search');
        appendPagination = false;
        index = ($(this).text()) - 1;
        current = $(this).text();*!/

        /!*$('html, body').animate({
            scrollTop: ((target.offset().top) - 140)
        },1500);*!/

       /!* $('.background-target').css({
            'height': heightResult
        });
*!/
        /!*$(this).siblings('li').removeClass('active');
        $(this).addClass('active');*!/
        // target.trigger('submit');
    });*/

    /*var right = $('#right');
    var left = $('#left');
    right.click(function () {
        var currentItem = $('#pagination li').hasClass('active');
        console.log(currentItem);
    });*/

    $('#scroll-button').on('click', function () {
        $("html, body").animate({
            scrollTop: 0
        }, 500)
    });

    function getHeight(){
        var result = $('#result');
        if(result.length > 0) {
            var distance = result.offset().top;
            var height = (result.outerHeight() + 80);
            $('.background-target').css({
                'top': distance,
                'height': height
            })
        }
    }

    getHeight();

    $(window).resize(getHeight);

    // Video play/pause

    var icon = $('#video-play');

    $('#video').click(function () {
        icon.toggleClass('hidden');
        $(this).get(0).paused ? $(this).get(0).play() : $(this).get(0).pause();
        // $(this).get(0).play();
        $('#video').bind('ended', function () {
            icon.toggleClass('hidden')
        });
    });

    icon.click(function () {
        var video = $('#video');
        $(this).toggleClass('hidden');
        video.get(0).paused ? video.get(0).play() : video.get(0).pause();
        video.bind('ended', function () {
            $(this).toggleClass('hidden');
        });
    });

    var pathname = window.location.pathname; // Returns path only (/path/example.html)
    if (pathname === '/label-shapes-sizes/'){
        $('#menu-main-menu .email a').attr("href", "mailto:info@richmarklabel.com?subject=Website Message: Custom Die Shape");
        $('#mail').attr("href", "mailto:info@richmarklabel.com?subject=Website Message: Custom Die Shape");
        $('.direction').attr("href", "mailto:info@richmarklabel.com?subject=Website Message: Custom Die Shape");
    } else {
        $('.direction').attr("href", "mailto:info@richmarklabel.com?subject=Richmark Label Website Message");
        $('#mail').attr("href", "mailto:info@richmarklabel.com?subject=Richmark Label Website Message");
    }

})(jQuery);