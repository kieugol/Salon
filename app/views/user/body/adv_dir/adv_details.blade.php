@extends('user.main')
@section('seo')
   <title>{{$adv_details['title_adv_right']}}</title>
@stop
@section('script')
<link rel="stylesheet" type="text/css" href="<?php echo Asset('/')?>store/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Asset('/')?>store/css/edit.css">
    <link href="<?php echo Asset('/')?>store/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo Asset('/')?>store/css/slider-project/jquery.excoloSlider.css" rel="stylesheet">
     <link href="<?php echo Asset('/')?>store/css/vertical.css" rel="stylesheet">
    <!-- Jquery -->
    <script type="text/javascript" src="<?php echo Asset('/')?>store/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo Asset('/')?>store/js/jquery-1.11.1.min.js"></script>
  	<script type="text/javascript" src="<?php echo Asset('/')?>store/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo Asset('/')?>store/js/bootstrap.min.js"></script>
    <!-- Slider -->
    <script type="text/javascript" src="<?php echo Asset('/')?>store/js/slider-project/jquery.excoloSlider.min.js"></script>
     <script type="text/javascript" src="<?php echo Asset('/')?>store/js/scriptbreaker-multiple-accordion.js"></script>

@stop


@section('content')

<div class="container hc-body-content">
  
      @include('user.menu_left')
      <!--Main Content-->
      <div class=" hc-adv-top-content">
          <div class="breadcrumb">
            <ul>
              <li><a href="{{Asset('/')}}">Trang chủ</a></li>
               <li><a class="color-bread" href="#"><img src="{{Asset('store/images/breadcrumb.png')}}">&nbsp;{{$adv_details['title_adv_right']}}</a></li>
              <div class="clr"></div>
            </ul>
          </div>
          <section class="hc-content-camera">
            <div class="hc-advertise-content">
                {{$adv_details['text_adv_right']}}
            </div>
            <div class="clr"></div>
          </section>
      </div>
      <!--End Main Content./-->
      @include('user.adv_right')
    </div>
</div>
@stop