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
  <title>Đăt vé {{$event_details['name_event']}}</title>
  <link rel="stylesheet" href="{{$_css . 'custom.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'bootstrap.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'theme-color.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'responsive.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'owl.carousel.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'jquery.bxslider.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'prettyPhoto.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'font-awesome.min.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'icomoon.css'}}" type="text/css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@stop

@section('content')
      <div class="cp_inner-banner">
      <div class="cp-inner-image">
        <img src="{{$_images}}/inner-reservation-img.jpg" alt="">
      </div>
      <div class="cp_breadcrumb-holder">
        <div class="container">
          <h1>Đặt hẹn</h1>
        </div>
      </div>
    </div>


    <div class="cp_main">

      <section class="cp_reservation-section pd-tb80">
        <div class="container">
          <form method="post" accept-charset="UTF8" action="{{Asset('/event-ticket/book-ticket')}}" id="form-ticket" class="wocommerace-form reservation-form">
            <div class="cp-heading-holder mt40">
              <h1>Đặt hẹn sự kiện</h1>
            </div>
            <ul  class="row">
              <li class="col-md-12 col-sm-12 col-xs-12">
                <div class="holder" style="margin-bottom:20px">
                <label style="font-size:16px;font-style:italic;">{{$event_details['name_event_categories']}} <span style="color:#d00009">({{$event_details['name_event']}})</span></label>
                 <input type="hidden" name="id_event" value="{{$event_details['id_event']}}">
                </div>
              </li>
            </ul>
            <ul  class="row">
              <li class="col-md-12 col-sm-12 col-xs-12">
                <div class="" style="margin-bottom:20px">
                <label for="cb11" class="" style="margin-right:10px;font-size:16px;font-style:italic;">Chọn dịch vụ:</label>
                  <label for="cb11" class="" style="margin-right:10px;">Cắt
                    <input type="checkbox" name="sv_ticket[]" value="Cắt"  id="cb11">
                  </label>
                  <label for="cb22" class="" style="margin-right:10px">Uốn
                    <input type="checkbox" name="sv_ticket[]" value="Uốn"   id="cb22">
                  </label>
                  <label for="cb33" class="" style="margin-right:10px">Duỗi
                    <input type="checkbox" name="sv_ticket[]" value="Duỗi" id="cb33">
                  </label>
                   <label for="cb44" class="" style="margin-right:10px">Nhuộm
                    <input type="checkbox" name="sv_ticket[]" value="Nhuộm" id="cb44">
                  </label>
                </div>
              </li>
            </ul>
            <ul class="row">
              <li class="col-md-8">
                <ul class="row">
                  <li class="col-md-6 col-sm-12 col-xs-12">
                    <div class="holder">
                      <input type="text" placeholder="" value="{{$event_details['name_salon']}}({{$event_details['name_district'] . ',' . $event_details['name_province']}})" readonly="true">
                    </div>
                  </li>
                  <li class="col-md-6 col-sm-12 col-xs-12">
                    <div class="holder">
                      <input type="text" name="name_ticket" placeholder="Họ tên">
                    </div>
                  </li>
                  <li class="col-md-6 col-sm-12 col-xs-12">
                    <div class="holder">
                      <input type="text" name="email_ticket" placeholder="Email">
                    </div>
                  </li>
                  <li class="col-md-6 col-sm-12 col-xs-12">
                    <div class="holder">
                      <input type="text" name="phone_ticket" placeholder="Số điện thoại">
                    </div>
                  </li>
<!--                  <li class="col-md-6 col-sm-12 col-xs-12">
                    <ul class="row">
                      <li class="col-md-7 col-sm-6">
                        <div class="holder">
                          <input type="text" name="date_ticket" id="date_ticket" placeholder="Ngày đặt hẹn">
                        </div>
                      </li>
                      <li class="col-md-5 col-sm-6">
                        <div class="holder">
                          <select name="hour_ticket" class="form-control">
                            <option value="8 AM">8 AM</option>
                            <option value="9 AM">9 AM</option>
                            <option value="10 AM">10 AM</option>
                            <option value="11 AM">11 AM</option>
                            <option value="12 AM">12 AM</option>
                            <option value="1 PM">1 PM</option>
                            <option value="2 PM">2 PM</option>
                            <option value="3 PM">3 PM</option>
                            <option value="4 PM">4 PM</option>
                            <option value="5 PM">5 PM</option>
                            <option value="6 PM">6 PM</option>
                            <option value="7 PM">7 PM</option>
                            <option value="8 PM">8 PM</option>
                          </select>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>-->
              <li class="col-md-12 col-sm-12 col-xs-12">
                <div class="holder">
                  <textarea name="message_ticket">Message</textarea>
                </div>
              </li>
              <li class="col-md-12 col-sm-12 col-xs-12">
                <div class="holder">
                  <button type="submit" class="wocommerace-button">Gửi đi<i class="fa fa-angle-right"></i></button>
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
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript" src="{{$_js .'jquery.validate.js'}}"></script>
  <script type="text/javascript">
            jQuery(function() {
                $("#date_ticket").datepicker({dateFormat: 'dd/mm/yy'});
            });
                    jQuery(document).ready(function(e) {
        $('#form-ticket').validate({
            rules: {
                name_ticket:{
                    required: true
                },
                addr_ticket:{
                    required: true,
                },
                phone_ticket:{
                    required: true,
                    number:true
                },
                email_ticket:{
                    required: true,
                    email: true
                },
                date_ticket :{
                    required: true,
                },
                'sv_ticket[]': {
                  required: true,
                }
            },
            messages: {
              'sv_ticket[]': {
                required: "You must check at least 1 event"
              }
            }
        });
    /*end đăng ký*/
});
</script>
@stop