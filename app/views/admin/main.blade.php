<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<link rel="Shortcut Icon" href="{{Asset('/store/images/logo.png')}}" type="image/x-icon">
		<title>System panel</title>
		
		<!-- load-Script./-->
		 <link href="<?php echo Asset('/')?>store/admin/css/style-ad.css" rel="stylesheet" type="text/css" />
		 @yield('script') 
    
	</head>
	<body class="skin-blue">
	<!--Star-Header./-->
	<input type="hidden" id="url_home" name="url_home" value="<?php echo Asset('/') ?>">
		@include('admin.header')
	<div class="wrapper row-offcanvas row-offcanvas-left">
		@include('admin.menuleft')
     	@yield('content')
     	<script type="text/javascript">
     	   var base_url=$("#url_home").val();
     		 // load more images
            jQuery('#load_more').click(function(e) {
                if($('#max_id').val()==0){
                    alert('End images!!');
                    e.preventDefault();
                }
                else
                {
                    $.ajax({
                                type: "POST",
                                url:base_url+"administrator/media/load-more",
                                data:{id_max:$('#max_id').val()}, 
                                success: function(data){
                                 $('#max_id').remove();
                                  $('#all_list').append(data).fadeIn();
                                 //alert(data);
                                jQuery("#all_list #img-list").click(function(e) {
                                //alert('have');
                                    var url = $('#url_home').val()+"store/upload/images/";
                                    var img = $(this).attr("imgname");
                                    $('#img-data').attr('src',url+img);
                                    $('#txt_thumb').val(img); 
                                    });
                                }, 
                                error: function(request, status, error){
                                  alert(request.responseText);
                                }
                            });           
                }
            });
            // end load more images     
     	</script> 
 	</div>
	<!-- Script admin -->
	 

	</body>

</html>