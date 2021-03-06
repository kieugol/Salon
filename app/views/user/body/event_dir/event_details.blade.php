﻿<?php
$_images = Config::get('site.url_image');
$_thumb = Config::get('site.url_thumb');
$_css = Config::get('site.url_css');
$_js = Config::get('site.url_js');
$is_padding = 0;
$pdTop = '';
?>
@extends('user.main')
@section('css')
  <title>{{$event_details['name_event']}}</title>
    <link rel="stylesheet" href="{{$_css . 'custom.css'}}" type="text/css">
    <link rel="stylesheet" href="{{$_css . 'style-popup.css'}}" type="text/css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{$_css . 'theme-color.css'}}" type="text/css">
    <link rel="stylesheet" href="{{$_css . 'responsive.css'}}" type="text/css">
    <link rel="stylesheet" href="{{$_css . 'owl.carousel.css'}}" type="text/css">
    <link rel="stylesheet" href="{{$_css . 'jquery.bxslider.css'}}" type="text/css">
    <link rel="stylesheet" href="{{$_css . 'prettyPhoto.css'}}" type="text/css">
    <link rel="stylesheet" href="{{$_css . 'font-awesome.min.css'}}" type="text/css">
    <link rel="stylesheet" href="{{$_css . 'icomoon.css'}}" type="text/css">
    <!-- Owl Carousel Assets -->
      <link rel="stylesheet" href="{{$_css . 'owl-carousel/owl.carousel.css'}}">
      <link rel="stylesheet" href="{{$_css . 'owl-carousel/owl.theme.css'}}">
    <!-- Start slider-->
    <link rel="stylesheet" href="{{$_css . 'content_slider_style.css'}}" type="text/css"/>

    <!-- tab -->
  <link rel="stylesheet" href="{{$_css . 'demo-tab.css'}}" type="text/css"/>
  <link rel="stylesheet" href="{{$_css . 'component-tab.css'}}" type="text/css" />
  <link rel="stylesheet" href="{{$_css . 'vernisage-stack-v/engine1/style.css'}}" type="text/css"/>
  <style type="text/css" media="screen">
      .price{
        color: #d00009 !important;
        font-size: 20px;
        line-height: 32px;
      }
    iframe{
      width: 100%;
    }
    .product .summary .price .small-amount{
      font-size: 16px !important;
      margin-top: 10px;
    }
    </style>
       <!-- Owl Carousel Assets -->
    <style type="text/css" media="screen">
      .price{
        color: #d00009 !important;
        font-size: 20px;
        line-height: 32px;
      }
    iframe{
      width: 100%;
    }
    .product .summary .price .small-amount{
      font-size: 16px !important;
      margin-top: 10px;
    }
          .owl-item{
        padding: 0 5px;
      }
    </style>
@stop

@section('content')
    <div class="cp_inner-banner">
      <div class="cp-inner-image">
        <img src="{{$_images}}/inner-services-img.jpg" alt="">
      </div>
      <div class="cp_breadcrumb-holder">
        <div class="container">
          <h1>{{$event_details['name_event_categories']}}</h1>
        </div>
      </div>
    </div>

    <div class="cp_main">
      <section class="cp_product-section pd-tb80">
        <div class="container">
          <div class="product">
            <div class="row">
              <div class="col-md-6">
                  <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-bottom:20px">
                      <!-- Indicators -->
					<?php
						$total = count($list_gallery_event);
						$service = new Service();
						$arrIdService = explode(',', $event_details['id_service']);
						$list_service = $service->getServiceForSalon($arrIdService);
						$price = 0;
						$str_service = '';
						$str_percent = '';
						if (count ($list_service) > 0) {
							foreach ($list_service as $k) {
								$price += $k->price_service;
								$str_service .= $k->name_service . ', ';
							}
						} else {
							// calculating percent price
							$percent_current = 100 - $event_details['percent_event'];
							$price_current = ($event_details['price_sale_event'] * $event_details['percent_event']) / $percent_current;
							$price = $price_current + $event_details['price_sale_event'];
						}
	
					?>
                      <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        @for($i =1 ; $i < $total ; $i++)
                        <li data-target="#myCarousel" data-slide-to="{{$i}}"></li>
                        @endfor
                      </ol>
                      <!-- Wrapper for slides -->

                      <div class="carousel-inner" role="listbox">
					@if($total == 0)
						<div class="item active">
                          <img src="{{$_thumb . '/' . $event_details['thumb_event']}}" alt="Chania">
                        </div>
					@else
						@foreach ($list_gallery_event as $key => $result)
						<?php $active = $key == 0 ? ' active' : ''?>
                        <div class="item{{$active}}">
                          <img src="{{$_thumb . '/' . $result->name_file}}" alt="Chania">
                        </div>
						@endforeach
					@endif
                      </div>

                      <!-- Left and right controls -->
                      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
              </div>
              <div class="col-md-6">
                <div class="summary">
                  <h2>{{$event_details['name_event']}}</h2>
                  <p class="price">
				<?php
					// event registered by user
					if ($event_details['price_sale_event'] > 0) {
						$str_percent = ' <span>(-' . $event_details['percent_event'] . '%)</span>';
						$price_sale = number_format($event_details['price_sale_event'], 0, ",", ".");
					} else {
						$price_sale = number_format($price, 0, ",", ".");
					}
				?>
                    <span class="amount">{{$price_sale}} VND{{$str_percent}}</span>
                    @if($event_details['price_sale_event'] > 0)
                      <span class="small-amount">{{number_format($price ,0,",",".")}} VND</span>
                    @endif
                  </p>
                  <p>{{$event_details['short_desc_event']}}</p>
                  <form method="get" class="cart">
                    <div class="product-quantity">
                    </div>
                    <a href="{{Asset('su-kien/dat-hen') . '/' . $event_details['alias_event_categories'] . '/' .  $event_details['alias_event']  . '/' .  $event_details['id_event']}}.html" class="wocommerace-button">Đặt hẹn</a>
                  </form>
                  <ul class="product_meta">
                    <li>Salon: <a href="#">{{$event_details['name_salon']}}</a></li>
                    <li>Địa chỉ: <a href="#">{{$event_details['address_salon']}}</a></li>
		                <li>Số điện thoại: <a href="#">{{$event_details['phone_salon']}}</a></li>
                  </ul>
                </div>
              </div>
            </div><!-- row -->
            <!-- tab -->
            <div class="cp_tabs-box2">
              <ul class="nav nav-tabs tabs-style" role="tablist">
                <li class="active"><a href="#cp_tab1" role="tab" data-toggle="tab">Mô tả</a></li>
                <li><a href="#cp_tab2" role="tab" data-toggle="tab">Salon</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="cp_tab1">
                    {{$event_details['des_event']}}
                </div>
                <div class="tab-pane" id="cp_tab2">
                     <!-- salon -->
                    <div class="logo-tan">
                      <div class="logo-salon">
                          <img width="140" src="{{$_thumb . $salon_details['thumb_salon']}}" alt="author"></span>
                      </div>
                      <div class="cp-heding-style1 right-logo">
                        <h1>{{$salon_details['name_salon']}}</h1>
                      </div>
                      <div style="clear:both;"></div>
                    </div>
                    <!-- logo end -->
                      <!-- Start tab -->
                      <div id="tabs" class="tabs">
                        <nav>
                          <ul>
                            <li>
                              <a href="#section-1">
                                <i class="fa fa-file-image-o" aria-hidden="true"></i>
                                <span> Hình ảnh</span>
                              </a>
                            </li>
                            <li><a href="#section-2"><i class="fa fa-money" aria-hidden="true"></i><span> Bảng giá</span></a></li>
                            <li><a href="#section-3"><i class="fa fa-fax" aria-hidden="true"></i><span> Liên hệ</span></a></li>
                            <li><a href="#section-4"><i class="fa fa-map-marker" aria-hidden="true"></i><span> Maps</span></a></li>

                          </ul>
                        </nav>
                        <div class="content">
                          <section id="section-1">

                            <!-- Start slider stack -->
                              <div class="ruled1">
                                <!-- Start WOWSlider.com BODY section -->
                                <div id="wowslider-container1">
                                  <div class="ws_images">
                                    <ul>
                                      @foreach($list_gallery as $gallery)
                                        <li><img src="{{$_thumb . $gallery->name_file}}"  title=""/></li>
                                      @endforeach
                                    </ul>
                                  </div>
                                  <div class="ws_thumbs">
                                    <div>
                                      <ul>
                                       @foreach($list_gallery as $gallery)
                                        <a href="#"><img width="130" height="62" src="{{$_thumb . $gallery->name_file}}"/></a>
                                        @endforeach
                                      </ul>
                                    </div>
                                  </div>
                                  <div class="ws_shadow"></div>
                                </div>
                                <!-- End WOWSlider.com BODY section -->
                              </div><!-- end slider stack -->
                          </section>
                          <section id="section-2">{{$salon_details['price_salon']}}</section>

                          <section id="section-3">{{$salon_details['contact_salon']}}</section>
                          <section id="section-4">{{$salon_details['maps_salon']}}</section>
                        </div><!-- /content -->
                      </div><!-- /tabs -->
                    <!-- end salon -->
                </div>
              </div>
            </div>
             <?php $alias_salon_current = Asset('/su-kien') . '/' . $event_details['alias_province'] . '/' . $event_details['alias_event_categories'] . '/' . $event_details['alias_event'] . '.html';?>
                <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                <div class="fb-comments" data-href="{{$alias_salon_current}}" data-width="100%" data-numposts="5"></div>
            <!-- endtab -->
          </div><!--  product -->
        </div> <!-- container -->
      </section>
      <section class="cp_about-section mb20">
        <div class="container">
                      <!-- Start event relation-->
          <div class="cp-heding-style1"><h2>Các sự kiện khác</h2></div>
          <div class="row">
              <div class="span12">
                <div id="event_same_cat" class="owl-carousel event">
               @foreach($list_event_same_cat as $event)
                 <?php $alias_event = Asset('/su-kien') . '/' . $event->alias_event_categories . '/' . $event->alias_event . '/' . $event->id_event . '.html'?>
                  <div class="item darkCyan">
                    <a href="{{$alias_event}}">
                      <img src="{{$_thumb . $event->thumb_event}}" alt="Touch">
                    </a>
                    <h3 style="font-size:20px">{{$event->name_event}}</h3>
<?php
$arrIdService = explode(',', $event->id_service);
$list_service = $service->getServiceForSalon($arrIdService);
$price = 0;
$str_percent = '';
$price_sale = 0;
foreach ($list_service as $k) {
	$price += $k->price_service;
}

if ($event->price_sale_event > 0) {
	$str_percent = ' <span class="price_sale">' . number_format($price, 0, ",", ".") . 'VND</span>';
	$price_sale = number_format($event->price_sale_event, 0, ",", ".");
} else {
	$price_sale = number_format($price, 0, ",", ".");
}

?>
                    <h4 class="price"><span>{{$price_sale}} VND{{$str_percent}}</span></h4>
                    <h4>{{$event->name_salon}} <span style="font-size:15px">({{$event->name_district}})</span></h4>
                    @if($event->price_sale_event > 0)
                     <div class="discounticonblk-phantram" style="right:8px;">
                        <span class="giovangtxtsp-phantram">Sale</span>
                        <span class="giovangdiscounttxtsp-phantram">{{$event->percent_event}}%</span>
                    </div>
                    @endif
                  </div>
                @endforeach
                </div>
              </div>
          </div>
          <!-- End event relation-->
        </div>
      </section>
    </div> <!-- cp_main -->

@stop

@section('script')
  <script type="text/javascript" src="{{$_js . 'jQuery.1.11.3.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'a.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'html5shiv.js'}}"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="{{$_js . 'migrate.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'owl.carousel.min.js'}}"></script>
  <script src="{{$_js . 'cbpFWTabs-tab.js'}}"></script>
  <!-- Start Slider -->
  <script type="text/javascript" src="{{$_js . 'salon-gallery/wowslider.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'vernisage-stack-v/engine1/script.js'}}"></script>
  <script>
    new CBPFWTabs( document.getElementById('tabs'));
  </script>
  <script type="text/javascript">
          $("#event_same_cat").owlCarousel({
                 // Most important owl features
          items : 4,
          itemsCustom : false,
          itemsDesktop : [1199,4],
          itemsDesktopSmall : [980,3],
          itemsTablet: [768,2],
          itemsTabletSmall: false,
          itemsMobile : [479,1],
          singleItem : false,
          itemsScaleUp : false,

          //Basic Speeds
          slideSpeed : 200,
          paginationSpeed : 800,
          rewindSpeed : 1000,

          //Autoplay
          autoPlay : true,
          stopOnHover : true,

          // Navigation
          navigation : false,
          navigationText : ["prev","next"],
          rewindNav : true,
          scrollPerPage : true,

          //Pagination
          pagination : true,
          paginationNumbers: true,
        });
  </script>
  <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=257711184565499";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
@stop