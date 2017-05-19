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
         </style>

@stop

@section('content')

 <aside class="right-side">



    <form  id="productForm" method="post"  action="<?php echo Asset('/')?>administrator/projects/remove" accept-charset="utf-8" role="form" >             



    <section class="content-header">



                    <h1>Design<small>/ home</small></h1>



                    <div style="text-align: right">



                        <a href="<?php echo Asset('/') ?>administrator/projects/design " class="btn btn-default  btn-flat"><span class="glyphicon glyphicon-refresh"></span></a>



                        <a href="<?php echo Asset('/') ?>administrator/projects/add-design " class="btn btn-primary btn-flat"><span class="glyphicon glyphicon-plus-sign"></span> Add New</a>



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



                                    <h3 class="box-title"><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Design List </h3>



                                </div><!-- /.box-header -->



                                <div class="box-body table-responsive">



                                    <table id="tb_home" class="table table-bordered table-striped">



                                        <thead>



                                            <tr>



                                            <th><input type="checkbox" name="all" id="checkall" class="form-control" /></th>



                                                <th>Order</th>



                                                <th>image</th>



                                                <th>Design name</th>



                                                <th>Categories</th>



                                                <th>status</th>



                                                <th>action</th>



                                            </tr>



                                        </thead>
                                        <tfoot>


                                            <tr>


                                            <th></th>



                                                <th></th>



                                                <th></th>



                                                <th>Design name</th>



                                                <th>Categories</th>



                                                <th>status</th>



                                                <th></th>



                                            </tr>



                                        </tfoot>


                                        <tbody>



                                <?php



                                            foreach ($list_projects as $result) {



                                         ?>  



                                            <tr>



                                                <td><input type="checkbox" name="delete[]" value="<?php echo $result->idProjects ?>" class="form-control" /></td>



                                                <td><input type="text" name="ordering[]" value="{{$result->ordering_projects }}" class="form-control" style="width:50px !important" />



                                                    <input type="hidden" name="idhide[]" value="{{$result->idProjects}}" />



                                                </td>



                                                <td><img src="<?php echo Asset('/').'store/upload/images/'.$result->thumb_projects ?>" /></td>



                                                <td><?php echo $result->name_projects ?></td>



                                                <td>

                                                    @foreach($list_projectsCat as $value)

                                                        @if($result->categories_id==$value->idProjectsCategories)

                                                        {{$value->name_projects_categories;}}

                                                        @endif

                                                    @endforeach

                                                </td>



                                                <td><a href="<?php echo Asset('/').'administrator/projects/enable?id='.$result->idProjects.'&stt='.$result->enable_projects ?>" class="btn btn-flat <?php if($result->enable_projects==1) echo "btn-primary" ; else echo "btn-danger"; ?>  btn-sm">



                                                    <?php if($result->enable_projects==1) echo "enable"; else echo "disable"; ?>



                                                    </a>



                                                </td>



                                                <td><a href="<?php echo Asset('/').'administrator/projects/update-design?id='.$result->idProjects ?>" class="btn btn-info btn-flat">  <span class="glyphicon glyphicon-pencil">  </span></a></td>



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

                var ch = <?php echo count($data_multi) ?>;

                $('#tb_home').dataTable().columnFilter({
                    aoColumns: 
                    [ 
                            null,
                            null,
                            null,
                            { type: "text"},
                            { type: "select",values: [
                            <?php
                                $n = count($data_multi);
                                for($i=0;$i<$n;$i++){
                                 echo "'".$data_multi[$i]."'".","; 
                                }
                            ?>
                            ] },
                           
                            { type: "select",values: [ 'enable','disable'] }
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



