<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Đơn đặt hàng</title>
		<!-- Bootstrap CSS -->
		<style type="text/css">
		table th{
			text-align: left;
			padding: 8px;
			font-family: TimesNewRoman, 'Times New Roman', Times, Baskerville, Georgia, serif !important;
		}
		table td{
			
			padding: 8px;
		}

		p{
			font-weight: bold;
			font-size: 16px;
		}
		</style>
	</head>
	<body style="font-family: TimesNewRoman, 'Times New Roman', Times, Baskerville, Georgia, serif !important;
			font-size: 16px">
	<div style="margin: 0 auto;max-width: 800px;height: auto;">
<?php if(isset($list_order)){ ?>
	@if(isset($check))
		<p>CanthoFruit cảm ơn quý khách đã đặt hàng!</p>
		<p> Chúng tôi sẻ liên lạc với quý khách trong thời gian sớm nhất kể từ khi nhận được đơn hàng này.</p>
		<p>Thông tin chi tiết về đơn đặt hàng của Quý Khách như sau:</p>
	@endif
		<table  >
			<tr>
				<td><label>Hóa đơn:</label></td>
				<td>{{$list_order['id_order']}}</td>
			</tr>
			<tr>
				<td><label>Họ tên:</label></td>
				<td>{{$list_order['name_customer']}}</td>
			</tr>
			<tr>
				<td><label>Tổng Cộng:</label></td>
				<td>{{ number_format($list_order['total_order'],0,",",".")}} VND</td>
			</tr>
			<tr>
				<td><label>Địa chỉ:</label></td>
				<td>{{ $list_order['address_customer']}}</td>
			</tr>
			<tr>
				<td><label>Tỉnh:</label></td>
				<td>{{$list_order['province_customer']}}</td>
			</tr>
			<tr>
				<td><label>Số điện thoại:</label></td>
				<td>{{$list_order['phone_customer']}}</td>
			</tr>
			<tr>
				<td><label>Email:</label></td>
				<td>{{$list_order['email_customer']}}</td>
			</tr>
			<tr>
				<td><label>Hình thức giao hàng:</label></td>
				<td>{{$list_order['name_shipping']}}</td>
			</tr>
			<tr><td colspan="2" ><hr /></td></tr>
			@if(count($vat_details)>0)
				<tr><td colspan="2"><label> Hóa đơn VAT</label></td></tr>
				<tr>
                    <td>Họ tên:</td>
                    <td>{{$vat_details['name_customer_vat']}}</td>
                </tr>
                <tr>
                    <td>Số điện thoại:</td>
                    <td>{{$vat_details['phone_customer_vat']}}</td>
               	</tr>
               <tr>
                    <td>Địa chỉ:</td>
                    <td>{{  $vat_details['address_customer_vat']}}</td>
                </tr>
                <tr>
                    <td>Tỉnh thành:</td>
                    <td>{{$vat_details['province_customer_vat']}}</td>
                </tr>
               	<tr><td colspan="2"><hr /></td></tr>
			@endif
		</table>
		<table >
			<tr>
                <th>Trái Cây</th>
                <th>Số lượng (kilogram)</th>
                <th>Đơn giá (VND)</th>
                <th>Thành tiền (VND)</th>
			</tr>
		 @foreach($list_orderDetails as $result)
			<tr style="text-align: center">
                <td>{{ $result->name_products }}</td>
               	<td>{{ $result->ql_order_details }}</td>
                <td>{{number_format($result->price_products,0,",",".")}} VND</td>
                <td>{{ number_format($result->money_order_details,0,",",".") }} VND</td>                           
			</tr>
		 @endforeach     
		</table>
<?php 
}?>
	</div>
	</body>
</html>