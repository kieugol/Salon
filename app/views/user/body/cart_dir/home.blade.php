@extends('user.main')

@section('seo')

  <meta name="keywords" content="Trái ngon miệt vườn| canthofruit|Trái cây online">

   <meta name="title" content="Trái ngon miệt vườn | canthofruit|Trái cây online">

   <meta name="description" content="Trái ngon miệt vườn |canthofruit| Trái cây online">

   <title>Giỏ hàng</title>

@stop

@section('script')

	<link rel="stylesheet" type="text/css" href="<?php echo Asset('/')?>store/css/style.css">

    <link rel="stylesheet" type="text/css" href="<?php echo Asset('/')?>store/css/edit.css">

    <link href="<?php echo Asset('/')?>store/css/bootstrap.min.css" rel="stylesheet">
     <script type="text/javascript" src="<?php echo Asset('/')?>store/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo Asset('/')?>store/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo Asset('store/js/bootstrap.min.js') ?>"></script>

    <style type="text/css">

 	.modal{

 		top:100px;
 	}

 	</style>

@stop
@section('alias_nav','Giỏ hàng')
@section('content')

<div class="content-news">

<div class="modal fade popup-order" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-sm">

    <div class="modal-content">
    <div class="pull-right close-popup">
        <a href="#" class="full-right" data-dismiss="modal"><img src="{{Asset('/store/images/icon-close.png')}}"></a>
      </div>
      <div class="modal-body">

        @if(Session::has('message'))

        <p>{{Session::get('message')}}</p>

        @endif

      </div>

    </div>

  </div>

</div>

<!--Endpopup -->

<input type="hidden" id="message" value="<?php if(Session::has('message')) echo Session::get('message'); else echo 'false'; ?>" />

<div class="content-cart row" style="margin:0">
   <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12  col-lg-offset-1">
	<h3 class="name-cart">SẢN PHẨM TRONG GIỎ HÀNG</h3>

	<form  id="CartForm" method="post"  action="<?php echo Asset('/')?>shoppingcart/update-cart" accept-charset="utf-8" role="form"  >             

		<table class="cart-his" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%; width:100%">

			<tbody>

				<tr>

					<td class="t-his bor-rigth stt-hist">STT</td>

					<td class="t-his bor-rigth code-hist">Hình ảnh </td>

					<td class="t-his bor-rigth code-hist">Sản phẩm</td>	

					<td class="t-his bor-rigth date-hist">Số lượng (kilogram)</td>	

					<td class="t-his bor-rigth price-hist">Đơn giá (VND/Kg)</td>

					<td class="t-his detail-hist">Tổng tiền (VND)</td>

				</tr>

		@if( Cart::count(false)>0) 

			<?php $stt =1; $cart = Cart::content(); ?>

			 @foreach($cart as $row)

				<tr bgcolor="#FFF">	

					<td class="td-his bor-rigth stt-hist"><span>{{$stt}}</span>

						<input type="hidden" name="id_item[]" value="{{$row->rowid;}}" />
						<input type="hidden" name="sort[]" value="{{$stt}}" />

					</td>

					<td class="td-his bor-rigth code-hist">

						<div><a href="{{Asset('/order').'/'.$row->options->alias_cat.'/'.$row->options->alias }}"><img width="80" height="80"  src="{{Asset('/store/upload/images').'/'.$row->options->img}}"></a>

								<a style="color:#B91717" href="<?php echo Asset('/shoppingcart/delete?id=').$row->rowid ?>">Xóa</a></div>

					</td>

					<td class="td-his bor-rigth code-hist"><span><a href="{{Asset('/order').'/'.$row->options->alias_cat.'/'.$row->options->alias }}">{{$row->name}}</a></span></td>

					<td class="td-his bor-rigth code-hist">

						<input type="text" id="quanlity[]" name="quanlity[]" class="text" value="{{$row->qty}}">

					</td>

					<td class="td-his bor-rigth price-hist"><span>{{number_format($row->price,0,",",".")}}</span></td>

					<td class="td-his price-hist"><span>{{number_format($row->price * $row->qty,0,",",".") }}</span></td></tr><tr bgcolor="#AEDD84">

				</tr>

			<?php $stt++;?>

			@endforeach

			<tr><td colspan="6" class="td-his sum-his">Tổng Cộng: {{ number_format(Cart::total(),0,",",".")}} VND</td></tr>

		@else

			<tr><td colspan="6" class="td-his price-hist">Giỏ hàng của bạn đang trống,hãy chọn sản phẩm và mua hàng!</td></tr>
			<tr><td colspan="6" class="td-his price-hist"> <a href="{{Asset('/')}}" style="font-style:italic; text-decoration: none">Tiếp tục mua hàng</a></td></tr>
		@endif

			</tbody>

		</table>

		@if( Cart::count(false)>0) 

			<div  class="gp-process">

				<div><button type="submit" name="bt_update" id="bt_update">Cập Nhật</button></div>



				<a id="show-form" >Tiến hành đặt hàng »</a>

			</div>

		@endif

	</form>

	<!-- Form order-->

	<div class="details-order">

		<div class="row-form">

        		<h3 class="name-cart" style="text-align:left">Thông tin đặt hàng</h3>

        		<hr/>

        </div>

        <form method="post" id="adminform" class="info-customer" action="<?php echo Asset('/')?>shoppingcart/insert-cart" accept-charset="utf-8" role="form"  >     	

        	<div class="row-form">

        		<div class="title">Họ tên:</div>

				<div class="input-content"><input type="text" name="txt_name" id="txt_name" required="required" placeholder="Họ tên người mua" /></div>

			</div>

			<div class="row-form">

				<div class="title">Số điện thoại</div>

				<div class="input-content"><input  type="text" name="txt_phone" id="txt_phone"  required="required" placeholder="Số điện thoại"/></div>

			</div>

			<div class="row-form">

					<div class="title">Email</div>

					<div class="input-content"><input  type="text" name="txt_email" id="txt_email"  required="required" placeholder="Email"/></div>

				</div>

			<div class="row-form">

				<div class="title">Tỉnh/Thành phố</div>

				<div class="input-content" >

					<select name="sl_province">
						<option value="Cần Thơ">Cần Thơ</option>
						<option value="Tp. Hồ Chí Minh">Tp. Hồ Chí Minh</option>
						<option value="Hà Nội">Hà Nội</option>
						<option value="Kiên Giang">Kiên Giang</option>
						<option value="Đảo Phú Quốc">Đảo Phú Quốc</option>
						<option value="Cà Mau">Cà Mau</option>
						<option value="Bạc Liêu">Bạc Liêu</option>
						<option value="Khánh Hòa">Khánh Hòa</option>
						<option value="Tỉnh thành Khác">Tỉnh thành khác</option>

					</select>

				</div>

			</div>

			<div class="row-form">

				<div class="title" >Địa chỉ nhận</div>

				<div class="input-content" ><input  type="text" name="txt_add" id="txt_add" required="required"  placeholder="Địa chỉ nhận"/></div>

			</div>

			<hr/>

			<div class="row-form">

				<input type="checkbox" id="check_vat" value="" name="check_vat" /> Địa chỉ in trên hóa đơn khác với địa chỉ nhận hàng

			</div>

			<hr/>

			<!-- Vat -->

			<div id="form-vat">

				<div class="row-form">

	        		<div class="title">Họ tên:</div>

					<div class="input-content"><input type="text" name="txt_name1" id="txt_namme1" required="required" placeholder="Họ tên người mua" /></div>

				</div>

				<div class="row-form">

					<div class="title">Số điện thoại</div>

					<div class="input-content"><input  type="text" name="txt_phone1" id="txt_phone1"  required="required" placeholder="Số điện thoại"/></div>

				</div>

				<div class="row-form">

					<div class="title">Tỉnh/Thành phố</div>

					<div class="input-content" >

						<select name="sl_province1">

						<option value="Cần Thơ">Cần Thơ</option>
						<option value="Tp. Hồ Chí Minh">Tp. Hồ Chí Minh</option>
						<option value="Hà Nội">Hà Nội</option>
						<option value="Kiên Giang">Kiên Giang</option>
						<option value="Đảo Phú Quốc">Đảo Phú Quốc</option>
						<option value="Cà Mau">Cà Mau</option>
						<option value="Bạc Liêu">Bạc Liêu</option>
						<option value="Khánh Hòa">Khánh Hòa</option>
						<option value="Tỉnh thành Khác">Tỉnh thành khác</option>

						</select>

					</div>

				</div>

				<div class="row-form">

					<div class="title" >Địa chỉ nhận</div>

					<div class="input-content" ><input  type="text" name="txt_add1" id="txt_add1" required="required"  placeholder="Địa chỉ nhận"/></div>

				</div>

				<!-- end vat -->

			</div>

			<div class="row-form">

					<div class="title">Hình thức giao hàng</div>

					<div class="input-content">

						<select name="sl_checkout" id="sl_checkout">

								<?php 

									$shipping = new Order();

									$list_shipping= $shipping->getShipping(); 

								?>

								@foreach($list_shipping as $result)

								<option value="{{$result->idShipping}}">{{ $result->name_shipping }}</option>

								@endforeach

						</select>

					</div>

			</div>

			<div class="row-form">

				<div class="title">Hóa đơn VAT</div>

				<div class="input-content"><input type="radio" value="1" name="rd_vat" /> Có &nbsp;<input type="radio" value="0" checked="checked" name="rd_vat" /> Không </div>

			</div>
			<div class="row-form">
				<div class="title"><input type="checkbox" name="check_pay" id="check_pay" /> *</div>
				<div class="input-content" style="color:red">Bạn đã đồng ý với các chính sách, quy định của canthofruit.com</div>
			</div>
			<div class="row-form">

				<button type="submit" id="btn-cart" class="btn-cart">Hoàn tất »</button>

			</div>

		</form>

      </div>

	<!-- End Form order-->

	</div>
</div>
</div>

 <script type="text/javascript" src="<?php echo Asset('/')?>store/js/jquery-1.11.1.min.js"></script>

 <script type="text/javascript" src="<?php echo Asset('store/js/bootstrap.min.js') ?>"></script>

  <script src="<?php echo Asset('/')?>store/js/jquery.validate.js"></script>

 <script type="text/javascript">

	 jQuery(document).ready(function() {

	 	$('#form-vat').hide();

	 	$('.details-order').hide();

	 });

	   $('#show-form').click(function(e) {

	   		$('.details-order').show(400);

	   });

	   $('#check_vat').bind('change', function () {

		   if ($(this).is(':checked')){

		     	$("#form-vat").show(400);

		 		$('#check_vat').val('accept');

		 	}

		   else{

		   		$('#check_vat').val('null');

		     	$("#form-vat").hide(400);

		   	}

		 		

			});

	   // $('#check_vat').click(function(e) {

	   // 		$('#form-vat').show(400);

	   // });

 </script>

 <script type="text/javascript">

    $(window).load(function(){

    	var check ="";

  		 check = $('#message').val();

  		if(check!="false")

        $('#myModal').modal('show');

    });		
     jQuery('#bt_update').click(function(e) {
	   		$('input[name="quanlity[]"]').each(function() {
   					if($(this).val()<1) {
						alert('Số lượng tối thiểu phải là 1kg , vui lòng nhập lại!');
						$(this).focus();
						e.preventDefault();
   					}
   					if( isNaN($(this).val()) ){
   						alert('Dữ liệu không hợp lê, vui lòng điền lại!');
   						$(this).val('');
						$(this).focus();
						e.preventDefault();
   					}
				});

	    });
   

	</script>

<script type="text/javascript" >


	 jQuery(document).ready(function() {
        $('#adminform').validate({ 

		            rules: {

		                txt_name:{

		                    required: true

		                },

		                txt_add:{

		                    required: true

		                },

		                 txt_phone:{

		                    required: true,

		                    number:true

		                },

		                  txt_email:{

		                    required: true,

		                    email:true

		                },

		            },

		            messages: {
		            	txt_name:{

		                    required:"Nhập họ tên..."

		                },

		                txt_add:{

		                    required:"Nhập địa chỉ..."

		                },

		                 txt_phone:{

		                    required: "Nhập số điện thoại...",

		                    number:"Phải là số..."

		                },

		                  txt_email:{

		                    required:"Nhập email...",

		                    email:"Email phải đúng định dạng..."

		                },
		                txt_name1:{

		                    required:"Nhập họ tên..."

		                },

		                txt_add1:{

		                    required:"Nhập địa chỉ..."

		                },

		                 txt_phone1:{

		                    required: "Nhập số điện thoại...",

		                    number:"Phải là số..."

		                },

		                  txt_email1:{

		                    required:"Nhập email...",

		                    email:"Email phải đúng định dạng..."

		                }

		            }

        		});
		});
		 jQuery('#btn-cart').click(function(e) {
    	if(!($('#check_pay').prop('checked')) ){
    		alert('Vui lòng check vào chính sách, quy định của canthofruit.com !');
    		e.preventDefault();
    	}
    });

</script>

@stop	