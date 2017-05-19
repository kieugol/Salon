/*
 * jQuery File Upload Plugin JS Example
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
	var is_salon_url = $('#is_salon').val();
    'use strict';
    var target_form = $('#obj_form').val();
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: '/tan/customer/upload-file?is_salon=' + is_salon_url,
        success:function(data) {
            if (data.error == '') {
                $('.'+ target_form).append('<input type="hidden" name="id_album[]" value="'+data.id_img+'">');
            }
        }
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );

    if (window.location.hostname === 'blueimp.github.io') {
        // Demo settings:
        $('#fileupload').fileupload('option', {
            url: '//jquery-file-upload.appspot.com/',
            // Enable image resizing, except for Android and Opera,
            // which actually support image resizing, but fail to
            // send Blob objects via XHR requests:
            disableImageResize: /Android(?!.*Chrome)|Opera/
                .test(window.navigator.userAgent),
            maxFileSize: 999000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
        });
        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: '//jquery-file-upload.appspot.com/',
                type: 'HEAD'
            }).fail(function () {
                $('<div class="alert alert-danger"/>')
                    .text('Upload server currently unavailable - ' +
                            new Date())
                    .appendTo('#fileupload');
            });
        }
    } else {
        // Load existing files:
        $('#fileupload').addClass('fileupload-processing');
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload').fileupload('option', 'url'),
            dataType: 'json',
            context: $('#fileupload')[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            console.log(result);
            $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {result: result});
        });
    }
    $.validator.addMethod("greaterThan",
        function (value, element, param) {
              var $otherElement = $(param);
              return parseInt(value, 10) < parseInt($otherElement.val(), 10);
    });
    // Handle register salon
    $('#bt-submit').click(function(){
        $('#description').trigger('click');
        $('.salon-form').validate({
            rules: {
                txt_name:{
                    required: true,
                    minlength:3,
                    maxlength:100
                },
                txt_phone:{
                    required: true,
                    number:true,
                    minlength:10,
                    maxlength:11
                },
                txt_address:{
                    required: true,
                    minlength:10,
                    maxlength:200
                },
                txt_contact:{
                    required: true,
                    minlength:10,
                    maxlength:200
                }
            },
            messages: {
                txt_name:{
                    required:'Bắt buộc nhập',
                    minlength : 'Độ dài tối thiểu 3 ký tự',
                    maxlength: 'Độ dài tối đa 100 ký tự'
                },
                txt_phone:{
                    required: "Bắt buộc nhập",
                    number :'Phải là số',
                    minlength: 'Độ dài tối thiểu 10 số',
                    maxlength: 'Độ dài tối đa 11 số'
                },
                txt_address:{
                    required: "Bắt buộc nhập",
                    minlength : 'Độ dài tối thiểu 10 ký tự',
                    maxlength: 'Độ dài tối đa 200 số'
                },
                txt_contact:{
                    required: "Bắt buộc nhập",
                    minlength : 'Độ dài tối thiểu 10 ký tự',
                    maxlength: 'Độ dài tối đa 200 số'
                }
            }
        });
        if ($('.salon-form').valid() == false) {
            return false;
        }
        $('.salon-form').append('<div class="loading-ajax"></div>')
        $('.fileupload-buttonbar .start').trigger('click');
        setTimeout(function(){
           $('.salon-form').submit();
        },2000);
    });
        // Handle register event
    $('#bt-submit-event').click(function(){
        $('#description').trigger('click');
        $('.event-form').validate({
            rules: {
				txt_user:{
                    required: true,
                    minlength:3,
                    maxlength:100
                },
				txt_pass:{
                    required: true,
                    minlength:6,
                    maxlength:100
                },
                txt_name:{
                    required: true,
                    minlength:10,
                    maxlength:100
                },
                txt_price:{
                    required: true,
                    number:true,
                    minlength:6,
                    maxlength:10
                },
                txt_price_sale:{
                    number:true,
                    greaterThan: '#txt_price'
                },
                txt_sort_des:{
                    required: true,
                    minlength:20,
                    maxlength:600
                }
            },
            messages: {
                txt_user:{
                    required:'Bắt buộc nhập',
                    minlength : 'Độ dài tối thiểu 3 ký tự',
                    maxlength: 'Độ dài tối đa 100 ký tự'
                },
				txt_pass:{
                    required:'Bắt buộc nhập',
                    minlength : 'Độ dài tối thiểu 6 ký tự',
                    maxlength: 'Độ dài tối đa 100 ký tự'
                },
				txt_name:{
                    required:'Bắt buộc nhập',
                    minlength : 'Độ dài tối thiểu 10 ký tự',
                    maxlength: 'Độ dài tối đa 100 ký tự'
                },
                txt_price:{
                    required: "Bắt buộc nhập",
                    number :'Phải là số',
                    minlength: 'Độ dài tối thiểu 6 số',
                    maxlength: 'Độ dài tối đa 10 số'
                },
                txt_price_sale:{
                    number :'Phải là số',
                    greaterThan : 'Phải nhỏ hơn giá dịch vụ'
                },
                txt_sort_des:{
                    required: "Bắt buộc nhập",
                    minlength : 'Độ dài tối thiểu 20 ký tự',
                    maxlength: 'Độ dài tối đa 600 số'
                }
            }
        });
        if ($('.event-form').valid() == false) {
            return false;
        }
        $('.event-form').append('<div class="loading-ajax"></div>');
        $('.fileupload-buttonbar .start').trigger('click');
        setTimeout(function(){
           $('.event-form').submit();
        },2000);
    });
});
