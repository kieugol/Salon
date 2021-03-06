﻿<?php
$_images = Config::get('site.url_image');
$_thumb = Config::get('site.url_thumb');
$_css = Config::get('site.url_css');
$_js = Config::get('site.url_js');

// Process for menu
$menu = new Menu();
$list_menu = $menu->getMenuheader();
$district = new District();
$province = new Province();
$list_district = $district->getDistrictHavingSalon();
$list_province = $province->getProvinceHavingEvent();
$list_district_hiring = $district->getDistrictHavingHiring();

// Filter Province from list district
$listProvince = [];
foreach ($list_district as $tmp) {
	if (!in_array($tmp->name_province, $listProvince)) {
		$listProvince[$tmp->alias_province] = $tmp->name_province;
	}
}

// Filter Province from list district
$listProvince_hiring = [];
foreach ($list_district_hiring as $tmp) {
	if (!in_array($tmp->name_province, $listProvince_hiring)) {
		$listProvince_hiring[$tmp->alias_province] = $tmp->name_province;
	}
}

// Get menu type from config site
$menuType = Config::get('site.menu_type');
$introPage = $menuType[0];
$eventPage = $menuType[1];
$salonPage = $menuType[2];
$hiringPage = $menuType[3];
$productPage = $menuType[4];
$contactPage = $menuType[5];
$newsPage = $menuType[6];

?>
<header id="cp_header">

      <section class="cp_navigation-row">
        <div class="container">

          <div class="cp-nav-holder">

            <strong class="cp-logo">
              <a href="{{Asset('/')}}">
                <em></em>
                <span style="font-size:30px !important">Diachilamtoc.com.vn</span>
              </a>
            </strong>

            <nav class="navbar navbar-inverse">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
              </div>
              <div id="navbar" class="collapse navbar-collapse">
                <ul id="nav" class="navbar-nav">
<!-- 		<li><a href="{{Asset('/')}}">Home</a></li> -->
                @if(count($list_menu) > 0)
                  @foreach($list_menu as $menu)
                    @if($menu->default_menus == $introPage)
                      <li><a href="#">{{$menu->title_menus}}</a></li>
                    @elseif($menu->default_menus == $eventPage)
                      <li class="dropdown">
                        <a href="{{Asset('/') . $menu->alias_menus}}.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{$menu->title_menus}}</a>
                        <ul class="dropdown-menu" role="menu">
                        @foreach($list_province as $province)
                          <li><a href="{{Asset('/su-kien') .'/' . $province->alias_province}}.html">{{$province->name_province}}</a></li>
                        @endforeach
                        <li><a href="{{Asset('/customer')}}/dang-ky-su-kien">Đăng ký sự kiện</a></li>
                        </ul>
                      </li>
                    @elseif($menu->default_menus == $salonPage)
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{$menu->title_menus}}<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                        @foreach($listProvince as $alias => $value)
                          <li>
                            <a href="{{Asset('/salon') . '/' . $alias . '.html'}}">{{$value}}</a>
                            <ul>
                            @foreach($list_district as $district)
                              @if($district->alias_province == $alias)
                              <li><a href="{{Asset('/salon') . '/' . $district->alias_province . '/' . $district->alias_district. '.html'}}">{{$district->name_district}}</a></li>
                              @endif
                            @endforeach
                            </ul>
                          </li>
                        @endforeach
                           <li><a href="{{Asset('/customer')}}/dang-ky-salon">Đăng ký salon</a></li>
                        </ul>
                      </li>
                    @elseif($menu->default_menus == $hiringPage)
                      <li class="dropdown" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{$menu->title_menus}}</a>
                        <ul class="dropdown-menu" role="menu">
							@foreach($listProvince_hiring as $alias => $value)
							  <li>
								<a href="{{Asset('/tuyen-dung') . '/' . $alias . '.html'}}">{{$value}}</a>
								<ul>
								@foreach($list_district_hiring as $district)
								  @if($district->alias_province == $alias)
								  <li><a href="{{Asset('/tuyen-dung') . '/' . $district->alias_province . '/' . $district->alias_district. '.html'}}">{{$district->name_district}}</a></li>
								  @endif
								@endforeach
								</ul>
							  </li>
							@endforeach
							<li><a href="{{Asset('customer/dang-ky-tin-tuyen-dung')}}">Đăng tin</a></li>
                        </ul>
                      </li>
                    @elseif($menu->default_menus == $productPage)
                      <li><a href="{{Asset('/').$menu->alias_menus}}.html">{{$menu->title_menus}}</a></li>
                    @elseif($menu->default_menus == $newsPage)
                      <li><a href="{{Asset('/').$menu->alias_menus}}.html">{{$menu->title_menus}}</a></li>
                    @elseif($menu->default_menus == $contactPage)
                      <li><a href="#" id="contact">{{$menu->title_menus}}</a></li>
                    @else
                      <li><a href="#">{{$menu->title_menus}}</a></li>
                    @endif
                  @endforeach
                @endif
                </ul>
              </div>
            </nav>
          </div>

        </div>

        <div class="cp-right-holder">
          <ul>
            <li class="cp_search-bar">
              <i class="fa fa-search"></i>
            </li>
          @if(Session::has('username_member'))
            <li class="cp-language-bar">
              <div class="dropdown">
                <button aria-expanded="true" data-toggle="dropdown" id="dropdownMenu2" type="button">Welcome, {{Session::get('username_member')}}<span class="caret"></span> </button>
                <ul role="menu" class="dropdown-menu">
                  <li role="presentation"><a href="{{Asset('/member/log-out')}}" tabindex="-1" role="menuitem">Logout</a></li>
                  <li role="presentation"><a href="#" tabindex="-1" role="menuitem">Profile</a></li>
                </ul>
              </div>
            </li>
          @else
            <li class="cp-online-booking">
              <a href="{{Asset('/dang-nhap.html')}}">đăng nhập /</a>
              <a href="{{Asset('/dang-ky-thanh-vien.html')}}">đăng ký</a>
            </li>
          @endif
          </ul>
        </div>

      </section>

    </header>
