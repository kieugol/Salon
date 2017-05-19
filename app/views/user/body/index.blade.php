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
    <link rel="stylesheet" href="{{$_css . 'style-popup.css'}}" type="text/css">
    <link rel="stylesheet" href="{{$_css . 'bootstrap.css'}}" type="text/css">
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
    <style type="text/css" media="screen">
      .owl-item{
        padding: 0 5px;
      }

    </style>
@stop
@section('content')
@include('user.slider')
<?php
$salon = new Salon();
$list_salon = $salon->getSalonDisplayHomePage();
$event = new EventTicket();
$list_event = $event->getEventDisplayHomePage();
$list_event_cat = array();
$scriptEventCat = array();
foreach ($list_event as $r) {
	if (!array_key_exists($r->id_event_categories, $list_event_cat)) {
		$list_event_cat[$r->id_event_categories] = array($r->alias_event_categories, $r->name_event_categories);
		$scriptEventCat[] = '#eventCat' . $r->id_event_categories;
	}
}
$scriptEventCat = implode(',', $scriptEventCat);

$service = new Service();

?>
  <div class="cp_main">
      <section class="cp_about-section pd-tb80">
        <div class="container">
        @foreach($list_event_cat as $id => $eventcat)
          <div class="cp-heding-style1 mt40"><h2>{{$eventcat[1]}}</h2></div>
          <div class="row">
            <div class="span12">
              <div id="eventCat{{$id}}" class="owl-carousel event">
                @foreach($list_event as $event)
                @if($event->id_event_categories == $id)
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
                @endif
                @endforeach
              </div>
            </div>
          </div>
        @endforeach
          <div class="cp-heding-style1 mt40"><h2>Hệ thống salon tóc</h2></div>
          <div class="row">
              <div class="span12">
                  <div id="owl-example3" class="owl-carousel">
                    @foreach($list_salon as $result)
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
      </section>
    </div>
    <section class="cp_blog-section pd-tb80">
        <div class="container">
            <div class="cp-heding-style1">
                <h2>Tin tuyển dụng</h2>
            </div>
        <?php $Hiring = new Hiring();
$list_hiring = $Hiring->getHiringIndex();?>
        @if(count($list_hiring) > 0)
            <ul class="pretty-gallery">
            @foreach($list_hiring as $hiring)
                <li class="blog-holder">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="cp-thumb">
                                <img src="{{$_thumb.$hiring->thumb_articles}}" alt="" height="250px">
                                <a href="{{$_thumb.$hiring->thumb_articles}}" class="zooming-holder" data-rel="prettyPhoto"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-holder">
                                <div class="top">
                                    <h4>{{$hiring->title_articles}}</h4>
                                    <ul class="cp-listed">
                                        <li><i class="fa fa-tag"></i>{{$hiring->name_province}}</li>
                                        <li><i class="fa fa-user"></i><a href="#">{{$hiring->name_salon}}</a>
                                        </li>
                                        <li><i class="fa fa-calendar"></i><a href="#">{{date('d/m/Y',strtotime($hiring->created_at))}}</a>
                                        </li>
                                    </ul>
                                </div>
                                <p>{{$hiring->introtext_articles}}</p>
                                <a href="{{Asset('/tuyen-dung').'/'.$hiring->alias_province.'/'.$hiring->alias_district.'/'.$hiring->alias_articles.'/'.$hiring->idArticles}}.html" class="cp-btn-style1">Đọc tiếp</a>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
            </ul>
        @endif
        </div>
    </section>
@if(Session::has('message'))
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document" style="margin-top:200px">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> <h4 class="modal-title" id="mySmallModalLabel">Thank you!</h4> </div>
        <div class="modal-body">{{Session::get('message')}}
        </div>
      </div>
    </div>
  </div>
@endif
@stop
@section('script')
  <script type="text/javascript" src="{{$_js . 'jQuery.1.11.3.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'jquery-1.11.1.min.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'html5shiv.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'jquery.content_slider.min.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'jquery.prettyPhoto.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'a.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'bootstrap.min.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'migrate.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'owl.carousel.min.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'jquery.bxslider.min.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'jquery.prettyPhoto.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'jquery.isotope.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'audioplayer.js'}}"></script>
  <script type="text/javascript" src="{{$_js . 'custom-script.js'}}"></script>
  <script type="text/javascript">
    $("{{$scriptEventCat}}").owlCarousel({
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

@if(Session::has('message'))
    jQuery(window).load(function(){
        jQuery('.bs-example-modal-sm').modal('show');
    });
@endif

  </script>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1803115506597924";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
@stop