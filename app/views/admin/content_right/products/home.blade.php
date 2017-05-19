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
    <form  id="productForm" method="post"  action="<?php echo Asset('/') ?>administrator/products/remove" accept-charset="utf-8" role="form" >
    <section class="content-header">
                    <h1>Products<small>/ home</small></h1>
                    <div style="text-align: right">
                        <a href="<?php echo Asset('/') ?>administrator/products/home " class="btn btn-default  btn-flat"><span class="glyphicon glyphicon-refresh"></span></a>
                        <a href="<?php echo Asset('/') ?>administrator/products/add " class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-plus-sign"></span> Add New</a>
                        <button type="submit" name="btnDeleteall" class="btn btn-danger btn-flat"><span class="glyphicon glyphicon-minus-sign"></span> Delete</button>
                        <button type="submit" name="bt_Update" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-floppy-saved"></span> Sort</button>
                    </div>
    </section> <!-- Function header -->
    <section class="content">
    @if( Session::has('message') )
                    <div class="alert alert-success alert-dismissable">
                        <i class="fa fa-check"></i>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <b>Alert!</b> Upadated data success....
                    </div> <!--  Alert Action   -->
                    {{Session::forget('message');}}
    @endif
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                            <div class="box-header">
                                <h3 class="box-title"><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Product List </h3>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <table id="tb_home" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                        <th><input type="checkbox" name="all" id="checkall" class="form-control" /></th>
                                            <th>Order</th>
                                            <th>image</th>
                                            <th>Product name</th>
                                            <th>Categories</th>
                                            <th>Price</th>
                                            <th>status</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($list_products as $result)
                                        <tr>
                                            <td><input type="checkbox" name="delete[]" value="<?php echo $result->idProducts ?>" class="form-control" /></td>
                                            <td><input type="text" name="ordering[]" value="{{$result->ordering_products }}" class="form-control" style="width:50px !important" />
                                                <input type="hidden" name="idhide[]" value="{{$result->idProducts}}" />
                                            </td>
                                            <td>
                                                <img src="<?php echo Asset('/') . 'store/upload/images/' . $result->thumb_products ?>" />
                                            </td>
                                            <td><?php echo $result->name_products ?></td>

                                            <td>{{$result->name_products_categories}}</td>
                                            <td><?php echo number_format($result->price_products, 0, ",", ".") ?></td>
                                            <td><a href="<?php echo Asset('/') . 'administrator/products/enable?id=' . $result->idProducts . '&stt=' . $result->enable_products ?>" class="btn btn-flat <?php if ($result->enable_products == 1) {
            echo "btn-primary";
    } else {
            echo "btn-danger";
    }
    ?>  btn-sm">
                                                <?php if ($result->enable_products == 1) {
            echo "enable";
    } else {
            echo "disable";
    }
    ?>
                                                </a>
                                            </td>
                                            <td><a href="<?php echo Asset('/') . 'administrator/products/update?id=' . $result->idProducts ?>" class="btn btn-info btn-flat">  <span class="glyphicon glyphicon-pencil">  </span></a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
            </div> <!-- col -->
            <div class="text-center">
                <div class="paginate"><?php echo $list_products->links(); ?></div>
            </div>
        </div> <!-- row -->
    </section>
    </form>
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
        <!-- page script -->
        <script type="text/javascript">
                $('#tb_home').dataTable();
        </script>
@stop
