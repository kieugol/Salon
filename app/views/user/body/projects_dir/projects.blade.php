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
          <section class="hc-news clr-lr">
              <div class="title-categories title-categories-add"><h2 class="clr-services">{{$menus['title_menus']}}</h2></div>
            @foreach ($list_projects as $result)
              <div class="view view-third">
                <img src="{{Asset('store/upload/images').'/'.$result->thumb_projects}}" alt="">
                <div class="mask">
                  <h2>Camera Kiều Kha</h2>
                  <p>{{$result->name_projects}}</p>
                  <a href="{{Asset('/cong-trinh').'/'.$result->alias_projects_categories.'/'.$result->alias_projects.'.html'}}" class="info">Xem Tiếp</a>
                </div>
              </div>
            @endforeach
            <div class="paginate text-center">
              {{$list_projects->links()}}
            </div>
          </section>
      </div>
      <!--End Main Content./-->
      @include('user.adv_right')
</div>
@stop