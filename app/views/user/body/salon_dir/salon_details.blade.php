<?php
$_images = Config::get('site.url_image');
$_thumb = Config::get('site.url_thumb');
$_css = Config::get('site.url_css');
$_js = Config::get('site.url_js');
?>
@extends('user.main')
@section('css')
  <title>{{$salon_details['name_salon']}}</title>
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
  <link rel="stylesheet" href="{{$_css . 'star-rating.css'}}" media="all" rel="stylesheet" type="text/css"/>

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
      <img src="{{$_thumb . $salon_details['banner_salon']}}" alt="">
    </div>
    <!-- <div class="cp_breadcrumb-holder">
      <div class="container">
        <ul class="breadcrumb">
          <li><a href="{{Asset('/')}}">Trang chủ</a></li>
          <li class="active">{{$salon_details['name_salon']}}</li>
        </ul>
      </div>
    </div> -->
  </div>
  <div class="cp_main">
    <section class="pt30">
      <div class="container">
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
              <li><a href="#section-4"><i class="fa fa-map-marker" aria-hidden="true"></i><span>Bản đồ</span></a></li>
              <li><a href="#section-5"><i class="fa fa-newspaper-o" aria-hidden="true"></i><span> Sự kiện</span></a></li>
               <!-- <li><a href="#section-6"><i class="fa fa-comments" aria-hidden="true"></i><span>Bình luận</span></a></li> -->
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
                          <li><a href="#"><img width="130" height="62" src="{{$_thumb . $gallery->name_file}}"/></a></li>
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
            <section id="section-5">
@if(count($list_event) >0 )
                  <div class="row">
                      <div class="span12">
                        <div id="event_same_cat" class="owl-carousel event">
                       @foreach($list_event as $event)
                         <?php $alias_event = Asset('/su-kien') . '/' . $event->alias_event_categories . '/' . $event->alias_event . '/' . $event->id_event . '.html'?>
                          <div class="item darkCyan">
                            <a href="{{$alias_event}}">
                              <img src="{{$_thumb . $event->thumb_event}}" alt="Touch">
                            </a>
                            <h3 style="font-size:20px">{{$event->name_event}}</h3>
        <?php
$service = new Service();
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
@endif
            </section>
          </div><!-- /content -->
        </div><!-- End tab -->
        <div style="margin-bottom: 20px; font-size: 10px">
            <form><input id="rating-input" value="{{$rating_details}}" type="number" /></form>
        </div>
          <?php $alias_salon_current = Asset('/salon') . '/' . $salon_details['alias_province'] . '/' . $salon_details['alias_district'] . '/' . $salon_details['alias_salon'] . '.html';?>
                <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                <div class="fb-comments" data-href="{{$alias_salon_current}}" data-width="100%" data-numposts="5"></div>
        <!-- Salon same province -->
      @if(count($list_salon_same_province) > 0)
        <div class="cp-heding-style1 mt40"><h2>Hệ thống salon khác tại {{$salon_details['name_district']}}</h2></div>
          <div class="row">
              <div class="span12 mb20">
                  <div id="owl-example3" class="owl-carousel">
                    @foreach($list_salon_same_province as $result)
                      <div class="item darkCyan">
                        <?php $alias_salon = Asset('/salon') . '/' . $result->alias_province . '/' . $result->alias_district . '/' . $result->alias_salon . '.html'?>
                          <a href="{{$alias_salon}}">
                            <img src="{{$_thumb . $result->thumb_salon}}" alt="Touch">
                          </a>
                          <a href="{{$alias_salon}}">
                            <h3>{{$result->name_district . ',' . $result->name_province}}</h3>
                          </a>
                          <h4>{{$result->address_salon}}</h4>
                      </div>
                    @endforeach
                  </div>
                </div>
            </div>
        </div>
      @endif
        <!-- End salon same province -->
      </div>
    </section>

  </div>
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
   <script type="text/javascript" src="{{$_js . 'star-rating.js'}}"></script>
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
    $("#owl-example3").owlCarousel({
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
      slideSpeed : 400,
      paginationSpeed : 800,
      rewindSpeed : 8000,

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
 <script>
    jQuery(document).ready(function () {

        $('#rating-input').rating({
              min: 0,
              max: 5,
              step: 1,
              size: 'lg',
              showClear: false
           });

        $('#btn-rating-input').on('click', function() {
            $('#rating-input').rating('refresh', {
                showClear:true,
                disabled: !$('#rating-input').attr('disabled')
            });
        });


        $('#rating-input').on('rating.change', function() {
            $.ajax({
                type: "POST",
                url: '{{Asset("/")}}salon/ajax-rating',
                data: {"rating": $('#rating-input').val(), 'salon_id' : {{$salon_details['id_salon']}}},
                dataType: "JSON",
                success: function(data){
                    $('#rating-input').val(data.rating);
                },
                error: function(){
                    alert('error');
                }
            });
            $('#rating-input').rating('refresh');
        });


        $('.rb-rating').rating({'showCaption':true, 'stars':'3', 'min':'0', 'max':'3', 'step':'1', 'size':'xs', 'starCaptions': {0:'status:nix', 1:'status:wackelt', 2:'status:geht', 3:'status:laeuft'}});
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
