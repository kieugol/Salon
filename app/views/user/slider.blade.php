<?php
$_images = Config::get('site.url_image');
$_thumb = Config::get('site.url_thumb');
$_css = Config::get('site.url_css');
$_js = Config::get('site.url_js');

$objSlider = new Slider();
$list_slider = $objSlider->getAllSlider();
?>
<!-- Start Slider-->
    <div class="cp_banner">
      <div id="cp_banner-slider" class="owl-carousel">
      @foreach($list_slider as $slider)
        <div class="item">
          <img src="{{$_thumb . $slider->image_slide_show}}" alt="">
          <div class="container">
            <div class="banner-caption">
              <h1>{{$slider->text1_slide_show}}</h1>
            </div>
          </div>
        </div>
      @endforeach
      </div>
    </div>
    <!-- Slider end -->