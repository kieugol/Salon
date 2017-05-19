<?php
$_images = Config::get('site.url_image');
$_thumb = Config::get('site.url_thumb');
$_css = Config::get('site.url_css');
$_js = Config::get('site.url_js');
?>
@extends('user.main')
@section('css')
  <title>Page not found</title>
  <link rel="stylesheet" href="{{$_css . 'custom.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'bootstrap.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'theme-color.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'responsive.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'owl.carousel.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'jquery.bxslider.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'prettyPhoto.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'font-awesome.min.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'icomoon.css'}}" type="text/css">
@stop

@section('content')
<div class="cp_inner-banner">
  <div class="cp-inner-image">
    <img src="{{$_images}}/inner-404-1-img.jpg" alt="">
  </div>
  <div class="cp_breadcrumb-holder">
    <div class="container">
      <h1>404</h1>
    </div>
  </div>
</div>

<div class="cp_main">

  <section class="cp_p404-section1">
    <div class="container">
      <div class="cp-p404-content">
        <div class="cp-heding-style3">
          <h2>Opps! The <span>Page</span> is not Existed</h2>
        </div>
        <p>It looks like that page no longer exists. Would you like to go to <a href="{{Asset('/')}}">homepage</a> instead?</p>
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
@stop