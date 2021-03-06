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
      <form  id="productForm" method="post" accept-charset="utf-8" role="form" action="<?php echo Asset('/')?>administrator/articles/remove"  >             
    <section class="content-header">
        <h1>Articles<small>/ home</small></h1>
        <div style="text-align: right">
             <a href="<?php echo Asset('/') ?>administrator/articles/home " class="btn btn-default  btn-flat"><span class="glyphicon glyphicon-refresh"></span></a>
            <a href="<?php echo Asset('/') ?>administrator/articles/add " class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-plus-sign"></span> Add New</a>
            <button type="submit" name="bt_Delete" class="btn btn-danger btn-flat"><span class="glyphicon glyphicon-minus-sign"></span> Delete</button>
             <button type="submit" name="bt_Update" class="btn btn-success btn-flat"><span class="glyphicon glyphicon-floppy-saved"></span> Sort</button>
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
                                   <h3 class="box-title"><span class="glyphicon glyphicon-align-justify">&nbsp;</span>Articles List </h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="tb_home" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            <th><input type="checkbox" name="all" id="checkall" /></th>
                                                <th>Order</th>
                                                <th>image</th>
                                                <th>articles name</th>
                                                <th>Categories</th>
                                                <th>created_by</th>
                                                <th>created_date</th>
                                                <th>status</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                            foreach ($list_articles as $result) {
                                        ?>  
                                            <tr>
                                                <td><input type="checkbox" name="delete[]" value="<?php echo $result->idArticles ?>" /></td>
                                                <td><input style="width: 50px !important" type="text" name="ordering[]" value="<?php echo $result->ordering_articles ?>" />
                                                    <input type="hidden" name="idhide[]" value="<?php echo $result->idArticles ?>" />
                                                </td>
                                                <td><img src="<?php echo Asset('/').'store/upload/images/'.$result->thumb_articles ?>" /></td>
                                                <td><?php echo $result->title_articles ?></td>
                                                <td><?php
                                                        foreach ($list_articlesCat as $value)
                                                        if($value->idArticlesCategories == $result->categories_id) 
                                                        echo $value->name_articles_categories 
                                                    ?>
                                                </td>
                                                <td><?php echo $result->related_articles ?></td>
                                                <td><?php echo $result->created_at ?></td>
                                                <td><a href="<?php echo Asset('/').'administrator/articles/enable?id='.$result->idArticles.'&status='.$result->enable_articles ?>" class="btn btn-flat <?php if($result->enable_articles==1) echo "btn-primary" ; else echo "btn-danger"; ?>  btn-sm">
                                                    <?php if($result->enable_articles==1) echo "enable"; else echo "disable"; ?>
                                                    </a>
                                                </td>
                                                <td><a href="<?php echo Asset('/').'administrator/articles/update?ID='.$result->idArticles ?>" class="btn btn-info btn-flat">  <span class="glyphicon glyphicon-pencil">  </span></a></td>
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
