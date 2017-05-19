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
 <form id="productForm" method="post" action="<?php echo Asset('/') ?>administrator/district/update"  accept-charset="uft8" role="form">
    <section class="content-header">
        <h1>district<small>/ update</small></h1>
        <div style="text-align: right">
            <button class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-floppy-save"></span> Save </button>
            <a href="<?php echo Asset('/') ?>administrator/district/home" class="btn btn-danger btn-flat"><i class="fa fa-fw fa-mail-reply"></i>Back</a>
        </div>
    </section> <!-- Function header -->
    <section class="content">
      <div class="row">

        <!-- left column -->
        <div class="  col-md-12 col-lg-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Data</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <table class="table " >
                                <tr>
                                    <td width="200"><label >Chọn Tỉnh/ Thành</label></td>
                                    <td>
                                        <select class="form-control" id="sl_province" name="sl_province">
                                            <option value="0"> Chọn tỉnh/thành</option>
                                            @foreach($list_province as $result)
                                                <option <?php if ($list_district['id_province'] == $result->id_province) {echo 'selected';}?> value="{{$result->id_province}}">{{$result->name_province}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label >Tên tỉnh/ thành</label></td>
                                    <td>
                                        <input type="text" class="form-control" value="{{$list_district['name_district']}}"  name="txt_name" id="txt_name" placeholder="Enter title">
                                        <input type="hidden" id="txt_id" name="txt_id" value="<?php echo $list_district['id_district'] ?>" >
                                    </td>
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
     // choose images avatar district
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