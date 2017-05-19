<?php
$_images = Config::get('site.url_image');
$_thumb = Config::get('site.url_thumb');
$_css = Config::get('site.url_css');
$_js = Config::get('site.url_js');
?>
@extends('user.main')
@section('css')
  <title>Sản phẩm</title>
  <link rel="stylesheet" href="{{$_css . 'custom.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'bootstrap.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'theme-color.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'responsive.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'owl.carousel.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'jquery.bxslider.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'prettyPhoto.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'font-awesome.min.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'icomoon.css'}}" type="text/css">
  <!-- tab -->
  <link rel="stylesheet" href="{{$_css . 'demo-tab.css'}}" type="text/css"/>
  <link rel="stylesheet" href="{{$_css . 'component-tab.css'}}" type="text/css" />
  <link rel="stylesheet" href="{{$_css . 'vernisage-stack-v/engine1/style.css'}}" type="text/css"/>
@stop
@section('content')
        <div class="cp_inner-banner">
            <div class="cp-inner-image">
                <img src="{{$_images . 'inner-product-2-img.jpg'}}" alt="">
            </div>
            <div class="cp_breadcrumb-holder">
                <div class="container">
                    <h1>Mỹ phẩm làm đẹp tóc</h1>
                    <ul class="breadcrumb">
                        <li><a href="{{Asset('/')}}">Home</a></li>
                        <li class="active">Sản phẩm</li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="cp_main">

            <section class="cp_product-section pd-tb80">
                <div class="container">
                    <ul class="row">
                    @foreach($list_products as $products)
                        <li class="col-md-3 col-sm-6">
                            <div class="cp-pro-item">
                                <figure class="cp-thumb">
                                    <img src="{{$_thumb.$products->thumb_products}}" alt="">
                                    <figcaption class="caption">
                                        <?php $alias =  Asset('/san-pham').'/'. $products->alias_products.'/'.$products->idProducts.'.html'?>
                                        <ul class="icons-holder">
                                            <li class="readmore-hold">
                                                <a href="{{$alias}}">
                                                    <i class="fa fa-share-square"></i>
                                                    <span>Xem tiếp</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </figcaption>
                                </figure>
                                <?php
                                    $str_percent = '';
                                    $price = 0;
                                    if ($products->is_sale_products > 0) {
                                        $str_percent = ' <span>' . number_format($products->price_products, 0, ",", ".") . ' đ</span>';
                                        $price = number_format($products->is_sale_products, 0, ",", ".");
                                    } else {
                                        $price = number_format($products->price_products, 0, ",", ".");
                                    }

                                ?>
                                <div class="text-holder">
                                    <span class="pro-title"><a href="{{$alias}}">{{$products->name_products}}</a></span>
                                    <em class="pro-price">{{$price}} đ   {{$str_percent}}</em>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    </ul>
                    <div class="text-center"><?php echo $list_products->links();?></div>
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
  <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=257711184565499";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
@stop
