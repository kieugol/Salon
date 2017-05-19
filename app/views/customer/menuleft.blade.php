<aside class="left-side sidebar-offcanvas">                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo Asset('/') . "store/admin/img/" ?>user-left.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello,
                            <?php if (Session::has('username')) {
	echo Session::get('username');
}
?>
                            </p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                     @if(Session::has('level') && Session::get('level') == md5(3) )
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-th"></i>
                                <span>Quản lý Tỉnh/Thành</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo Asset('/') ?>administrator/province/home"><i class="fa fa-angle-double-right"></i>Tỉnh/Thành</a></li>
                                <li><a href="<?php echo Asset('/') ?>administrator/district/home"><i class="fa fa-angle-double-right"></i>Quận/Huyện</a></li>
                            </ul>
                        </li>
                    <!-- Salom -->
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-th"></i><span>Quản lý Salon</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo Asset('/') ?>administrator/salon/home"><i class="fa fa-angle-double-right"></i>Salon</a></li>
                                <li><a href="<?php echo Asset('/') ?>administrator/salon/display-index"><i class="fa fa-angle-double-right"></i>Hiển thị trang chủ</a></li>
                                <li><a href="<?php echo Asset('/') ?>administrator/service/add"><i class="fa fa-angle-double-right"></i>Thêm dịch vụ</a></li>
                            </ul>
                        </li>
                    @endif
                        <!-- Event -->
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-th"></i>
                                <span>Quản lý Sự kiện</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                @if(Session::has('level') && Session::get('level') == md5(3) )
                                <li><a href="<?php echo Asset('/') ?>administrator/eventCat/home"><i class="fa fa-angle-double-right"></i>Danh mục sự kiện</a></li>
                                <li><a href="<?php echo Asset('/') ?>administrator/event/home"><i class="fa fa-angle-double-right"></i>Sự Kiện</a></li>
                                <li><a href="<?php echo Asset('/') ?>administrator/event/display-index"><i class="fa fa-angle-double-right"></i>Hiển thị trang chủ</a></li>
                                 @endif
                                <li><a href="<?php echo Asset('/') ?>administrator/event/ticket"><i class="fa fa-angle-double-right"></i>Đặt vé</a></li>
                            </ul>
                        </li>
                       <!-- Products -->
                        @if(Session::has('level') && Session::get('level') == md5(3) )
                         <li class="treeview">
                            <a href="#">
                                <i class="fa fa-th"></i>
                                <span>Products Manager</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo Asset('/') ?>administrator/products/home"><i class="fa fa-angle-double-right"></i>Sản phẩm</a></li>
                                <li><a href="<?php echo Asset('/') ?>administrator/productsCategories/home"><i class="fa fa-angle-double-right"></i>Danh mục sản phẩm</a></li>
                                <li><a href="<?php echo Asset('/') ?>administrator/productsMade/home"><i class="fa fa-angle-double-right"></i>Xuất xứ sản phẩm</a></li>
                            </ul>
                        </li>
                        @endif
                       <!--  Articles -->
                         <li class="treeview">
                            <a href="#">
                               <i class="fa fa-fw  fa-tags"></i>
                                <span>Tin tuyển dụng</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo Asset('/') ?>administrator/articles/home"><i class="fa fa-angle-double-right"></i>Duyệt tin</a></li>

                            </ul>
                        </li>
                        <!-- Gallery -->
                        @if(Session::has('level') && Session::get('level') == md5(3) )
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-fw fa-picture-o"></i>
                                <span>Multimedia Manager</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo Asset('/') ?>administrator/media/home"><i class="fa fa-angle-double-right"></i>Upload/Delete</a></li>
                            </ul>
                        </li>
                        @endif
                        <!-- User -->
                    @if(Session::has('level') && Session::get('level') == md5(3) )
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-fw fa-group"></i>
                                <span>User Manager</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo Asset('/') ?>administrator/user/home"><i class="fa fa-angle-double-right"></i>Users</a></li>
                                <li><a href="<?php echo Asset('/') ?>administrator/user/log"><i class="fa fa-angle-double-right"></i>Log </a></li>
                            </ul>
                        </li>
                         <!-- Menu -->
                            <li class="treeview">
                            <a href="#">
                                <i class="fa fa-fw fa-windows"></i>
                                <span>Menus Manager</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo Asset('/') ?>administrator/menu/home"><i class="fa fa-angle-double-right"></i>Main Menu </a></li>
                                <li><a href="<?php echo Asset('/') ?>administrator/menu/header"><i class="fa fa-angle-double-right"></i>Header Menu </a></li>
                                <li><a href="<?php echo Asset('/') ?>administrator/menu/footer"><i class="fa fa-angle-double-right"></i>Footer Menu </a></li>
                            </ul>
                        </li>
                    @endif
                        <li class="treeview">
                            <a href="#">
                                <span class="glyphicon glyphicon-link"></span>
                                <span>Quản lý Block</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo Asset('/') ?>administrator/slider/home"><i class="fa fa-angle-double-right"></i>Slider</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
</aside>