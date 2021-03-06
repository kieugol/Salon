
<!DOCTYPE html>
<html lang="en" class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Admin | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo Asset('/')?>store/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
         <style type="text/css">
         .error{
            color: #f64747 !important;
         }
         </style>
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Sign In
            </div>
            <!--  -->
            <form name="adminlogin" id="adminlogin" method="post" action="<?php echo Asset('/')?>home/check-login" >
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" id="txt_userid" name="txt_userid" class="form-control" placeholder="User ID"/>
                    </div>
                    <div class="form-group">
                        <input type="password" id="txt_userpass" name="txt_userpass" class="form-control" placeholder="Password"/>
                    </div>
                @if(Session::has('message'))
                    <div class="form-group">
                        <p style="color:red">{{Session::get('message')}}</p>
                    </div>
                @endif
                </div>
                <div class="footer">
                    <button type="submit" id="login_admin" name="login_admin" class="btn bg-olive btn-block">Sign me in</button>  

                    <p><a href="#">I forgot my password</a></p>
                </div>
             </form>

        </div>
        <script src="<?php echo Asset('/')?>store/js/jquery.js"></script>
        <script src="<?php echo Asset('/')?>store/js/jquery-1.11.1.min.js"></script>      
        <script src="<?php echo Asset('/')?>store/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo Asset('/')?>store/js/jquery.validate.js"></script>
<script type="text/javascript" >
        jQuery(document).ready(function(e) {
        $('#adminlogin').validate({ 
            rules: {
                txt_userid:{
                    required: true
                },
                txt_userpass:{
                    required: true,
                    minlength: 6,
                    maxlength: 12
                }
            },
            messages: {
            }
        });
    /*end đăng ký*/
});
</script>
<script type="text/javascript">
// jQuery(document).ready(function() {
//     var base_url= '<?php echo Asset('') ?>';
//     $('#login_admin').click(function(event){
//         alert('kieu gol');
        //     $.ajax({
        //         url: base_url+"/home-check-login",
        //         type: "POST",
        //         data:{
        //             username:$('#txt_userid').val(),
        //             password:$('#txt_userpass').val()
        //         },
        //     })
        //     .always(function(mgs) {
        //         if(mgs==0)
        //         {
        //             if(msg.numberlogin>3)
        //                 {
        //                     alert("Tài khoản của bạn đã bị khóa, xin vui lòng liên hệ ban quản trị");
        //                     window.location = base_url+"admin/limitlogin";
        //                 }
        //                 else if(msg.numberlogin>2)
        //                 {
        //                     alert("Bạn đã đăng nhập sai 2 lần, hãy kiểm tra lại mật khẩu trước khi tiến hành đăng nhập lần tiếp theo\n Đừng nên đăng nhập sai quá 3 lần không thì tài khoản của bạn sẽ bị khóa");
        //                 }
        //         }
        //     });   
        // },'json');
//});
</script>
    </body>
</html>