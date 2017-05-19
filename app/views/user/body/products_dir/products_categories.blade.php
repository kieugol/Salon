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
            <div class="adv-wapper2 adv-manufacture">
                  <a href="#" class="img1">
                    <img alt="{{$productsCat_details['name_products_categories']}}" title="{{$productsCat_details['name_products_categories']}}" src="{{ Asset('/store/upload/images/').'/'.$productsCat_details['thumb_products_categories']}}">
                  </a>
                  <div class="clr"></div>
              </div>
          </section>
          <section class="hc-content-camera">
              <div class="title-categories title-categories-add"><h2 class="clr-services">{{$productsCat_details['name_products_categories']}}</h2></div>
              <aside class="hc-wapper-products">
              @if(count($list_products)>0)
                @foreach($list_products as $product_new)
                  <div class="hc-item-products tip-item " id="tip-item">
                      <div id="item_1" class="activator tip-specific-class">
                        <a href="{{Asset('/san-pham').'/'.$product_new->alias_products_categories.'/'.$product_new->alias_products.'.html'}}">
                          <img alt="{{$product_new->name_products}}"  src="{{ Asset('/store/upload/images').'/'.$product_new->thumb_products}}" class="products-thumb">
                        </a>
                      </div>
                      <div id="tip-content" class="tip tip-specific-class">{{$product_new->short_desc_products}}</div>
                      <a href="{{Asset('/san-pham').'/'.$product_new->alias_products_categories.'/'.$product_new->alias_products.'.html'}}"><h3 class="products-name">{{$product_new->name_products}}</h3></a>
                   @if($product_new->price_products>0)
                    @if($product_new->is_sale_products>0)
                      <?php $price = $product_new->price_products-( $product_new->price_products*($product_new->is_sale_products/100) ); ?>
                    <p class="products-price-sale">{{number_format($product_new->price_products,0,",",".")}} đ</p>
                    <p class="products-price">Giảm còn: {{number_format($price,0,",",".")}} đ</p>
                    @else
                    <p class="products-price add-top">Giá: {{number_format($product_new->price_products,0,",",".")}} đ</p>
                    @endif
                  @else
                    <p class="products-price-contact">Giá: Liên Hệ</p>
                  @endif
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