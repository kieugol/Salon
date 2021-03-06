@extends('admin.main')
@section('script')
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
            <!--Datatable-->
        <!-- Theme style -->
        <link href="<?php echo Asset('/')?>store/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Upload file -->
        <link href="<?php echo Asset('/')?>store/admin/css/uploadfile.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Asset('/')?>store/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
       
@stop
@section('content')
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
     <form  id="productForm" method="post"  action="<?php echo Asset('/')?>administrator/media/remove" accept-charset="utf-8" role="form"   >             
                <!-- Content Header (Page header) -->
                <section class="content-header">             
                    <h1>Gallery<small>/ home</small></h1>
                    <div style="text-align: right">
                        <a href="<?php echo Asset('/') ?>administrator/media/home" class="btn btn-default btn-flat" style="padding-left: 40px; padding-right: 40px;"><span class="glyphicon glyphicon-refresh"></span> </a>
                        <button   class="btn btn-danger btn-flat"><span class="glyphicon glyphicon-minus-sign"></span> Delete</button>
                                                
                    </div> 
                </section>

                <!-- Main content -->
                <section class="content">
                    
                    <div class="row">
                        <!-- left column -->                
                        <div class="  col-md-12 col-lg-12">
                                    <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#gallery" data-toggle="tab">Image List</a></li>
                                                <li class=""><a href="#upload" data-toggle="tab">Upload</a></li>
                                            </ul>
                                        <div class="tab-content">
                                                <div class="tab-pane active" id="gallery">
                                                     
                                                            <h3 class="box-title">Images List</h3>
                                                                <ul class="img-list">
                                                            <?php
                                                                    foreach ($list_images as $value) {
                                                                ?>
                                                                    <li>
                                                                        <a href="#" imgname="<?php echo $value->name_file ?>" id="img-list">
                                                                            <img width="100" height="80" src="<?php echo Asset('/')."store/upload/images/".$value->name_file ?>" data-toggle="tooltip" data-placement="top" title="{{$value->name_display}}" /><br />
                                                                            <input type="checkbox" name="imglist[]" value="<?php echo $value->id ?>">
                                                                        </a>
                                                                    </li>
                                                            <?php 
                                                                    }
                                                                ?>
                                                                </ul>                                    
                                                </div> <!-- Image gallery -->
                                                <div class="tab-pane " id="upload">
                                                    <div class="inner">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <h2> Thêm tập tin </h2>
                                                            </div>
                                                        </div>
                                                        <hr />
                                                        <div id="fileuploader">Chọn tập tin</div>
                                                    </div>        
                                                </div><!-- /.tab-pane -->
                                        </div><!-- /.tab-content -->
                                    </div> <!-- Tab -->
                        </div> <!-- /.col-->
                        <div class="text-center">
                             <div class="paginate"><?php echo $list_images->links(); ?></div>
                        </div>
                    </div><!-- row./ -->  
                </section>
                <!-- /.content -->
    </form>      
</aside><!-- /.right-side -->
<!-- Start gallery -->
 <div class="modal  bs-example-modal-lg gallery-img" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
              <h2 class="modal-title" id="myLargeModalLabel"><a id="rf_img" href="#"><span class="glyphicon glyphicon-refresh"></span></a></h2>
            </div>
            <div class="modal-body">
                  <ul class="img-list" id="all_list"> 
                        @foreach ($list_images as $value) 
                       <li>
                             <a href="#"  data-dismiss="modal" imgname="<?php echo $value->name_file ?>" id="img-list"  >
                                <img width="100" height="80"  src="<?php echo Asset('/')."store/upload/images/".$value->name_file ?>">
                             </a>
                        </li>
                        @endforeach
                    </ul>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div>
 <!-- end gallery  -->
       <script src="<?php echo Asset('/')?>store/js/jquery.js"></script>
        <script src="<?php echo Asset('/')?>store/js/jquery-1.11.1.min.js"></script>      
        <script src="<?php echo Asset('/')?>store/js/bootstrap.min.js" type="text/javascript"></script>  
        <!-- Upload file -->
         <script src="<?php echo Asset('')?>store/admin/js/jquery.uploadfile.min.js"></script>   
        <!-- AdminLTE App -->
        <script src="<?php echo Asset('/')?>store/admin/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo Asset('/')?>store/admin/js/AdminLTE/demo.js" type="text/javascript"></script> 


<script type="text/javascript">
    // upload file
    jQuery(document).ready(function(e) {
        var base_url = '<?php echo Asset('/'); ?>';
            jQuery("#fileuploader").uploadFile({
                url:base_url+"administrator/media/media-upload",
                allowedTypes:"png,gif,jpg,jpeg",
                fileName:"myfile"
                });
     // choose images avatar products
            jQuery("#all_list #img-list").click(function(e) {
                //alert('have');
            var url = $('#url_home').val()+"store/upload/images/";
            var img = $(this).attr("imgname");
              $('#img-data').attr('src',url+img);
              $('#txt_thumb').val(img); 
            });
         // load imgaes list
        var base_url=$("#url_home").val();
            jQuery('#rf_img ').click(function(e) {
                $.ajax({
                            type: "POST",
                            url:base_url+"administrator/media/load-images-list",
                            data:{}, 
                            success: function(data){
                              $('.modal-body').html(null);
                             $('.modal-body').hide();
                              $('.modal-body').html(data).fadeIn();;
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
            });     
    });                                    
</script>


@stop