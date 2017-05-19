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
 
   <form id="productForm" method="post" action="<?php echo Asset('/') ?>administrator/shipping/update"  accept-charset="uft8" role="form">
    <section class="content-header">
                    <h1>Shipping<small>/ update</small></h1>
                    <div style="text-align: right">
                        <button class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-floppy-save"></span> Save </button>
                        <a href="<?php echo Asset('/') ?>administrator/shipping/home" class="btn btn-danger btn-flat"><i class="fa fa-fw fa-mail-reply"></i> Back</a>
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
                                        <div class="box-body">
                                            <table class="table " >
                    
                                                        <tr>
                                                            <td><label >Shpping Name</label></td>
                                                            <td><input type="text" class="form-control" value="{{$list_shipping['name_shipping']}}" name="txt_name"id="txt_name" placeholder="Enter name">
                                                                <input type="hidden" name="txt_id" value="<?php echo $list_shipping['idShipping'] ?>" />
                                                            </td>                                                
                                                        
                                                       </tr>                            
                                                        <tr>
                                                            <td> <label >Status</label></td>
                                                            <td>
                                                                <input type="radio" name="rd_status" <?php if($list_shipping['enable_shipping'] == 1) echo 'checked="checked"'?>   value="1">&nbsp;On &nbsp;&nbsp;     
                                                                <input type="radio" name="rd_status" <?php if($list_shipping['enable_shipping'] == 0) echo 'checked="checked"'?>  value="0"> Off
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> <label> Description</label></td>
                                                            <td> <textarea name="txt_des" id="txt_des" rows="4" cols="60">{{$list_shipping['des_shipping']}}</textarea></td>
                                                        </tr>
                                                         <tr>
                                                            <td> <label >Meta title</label></td>
                                                            <td><input type="text" value="{{$list_shipping['meta_title_shipping']}}" class="form-control"  id="txt_title" name="txt_title" ></td>
                                                        </tr>
                                                        <tr>
                                                            <td> <label >Meta keyword</label></td>
                                                            <td><input type="text" value="{{$list_shipping['meta_key_shipping']}}" class="form-control" id="txt_key" name="txt_key" ></td>
                                                        </tr>
                                                        <tr>
                                                            <td> <label>Meta Description</label></td>
                                                            <td><input type="text" value="{{$list_shipping['meta_desc_shipping']}}"  class="form-control" id="txt_sedesc" name="txt_seodesc" ></td>
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

       <script src="<?php echo Asset('/')?>store/js/jquery.js"></script>
        <script src="<?php echo Asset('/')?>store/js/jquery-1.11.1.min.js"></script>      
        <script src="<?php echo Asset('/')?>store/js/bootstrap.min.js" type="text/javascript"></script>
         <script src="<?php echo Asset('/')?>store/js/jquery.validate.js"></script>

        <!-- AdminLTE App -->
        <script src="<?php echo Asset('/')?>store/admin/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo Asset('/')?>store/admin/js/AdminLTE/demo.js" type="text/javascript"></script> 
    

<script type="text/javascript" >
        jQuery(document).ready(function(e) {
        $('#productForm').validate({ 
            rules: {
                txt_name:{
                    required: true
                },
                txt_des:{
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