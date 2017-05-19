<?php
$_images = Config::get('site.url_image');
$_thumb = Config::get('site.url_thumb');
$_css = Config::get('site.url_css');
$_js = Config::get('site.url_js');
?>
@extends('user.main')
@section('css')
<meta name="google-signin-client_id" content="614576660056-2falb7t5egt089ov0s4gaamfcmnodv85.apps.googleusercontent.com">
<title>Tuyển dụng</title>
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
@stop
@section('content')
<div class="cp_inner-banner">
  <div class="cp-inner-image">
    <img src="{{$_images}}inner-blog-img1.jpg" alt="">
  </div>
  <div class="cp_breadcrumb-holder">
    <div class="container">
      <h1>Tin tuyển dụng</h1>
      <ul class="breadcrumb">
        <li><a href="Asset('/')">Trang chủ</a></li>
        <li class="active">Tin tuyển dụng tại {{$province}} </li>
      </ul>
    </div>
  </div>
</div>


<div class="cp_main">
  <section class="cp_blog-section pd-tb80">
    <div class="container">
      <div class="row">

        <div class="col-md-9">
           <div class="cp-blog-outer">
                <!--  -->
                @foreach($listArticles as $articles)
                <div class="cp-blog-box">
                    <h2>{{$articles->title_articles}}</h2>
                    <ul class="cp_meta-listed">
                        <li><i class="fa fa-user"></i> <a href="#">{{$articles->name_salon}}</a></li>
                        <li><i class="fa fa-tag"></i> <span>{{$articles->name_province}}</span></li>
                        <li><i class="fa fa-calendar"></i> <span>{{date_format($articles->created_at,'d/m/Y')}}</span></li>
                    </ul>
                    <figure class="cp-thumb">
                       <img src="{{$_thumb.$articles->thumb_articles}}" alt="">
                       <span class="icon-holder"><i class="fa fa-file-image-o"></i></span>
                    </figure>
                    <div class="bottom-holder">
                        <p>{{$articles->introtext_articles}}</p>
                        <a href="{{Asset('/tuyen-dung').'/'.$articles->alias_province.'/'.$articles->alias_district .'/'.$articles->alias_articles.'/'.$articles->idArticles}}.html" class="cp-btn-style1">Đọc tiếp</a>
                    </div>
                </div>
                @endforeach
                <!--  -->

                    <div class="paginate text-center">{{$listArticles->links()}}</div>
            </div>
        </div>

          <div class="col-md-3">

            <aside class="cp_sidebar">
				<div class="cp-sidebar-box">
				<h3>Tin tức </h3>
				<ul class="cp-sidebar-format">
				 @foreach($list_news as $articles)
					<li>
					<div class="holder">
					  <span class="icon-holder">
						<i class="fa fa-file-text"></i>
					  </span>
					  <div class="text">
						<strong><a href="{{Asset('/tin-tuc').'/'.$articles->alias_articles_categories.'/'.$articles->alias_articles.'/'.$articles->idArticles}}.html">{{$articles->title_articles}}</a></strong>
						<ul class="cp_meta-listed">
						  <li><i class="fa fa-user"></i> <a href="#">{{$articles->related_articles}}</a></li>
						  <li><i class="fa fa-calendar"></i> <span>{{date_format($articles->created_at,'d/m/Y')}}</span></li>
						</ul>
					  </div>
					</div>
					</li>
				@endforeach
				</ul>
				</div>
				<div class="cp-sidebar-box">
					<h3>Liên kết</h3>
					<ul class="cp-sidebar-flickr">
						<li>
							<div class="thumb">
								<img src="{{$_images}}flickr-md-img-01.jpg" alt="">
								<a href="https://www.facebook.com/Chamsoctoctainha/" class="icon-link"><i class="fa fa-link"></i></a>
							</div>
						</li>
						<li>
							<div class="thumb">
								<img src="{{$_images}}flickr-md-img-02.jpg" alt="">
								<a href="https://www.facebook.com/Chamsoctoctainha/" class="icon-link"><i class="fa fa-link"></i></a>
							</div>
						</li>
						<li>
							<div class="thumb">
								<img src="{{$_images}}flickr-md-img-03.jpg" alt="">
								<a href="https://www.facebook.com/Chamsoctoctainha/" class="icon-link"><i class="fa fa-link"></i></a>
							</div>
						</li>
						<li>
							<div class="thumb">
								<img src="{{$_images}}flickr-md-img-04.jpg" alt="">
								<a href="https://www.facebook.com/Chamsoctoctainha/" class="icon-link"><i class="fa fa-link"></i></a>
							</div>
						</li>
					</ul>
				</div>
				<div class="cp-sidebar-box">
				<h3>Tags</h3>
				<ul class="cp-sidebar-tags">
				  <li><a href="#">Lips</a></li>
				  <li><a href="#">Women</a></li>
				  <li><a href="#">Make Up</a></li>
				  <li><a href="#">Hair Cut</a></li>
				  <li><a href="#">Hair Salon</a></li>
				  <li><a href="#">Face Facial</a></li>
				  <li><a href="#">Lips</a></li>
				  <li><a href="#">Women</a></li>
				  <li><a href="#">Make Up</a></li>
				</ul>
				</div>
            </aside>
          </div>

            </div>
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
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=257711184565499";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        @stop