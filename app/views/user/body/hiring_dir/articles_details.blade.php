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
@stop
@section('content')
<div class="cp_inner-banner">
	<div class="cp-inner-image">
		<img src="{{$_images}}inner-blog-img1.jpg" alt="">
	</div>
	<div class="cp_breadcrumb-holder">
		<div class="container">
			<h1>Tin tức</h1>
			<ul class="breadcrumb">
				<li><a href="Asset('/')">Trang chủ</a></li>
				<li class="active">Tin tức</li>
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
						<div class="cp-blog-box">
							<h2 style="padding-bottom: 5px;border-bottom: 1px solid #333;">{{$articles_details['title_articles']}}</h2>
							<ul class="cp_meta-listed">
								<li>Đăng bởi <a href="#">{{$articles_details['related_articles']}}</a></li>
								<li>Danh mục <span>{{$articles_details['name_articles_categories']}}</span></li>
								<li>Ngày đăng <span>{{date_format($articles_details['created_at'],'j F Y')}}</span></li>
							</ul>
							<div class="bottom-holder">
								<p>{{$articles_details['fulltext_articles']}}</p>
							</div>
							   <?php $alias_articles_current = Asset('/tin-tuc') . '/' . $articles_details['alias_articles_categories'] . '/' . $articles_details['alias_articles'] . '/' . $articles_details['idArticles'] . '.html';?>
                			<div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                			<div class="fb-comments" data-href="{{$alias_articles_current}}" data-width="100%" data-numposts="5"></div>
						</div>
						<!--  -->
					</div>
				</div>

				<div class="col-md-3">

					<aside class="cp_sidebar">
						<div class="cp-sidebar-box">
							<h3>Tin tức khác</h3>
							<ul class="cp-sidebar-format">
								@foreach($listArticles as $articles)
								<li>
									<div class="holder">
										<span class="icon-holder">
											<i class="fa fa-file-text"></i>
										</span>
										<div class="text">
											<strong><a href="{{Asset('/tin-tuc').'/'.$articles->alias_articles_categories.'/'.$articles->alias_articles}}.html">{{$articles->title_articles}}</a></strong>
											<ul class="cp_meta-listed">
												<li>Đăng bởi <a href="#">{{$articles->related_articles}}</a></li>
												<li>Ngày <span>{{date_format($articles->created_at,'j F Y')}}</span></li>
											</ul>
										</div>
									</div>
								</li>
								@endforeach
							</ul>
						</div>

						<div class="cp-sidebar-box">
							<h4>Tags</h4>
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