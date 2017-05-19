<?php

class Order extends \Eloquent {
	public static $rules = array();
	protected $table = 'order';
	protected $fillable = array('id_order','details_order','idCustomer','id_shipping','datetime_order','total_order','enable_order','order_vat','ordering_order','created_at','updated_at');

/*---------------------------------------Admin---------------------------------------------------------*/

	//get Order home 
	public function getOrderHome(){
		$listOrder = $this
		->orderBy('id_order', 'desc')
		->join('shipping','id_shipping','=','shipping.idShipping')
		->join('customer','idCustomer','=','customer.id_customer')
		->get();
		return $listOrder; 
	}
	//enable products
	public function enable($id,$status){
		if($status==0)
			$status=1;
			else
			$status=0;
		$this
		->where('id_order','=',$id)
		->update(array(
				'enable_order'=>$status,
				'updated_at'=>date('Y-m-d H:i:s')
			));
	}
	// get Order update
	public function getOrderDetails($id){
		$listOrder = $this
		->where('id_order','=',$id)
		->join('order_details','id_order','=','order_details.idOrder')
		->join('customer','idCustomer','=','customer.id_customer')
		->get();
		return $listOrder; 
	}
	
	//remove 
	public function removeOrder($id){
		$this
		->where('id_order','=',$id)
		->delete();
	}
	public function removeOrderDetails($id){
		DB::table('order_details')
		->where('idOrder','=',$id)
		->delete();
	}
	public function getDetailsOder($id){
		$result=DB::table('order_details')
		->where('idOrder','=',$id)
		->join('products','order_details.idproducts','=','products.idProducts')
		->join('products_categories','products.categories_id','=','products_categories.idProductsCategories')
		->get();
		return $result;
	}
	public function getOder($id){
		$result = $this
		->where('id_order','=',$id)
		->join('shipping','id_shipping','=','shipping.idShipping')
		->join('customer','idCustomer','=','customer.id_customer')
		->first();
		return $result;
	}
	public function getVat($id){
		$result = $this
		->where('id_order','=',$id)
		->join('customer_vat','id_order','=','customer_vat.idOrder')
		->first();
		return $result;
	}
/*---------------------------------------User---------------------------------------------------------*/
	public function getShipping(){
		$list_shipping = DB::table('shipping')
		->get();
		return $list_shipping;
	}
	public function insertOrder($data){
		$this->insert($data);
		return true;
	}
	public function insertDetails($data){
		DB::table('order_details')->insert($data);
	}
	public function insertCustomer($data){
		DB::table('customer')->insert($data);
		return true;
	}
	public function insertCustomerVat($data){
		DB::table('customer_vat')->insert($data);
		return true;
	}
}