<?php

class Shipping extends \Eloquent {
	public static $rules = array();
	protected $table = 'shipping';
	protected $fillable = array('name_shipping','alias_shipping','des_shipping','enable_shipping','meta_title_shipping','meta_key_shipping','meta_desc_shipping');
	/* --------------------Admin---------------------------*/ 
	public function getshippingHome(){
		$listshipping = $this
		->orderBy('idShipping','desc')
		->get();
		return $listshipping; 
	}
	// insert data
	public function insert($data_pd){
		$this::create($data_pd);
		return true;
	}	
	//enable products
	public function enable($id,$status){
		if($status==0)
			$status=1;
			else
			$status=0;
		$this
		->where('idshipping','=',$id)
		->update(array(
				'enable_shipping'=>$status
			));
	}
	// get articles update
	public function getshippingUpdate($id){
		$listshipping = $this
		->where('idshipping','=',$id)
		->first();
		return $listshipping; 
	}
	// upadate
	public function updateshipping($id,$data_pd){
		$this->where('idshipping','=',$id)
		 	 ->update($data_pd);
		 	 return true;
	}

	//remove 
	public function removeshipping($id){
		$this
		->where('idshipping','=',$id)
		->delete();
	}
	// sort order
	public function orderCat($id,$value){
		$this
		->where('idshippingegories','=',$id)
		->update( array('ordering_shipping'=>$value) );
		return true;
	}
}