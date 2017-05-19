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

     <form  id="productForm" method="post" accept-charset="utf-8" role="form" action="<?php echo Asset('/')?>administrator/contact/insert"  >             

                <!-- Content Header (Page header) -->

                <section class="content-header">             

                <h1>Contact<small>/ insert</small></h1>

                    <div style="text-align: right">

                        <button class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-floppy-save"></span> Save </button>

                        <a href="<?php echo Asset('/') ?>administrator/contact/home" class="btn btn-danger btn-flat"><i class="fa fa-fw fa-mail-reply"></i>Back</a>

                    </div> 

                </section>



                <!-- Main content -->

                <section class="content">

                @if( Session::has('message') )

                    <div class="alert alert-success alert-dismissable">

                        <i class="fa fa-check"></i>

                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                        <b>Alert!</b> Inserted data success....

                    </div> <!--  Alert Action   -->

                    {{Session::forget('message');}}

                @endif

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

                                                            <td style="width:200px !important"><label >About</label></td>

                                                            <td><textarea name="txt_name" id="txt_name" class="form-control" rows="5"></textarea></td>                                                                                   

                                                        </tr>

                                                        <tr>

                                                            <td> <label>Contact Address</label></td>

                                                            <td><input type="text" class="form-control" name="txt_add"id="txt_add" placeholder="Enter address" /> </td>

                                                        </tr>
                                                        <tr>

                                                            <td> <label>Contact Email</label></td>

                                                            <td><input type="text" class="form-control" name="txt_email"id="txt_email" placeholder="Enter email" /> </td>

                                                        </tr>
                                                         <tr>

                                                            <td> <label>Contact Telephone</label></td>

                                                            <td><input type="text" class="form-control" name="txt_telephone"id="txt_telephone" placeholder="Enter telephone" /></td>

                                                        </tr>

                                                         <tr>

                                                            <td> <label>Contact Mobilephone</label></td>

                                                            <td><input type="text" class="form-control" name="txt_mobile"id="txt_mobile" placeholder="Enter mobilephone" /></td>

                                                        </tr>

                                                         <tr>

                                                            <td> <label>Contact google +</label></td>

                                                            <td><input type="text" class="form-control" name="txt_yahoo"id="txt_yahoo" placeholder="Enter yahoo" /> </td>

                                                        </tr>

                                                         <tr>

                                                            <td> <label>Contact Skype</label></td>

                                                            <td><input type="text" class="form-control" name="txt_skype"id="txt_skype" placeholder="Enter Skype" /></td>

                                                        </tr>
                                                        <tr>
                                                            <td> <label>Contact facebook</label></td>

                                                            <td><input type="text" class="form-control" name="txt_facebook"id="txt_facebook" placeholder="Enter Facebook" /></td>

                                                        </tr>         

                                                        <tr>

                                                            <td> <label >Status</label></td>

                                                            <td>

                                                                <input type="radio" name="rd_status" checked="checked"  value="1">&nbsp;On &nbsp;&nbsp;     

                                                                <input type="radio" name="rd_status" value="0"> Off

                                                            </td>

                                                        </tr>

                                                         <tr>

                                                            <td> <label >Sort </label></td>

                                                            <td> <input type="text" class="form-control" name="txt_sort" id="txt_sort"> </td>

                                                        </tr>         

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

                txt_skype:{

                    required: true

                },

                txt_yahoo:{

                    required: true

                },

                txt_add:{

                    required: true

                },

                txt_sort:{

                    required: true,

                    number:true

                },

                txt_email:{

                    required: true,

                    email:true

                },

                txt_mobile:{

                    required: true,


                },

                txt_telephone:{

                    required: true,


                }

            },            

            messages: {

            }

        });

});

</script>





@stop