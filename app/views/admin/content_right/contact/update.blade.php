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

 

   <form id="productForm" method="post" action="<?php echo Asset('/') ?>administrator/contact/update"  accept-charset="uft8" role="form">

    <section class="content-header">

                    <h1>Contact<small>/ update</small></h1>

                    <div style="text-align: right">

                        <button class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-floppy-save"></span> Save </button>

                        <a href="<?php echo Asset('/') ?>administrator/contact/home" class="btn btn-danger btn-flat"><i class="fa fa-fw fa-mail-reply"></i> Back</a>

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

                                                            <td style="width:200px !important"><label >Contact Name</label></td>

                                                            <td><textarea class="form-control" name="txt_name" id="txt_name" placeholder="Enter name" rows="5">{{$list_contact->name_contact}}</textarea>

                                                                <input type="hidden" name="txt_id" id="txt_id" value="{{ $list_contact['idContact'] }}" /> 

                                                            </td>                                                

                                                        

                                                        </tr>

                                                        <tr>

                                                            <td> <label>Contact Address</label></td>

                                                            <td><input type="text" class="form-control" value="{{$list_contact->address_contact }}" name="txt_add"id="txt_add" placeholder="Enter address" /> </td>

                                                        </tr>

                                                        <tr>

                                                            <td> <label>Contact Email</label></td>

                                                            <td><input type="text" class="form-control" value="{{$list_contact->email_contact}}" name="txt_email"id="txt_email" placeholder="Enter email" /> </td>

                                                        </tr>

                                                         <tr>

                                                            <td> <label>Contact Telephone</label></td>

                                                            <td><input type="text" class="form-control" value="{{$list_contact->telephone_contact}}" name="txt_telephone"id="txt_telephone" placeholder="Enter telephone" /></td>

                                                        </tr>

                                                         <tr>

                                                            <td> <label>Contact Mobilephone</label></td>

                                                            <td><input type="text" class="form-control"value="{{$list_contact->mobilephone_contact}}" name="txt_mobile"id="txt_mobile" placeholder="Enter mobilephone" /></td>

                                                        </tr>

                                                         <tr>

                                                            <td> <label>Contact Yahoo</label></td>

                                                            <td><input type="text" class="form-control" value="{{$list_contact->yahoo_contact}}" name="txt_yahoo"id="txt_yahoo" placeholder="Enter yahoo" /> </td>

                                                        </tr>

                                                         <tr>

                                                            <td> <label>Contact Skype</label></td>

                                                            <td><input type="text" class="form-control" value="{{$list_contact->skype_contact}}" name="txt_skype"id="txt_skype" placeholder="Enter Skype" /></td>

                                                        </tr>        
                                                        <tr>
                                                            <td> <label>Contact facebook</label></td>

                                                            <td><input type="text" class="form-control" value="{{$list_contact->facebook_contact}}" name="txt_facebook"id="txt_facebook" placeholder="Enter Facebook" /></td>

                                                        </tr>   
                                                        <tr>

                                                            <td> <label >Status</label></td>

                                                           <td>

                                                                <input type="radio" <?php if($list_contact['enable_contact'] == 1) echo 'checked="checked"'?>  name="rd_status" checked="checked"  value="1">&nbsp;On &nbsp;&nbsp;     

                                                                <input type="radio" <?php if($list_contact['enable_contact'] == 0) echo 'checked="checked"'?> name="rd_status" value="0"> Off

                                                            </td>

                                                        </tr>

                                                         <tr>

                                                            <td> <label >Sort </label></td>

                                                            <td> <input type="text" class="form-control" value="{{$list_contact->ordering_contact}}" name="txt_sort" id="txt_sort"> </td>

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