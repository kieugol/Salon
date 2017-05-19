@extends('admin.main')
@section('script')
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
            <!--Datatable-->
        <!-- Theme style -->
        <link href="<?php echo Asset('/') ?>store/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <!-- Upload file -->
        <link href="<?php echo Asset('/') ?>store/admin/css/uploadfile.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Asset('/') ?>store/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@stop
@section('content')
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
     <form  id="productForm" method="post"  action="<?php echo Asset('/') ?>administrator/event/update" accept-charset="utf-8" role="form"   >
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Sự kiện
                <small>/cập nhật</small>
            </h1>
            <div style="text-align: right">
                <button class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-floppy-save"></span> Save </button>
                <a href="<?php echo Asset('/') ?>administrator/event/home" class="btn btn-default btn-flat"><i class="fa fa-fw fa-mail-reply"></i> Back</a>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            @if( Session::has('message') )
                <div class="alert alert-success alert-dismissable">
                    <i class="fa fa-check"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <b>Alert!</b> Inserts data success....
                </div> <!--  Alert Action   -->
                {{Session::forget('message');}}
            @endif
            <div class="row">
                <!-- left column -->
                <div class=" col-md-12 col-lg-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Data</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="box-body">
                                    <table class="table " >
                                        <tr>
                                            <td><label>Thumbs</label></td>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target=".gallery-img">
                                                <img id="img-data" src="<?php echo Asset('/') . 'store/upload/images/' . $event_details['thumb_event'] ?>">
                                                </a> <br />
                                                <a href="#" id="img-product"  data-toggle="modal" data-target=".gallery-img"> Changes images</a>
                                                <input type="hidden" id="txt_thumb" name="txt_thumb" value="logo.png" class="form-control" >
                                                <input type="hidden" value="{{$event_details['id_event']}}" id="txt_id" name="txt_id">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Tên sự kiện</label></td>
                                            <td><input type="text" value="{{$event_details['name_event']}}" class="form-control" name="txt_name"id="txt_name" placeholder="Enter name"></td>

                                        </tr>
                                        <tr>
                                            <td><label>Chọn salon</label></td>
                                            <td>
                                                <select class="form-control" id="sl_salon" name="sl_salon">
                                                @foreach($list_salon as $salon)
                                                    <option <?php if ($salon->id_salon == $event_details['id_salon']) {
	echo 'selected';
}
?> value="{{$salon->id_salon}}">{{$salon->name_salon}}({{$salon->name_province}})</option>
                                                @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Danh mục</label></td>
                                            <td>
                                                <select class="form-control" id="sl_categories" name="sl_categories">
                                                @foreach($list_eventcat as $eventcat)
                                                    <option <?php if ($eventcat->id_event_categories == $event_details['id_event_categories']) {
	echo 'selected';
}
?> value="{{$eventcat->id_event_categories}}">{{$eventcat->name_event_categories}}</option>
                                                @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>Ngày bắt đầu</label></td>
                                            <td><input type="text"  value="<?php echo date('d/m/Y', strtotime($event_details['date_start'])); ?>" class="form-control" name="txt_date_start" id="txt_date_start"> </td>
                                        </tr>
                                        <tr>
                                            <td><label>Ngày kết thúc</label></td>
                                            <td><input type="text" value="<?php echo date('d/m/Y', strtotime($event_details['date_end'])); ?>" class="form-control" name="txt_date_end" id="txt_date_end"> </td>
                                        </tr>
<!--                                         <tr>
                                            <td> <label >Status</label></td>
                                            <td>
                                                <input type="radio" name="rd_status" checked="checked"  value="1">&nbsp;On &nbsp;&nbsp;
                                                <input type="radio" name="rd_status" value="0"> Off
                                            </td>
                                        </tr> -->
                                        <tr>
                                            <td><label>Thứ tự</label></td>
                                            <td> <input value="{{$event_details['ordering_event']}}" type="text" class="form-control" name="txt_sort" id="txt_sort"> </td>
                                        </tr>
                                        <tr>
                                            <td><label>Mô tả ngắn</label></td>
                                            <td> <textarea name="txt_sort_des"rows="6" id="txt_sort_des" class="form-control">{{$event_details['short_desc_event']}}</textarea></td>
                                        </tr>
                                        <tr>
                                            <td> <label >Mô tả</label></td>
                                            <td> <textarea name="txt_des" id="txt_des">{{$event_details['des_event']}}</textarea></td>
                                        </tr>
<!--
                                        <tr>
                                            <td> <label >Meta title</label></td>
                                            <td><input type="text" class="form-control" id="txt_title" name="txt_title" ></td>
                                        </tr>
                                        <tr>
                                            <td> <label >Meta keyword</label></td>
                                            <td><input type="text" class="form-control" id="txt_key" name="txt_key" ></td>
                                        </tr>
                                        <tr>
                                            <td> <label>Meta Description</label></td>
                                            <td><input type="text" class="form-control" id="txt_sedesc" name="txt_seodesc" ></td>
                                        </tr> -->
                                    </table>
                                </div>
                            </div><!-- /.tab-pane -->
                        </div><!-- /.tab-content -->
                    </div>
                </div> <!-- /.col-->
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
                                <img width="100" height="80"  src="<?php echo Asset('/') . "store/upload/images/" . $value->name_file ?>" data-toggle="tooltip" data-placement="top" title="{{$value->name_display}}">
                             </a>
                        </li>
                    @endforeach
                        <?php
$min_id = 0;
foreach ($max_id as $result) {
	$min_id = $result->id;
}

// check min id
foreach ($max_id as $result) {
	if ($result->id < $min_id) {
		$min_id = $result->id;
	}

}
?>
                            <input type="hidden" name="max_id" id="max_id" value="{{$min_id}}" />
                    </ul>
            </div>
            <div class="modal-footer">
                   <h4 class="text-center"><b><a href="#" id="load_more">---Load more---</a></b></h4>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div>
 <!-- end gallery  -->
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
                $("#txt_date_start").datepicker();
                $("#txt_date_end").datepicker();
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
     // choose images avatar event
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
                    required: true,
                    number:true
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
            selector: "textarea#txt_des,textarea#txt_about",
            theme: "modern",
            width: 800,
            height: 300,
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