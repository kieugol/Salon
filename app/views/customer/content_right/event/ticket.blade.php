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
    <form  id="productForm" method="post"  action="<?php echo Asset('/') ?>administrator/event/remove" accept-charset="utf-8" role="form" >
    <section class="content-header">
        <h1>Sự kiện đặt hẹn<small>/ home</small></h1>
        <div style="text-align: right">
            <a href="<?php echo Asset('/') ?>administrator/event/ticket" class="btn btn-default  btn-flat"><span class="glyphicon glyphicon-refresh"></span></a>
           <a href="<?php echo Asset('/') ?>administrator/event/home " class="btn btn-default btn-flat"><i class="fa fa-fw fa-mail-reply"></i>Back</a>
        </div>
    </section> <!-- Function header -->
    <section class="content">
    @if( Session::has('message') )
        <div class="alert alert-success alert-dismissable">
            <i class="fa fa-check"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <b>Alert!</b> Upadated data success....
        </div> <!--  Alert Action   -->
        {{Session::forget('message')}}
    @endif
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Danh sách sự kiện đặt vé</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="tb_home" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sự kiện</th>
                                    <th>Salon</th>
                                    <th>Dịch vụ</th>
                                    <th>Thông tin KH</th>
                                    <th>Ngày đặt hẹn</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($list_ticket as $result)
                                <tr>
                                    <td>{{$result->name_event}}</td>
                                    <td>{{$result->name_salon}}</td>
                                    <td>{{$result->service_ticket}}</td>
                                    <td>
                                        <?php
echo "<strong>Tên: </strong>" . $result->name_customer;
echo "<br><strong>Sdt: </strong>" . $result->phone_customer;
echo "<br><strong>Email: </strong>" . $result->email_customer;
echo "<br><strong>Đ/c: </strong>" . $result->address_customer;
?>
                                    </td>
                                    <td>{{$result->hour_ticket}} <strong>Ngày</strong> {{$result->date_ticket}}</td>
                                   <td>{{$result->message_customer}}</td>
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
    $(document).ready(function(){
        $('#tb_home').dataTable();
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
