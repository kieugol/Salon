<?php

$_images = Config::get('site.url_image');

$_thumb = Config::get('site.url_thumb');

$_css = Config::get('site.url_css');

$_js = Config::get('site.url_js');

?>

@extends('user.main')

@section('css')

  <title>Địa chỉ làm tóc</title>

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

      <img src="{{$_images}}/inner-services-img.jpg" alt="">

    </div>



<!--     <div class="cp_breadcrumb-holder">

      <div class="container">

        <ul class="breadcrumb">

          <li><a href="#">Trang chủ</a></li>

          <li><a href="#">Hệ thống salon tóc</a></li>

          <li class="active"><a href="#">TP Hồ Chí Minh</a></li>

        </ul>

      </div>

    </div> -->



  </div>





  <div class="cp_main">

    <section class="cp_gallery-section pd-tb80">

      <div class="container">

        <div class="cp-heding-style1"><h2>Hệ thống salon tóc {{$name_province}}</h2></div>

        <div class="cp_portfolioFilter">

          <a href="#" data-filter="*" class="current">Tất cả</a>

        @foreach($list_district as $key => $district)

          <a href="#" data-filter=".cp_filter{{$key}}">{{$district[1]}}</a>

        @endforeach

        </div>

        <ul class="portfolioContainer pretty-gallery">

        @foreach($list_salon as $salon)
 <?php $alias_salon = Asset('/salon') . '/' . $salon->alias_province . '/' . $salon->alias_district . '/' . $salon->alias_salon . '.html'?>
          <li class="cp_filter{{$salon->id_district}}">

            <div class="cp_gallery-box">

              <figure class="thumb">

                <img src="{{$_thumb . $salon->thumb_salon}}" alt="">

                <figcaption>
                  <div class="holder">
                      <a href="{{$alias_salon}}">
                        <i class="fa fa-search"></i>
                      </a>
                  </div>

                </figcaption>

              </figure>

              <div class="text">

                <strong><a href="{{$alias_salon}}">{{$salon->name_salon}}</a></strong>

                <span>{{$salon->address_salon}}</span>

              </div>

            </div>

          </li>

        @endforeach

        </ul>

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