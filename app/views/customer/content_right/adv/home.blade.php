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
         </style>
        
@stop
@section('content')
 <aside class="right-side">
    <form  id="productForm" method="post"  action="<?php echo Asset('/')?>administrator/adv/remove" accept-charset="utf-8" role="form" >             
    <section class="content-header">
                    <h1>Adv<small>/ home</small></h1>
                    <div style="text-align: right">
                        <a href="<?php echo Asset('/') ?>administrator/adv/home " class="btn btn-default  btn-flat"><span class="glyphicon glyphicon-refresh"></span></a>
                        <a href="<?php echo Asset('/') ?>administrator/adv/add " class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-plus-sign"></span> Add New</a>
                        <button type="submit" name="bt_Delete" class="btn btn-danger btn-flat"><span class="glyphicon glyphicon-minus-sign"></span> Delete</button>
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
                                    <h3 class="box-title"><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Adv List </h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="tb_home" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" name="all" id="checkall" class="form-control" /></th>
                                                <th>Ordering</th>
                                                <th>Block(postion)</th>
                                                <th>Images_adv</th>
                                                <th>On page</th>
                                                <th>title</th>
                                                <th>Url_adv</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                         <tfoot>
                                            <tr>
                                                <th class="hidden"></th>
                                                <th class="hidden"></th>
                                                <th>block</th>
                                                <th class="hidden"></th>
                                                <th class="hidden"></th>
                                                <th class="hidden"></th>
                                                <th class="hidden"></th>
                                                <th>Status</th>
                                                <th class="hidden"></th>
                                            </tr>
                                             </tfoot>
                                        <tbody>
                                <?php
                                            foreach ($list_adv as $result) {
                                         ?>  
                                            <tr>
                                                <td><input type="checkbox" name="delete[]" value="<?php echo $result->idAdvRight ?>" class="form-control" /></td>
                                                <td><input type="text" name="ordering[]" value="{{$result->ordering_adv_right }}" class="form-control" style="width:50px !important" />
                                                    <input type="hidden" name="idhide[]" value="{{$result->idAdvRight}}" />
                                                </td>
                                                <td>
                                                    <?php 
                                                        if($result->position_adv_right==1)
                                                            echo '<b>Block 1</b>';
                                                        if($result->position_adv_right==2)
                                                            echo '<b>Block 2</b>';
                                                        if($result->position_adv_right==3)
                                                            echo '<b>Block 3</b>';
                                                        if($result->position_adv_right==4)
                                                            echo '<b>Block 4</b>';
                                                        if($result->position_adv_right==5)
                                                            echo '<b>Block 5</b>';
                                                        if($result->position_adv_right==6)
                                                            echo '<b>Block 6</b>';
                                                    ?>
                                                </td>
                                                <td><img src="<?php echo Asset('/').'store/upload/images/'.$result->image_adv_right ?>" /></td>
                                                <td width="50">{{$result->onpage_adv_right }}</td>
                                                <td>{{$result->title_adv_right }}</td>
                                                <td>{{$result->url_adv_right}}</td>
                                                <td><a href="<?php echo Asset('/').'administrator/adv/enable?id='.$result->idAdvRight.'&stt='.$result->enable_adv_right ?>" class="btn btn-flat <?php if($result->enable_adv_right==1) echo "btn-primary" ; else echo "btn-danger"; ?>  btn-sm">
                                                    <?php if($result->enable_adv_right==1) echo "enable"; else echo "disable"; ?>
                                                    </a>
                                                </td>
                                                <td><a href="<?php echo Asset('/').'administrator/adv/update?id='.$result->idAdvRight ?>" class="btn btn-info btn-flat">  <span class="glyphicon glyphicon-pencil">  </span></a></td>
                                            </tr>
                                <?php
                                        } 
                                        ?>
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
        <script src="<?php echo Asset('/')?>store/admin/js/jquery.dataTables.columnFilter.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo Asset('/')?>store/admin/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo Asset('/')?>store/admin/js/AdminLTE/demo.js" type="text/javascript"></script>
        <!-- page script -->
        <script type="text/javascript">
            $(document).ready(function(){
                $('#tb_home').dataTable().columnFilter({
                    aoColumns: 
                    [ 
                            null,
                            null,
                            { type: "select",values: [ 'Block 1','Block 2','Block 3','Block 4','Block 5','Block 6'] },
                            null,
                            null,
                            null,
                            null,
                            { type: "select",values: [ 'enable','disable'] },
                            null
                    ]
                });
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
