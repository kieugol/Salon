 <header class="header">
    <a href="<?php echo Asset('/') ?>administrator" class="logo">Minh Tan Salon</a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span>
                        <?php
if (Session::has('username')) {
	$value = Session::get('username');
	echo $value;
}
?>
                            <i class="caret"></i>
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            <img src="<?php echo Asset('/') ?>store/admin/img/user.png" class="img-circle" alt="User Image" />
                            <p>
                               <?php
if (Session::has('username') && Session::has('rules')) {
	echo Session::get('username') . ' - ' . Session::get('rules');
}
?>
                                <small>
                                    <?php if (Session::has('created_at')) {
	$value = strtotime(Session::get('created_at'));
	echo 'Register - ' . date('d/m/Y H:i:s', $value);
}
?>
                                </small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                            <a href="<?php echo Asset('/') ?>home/log-out" class="btn btn-default btn-flat">Log out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>