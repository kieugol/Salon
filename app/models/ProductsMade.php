<?php

class ProductsMade extends \Eloquent {
	public static $rules = array();
	protected $table = 'products_madein';
	/*------------------ADMIN-------------------------- */
	
	// insert data
	public function insert($data_pd){
		DB::table('products_madein')->insert($data_pd);
	}
	// get products homes
	public function getHomeProductsMadeAd(){
		$listProductsMade = $this
		->orderBy('idProductsMadein', 'desc')
		->get();
		return $listProductsMade; 
	}
	// get products update
	public function getProductsMadeUpdate($id){
		$listProductsMade = $this
		->where('idProductsMadein','=',$id)
		->first();
		return $listProductsMade; 
	}
	// upadate
	public function updateProductsMade($id,$data_pd){
			$this ->where('idProductsMadein','=',$id)
		 		  ->update($data_pd);
		 	return true;
	}
	//enable products
	public function enable($id,$status){
		if($status==0)
			$status=1;
			else
			$status=0;
		$this
		->where('idProductsMadein','=',$id)
		->update(array(
				'enable_products_madein'=>$status
			));
	}
	//remove products Cat
	public function removeProductsMade($id){
		$this
		->where('idProductsMadein','=',$id)
		->delete();
	}
	public function SetNullProducts($id){
		DB::table('products')
		->where('manufacture_id',$id)
       ->update(array('manufacture_id' => 0));
	}
	public function orderCat($id,$value){
		$this->where('idProductsMadein','=',$id)
			->update(array('ordering_products_madein'=>$value));
		return true;
	}
	// count products in categories
	public function totalProducts($idProductsMadein){
		$qty = $this
			->join('products','idProductsMadein','=','products.categories_id')
			->where('idProductsMadein','=',$idProductsMadein)
			->get();
		return count($qty);
	}
	/*------------------USER-------------------------- */
	// get Id ordering min 
	public function getIdOrder(){
		$value = $this->min('ordering_products_madein');
		return $value;
	}
	// get all products Catagories 
	public function getAllProductsMade(){
		$listProductsMade = $this
		->orderBy('idProductsMadein','desc')
		->where('enable_products_madein','=',1)
		->get();
		return $listProductsMade; 
	}
	// get Products Categories ordering Max  
	public function getProductsMadeFirst(){
		$id_max = $this->min('ordering_products_madein');
		$categories = $this
		->where('ordering_products_madein','=',$id_max)
		->first();
		return $categories; 
	}
	// get products categories have alias
	public function getProductsMadeDetails($alias){
	   $listProductsMade = $this
  	 		->where('alias_products_madein','=',$alias)
			->first();
		return $listProductsMade; 
	}
}