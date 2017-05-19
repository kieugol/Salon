@extends('user.main')
@section('seo')
   <meta name="keywords" content="{{$menus['meta_key_menus']}}">
   <meta name="title" content="{{$menus['meta_title_menus']}}">
   <meta name="description" content="{{$menus['meta_desc_menus']}}">
   <title>{{$menus['title_menus']}}</title>
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
               <li><a href="{{Asset('/').$menus['alias_menus'].'.html'}}"><img src="{{Asset('store/images/breadcrumb.png')}}">&nbsp;{{$menus['title_menus']}}</a></li>
              <div class="clr"></div>
            </ul>
          </div>
      </div>
      <!--End Main Content./-->
      @include('user.adv_right')
</div>
@stop