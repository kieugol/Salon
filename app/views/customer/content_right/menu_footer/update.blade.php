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
 
   <form id="productForm" method="post" action="<?php echo Asset('/') ?>administrator/articles/update"  accept-charset="uft8" role="form">
    <section class="content-header">
                    <h1>Menu<small>/ Update</small></h1>
                    <div style="text-align: right">
                        <button class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-floppy-save"></span> Save </button>
                        <a href="<?php echo Asset('/') ?>administrator/user/home" class="btn btn-danger btn-flat"><i class="fa fa-fw fa-mail-reply"></i> Back</a>
                    </div> 
    </section> <!-- Function header -->

    <section class="content">
     <?php if( isset($check) && $check==1 ){ ?>
            <div class="alert alert-success alert-dismissable">
                <i class="fa fa-check"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <b>Alert!</b> Update data success....
            </div> <!--  Alert Action   -->
    <?php
        $check==0;
        } 
    ?>
      <div class="row">
           
                        <!-- left column -->                
            <div class="  col-md-10 col-lg-10">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1" data-toggle="tab">Data</a></li>
                    </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">                              
                                        <div class="box-body">
                                            <table class="table">
                                                        <tr>
                                                            <td><label >Menu Title</label></td>
                                                            <td><input type="text" value="{{ $list_menu['title_menus'] }}" class="form-control" name="txt_title" id="txt_title" placeholder="Enter name">
                                                                <input type="hidden" id="txt_id" name="txt_id" value="{{ $list_menu['idMenus'] }}" class="form-control" >
                                                            </td>                                                                                       
                                                        </tr>
                                                        <tr>
                                                            <td> <label >Status</label></td>
                                                            <td>
                                                                <input type="radio" <?php if($list_menu['enable_menus'] == 1) echo 'checked="checked"'?>  name="rd_status" checked="checked"  value="1">&nbsp;On &nbsp;&nbsp;     
                                                                <input type="radio" <?php if($list_menu['enable_menus'] == 0) echo 'checked="checked"'?> name="rd_status" value="0"> Off
                                                            </td>
                                                        </tr>
                                                         <tr>
                                                            <td> <label >Sort </label></td>
                                                            <td> <input type="text" value="<?php echo $list_menu['ordering_menus'] ?>" class="form-control" name="txt_sort" id="txt_sort"> </td>
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
                                </div><!-- /.tab-content -->
                </div>
            </div> <!-- /.col-->
        </div><!-- row./ -->  
    </section>
    </form>    
</aside>

 <!-- end gallery  -->
       <script src="<?php echo Asset('/')?>store/js/jquery.js"></script>
        <script src="<?php echo Asset('/')?>store/js/jquery-1.11.1.min.js"></script>      
        <script src="<?php echo Asset('/')?>store/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo Asset('/')?>store/js/jquery.validate.js"></script>

         <!-- DATA TABES SCRIPT -->
        <script src="<?php echo Asset('/')?>store/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo Asset('/')?>store/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo Asset('/')?>store/admin/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo Asset('/')?>store/admin/js/AdminLTE/demo.js" type="text/javascript"></script> 
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

<script type="text/javascript" >
        jQuery(document).ready(function(e) {
    /*dang ky*/
        $('#productForm').validate({ 
            rules: {
                txt_title:{
                    required: true
                },
                txt_introtext:{
                    required: true
                },
                 txt_sort:{
                    required: true,
                    number:true
                },
                 txt_related_articles:{
                    required: true
                }
            },
            messages: {
            }
        });
    /*end đăng ký*/
});
</script>

@stop