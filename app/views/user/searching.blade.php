@extends('user.main')
@section('seo')
   <title>Kết quả tìm kiếm</title>
@stop
@section('script')
    <link href="<?php echo Asset('/')?>store/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Jquery -->
     <!-- Datatable -->
    <script src="<?php echo Asset('/')?>store/js/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?php echo Asset('/')?>store/js/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <style type="text/css" media="screen">
      .dataTable tbody tr{
        margin:5px 0 !important;
      }
      .col-xs-6{
        width:100%;
      }
      .dataTables_paginate{
        margin-top:10px !important;
        float: none !important;
        text-align:center;
      }
    </style>
@stop


@section('content')

<div class="container hc-body-content">
      @include('user.menu_left')
      <!--Main Content-->
      <div class=" hc-adv-top-content">
          <div class="breadcrumb">
            <ul>
              <li><a href="{{Asset('/')}}">Trang chủ</a></li>
              <li><a class="color-bread" href="#"><img src="{{Asset('store/images/breadcrumb.png')}}">&nbsp;Tìm kiếm</a></li>
              <div class="clr"></div>
            </ul>
          </div>
          <?php
                $pd = count($list_products);
                $art = count($list_articles);
                $pj = count($list_projects);
            ?>
          <section class="hc-news">
            @if($pd==0 && $pj==0 && $art==0)
              <p>Không tìm thấy kết quả, mời nhập từ khóa khác ...</p>
            @else
              <article class="clr-border">
                <table id="tb-search" class="dataTable">
                  <thead>
                    <th></th>
                  </thead>
                  <tbody>
                 <!--  Products -->
                  @foreach($list_products as $key =>$value)
                    <tr>
                      <td>
                        <div class="item-articles clr-item-news">
                            <div class="thumnail">
                              <a href="{{Asset('/san-pham').'/'.$list_products[$key]->alias_products_categories.'/'.$list_products[$key]->alias_products.'.html'}}">
                                <img style="padding:0" src="{{Asset('/store/upload/images').'/'.$list_products[$key]->thumb_products}}" data-toggle="tooltip" data-placement="top" title="{{$list_products[$key]->name_products}}" alt="{{$list_products[$key]->thumb_products}}">
                              </a>
                            </div>
                            <div class="sort-content" >
                                <a href="{{Asset('/san-pham').'/'.$list_products[$key]->alias_products_categories.'/'.$list_products[$key]->alias_products.'.html'}}">
                                  <h3>{{$list_products[$key]->name_products}}</h3>
                                </a>
                                <div class="clr"></div>
                              @if($list_products[$key]->price_products>0)
                                 @if($list_products[$key]->is_sale_products>0)
                                  <?php $price = $list_products[$key]->price_products-($list_products[$key]->price_products*($list_products[$key]->is_sale_products/100) ); ?>
                                  <p class="price-search-sale">{{number_format($list_products[$key]->price_products,0,",",".")}} đ</p>
                                  <p class="price-search">Giảm còn: {{number_format($price,0,",",".")}} đ</p>
                                @else
                                <p class="price-search">Giá: {{number_format($list_products[$key]->price_products,0,",",".")}} đ</p>
                                @endif
                              @else
                                <p class="price-search">Giá: Liên hệ</p>
                              @endif
                            </div>
                        </div>
                        <hr/>
                      </td>
                    </tr>
                  @endforeach
                  <!-- Projects -->
                  @foreach($list_projects as $result)
                    <tr>
                      <td>
                      <div class="item-articles clr-item-news">
                          <div class="thumnail">
                            <a href="{{Asset('/cong-trinh').'/'.$result->alias_projects_categories.'/'.$result->alias_projects.'.html'}}">
                              <img style="padding:0" src="{{Asset('/store/upload/images').'/'.$result->thumb_projects}}"  data-toggle="tooltip" data-placement="top" title="{{$result->name_projects}}" alt="{{$result->thumb_projects}}">
                            </a>
                          </div>
                          <div class="sort-content" >
                            <a href="{{Asset('/cong-trinh').'/'.$result->alias_projects_categories.'/'.$result->alias_projects.'.html'}}">
                              <h3>{{$result->name_projects}}</h3>
                            </a>
                          </div>
                      </div>
                      <hr/>
                      </td>
                    </tr>
                  @endforeach
                  <!--Prticles -->
                  @foreach($list_articles as $key =>$value)
                    <tr>
                      <td>
                      <div class="item-articles clr-item-news">
                          <div class="thumnail">
                            <a href="{{Asset('/tin-tuc').'/'.$list_articles[$key]->alias_articles_categories.'/'.$list_articles[$key]->alias_articles.'.html'}}">
                              <img  style="padding:0" src="{{Asset('/store/upload/images').'/'.$list_articles[$key]->thumb_articles}}"  data-toggle="tooltip" data-placement="top" title="{{$list_articles[$key]->title_articles}}" alt="{{$list_articles[$key]->thumb_articles}}">
                            </a>
                          </div>
                          <div class="sort-content" >
                              <a href="{{Asset('/tin-tuc').'/'.$list_articles[$key]->alias_articles_categories.'/'.$list_articles[$key]->alias_articles.'.html'}}">
                                <h3>{{mb_strimwidth($list_articles[$key]->title_articles,0,57,'...','utf-8')}}</h3>
                              </a>
                              <span class="date">({{date_format( $list_articles[$key]->created_at,'d/m/Y' )}})</span>
                              <div class="intro-text">{{mb_strimwidth($list_articles[$key]->introtext_articles,0,203,'...','utf-8')}}</div>
                          </div>
                      </div>
                      <hr/>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </article>
          @endif
          </section>
      </div>
      <!--End Main Content./-->
      @include('user.adv_right')
    </div>
</div>
<script type="text/javascript">
            $(function() {
                $('#tb-search').dataTable({
                   "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": true
                });
            });
    
    </script>
@stop