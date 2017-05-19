<?php
$_images = Config::get('site.url_image');
$_thumb = Config::get('site.url_thumb');
$_css = Config::get('site.url_css');
$_js = Config::get('site.url_js');
?>
@extends('user.main')
@section('css')
<title>Đăng ký sự kiện</title>
<link rel="stylesheet" href="{{$_css . 'custom.css'}}" type="text/css">
<link rel="stylesheet" href="{{$_css . 'bootstrap.css'}}" type="text/css">
<link rel="stylesheet" href="{{$_css . 'theme-color.css'}}" type="text/css">
<link rel="stylesheet" href="{{$_css . 'responsive.css'}}" type="text/css">
<link rel="stylesheet" href="{{$_css . 'owl.carousel.css'}}" type="text/css">
<link rel="stylesheet" href="{{$_css . 'jquery.bxslider.css'}}" type="text/css">
<link rel="stylesheet" href="{{$_css . 'prettyPhoto.css'}}" type="text/css">
<link rel="stylesheet" href="{{$_css . 'font-awesome.min.css'}}" type="text/css">
<link rel="stylesheet" href="{{$_css . 'icomoon.css'}}" type="text/css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="{{$_css}}upload_file/jquery.fileupload.css">
<link rel="stylesheet" href="{{$_css}}upload_file/jquery.fileupload-ui.css">
<style type="text/css" media="screen">
   .mce-tinymce button {
    background-color: transparent!important;
}
</style>
@stop

@section('content')
<div class="cp_inner-banner">

    <div class="cp-inner-image">
      <img src="{{$_images}}/inner-services-img.jpg" alt="">
  </div>
</div>
<div class="cp_main">

    <section class="cp_reservation-section pd-tb80">
        <div class="container">
            @if(Session::has('message'))
                <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                <div class="modal-dialog modal-sm" role="document" style="margin-top:200px">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> <h4 class="modal-title" id="mySmallModalLabel">Thank you!</h4> </div>
                    <div class="modal-body">{{Session::get('message')}}
                    </div>
                  </div>
                </div>
              </div>
            @endif
            <div class="cp-heding-style1 mt40"><h2>Đăng ký sự kiện</h2></div>
            @if ($errors->count() > 0 )
                <p><b>The following errors have occurred:</b></p>
                <ul>
                @foreach( $errors->all() as $message )
                  <li>{{ $message }}</li>
                @endforeach
                </ul>
                <br>
            @endif
            <div class="cp_tabs-box2">
                <ul class="nav nav-tabs tabs-style" role="tablist">
                    <li class="active"><a href="#cp_tab1" id="description" role="tab" data-toggle="tab">Mô tả</a></li>
                    <li><a href="#cp_tab2" id="album" role="tab" data-toggle="tab">Bộ sưu tập ảnh</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="cp_tab1">
                        <form class="cp-form-box event-form" enctype="multipart/form-data" method="post" accept-charset="UTF-8" action="{{Asset('/customer/insert-su-kien')}}" id="form-ticket">
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-xs-12">
                                    <div class="holder">
									    <input type="hidden" name="is_salon" id="is_salon" value="0"/>
                                        <label><i class="text-danger">(Vui lòng đăng nhập tài khoản của bạn để đăng ký sự kiện*)</i></label>
                                        <input type="hidden" name="obj_form" id="obj_form" value="event-form">
                                    </div>
                                    <div class="holder user-info" >
                                        <label>Tên tài khoản*</label>
                                        <input type="text" name="txt_user" id="txt_user" placeholder="Nhập tên tài khoản salon của bạn"/>
                                        <br>
                                        <br>
                                        <label>Mật khẩu*</label>
                                        <input type="password" name="txt_pass" id="txt_pass" placeholder="Nhập mật khẩu"/>
                                    </div>
                                    <div class="holder">
                                        <label>Thumbnail sự kiện* (Chấp nhận ảnh PNG,GIF,JPEG,JPG)</label>
                                        <input type="file" name="thumb_logo"/>
                                    </div>
                                    <div class="holder">
                                        <label>Tên sự kiện*</label>
                                        <input type="text"  name="txt_name" id="txt_name" placeholder="Nhập tên sự kiện">
                                    </div>
                                    <div class="holder">
                                        <label>Danh mục sự kiện *</label>
                                        <select class="form-control" id="sl_categories" name="sl_categories">
                                           @foreach($list_eventcat as $eventcat)
                                                <option value="{{$eventcat->id_event_categories}}">{{$eventcat->name_event_categories}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="holder">
                                        <label>Giá dịch vụ</label>
                                        <input type="text" name="txt_price" id="txt_price" placeholder="Nhập giá dịch vụ">
                                    </div>
                                    <div class="holder">
                                        <label>Giảm giá còn</label>
                                        <input type="text" name="txt_price_sale" id="txt_price_sale" placeholder="Nhập giá đã được giảm">
                                    </div>
                                    <div class="holder">
                                        <label>Giới thiệu ngắn</label>
                                        <textarea name="txt_sort_des"  id="txt_sort_des" rows="5"></textarea>
                                    </div>
                                    <div class="holder">
                                        <label>Mô tả*</label>
                                        <textarea name="txt_des" id="txt_des" rows="5"></textarea>
                                    </div>
                                </div> <!-- col -->
                            </div> <!-- row -->
                        </form>
                    </div> <!-- tab -->
                    <div class="tab-pane" id="cp_tab2">
                        <div class="mt40">
                            <!-- The file upload form used as target for the file upload widget -->
                            <form id="fileupload" action="{{Asset('/customer/up-load-image')}}" method="POST" enctype="multipart/form-data">
                                <!-- Redirect browsers with JavaScript disabled to the origin page -->
                                <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                <div class="row fileupload-buttonbar">
                                    <div class="col-lg-7">
                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                        <span class="btn btn-success fileinput-button">
                                            <i class="glyphicon glyphicon-plus"></i>
                                            <span>Thêm ảnh...</span>
                                            <input type="file" name="files[]" multiple>
                                        </span>
                                        <button type="submit" class="btn btn-primary start hide">
                                        </button>
                                        <!-- The global file processing state -->
                                        <span class="fileupload-process"></span>
                                    </div>
                                    <!-- The global progress state -->
                                    <div class="col-lg-5 fileupload-progress fade">
                                        <!-- The global progress bar -->
                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                        </div>
                                        <!-- The extended global progress state -->
                                        <div class="progress-extended">&nbsp;</div>
                                    </div>
                                </div>
                                <!-- The table listing the files available for upload/download -->
                                <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                            </form>
                        </div>
                    </div><!-- tab -->
                </div>
            </div>
            <div class="holder cp-form-box">
                <button type="button" id="bt-submit-event" value="">Đăng ký<i class="fa fa-angle-right"></i></button>
            </div>
        </div>
    </section>
</div>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document" style="margin-top:200px">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title" id="mySmallModalLabel" style="color:#d00009">Thông báo!</h4> </div>
        <div class="modal-body" style="color:#d00009">Tài khoản salon không tồn tại, vui lòng kiểm tra lại!</div>
      </div>
    </div>
  </div>

@stop

@section('script')
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start hide" disabled>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Hủy</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger"></span> </div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}

            {% } %}
        </td>
    </tr>
{% } %}
</script>
<script type="text/javascript" src="{{$_js . 'html5shiv.js'}}"></script>
<script type="text/javascript" src="{{$_js . 'jQuery.1.11.3.js'}}"></script>
<script type="text/javascript" src="{{$_js . 'bootstrap.min.js'}}"></script>
<script type="text/javascript" src="{{$_js . 'migrate.js'}}"></script>
<script type="text/javascript" src="{{$_js . 'jquery.bxslider.min.js'}}"></script>
<script type="text/javascript" src="{{$_js . 'jquery.isotope.js'}}"></script>
<script type="text/javascript" src="{{$_js . 'jquery.prettyPhoto.js'}}"></script>
<script type="text/javascript" src="{{$_js . 'custom-script.js'}}"></script>
<script type="text/javascript" src="{{$_js .'jquery.validate.js'}}"></script>
<script src="{{$_js}}upload_file/vendor/jquery.ui.widget.js"></script>
  <!-- Plugin TinyCME -->
<script src="{{Asset('/')}}store/tinymce/tinymce.min.js" type="text/javascript"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->
<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="{{$_js}}upload_file/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="{{$_js}}upload_file/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="{{$_js}}upload_file/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="{{$_js}}upload_file/jquery.fileupload-image.js"></script>
<!-- The File Upload validation plugin -->
<script src="{{$_js}}upload_file/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="{{$_js}}upload_file/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="{{$_js}}upload_file/main.js"></script>
 <script type="text/javascript" >
        var url = "{{Asset('/')}}store/";
         var base_url = "{{Asset('/')}}";
       // alert(base_url);
        tinymce.init({
            selector: "textarea#txt_des",
            theme: "modern",
            height: 200,
            relative_urls: false,
            remove_script_host: false,
            plugins: [
                 "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                 "save table contextmenu directionality emoticons template paste textcolor"
           ],
            fontsize_formats: "8pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 18pt 24pt 26pt 36pt",
           //content_css: "css/content.css",
            toolbar: "insertfile undo redo | styleselect | bold italic | fontselect |  fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
           style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ]
        });
        $('#click-here').click(function(event) {
            $('.user-info').slideDown();
            return false;
        });

        $('#txt_pass').focusout(function(event) {
            var user = $('#txt_user').val();
            var pass = $('#txt_pass').val();
            if (user != '' && pass != '') {
                $.ajax({
                url: base_url + 'customer/check-user-salon',
                type: 'POST',
                dataType: 'JSON',
                data: {txt_user: user, txt_pass: pass},
                success:function(data){
                    if (data.error == true) {
                        jQuery('.bs-example-modal-sm').modal('show');
                        $('#txt_pass').val('');
                        return false;
                    }
                }
                })
            }
        });
     </script>
@stop