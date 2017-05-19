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

        <link href="<?php echo Asset('/')?>store/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

        

@stop

@section('content')



 <aside class="right-side">

    <form  id="productForm" method="post"  action="<?php echo Asset('/')?>administrator/user/remove-log" accept-charset="utf-8" role="form" >             

    <section class="content-header">

                    <h1>ALL Logs</h1>

                    <div style="text-align: right">

                        <a href="<?php echo Asset('/') ?>administrator/user/log " class="btn btn-default  btn-flat"><span class="glyphicon glyphicon-refresh"></span></a>

                        <button type="submit" name="btnDeleteall" class="btn btn-danger btn-flat"><span class="glyphicon glyphicon-minus-sign"></span> Delete</button>

                    </div>

    </section> <!-- Function header -->

    <section class="content">

        @if( Session::has('message') )

                    <div class="alert alert-success alert-dismissable">

                        <i class="fa fa-check"></i>

                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                        <b>Alert!</b> Updated data success....

                    </div> <!--  Alert Action   -->

            {{Session::forget('message');}}

        @endif

        <div class="row">

            <div class="col-xs-12">

                <div class="box">

                        <div class="box-header">

                                    <h3 class="box-title"><span class="glyphicon glyphicon-align-justify"></span>&nbsp;User List </h3>

                        </div><!-- /.box-header -->

                                <div class="box-body table-responsive">

                                    <table id="tb_home" class="table table-bordered table-striped">

                                        <thead>

                                            <tr>

                                                <th><input type="checkbox" name="all" id="checkall" class="form-control" /></th>

                                                <th>Name Users</th>

                                                <th>Level</th>
                                                 <th>Ip</th>
                                                <th>Visited Date</th>

                                            </tr>

                                        </thead>

                                        <tbody>          

                                           @foreach ($list_log as $result)        

                                            <tr>

                                                <td><input type="checkbox" name="delete[]" value="<?php echo $result->idLog ?>" class="form-control" /></td>

                                                <td>{{ $result->name_log }} </td>

                                                <td>{{ $result->name }}</td>
                                                <td>{{ $result->ip_log}}</td>
                                                <td><?php echo $result->created_log ?></td>

                                            </tr>

                                            @endforeach

                                        </tbody>    

                                    </table>

                                </div><!-- /.box-body -->

                            </div><!-- /.box -->

            </div> <!-- col -->

        </div> <!-- row -->



    </section>

    </form>



 </aside>



  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>

        <!-- DATA TABES SCRIPT -->

        <script src="<?php echo Asset('/')?>store/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>

        <script src="<?php echo Asset('/')?>store/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

        <!-- AdminLTE App -->

        <script src="<?php echo Asset('/')?>store/admin/js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->

        <script src="<?php echo Asset('/')?>store/admin/js/AdminLTE/demo.js" type="text/javascript"></script>

        <!-- page script -->

        <script type="text/javascript">

            $(function() {

                $("#tb_home").dataTable();            

            });

            // check all delete 

        </script>

        <script type="text/javascript">

            $('#checkall:checkbox').change(function () {

                if($(this).attr("checked")) $('input:checkbox').attr('checked','checked');

                else $('input:checkbox').removeAttr('checked');

            });

        </script>



@stop

