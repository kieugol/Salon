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
            .menu-root{
                font-weight: bold;
                margin-left: 10px;
            }
        </style>
        

@stop

@section('content')



 <aside class="right-side">

      <form  id="productForm" method="post" accept-charset="utf-8" role="form" action="<?php echo Asset('/')?>administrator/menu/remove"  >             

    <section class="content-header">

        <h1>Menu<small>/ home</small></h1>

        <div style="text-align: right">

            <a href="<?php echo Asset('/') ?>administrator/menu/add " class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-plus-sign"></span> Add New</a>

            <a href="<?php echo Asset('/') ?>administrator/menu/home " class="btn btn-default  btn-flat"><span class="glyphicon glyphicon-refresh"></span></a>

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

            <div class="col-xs-12 col-lg-12 colmd-12">

                <div class="box">

                                <div class="box-header">

                                   <h3 class="box-title"><span class="glyphicon glyphicon-align-justify">&nbsp;</span>Sub Menu List </h3>

                                </div><!-- /.box-header -->

                                <div class="box-body table-responsive">

                                    <table id="tb_home" class="table table-bordered table-striped">

                                        <thead>

                                            <tr>

                                            <th><input type="checkbox" name="all" id="checkall" /></th>

                                                <th>title Menu</th>

                                                <th>status</th>

                                                <th>action</th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                <?php

                                            foreach ($list_menu as $result) {

                                        ?>  

                                            <tr>

                                                <td><input type="checkbox"  name="delete[]"  value="<?php echo $result->idMenus ?>" /></td>
                                                <td>
                                                <?php 
                                                        $menu = new menu();
                                                        $row = $menu->checkParentId($result->idMenus);
                                                        if(count($row)>0)
                                                        {
                                                            $dropdown = $menu->getMultiHome($result->idMenus,1);
                                                            echo '<select class="form-control" name="sl_menusub">';
                                                            echo '<option selected="selected">'.$result->title_menus.'</option>';
                                                            echo $dropdown;
                                                            echo '</select>';
                                                            if($result->parentid==0)
                                                                echo '<span class="menu-root"> (Menu Root)</span>';
                                                        }
                                                        else{
                                                            if($result->parentid==0)
                                                                echo $result->title_menus.'<span class="menu-root"> (Menu Root)</span>'; 
                                                            else
                                                                echo $result->title_menus;
                                                        }
                                                    ?>
                                                </td>
                                                <td><a href="<?php echo Asset('/').'administrator/menu/enable?id='.$result->idMenus.'&status='.$result->enable_menus ?>" class="btn btn-flat <?php if($result->enable_menus==1) echo "btn-primary" ; else echo "btn-danger"; ?>  btn-sm">

                                                    <?php if($result->enable_menus==1) echo "enable"; else echo "disable"; ?>

                                                    </a>
                                                </td>
                                                <td><a href="<?php echo Asset('/').'administrator/menu/update?ID='.$result->idMenus ?>" class="btn btn-info btn-flat">  <span class="glyphicon glyphicon-pencil">  </span></a></td>
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
         <select>
                
        </select>


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

