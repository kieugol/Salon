@extends('admin.main')
@section('script')
	 <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="<?php echo Asset('/')?>store/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo Asset('/')?>store/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
         <link href="<?php echo Asset('/')?>store/admin/css/uploadfile.min.css" rel="stylesheet" type="text/css" />
       
@stop
@section('content')
 
   
<aside class="right-side">
   <form id="productForm" method="post" action="<?php echo Asset('/') ?>administrator/media/update-gallery"  accept-charset="uft8" role="form">
    <section class="content-header">
                    <h1>Gallery Projects Index</h1>
                    <div style="text-align: right">
                    <a href="<?php echo Asset('/') ?>administrator/media/display-index" class="btn btn-default btn-flat" style="padding-left: 20px; padding-right:20px;"><span class="glyphicon glyphicon-refresh"></span> </a>
                    <button class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-floppy-save"></span> Save </button>     
                    </div> 
    </section> <!-- Function header -->
    <section class="content">
      <div class="row">
           
                        <!-- left column -->                
            <div class="  col-md-12 col-lg-12">
                
                                        <!--All images gallery  -->
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#gallery" data-toggle="tab">Gallery</a></li>
                                                <li class=""><a href="#upload" data-toggle="tab">Upload</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="gallery">                   
    
                                                        <ul class="img-list">
                                                            
                                                            @foreach ($list_images as $value)
                                                                <li>
                                                                    <a href="#" imgname="<?php echo $value->name_file ?>" id="img-list">
                                                                        <img width="100" height="80" src="<?php echo Asset('/')."store/upload/images/".$value->name_file ?>" data-toggle="tooltip" data-placement="top" title="{{$value->name_display}}"  /><br />
                                                                        <input <?php
                                                                                foreach($list_gallery as $gallery) 
                                                                                if($gallery->idMedia == $value->id ) echo 'checked="checked"' 
                                                                                ?> type="checkbox" name="imglist[]" value="<?php echo $value->id ?>" />
                                                                            <div>
                                                                                <input type="text" name="projects_name[]" style="color:#383535"
                                                                                        value="<?php
                                                                                        foreach($list_gallery as $gallery)
                                                                                        if($gallery->idMedia == $value->id ) echo $gallery->name_projects;
                                                                                        ?>"   
                                                                                />
                                                                                <input type="hidden" name="idhide[]" value="{{$value->id}}"/>
                                                                            </div>
                                                                    </a>
                                                                </li>
                                                            @endforeach
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
                                                </div> <!-- images upload -->
                                        </div> <!-- Content-gallery -->
                                    </div>
                        </div> <!-- /.col-->
                    </div><!-- row./ -->  
        </section> 
     </form>
     
</aside>
       <script src="<?php echo Asset('/')?>store/js/jquery.js"></script>
        <script src="<?php echo Asset('/')?>store/js/jquery-1.11.1.min.js"></script>      
        <script src="<?php echo Asset('/')?>store/js/bootstrap.min.js" type="text/javascript"></script>
         <script src="<?php echo Asset('/')?>store/js/jquery.validate.js"></script>
        <!-- Plugin TinyCME -->
        <script src="<?php echo Asset('/')?>store/tinymce/tinymce.min.js" type="text/javascript"></script>
        <!-- Upload file -->
        <script src="<?php echo Asset('')?>store/admin/js/jquery.uploadfile.min.js"></script>   
        
         <!-- DATA TABES SCRIPT -->
        <script src="<?php echo Asset('/')?>store/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo Asset('/')?>store/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo Asset('/')?>store/admin/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo Asset('/')?>store/admin/js/AdminLTE/demo.js" type="text/javascript"></script> 
    <script type="text/javascript">
            jQuery(function() {
                $('#tb2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
    </script>
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
            jQuery('#rf_img').click(function(e) {
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
<script type="text/javascript" >
        jQuery(document).ready(function(e) {
    /*dang ky*/
        $('#productForm').validate({ 
            rules: {
                txt_name:{
                    required: true
                },
                txt_quan:{
                    required: true,
                    number:true
                },
                txt_price:{
                    required: true,
                    number:true
                },
                txt_wei:{
                    required: true
                },
                txt_sort :{
                    required: true,
                    number:true
                }
            },
            messages: {
            }
        });
    /*end đăng ký*/
});
</script>
<script type="text/javascript" >
        var url = $('#url_home').val()+"store/";
       // alert(base_url);
        tinymce.init({
            selector: "textarea#txt_des",
            theme: "modern",
            width: 700,
            height: 400,
            relative_urls: false,
            remove_script_host: false,
            plugins: [
                 "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                 "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager "
           ],
           //content_css: "css/content.css",
           toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | responsivefilemanager | print preview media fullpage | forecolor backcolor emoticons", 
           style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ],
            external_filemanager_path:url+"filemanager/",
            filemanager_title:"Responsive Filemanager" ,
            external_plugins: { "filemanager" :url+"filemanager/plugin.min.js"}
        }); 
    </script>           
@stop