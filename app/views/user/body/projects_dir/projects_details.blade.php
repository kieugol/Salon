@extends('user.main')
@section('seo')

   <meta name="keywords" content="{{$projects_details['meta_key_projects']}}">
   <meta name="title" content="{{$projects_details['meta_title_projects']}}">
   <meta name="description" content="{{$projects_details['meta_desc_projects']}}">
   <title>{{$projects_details['name_projects']}}</title>
@stop
@section('content')
<script>
  var _alias_menus = '{{$projects_details["alias_menus"]}}';
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
               <li><a href="{{Asset('/cong-trinh').'.html'}}"><img src="{{Asset('store/images/breadcrumb.png')}}">&nbsp;công trình</a></li>
               <li><a class="color-bread" ><img src="{{Asset('store/images/breadcrumb.png')}}">&nbsp;{{$projects_details['name_projects']}}</a></li>
              <div class="clr"></div>
            </ul>
          </div>
          <section class="hc-articles">
              <h3 class="title-articles" style="color:#D91E1E">{{$projects_details['name_projects']}}</h3>
              <hr style="border-color:#CFC6C6;margin:10px 0" />
              <article class="content-articles">
                {{$projects_details['des_projects']}}
                <div class="text-left">
                  <div class='addthis_toolbox addthis_default_style'>
                  <a class='addthis_button_facebook_like' fb:like:layout='button_count'></a>
                  <a class='addthis_button_tweet'></a>
                  <a class='addthis_button_google_plusone' g:plusone:size='medium'></a>
                  </div>
                  <script src='http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4ec4dd3d1e59e9dc' type='text/javascript'></script>
                </div>
              </article>
          </section>
        @if(count($projects_other)>0)
           <section class="news-more">
              <div class="title-categories title-categories-add"><h2 class="title-news">Các công trình lắp đặt khác</h2></div>
              <ul class="hc-news-other">
              @foreach($projects_other as $result)
                <li><a href="{{Asset('/cong-trinh').'/'.$result->alias_projects_categories.'/'.$result->alias_projects.'.html'}}">{{$result->name_projects}}</a></li>
              @endforeach
              </ul>
          </section>
        @endif
      </div>
      <!--End Main Content./-->
      @include('user.adv_right')
</div>
@stop