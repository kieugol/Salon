<?php
$_images = Config::get('site.url_image');
$_thumb = Config::get('site.url_thumb');
$_css = Config::get('site.url_css');
$_js = Config::get('site.url_js');
$is_padding = 0;
$pdTop = '';
?>
@extends('user.main')
@section('css')
  <title>Sự kiện</title>
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
      <img src="{{$_images}}/inner-event-1-img.jpg" alt="">
    </div>
  </div>

<?php
$service = new Service();
?>
 <div class="cp_main">
  <!-- new style -->
    <section class="cp_gallery-section pd-tb80">
      <div class="container">
        <div class="cp-heding-style1"><h2>Sự kiện tại TPHCM</h2></div>
        <div class="cp_portfolioFilter">
          <a href="#" data-filter="*" class="current">Tất cả</a>
        @foreach($list_event_cat as $key => $eventcat)
          <a href="#" data-filter=".cp_filter{{$key}}">{{$eventcat[1]}}</a>
        @endforeach
        </div>
        <ul class="portfolioContainer pretty-gallery">
        @foreach($list_event as $event)
		<?php
			$alias_event = Asset('/su-kien') . '/' . $event->alias_event_categories . '/' . $event->alias_event . '/' . $event->id_event . '.html';

			// get price for event
			$arrIdService = explode(',', $event->id_service);
			$list_service = $service->getServiceForSalon($arrIdService);
			$price = 0;
			$str_percent = '';
			$price_sale = 0;
			if (count ($list_service) > 0) {
				foreach ($list_service as $k) {
					$price += $k->price_service;
				}
			} else {
				// calculating percent price
				$percent_current = 100 - $event->percent_event;
				$price_current = ($event->price_sale_event * $event->percent_event) / $percent_current;
				$price = round($price_current + $event->price_sale_event);
			}

			if ($event->price_sale_event > 0) {
				$str_percent = ' <span class="price_sale">' . number_format($price, 0, ",", ".") . 'VND</span>';
				$price_sale = number_format($event->price_sale_event, 0, ",", ".");
			} else {
				$price_sale = number_format($price, 0, ",", ".");
			}
		?>
          <li class="cp_filter{{$event->id_event_categories}}">
            <div class="cp_gallery-box event">
              <figure class="thumb">
                <img src="{{$_thumb . $event->thumb_event}}" style="max-width:263px" alt="">
                <figcaption>
                  <div class="holder">
                      <a href="{{$alias_event}}">
                        <i class="fa fa-search"></i>
                      </a>
                  </div>
                </figcaption>
              </figure>
              <div class="text">
                <strong><a href="{{$alias_event}}">{{$event->name_event}}</a></strong>
                <h4 class="price"><span>{{$price_sale}} VND{{$str_percent}}</span></h4>
                <h4>{{$event->name_salon}} <span style="font-size:15px">({{$event->name_district}})</span></h4>
              @if($event->price_sale_event > 0)
                 <div class="discounticonblk-phantram">
                    <span class="giovangtxtsp-phantram">Sale</span>
                    <span class="giovangdiscounttxtsp-phantram">{{$event->percent_event}}%</span>
                </div>
              @endif
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