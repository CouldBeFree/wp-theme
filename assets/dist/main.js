(function($) {

    // Variables
    var video = $('#myVideo');
    var header = $('.page-header');
    var videoSection = $('.video-section');
    var videoWrap = $('.video-wrap');

    // Scroll on video end
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
        } );
    });

    // Sticky header
    $(window).scroll(function() {
        var scroll = $(this).scrollTop();

        if(scroll > 1 ) {
            header.addClass('small');
        } else if(scroll < 1) {
            header.removeClass('small');
        }

        if(scroll > (videoSection.height() + 110) ) {
            videoSection.animate({
                height: '0px'
            }, 500, function () {
                videoSection.remove();
            });
        }
    });

    $('.slider img').addClass('hidden');

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
    // input.before('<label class="label-select">CHOOSE FILE</label>');
    var label = $('.label-select');
    label.after('<div class="filename"></div>');

    input.change(function() {
        var filename = this.files[0].name;
        var nameTarget = $('.filename');
        nameTarget.text(filename);
        var filesize = ((this.files[0].size/1024) / 1024).toFixed(4);
        if(filesize > 10) {
            var files = this.files;
            console.log(files);
            nameTarget.after('<span role="alert" class="wpcf7-not-valid-tip">This file is more than 50MB</span>');
            input.val('');
            nameTarget.text('');
        } else {
            nameTarget.next('.wpcf7-not-valid-tip').remove();
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
    $('.page-contact .wpcf7 br').remove();

    $(".wpcf7").on('wpcf7:invalid', function(){
        input.next('.wpcf7-not-valid-tip').text('The file is not selected');

        var inputText = $('.submit-art .wpcf7-form-control');
        var inputTextarea = $('.wpcf7 textarea');
        inputText.closest("p").addClass('offset');
        inputTextarea.next('.wpcf7-not-valid-tip').css(
            "bottom", "10px"
        )
    });

    $(".wpcf7").on('wpcf7mailsent ', function () {
        $('.offset').removeClass('offset')
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

    /*$(".shape-value").inputFilter(function(value) {
        return /^\d*$/.test(value); });*/

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

        if (initialLength % 1 === 0 || initialWidth % 1 === 0) {
            initialLength = parseFloat(Math.round(initialLength * 100) / 100).toFixed(2);
            initialWidth = parseFloat(Math.round(initialWidth * 100) / 100).toFixed(2);
            initialDiameter = parseFloat(Math.round(initialDiameter * 100) / 100).toFixed(2);
        }

        result.each(function () {
            var target = $('.entry');
            var findWidth = $(this).find('.width-result').text();
            var findLength = $(this).find('.length-result').text();
            var findDiameter = $(this).find('.diameter-result').text();
            if(findWidth === initialWidth && findLength === initialLength || findDiameter === initialDiameter) {
                target.append($(this));
                target.addClass('visible');
            }
        });

        $('.search').addClass('visible');
    }

    widthInput.inputFilter(function (value) {
        return /^-?\d*[.]?\d*$/.test(value)
    });

    lengthInput.inputFilter(function (value) {
        return /^-?\d*[.]?\d*$/.test(value)
    });

    diameter.inputFilter(function (value) {
        return /^-?\d*[.]?\d*$/.test(value)
    });

    function prependHeadline() {
        var target = $('.result');
        var capitalized = radioVal.charAt(0).toUpperCase() + radioVal.slice(1);
        return target.prepend("<h2>" + capitalized + ':' + ' ' + "Search Results</h2>")
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

})(jQuery);