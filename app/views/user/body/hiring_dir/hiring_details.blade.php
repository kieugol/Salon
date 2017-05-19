<?php
$_images = Config::get('site.url_image');
$_thumb = Config::get('site.url_thumb');
$_css = Config::get('site.url_css');
$_js = Config::get('site.url_js');
?>
@extends('user.main')
@section('css')
  <meta name="google-signin-client_id" content="614576660056-2falb7t5egt089ov0s4gaamfcmnodv85.apps.googleusercontent.com">
  <title>{{$articles_details['title_articles']}}</title>
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
                                    <li class="active">Xem tin tuyển dụng</li>
                            </ul>
                    </div>
            </div>
    </div>


    <div class="cp_main">
        <section class="cp_contact-section pd-tb80">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-lg-9 col-sm-9 col-">
                        <div class="cp-blog-outer">

                            <div class="cp-blog-box">
                                <h2>{{$articles_details['title_articles']}}</h2>
                                <ul class="cp_meta-listed">
                                    <li><i class="fa fa-user"></i> <a href="#">{{$articles_details['name_salon']}}</a>
                                    </li>
                                    <li><i class="fa fa-map-marker"></i> <span>{{$articles_details['name_province']}}</span>
                                    </li>
                                    <li><i class="fa fa-calendar"></i> <span>{{date('d/m/Y',strtotime($articles_details['created_at']))}}</span>
                                    </li>
                                </ul>
								<div class="line-through"></div>
                                <div class="bottom-holder">{{$articles_details['fulltext_articles']}}</div>
                                 <?php $alias_news_current = Asset('/xem-tin-tuyen-dung') . '/' . $articles_details['alias_articlies'] . '.html';?>
                                <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                                <div class="fb-comments" data-href="{{$alias_news_current}}" data-width="100%" data-numposts="5"></div>
                            </div>
                        </div>

                    </div>
					
					          <div class="col-md-3">

            <aside class="cp_sidebar">
				<div class="cp-sidebar-box">
				<h3>Tin tuyển dụng khác</h3>
				<ul class="cp-sidebar-format">
				 @foreach($list_news as $articles)
					<li>
					<div class="holder">
					  <span class="icon-holder">
						<i class="fa fa-file-text"></i>
					  </span>
					  <div class="text">
						<strong><a href="{{Asset('/tuyen-dung').'/'.$articles->alias_province.'/'.$articles->alias_district .'/'.$articles->alias_articles.'/'.$articles->idArticles}}.html">{{$articles->title_articles}}</a></strong>
						<ul class="cp_meta-listed">
						  <li><i class="fa fa-tag"></i> <a href="#">{{$articles->name_district}}</a></li>
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
