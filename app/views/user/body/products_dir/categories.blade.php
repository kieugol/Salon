@extends('user.main')
@section('seo')
   <meta name="keywords" content="{{$productsCat_details['meta_key_products_categories']}}">
   <meta name="title" content="{{$productsCat_details['meta_title_products_categories']}}">
   <meta name="description" content="{{$productsCat_details['meta_desc_products_categories']}}">
   <title>{{$productsCat_details['name_products_categories']}}</title>
@stop
@section('content')

<div class="container hc-body-content">
      @include('user.menu_left')
      <!--Main Content-->
      <div class=" hc-adv-top-content">
          <div class="breadcrumb">
            <ul>
              <li><a href="{{Asset('/')}}">Trang chủ</a></li>
            @if(count($parent_cat)>0)
              <li><a href="{{Asset('/danh-muc-san-pham').'/'.$parent_cat['alias_products_categories'].'.html'}}"><img src="{{Asset('store/images/breadcrumb.png')}}">&nbsp;{{$parent_cat->name_products_categories}}</a></li>
            @endif
            @if(count($child_cat)>0)
              <li><a href="{{Asset('/danh-muc-san-pham').'/'.$child_cat['alias_products_categories'].'.html'}}"><img src="{{Asset('store/images/breadcrumb.png')}}">&nbsp;{{$child_cat->name_products_categories}}</a></li>
            @endif
              <li><a href="{{Asset('/danh-muc-san-pham').'/'.$productsCat_details['alias_products_categories'].'.html'}}"><img src="{{Asset('store/images/breadcrumb.png')}}">&nbsp;{{$productsCat_details['name_products_categories']}}</a></li>
              <div class="clr"></div>
            </ul>
          </div>
          <section class="hc-content-adv">
            <div class="adv-wapper2 ">
                  <a href="#" class="img1"><img alt="{{$productsCat_details['name_products_categories']}}" title="{{$productsCat_details['name_products_categories']}}"  src="{{ Asset('/store/upload/images/').'/'.$productsCat_details['thumb_products_categories']}}"></a>
                  <div class="clr"></div>
              </div>
          </section>
          <section class="hc-content-camera">
              <div class="title-categories title-categories-add">
                <h2 class="clr-services">{{$productsCat_details['name_products_categories']}}</h2>
              </div>
              <aside class="hc-wapper-products">
              @if(count($list_cat_child)>0)
                @foreach($list_cat_child as $result)
                  <div class="hc-item-products">
                      <a href="{{Asset('/danh-muc-san-pham').'/'.$result->alias_products_categories.'.html'}}">
                        <img alt="{{$result->name_products_categories}}" title="{{$result->name_products_categories}}fimg" src="{{ Asset('/store/upload/images').'/'.$result->thumb_products_categories}}" alt="{{$result->thumb_products_categories}}" class="products-thumb">
                      </a>
                      <a href="{{Asset('/danh-muc-san-pham').'/'.$result->alias_products_categories.'.html'}}">
                        <h3 class="products-name">{{$result->name_products_categories}}</h3>
                      </a>
                  </div>
                @endforeach
              @endif
                  <div class="clr"></div>
              </aside>
          </section>
      </div>
      <!--End Main Content./-->
      @include('user.adv_right')
    </div>
</div>
@stop