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
      <form  id="productForm" method="post" accept-charset="utf-8" role="form" action="<?php echo Asset('/')?>administrator/menu/insert-header"  >             
    <section class="content-header">
        <h1>Menu Header<small>/ Add</small></h1>
        <div style="text-align: right">
            <button type="submit" class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-plus-sign"></span> Add</button>
            <a href="<?php echo Asset('/') ?>administrator/menu/add-header " class="btn btn-default  btn-flat"><span class="glyphicon glyphicon-refresh"></span></a>
             <a href="<?php echo Asset('/') ?>administrator/menu/header "  class="btn btn-danger btn-flat"><span class="glyphicon glyphicon-minus-sign"></span> Back</a>
        </div>
    </section> <!-- Function header -->
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
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                       <h3 class="box-title"><span class="glyphicon glyphicon-align-justify">&nbsp;</span>Choose Menu Display </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="tb_home" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="all" id="checkall" /></th>
                                    <th>Name Menu</th>
                                    <th>Menu Type</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($list_menu as $result)
                                <tr>
                                    <td width="50"><input type="checkbox" name="list_header[]" value="<?php echo $result->idMenus ?>" /></td>
                                    <td width="200"><?php echo $result->title_menus ?> </td>
                                    <td><?php echo $result->default_menus ?> </td>
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
            if($(this).attr("checked")) {
                $('input:checkbox').attr('checked','checked');
            }
         else $('input:checkbox').removeAttr('checked');
        });
        </script>

@stop
