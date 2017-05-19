@extends('user.main')
@section('seo')
   <meta name="keywords" content="{{$menus['meta_key_menus']}}">
   <meta name="title" content="{{$menus['meta_title_menus']}}">
   <meta name="description" content="{{$menus['meta_desc_menus']}}">
   <title>{{$menus['title_menus']}}</title>
@stop
@section('content')
<script>
  var _alias_menus = '{{$menus["alias_menus"]}}';
  $(".nav li").each(function() {
    if($(this).attr('id') == _alias_menus){
      $(this).addClass('active');
    }
  });
</script>
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
          <section class="hc-articles clr-hc-articles">
              <h3 class="title-articles">{{$menus['title_menus']}}</h3>
              <div class="info-articles">
                <p class="topic-articles">
                  <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>&nbsp;{{date_format($menus['updated_at'],'d/m/Y') }}
                </p>
                <p class="topic-articles">
                  <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Kiều Kha
                </p>
              </div>
              <article class="content-articles mt20 mb20">{{ $menus['des_menus'] }}</article>
              <div class="text-left">
                <div class='addthis_toolbox addthis_default_style'>
                <a class='addthis_button_facebook_like' fb:like:layout='button_count'></a>
                <a class='addthis_button_tweet'></a>
                <a class='addthis_button_google_plusone' g:plusone:size='medium'></a>
                </div>
                <script src='http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4ec4dd3d1e59e9dc' type='text/javascript'></script>
              </div>
          </section>
      </div>
      <!--End Main Content./-->
      @include('user.adv_right')
</div>

@stop