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
        <link href="<?php echo Asset('/') ?>store/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

@stop
@section('content')
 <aside class="right-side">
    <form  id="productForm" method="post"  action="<?php echo Asset('/') ?>administrator/eventCat/remove" accept-charset="utf-8" role="form" >
    <section class="content-header">
                    <h1>Danh mục sự kiện<small>/ home</small></h1>
                    <div style="text-align: right">
                        <a href="<?php echo Asset('/') ?>administrator/eventCat/home " class="btn btn-default  btn-flat"><span class="glyphicon glyphicon-refresh"></span></a>
                        <a href="<?php echo Asset('/') ?>administrator/eventCat/add " class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-plus-sign"></span> Add New</a>
                        <button type="submit" name="btn_Delete" class="btn btn-danger btn-flat"><span class="glyphicon glyphicon-minus-sign"></span> Delete</button>
                    </div>
    </section> <!-- Function header -->
    <section class="content">
                @if( Session::has('message') )
                    <div class="alert alert-success alert-dismissable">
                        <i class="fa fa-check"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <b>Alert!</b> Updated data successfully....
                    </div> <!--  Alert Action   -->
                    {{Session::forget('message');}}
                @endif
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                        <div class="box-header">
                                    <h3 class="box-title"><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Danh sách danh mục</h3>
                        </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="tb_home" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" name="all" id="checkall" class="form-control" /></th>
                                                <th>thứ tự danh mục</th>
                                                <th>Tên danh mục</th>
<!--                                                 <th>Tình trạng</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($list_eventCat as $result)
                                            <tr>
                                                <td><input type="checkbox" name="delete[]" value="<?php echo $result->id_event_categories ?>" class="form-control" /></td>
                                                <td>
                                                    <input type="text" name="ordering[]" value="{{$result->ordering_event_categories}}" class="form-control" style="width:50px !important" />
                                                    <input type="hidden" name="idhide[]" value="{{$result->ordering_event_categories}}" />
                                                </td>
                                                <td>{{$result->name_event_categories}}</td>
                                                <td><a href="<?php echo Asset('/') . 'administrator/eventCat/update?id=' . $result->id_event_categories ?>" class="btn btn-info btn-flat"> <span class="glyphicon glyphicon-pencil">  </span></a></td>
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
        <script src="<?php echo Asset('/') ?>store/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo Asset('/') ?>store/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo Asset('/') ?>store/admin/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo Asset('/') ?>store/admin/js/AdminLTE/demo.js" type="text/javascript"></script>
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
