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

     <form  id="productForm" method="post" accept-charset="utf-8" role="form" action="<?php echo Asset('/')?>administrator/menu/insert-cat"     >             

                <!-- Content Header (Page header) -->

                <section class="content-header">             

                    <h1>Articles Categories</h1>

                    <div style="text-align: right">

                        <button class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-floppy-saved"></span> Save </button>

                         <a href="<?php echo Asset('/') ?>administrator/menu/add-cat " class="btn btn-default  btn-flat"><span class="glyphicon glyphicon-refresh"></span></a>

                        <a href="<?php echo Asset('/') ?>administrator/menu/home" class="btn btn-danger btn-flat"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>

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

                            <div class="box">

                                <div class="box-header">

                                   <h3 class="box-title"><span class="glyphicon glyphicon-align-justify">&nbsp;</span>Choose articles categories display in menu </h3>

                                </div><!-- /.box-header -->

                                <div class="box-body table-responsive">

                                    <table id="tb_home" class="table table-bordered table-striped">

                                        <thead>

                                            <tr>

                                                <th><input type="checkbox" name="all" id="checkall" /></th>

                                                <th>Name Menu</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                        @foreach ($list_articlesCat as $result)

                                            <tr>

                                                <td><input type="checkbox" name="list_menu[]" value="<?php echo $result->idArticlesCategories ?>" /></td>

                                                <td><?php echo $result->name_articles_categories ?></td>

                                            </tr>

                                        @endforeach

                                        </tbody>                                    

                                    </table>

                                </div><!-- /.box-body -->

                            </div><!-- /.box -->

                        </div> <!-- /.col-->

                    </div><!-- row./ -->  

                </section>

                <!-- /.content -->

    </form>      

</aside><!-- /.right-side -->



       <script src="<?php echo Asset('/')?>store/js/jquery.js"></script>

        <script src="<?php echo Asset('/')?>store/js/jquery-1.11.1.min.js"></script>      

        <script src="<?php echo Asset('/')?>store/js/bootstrap.min.js" type="text/javascript"></script>

        

         <!-- DATA TABES SCRIPT -->

        <script src="<?php echo Asset('/')?>store/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>

        <script src="<?php echo Asset('/')?>store/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <!-- AdminLTE App -->

        <script src="<?php echo Asset('/')?>store/admin/js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->

        <script src="<?php echo Asset('/')?>store/admin/js/AdminLTE/demo.js" type="text/javascript"></script> 

<script type="text/javascript">

            jQuery(function() {

                $("#tb_home").dataTable({

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





@stop