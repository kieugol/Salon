<?php
$_images = Config::get('site.url_image');
$_thumb = Config::get('site.url_thumb');
$_css = Config::get('site.url_css');
$_js = Config::get('site.url_js');
?>
@extends('user.main')
@section('css')
  <meta name="google-signin-client_id" content="614576660056-2falb7t5egt089ov0s4gaamfcmnodv85.apps.googleusercontent.com">
  <title>Đăng nhập</title>
  <link rel="stylesheet" href="{{$_css . 'custom.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'bootstrap.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'theme-color.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'responsive.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'owl.carousel.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'jquery.bxslider.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'prettyPhoto.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'font-awesome.min.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'icomoon.css'}}" type="text/css">
  <link rel="stylesheet" href="{{$_css . 'bootstrap-social.css'}}" type="text/css">
@stop

@section('content')
<div class="cp_inner-banner">
    <div class="cp-inner-image">
        <img src="{{$_images}}/inner-login-img.jpg" alt="">
    </div>
    <div class="cp_breadcrumb-holder">
        <div class="container">
            <h1>Đăng nhập</h1>
            <ul class="breadcrumb">
                <li><a href="{{Asset('/')}}">Home</a>
                </li>
                <li class="active">Đăng nhập</li>
            </ul>
        </div>
    </div>
</div>

<div class="cp_main">

    <section class="cp_login-section pd-tb80">
        <div class="container">
            <div class="cp-heading-holder">
                <h2>Login</h2>
            </div>
            <div class="clr"></div>
        @if(Session::has('message'))
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>{{Session::get('message')}}</strong>
            </div>
        @endif
            <form method="post" accept-charset="UTF-8" action="{{Asset('/member/log-in')}}" id="form-ticket" class="wocommerace-form login-form">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <ul class="row">
                    <li class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="holder">
                        <label>Địa chỉ email *</label>
                            <input type="text" name="email" placeholder="email@example.com">
                        </div>
                    </li>
                </ul>
                <ul class="row">
                    <li class="col-lg-4 col-md-4 col-sm-8 col-xs-12">
                        <div class="holder">
                            <label>Mật khẩu*</label>
                            <input type="password" name="password" placeholder="Nhập mật khẩu">
                        </div>
                    </li>
                </ul>
                <ul class="row">
                    <li class="col-lg-4 col-md-4 col-sm-8 col-xs-12">
                        <div class="login-row">
                            <p>
                                <button type="submit" class="wocommerace-button">Đăng nhập <i class="fa fa-angle-right"></i></button>
                            </p>
                            <br>
                            <p><a href="#" class="lost-password">Hoặc đăng nhập với</a></p>
                            <br>
                        </div>
                        <div class="text-left">
                            <a class="btn btn-social-icon btn-facebook">
                                <span class="fa fa-facebook"></span>
                            </a>
                            <a onclick="loginGoogle()" class="btn btn-social-icon btn-google">
                                <span class="fa fa-google"></span>
                            </a>
                            <a class="btn btn-social-icon btn-twitter">
                                <span class="fa fa-twitter"></span>
                            </a>
                        </div>
                    </li>
                </ul>
            </form>
        </div>
    </section>

</div>

<div id="profile"></div>
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
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script src="https://apis.google.com/js/client:platform.js" async defer></script>
<script type="text/javascript">
      (function() {
       var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
       po.src = 'https://apis.google.com/js/client.js?onload=onLoadCallback';
       var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
     })();
</script>

  <script type="text/javascript">

      jQuery(document).ready(function(e) {
        $('#form-ticket').validate({
            rules: {
                email:{
                    required: true,
                    email: true
                },
                password :{
                    required: true,
                    minlength :6,
                    maxlength:20
                }
            },
            messages: {
            }
        });

    window.fbAsyncInit = function() {
        FB.init({
            appId : '257711184565499',
            xfbml      : true,
            version    : 'v2.5'
        });
    };
    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    (function($) {
        $.fn.clickToggle = function(func1, func2) {
            var funcs = [func1, func2];
            this.data('toggleclicked', 0);
            this.click(function() {
                var data = $(this).data();
                var tc = data.toggleclicked;
                $.proxy(funcs[tc], this)();
                data.toggleclicked = (tc + 1) % 2;
            });
            return this;
        };
    }(jQuery));
var base_url = '{{Asset('/')}}';

$('body').on('click','.btn-facebook',function (e) {
    e.preventDefault();
        FB.login(function (response) {
            if (response.authResponse){
                FB.api('/me?fields=first_name,id,name,last_name, picture, email,location', function (response) {
                    console.log(response);
                    $.ajax({
                        type: "POST",
                        data: "email=" + response.email + "&name=" + response.name + "&id=" + response.id + "&response=" + JSON.stringify(response),
                        url: base_url + "member/login-social",
                        success: function (data) {
                            var data = $.parseJSON(data);
                            if (data.url == 'login_false') {
                               window.location.href = '{{Asset('/')}}' + 'dang-nhap.html';
                            } else {
                                window.location.href = '{{Asset('/')}}';
                            }
                        },
                        error: function (request, status, error) {
                            console.log(request.responseText);
                        }
                    });
                });
            }
            else {
              alert('failed');
                 window.location.href = data.url;
            }
        }, {scope: 'email'});

    });
  });
// Login google +
function logout() {
    gapi.auth.signOut();
    location.reload();
}
function loginGoogle() {
  var myParams = {
    'clientid' : '614576660056-2falb7t5egt089ov0s4gaamfcmnodv85.apps.googleusercontent.com',
    'cookiepolicy' : '{{Asset('/')}}',
    'callback' : 'onSignInCallback',
    'approvalprompt':'force',
    'scope' : 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.profile.emails.read'
  };
  gapi.auth.signIn(myParams);
}

    function onSignInCallback(resp) {
        gapi.client.load('plus', 'v1', apiClientLoaded);
        //gapi.client.load('oauth2', 'v2', apiClientLoaded2);
    }

    function apiClientLoaded() {
        gapi.client.plus.people.get({userId: 'me'}).execute(handleEmailResponse);
    }

    function apiClientLoaded2() {
        gapi.client.oauth2.userinfo.get().execute(handleEmailResponse);
    }

    function handleEmailResponse(resp) {;
        $.ajax({
                type: "POST",
                data: "email=" + resp.emails[0].value + "&name=" + resp.displayName + "&id=" + resp.id + "&response=" + JSON.stringify(resp),
                url:  "{{Asset('/')}}member/login-social",
                success: function (data) {
                    var data = $.parseJSON(data);
                    if (data.url == 'login_false') {
                        window.location.href = '{{Asset('/')}}' + 'dang-nhap.html';
                    }
                    else {
                        window.location.href = '{{Asset('/')}}';
                    }
                },
                error: function (request, status, error) {
                  console.log(request.responseText);
                 }
        });


    }



function loginCallback(result)
{
    if(result['status']['signed_in']) {
        var request = gapi.client.plus.people.get(
        {
            'userId': 'me'
        });
        request.execute(function (resp) {
            var email = '';
            if(resp['emails']) {
                for(i = 0; i < resp['emails'].length; i++) {
                    if(resp['emails'][i]['type'] == 'account') {
                        email = resp['emails'][i]['value'];
                    }
                }
            }

            var str = "Name:" + resp['displayName'] + "<br>";
            str += "Image:" + resp['image']['url'] + "<br>";
            str += "<img src='" + resp['image']['url'] + "' /><br>";

            str += "URL:" + resp['url'] + "<br>";
            str += "Email:" + email + "<br>";
        });

    }

}
function onLoadCallback() {
    gapi.client.setApiKey('AIzaSyAbKribtwRlBT3Iwn0q598YKlHfcjKRKw4');
    gapi.client.load('plus', 'v1',function(){});
}


</script>

@stop