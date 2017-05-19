<?php
$_images = Config::get('site.url_image');
$_thumb = Config::get('site.url_thumb');
$_css = Config::get('site.url_css');
$_js = Config::get('site.url_js');
?>
@extends('user.main')
@section('css')
  <title>{{$products_details['name_products']}}</title>
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
                <div class="product">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="product-slider-holder pretty-gallery">
                                <ul class="bxslider" id="product-slider">
                                @foreach($list_gallery as $gallery)
                                    <li>
                                        <a href="{{$_thumb.$gallery->name_file}}" data-rel="prettyPhoto"><img src="{{$_thumb.$gallery->name_file}}" alt="" />
                                        </a>
                                    </li>
                                @endforeach
                                </ul>
                                <div id="bx-pager">
                                @foreach($list_gallery as $key => $gallery)
                                    <a data-slide-index="{{$key}}" href="#"><img src="{{$_thumb.$gallery->name_file}}" alt=""/></a>
                                @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="summary">
                                <h2>{{$products_details['name_products']}}</h2>
                                <?php
$price = 0;
if ($products_details['is_sale_products'] > 0) {
	$str_percent = number_format($products_details['price_products'], 0, ",", ".") . ' đ';
	$price = number_format($products_details['is_sale_products'], 0, ",", ".");
} else {
	$price = number_format($products_details['price_products'], 0, ",", ".");
}

?>
                                <p class="price">
                                    <span class="amount">{{$price}} đ</span>
                                @if($products_details['is_sale_products'] > 0)

                                <span class="small-amount"><?php echo number_format($products_details['price_products'], 0, ",", ".") ?> đ</span>
                                @endif
                                </p>
                                <p>{{$products_details['short_desc_products']}}</p>
                                <ul class="product_meta">
                                    <li>Danh mục: <a href="#">{{$products_details['name_products_categories']}}</a>
                                    </li>
                                    <li>Xuất xứ: <a href="#">{{$products_details['name_products_madein']}}</a>
                                    </li>
                                    <li>Dung lượng: <a href="#">{{$products_details['size_products']}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="cp_tabs-box2">
                        <ul class="nav nav-tabs tabs-style" role="tablist">
                            <li><a href="#cp_tab1" role="tab" data-toggle="tab">Mô tả sản phẩm</a>
                            </li>
                            <li class="active"><a href="#cp_tab2" role="tab" data-toggle="tab">Bình luận</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane" id="cp_tab1">
                                <div class="tab-inner-holder">{{$products_details['des_products']}}</div>
                            </div>
                            <div class="tab-pane active" id="cp_tab2">
                                <div class="tab-inner-holder">
                                     <?php $alias_products = Asset('/san-pham') . '/' . $products_details['alias_products'] . '.html';?>
                                    <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                                    <div class="fb-comments" data-href="{{$alias_products}}" data-width="100%" data-numposts="5"></div>
                                </div>
                            </div>
                        </div>
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
  <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=257711184565499";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
@stop
