<?php
$_images = Config::get('site.url_image');
$_thumb = Config::get('site.url_thumb');
$_css = Config::get('site.url_css');
$_js = Config::get('site.url_js');
?>
@extends('user.main')
@section('css')
    <title>Đăng ký thành viên</title>
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
        <img src="{{$_images}}/inner-login-img.jpg" alt="">
    </div>
    <div class="cp_breadcrumb-holder">
        <div class="container">
            <h1>Đăng ký thành viên</h1>
            <ul class="breadcrumb">
                <li><a href="{{Asset('/')}}">Home</a>
                </li>
                <li class="active">Đăng ký thành viên</li>
            </ul>
        </div>
    </div>
</div>

<div class="cp_main">

  @if(Session::has('message'))
      <?php echo Session::get('message'); ?>
  @endif
  @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
    <section class="cp_login-section pd-tb80">
        <div class="container">
            <form method="post" accept-charset="UTF-8" action="{{Asset('/member/insert')}}" id="form-ticket" class="wocommerace-form">
                <div class="cp-heading-holder">
                    <h2>Đăng ký thành viên để nhận các dịch vụ ưu đãi</h2>
                </div>
                <ul class="row">
                    <li class="col-lg-6 col-md-6 col-xs-12">
                        <div class="holder">
                            <label>Họ tên *</label>
                            <input type="text" name="fullname" placeholder="Họ tên">
                        </div>
                    </li>
                </ul>
                <ul class="row">
                    <li class="col-lg-6 col-md-6 col-xs-12">
                        <div class="holder">
                            <label>Địa chỉ *</label>
                            <input type="text" name="address" placeholder="nhập địa chỉ">
                        </div>
                    </li>
                </ul>
                <ul class="row">
                    <li class="col-md-6">
                        <div class="holder">
                            <label>Số điện thoại *</label>
                            <input type="text" name="phone" placeholder="Số điện thoại">
                        </div>
                    </li>
                </ul>
                <ul class="row">
                    <li class="col-md-6">
                        <div class="holder">
                            <label>Địa chỉ email *</label>
                            <input type="text" name="email" placeholder="email@example.com">
                        </div>
                    </li>
                </ul>
                <ul class="row">
                    <li class="col-md-6">
                        <div class="holder">
                            <label>Mật Khẩu *</label>
                            <input type="password" name="password"  id="password" placeholder="Mật khẩu">
                        </div>
                    </li>
                </ul>
                <ul class="row">
                    <li class="col-md-6">
                        <div class="holder">
                            <label>Xác nhận mật khẩu*</label>
                            <input type="password" name="confirm_pass" id="confirm_pass" placeholder="Xác nhận mật khẩu">
                        </div>
                    </li>
                </ul>
                <ul class="row">
                    <li class="col-md-6">
                        <div class="login-row">
                            <p>
                                <button type="submit" class="wocommerace-button">Đăng ký <i class="fa fa-angle-right"></i>
                                </button>
                            </p>
                        </div>
                    </li>
                </ul>
            </form>
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
  <script type="text/javascript" src="{{$_js .'jquery.validate.js'}}"></script>
  <script type="text/javascript">
      jQuery(document).ready(function(e) {
        $('#form-ticket').validate({
            rules: {
                fullname:{
                    required: true,
                    minlength :10,
                    maxlength:50
                },
                address:{
                    required: true,
                    maxlength:100
                },
                phone:{
                    required: true,
                    number:true
                },
                email:{
                    required: true,
                    email: true
                },
                password :{
                    required: true,
                    minlength :6,
                    maxlength:20
                },
                confirm_pass: {
                  equalTo:"#password",
                }
            },
            messages: {
            }
        });
    /*end đăng ký*/
});
</script>
@stop