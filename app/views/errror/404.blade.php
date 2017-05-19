@extends('user.main')
@section('seo')
   <meta name="keywords" content="">
   <meta name="title" content="">
   <meta name="description" content="">
@stop
@section('script')
<link rel="stylesheet" type="text/css" href="<?php echo Asset('/')?>store/css/style.css">
     <link rel="stylesheet" type="text/css" href="<?php echo Asset('/')?>store/css/edit.css">
    <link href="<?php echo Asset('/')?>store/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' id='rs-settings-css'  href='<?php echo Asset('/')?>store/css/slider-main/settings261a.css' type='text/css' media='all' />
    <!-- Jquery -->
    <script type="text/javascript" src="<?php echo Asset('/')?>store/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo Asset('/')?>store/js/jquery-1.11.1.min.js"></script>
     
    <script type='text/javascript' src='<?php echo Asset('/')?>store/js/slider-main/custom5152.js'></script>
    <script type='text/javascript' src='<?php echo Asset('/')?>store/js/slider-main/jquery.themepunch.plugins.min261a.js'></script>
    <script type='text/javascript' src='<?php echo Asset('/')?>store/js/slider-main/jquery.themepunch.revolution.min261a.js'></script>
 	<style type="text/css">
 	.modal{
 		top:200px;
 	}
 	</style>
@stop
@section('content')
@include('user.slider')
<!--Star-content-->
<!-- popup -->
<div>
	<img class="img-responsive" src="<?php echo Asset('/store/images').'/404.jpg' ?>">
</div>
	<!-- End Order-products./-->
	<script type="text/javascript" src="<?php echo Asset('store/js/bootstrap.min.js')?>"></script>
	<script type="text/javascript">
    jQuery(window).load(function(){
    	var check ="";
  		check = $('#message').val();
  		if(check!="false")
        jQuery('#myModal').modal('show');
    });		
	</script>
@stop