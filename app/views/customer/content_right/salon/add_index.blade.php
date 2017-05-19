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
        <style type="text/css">
                tfoot{
                    display: table-caption !important;
                }
                tfoot tr{ }
                tfoot td{ }
                tfoot tr th{
                    border:0 !important;
                    padding-left: 0 !important;
                }
                .form-control{
                    width: auto !important;
                }
                .hidden tr{
                    padding: 0 !important;
                    margin: 0 !important;
                }
                .hidden tr td{
                     padding: 0 !important;
                    margin: 0 !important;
                }
                .paginate ul{
                    margin:0 20px 0 0  !important;
                }
         </style>

@stop
@section('content')
 <aside class="right-side">
    <form  id="productForm" method="post"  action="<?php echo Asset('/') ?>administrator/salon/insert-index" accept-charset="utf-8" role="form" >
    <section class="content-header">
                    <h1>Thêm salon hiển thị <small>/add</small></h1>
                    <div class="text-right">
                         <button class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-floppy-save"></span> Save </button>
                        <a href="<?php echo Asset('/') ?>administrator/salon/display-index" class="btn btn-default btn-flat"><i class="fa fa-fw fa-mail-reply"></i> Back</a>
                    </div>
    </section> <!-- Function header -->
    <section class="content">
    @if( Session::has('message') )
        <div class="alert alert-success alert-dismissable">
            <i class="fa fa-check"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <b>Alert!</b> Inserted data successfully ...
        </div> <!--  Alert Action   -->
        {{Session::forget('message');}}
    @endif
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Salon List </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="tb_home" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="all" id="checkall" class="form-control" /></th>
                                    <th>image</th>
                                    <th>Tên salon</th>
                                    <th>Tỉnh/Thành</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($list_salon as $result)
                                <tr>
                                    <td><input type="checkbox" name="id[]" value="<?php echo $result->id_salon ?>" class="form-control" /></td>
                                    <td><img src="<?php echo Asset('/') . 'store/upload/images/' . $result->thumb_salon ?>"/>
                                    <td>{{$result->name_salon}}</td>
                                    <td>{{$result->name_district .  ',' . $result->name_province}}</td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div> <!-- col -->
            <div class="text-center">
                <div class="paginate"><?php echo $list_salon->links(); ?></div>
            </div>
        </div> <!-- row -->
    </section>
    </form>

<!-- Modal -->
<div class="modal fade" id="myService" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Danh sách dịch vụ</h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
 </aside>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="<?php echo Asset('/') ?>store/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo Asset('/') ?>store/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
         <script src="<?php echo Asset('/') ?>store/admin/js/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo Asset('/') ?>store/admin/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo Asset('/') ?>store/admin/js/AdminLTE/demo.js" type="text/javascript"></script>
        <script type="text/javascript">
            $('#tb_home').dataTable();
            $('#checkall:checkbox').change(function () {
                if($(this).attr("checked")) $('input:checkbox').attr('checked','checked');
                else $('input:checkbox').removeAttr('checked');
            });
            $('.view-service').click(function(){
                var svhtml =  $(this).next().html();
                $('#myService .modal-body').html(null);
                $('#myService .modal-body').html(svhtml);
                $('#myService').modal('show');
                return false;
            });
        </script>
@stop
