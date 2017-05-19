@extends('admin.main')
@section('script')
	 <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="<?php echo Asset('/') ?>store/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo Asset('/') ?>store/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
         <link href="<?php echo Asset('/') ?>store/admin/css/uploadfile.min.css" rel="stylesheet" type="text/css" />

@stop
@section('content')


<aside class="right-side">

   <form id="productForm" method="post" action="<?php echo Asset('/') ?>administrator/menu/update"  accept-charset="uft8" role="form">
    <section class="content-header">
                    <h1>Menu<small>/ Update</small></h1>
                    <div style="text-align: right">
                        <button class="btn btn-primary btn-flat" id="bt-submit"><span class="glyphicon glyphicon-floppy-save"></span> Save </button>
                        <a href="<?php echo Asset('/') ?>administrator/menu/home" class="btn btn-default btn-flat"><i class="fa fa-fw fa-mail-reply"></i> Back</a>
                    </div>
    </section> <!-- Function header -->

    <section class="content">
     <?php if (isset($check) && $check == 1) {
	?>
            <div class="alert alert-success alert-dismissable">
                <i class="fa fa-check"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <b>Alert!</b> Update data success....
            </div> <!--  Alert Action   -->
    <?php
$check == 0;
}
?>
      <div class="row">
            <div class="  col-md-12 col-lg-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active" id="data_vn"><a href="#tab_1" data-toggle="tab">Data (Vn)</a></li>
                        <li id="data_en"><a href="#tab_2" data-toggle="tab">Data (En)</a></li>
                    </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="box-body">
                                    <table class="table">
                                        <tr>
                                            <td><label >Menu Title</label></td>
                                            <td><input type="text" value="{{ $list_menu['title_menus'] }}" class="form-control" name="txt_title" id="txt_title" placeholder="Enter name">
                                                <input type="hidden" id="txt_id" name="txt_id" value="{{ $list_menu['idMenus'] }}" class="form-control" >
                                                <input type="hidden" id="txt_id" name="txt_idCat" value="{{ $list_menu['idArticlesCategories'] }}" class="form-control" >
                                                <input type="hidden" id="txt_title_hide" name="txt_title_hide" value="{{ $list_menu['title_menus'] }}" class="form-control" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Menu Type</label></td>
                                            <td>
                                                <select class="form-control" name="sl_type" id="sl_type">
                                                @foreach($menu_type as $key => $menu)
                                                    <option <?php if ($menu == $list_menu['default_menus']) {echo 'selected';}?> value="{{$menu}}">{{$menu}}</option>
                                                @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr id="url" style="display:none">
                                            <td> <label >Url</label></td>
                                            <td><input type="text" value="{{$list_menu['url_menus']}}" class="form-control" id="txt_url" name="txt_url" ></td>
                                        </tr>
                                        <tr>
                                            <td> <label >Status</label></td>
                                            <td>
                                                <input type="radio" <?php if ($list_menu['enable_menus'] == 1) {
	echo 'checked="checked"';
}
?>  name="rd_status" checked="checked"  value="1">&nbsp;On &nbsp;&nbsp;
                                                <input type="radio" <?php if ($list_menu['enable_menus'] == 0) {
	echo 'checked="checked"';
}
?> name="rd_status" value="0"> Off
                                            </td>
                                        </tr>
                                         <tr>
                                            <td> <label >Sort </label></td>
                                            <td> <input type="text" value="<?php echo $list_menu['ordering_menus'] ?>" class="form-control" name="txt_sort" id="txt_sort"> </td>
                                        </tr>
                                        <tr>
                                            <td> <label> Description</label></td>
                                            <td> <textarea name="txt_des" id="txt_des">{{$list_menu['des_menus']}}</textarea></td>
                                        </tr>
                                        <tr>
                                            <td> <label >Meta title</label></td>
                                            <td><input type="text" value="<?php echo $list_menu['meta_title_menus'] ?>" class="form-control" id="txt_meta_title" name="txt_meta_title" ></td>
                                        </tr>
                                        <tr>
                                            <td> <label >Meta keyword</label></td>
                                            <td><input type="text" value="<?php echo $list_menu['meta_key_menus'] ?>" class="form-control" id="txt_key" name="txt_key" ></td>
                                        </tr>
                                        <tr>
                                            <td> <label>Meta Description</label></td>
                                            <td><input type="text" value="<?php echo $list_menu['meta_desc_menus'] ?>" class="form-control" id="txt_sedesc" name="txt_seodesc" ></td>
                                       </tr>
                                    </table>
                                </div>
                            </div><!-- /.tab-pane -->
                             <div class="tab-pane " id="tab_2">
                                <div class="box-body">
                                    <table class="table " >
                                        <tr>
                                            <td><label >Menu Title</label></td>
                                            <td><input type="text" <?php if ($list_menu['idArticlesCategories'] != 0) {
	echo 'disabled';
}
?> value="{{ $list_menu['title_en_menus'] }}" class="form-control" name="txt_name_en" id="txt_name_en" placeholder="Enter title"></td>
                                        </tr>
                                        <tr>
                                            <td> <label> Description</label></td>
                                            <td> <textarea name="txt_des_en" id="txt_des_en">{{$list_menu['des_en_menus']}}</textarea></td>
                                        </tr>
                                    </table>
                                </div>
                            </div><!-- /.tab-pane -->
                        </div><!-- /.tab-content -->
                    </div>
                </div> <!-- /.col-->
            </div><!-- row./ -->
        </section>
    </form>
</aside>

 <script src="<?php echo Asset('/') ?>store/js/jquery.js"></script>
        <script src="<?php echo Asset('/') ?>store/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo Asset('/') ?>store/js/bootstrap.min.js" type="text/javascript"></script>
         <script src="<?php echo Asset('/') ?>store/js/jquery.validate.js"></script>

        <!-- Plugin TinyCME -->
        <script src="<?php echo Asset('/') ?>store/tinymce/tinymce.min.js" type="text/javascript"></script>
        <!-- Upload file -->
         <script src="<?php echo Asset('') ?>store/admin/js/jquery.uploadfile.min.js"></script>

         <!-- DATA TABES SCRIPT -->
        <script src="<?php echo Asset('/') ?>store/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo Asset('/') ?>store/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo Asset('/') ?>store/admin/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo Asset('/') ?>store/admin/js/AdminLTE/demo.js" type="text/javascript"></script>
<script type="text/javascript">
            jQuery(function() {
                $("#tb1").dataTable({
                    "bFilter": false,
                    "bLengthChange": false
                });
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
        //
        if($('#sl_type').val()=='url'){
          $('#url').show();
        }
        $("#sl_type").change(function(event) {
          if ($("#sl_type").val()=='url') {
            $('#url').slideDown(800);
          }
          else{
            $('#url').slideUp(800);
          }
        });
        //
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
<script type="text/javascript" >
jQuery(document).ready(function(e) {
       $('#bt-submit').click(function(event) {
            if($('#txt_name_en').val()==''){
               $('#data_en a:first').tab('show');
            } else {
               $('#data_vn a:first').tab('show');
            }
         });
        $('#productForm').validate({
            rules: {
                txt_name:{
                    required: true
                },
                // txt_url:{
                //     required: true
                // },
                // txt_name_en:{
                //     required: true
                // },
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
            selector: "#txt_des,#txt_des_en",
            theme: "modern",
            width: 630,
            height: 100,
            relative_urls: false,
            remove_script_host: false,
            plugins: [
                 "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                 "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager "
           ],
           fontsize_formats: "8pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 18pt 24pt 26pt 36pt",
           //content_css: "css/content.css",
            toolbar: "insertfile undo redo | styleselect | bold italic | fontselect |  fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | responsivefilemanager | print preview media fullpage | forecolor backcolor emoticons",
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