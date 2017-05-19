<?php
$_images = Config::get('site.url_image');
$_thumb = Config::get('site.url_thumb');
$_css = Config::get('site.url_css');
$_js = Config::get('site.url_js');
?>
@extends('user.main')
@section('css')
  <meta name="google-signin-client_id" content="614576660056-2falb7t5egt089ov0s4gaamfcmnodv85.apps.googleusercontent.com">
  <title>Đăng nhập</title>
  <link rel="stylesheet" href="{{$_css . 'custom.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'bootstrap.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'theme-color.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'responsive.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'owl.carousel.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'jquery.bxslider.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'prettyPhoto.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'font-awesome.min.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'icomoon.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'bootstrap-social.css'}}" type="text/css">
  <style type="text/css" media="screen">
  	.mce-tinymce button {
  		background-color: transparent!important;
  	}
  </style>
@stop

@section('content')

		<div class="cp_inner-banner">
			<div class="cp-inner-image">
				<img src="{{$_images}}inner-contact-img1.jpg" alt="">
			</div>
			<div class="cp_breadcrumb-holder">
				<div class="container">
					<h1></h1>
					<ul class="breadcrumb">
						<li><a href="{{Asset('/')}}">Home</a></li>
						<li class="active">Đăng tin</li>
					</ul>
				</div>
			</div>
		</div>


		<div class="cp_main">

			<section class="cp_contact-section pd-tb80">
				<div class="container">
            <h2>Đăng tin tuyển dụng</h2>
            <br>
            @if(Session::has('message'))
                <div class="alert alert-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  {{Session::get('message')}}
                </div>
            @endif
					<form class="cp-form-box" enctype="multipart/form-data" method="post" accept-charset="UTF-8" action="{{Asset('/article/insert-hiring')}}" id="form-ticket">
					<div class="row">
						<div class="col-md-6 col-lg-6 col-xs-12">
								<div class="holder">
									<label>Bạn là salon*</label>
									 <select class="form-control" id="sl_salon" name="sl_salon">
                      @foreach($list_salon as $salon)
                          <option value="{{$salon->id_salon}}">{{$salon->name_salon}}({{$salon->name_province}})</option>
                      @endforeach
                    </select>
								</div>
								<div class="holder">
									<label>Tiêu đề*</label>
									<input type="text" name="title" placeholder="Subject">
								</div>
								<div class="holder">
									<label>Ảnh thumb</label>
									<input type="file" name="thumb"/>
								</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<br><br>
              <div class="holder">
                <label>Mô tả ngắn</label>
                <textarea name="short_content" id="short_content" placeholder="Mô tả ngắn"></textarea>
              </div>
							<div class="holder">
								<label>Nội dung *</label>
								<textarea name="content" id="content" placeholder="Nội dung"></textarea>
							</div>
							<div class="holder">
								<button type="submit" value="">Gửi đi<i class="fa fa-angle-right"></i></button>
							</div>
						</div>
					</div>
					</form>
				</div>
			</section>

		</div>
@stop

@section('script')
  <script type="text/javascript" src="{{$_js . 'html5shiv.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'jQuery.1.11.3.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'bootstrap.min.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'migrate.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'owl.carousel.min.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'jquery.bxslider.min.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'jquery.isotope.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'jquery.prettyPhoto.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'custom-script.js'}}"></script>
  <script type="text/javascript" src="{{$_js .'jquery.validate.js'}}"></script>
  <!-- Plugin TinyCME -->
<script src="{{Asset('/')}}store/tinymce/tinymce.min.js" type="text/javascript"></script>
<!-- Upload file -->
 <script src="{{Asset('')}}store/admin/js/jquery.uploadfile.min.js"></script>
  <script type="text/javascript">
jQuery(document).ready(function(e) {
        $('#form').validate({
            rules: {
                name:{
                    required: true,
                    maxlength:50
                },
                address:{
                    required: true,
                    maxlength:100
                },
                phone:{
                    required: true,
                    number:true
                },
                email:{
                    required: true,
                    email: true
                },
                title: {
  					required: true,
  					maxlength:100
                },
                content : {
                	required: true
                }
            },
            messages: {
            }
        });
});
</script>
 <script type="text/javascript" >
        var url = "{{Asset('/')}}store/";
       // alert(base_url);
        tinymce.init({
            selector: "textarea#content",
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
     </script>

@stop