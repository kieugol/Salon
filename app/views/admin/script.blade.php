
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="<?php echo Asset('/') ?>store/admin/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="<?php echo Asset('/') ?>store/admin/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="<?php echo Asset('/') ?>store/admin/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="<?php echo Asset('/') ?>store/admin/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="<?php echo Asset('/') ?>store/admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo Asset('/') ?>store/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo Asset('/') ?>store/admin/js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo Asset('/') ?>store/admin/js/AdminLTE/dashboard.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo Asset('/') ?>store/admin/js/AdminLTE/demo.js" type="text/javascript"></script>


       <!-- DATA TABES SCRIPT -->
        <script src="<?php echo Asset('/') ?>store/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo Asset('/') ?>store/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
         <script type="text/javascript">
                    $(function() {
                        $("#example1").dataTable();
                        $('#example2').dataTable({
                            "bPaginate": true,
                            "bLengthChange": false,
                            "bFilter": false,
                            "bSort": true,
                            "bInfo": true,
                            "bAutoWidth": false
                        });
                    });
                </script>