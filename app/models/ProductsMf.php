<?php



class ProductsMf extends \Eloquent {

	public static $rules = array();

	protected $table = 'products_manufacture';

	/*------------------ADMIN-------------------------- */

	

	// insert data

	public function insert($data_pd){

		DB::table('products_manufacture')->insert($data_pd);

	}

	// get products homes

	public function getHomeProductsMfAd(){

		$listProductsMf = $this

		->orderBy('ordering_products_manufacture', 'desc')

		->get();
		return $listProductsMf; 

	}

	// get products update

	public function getProductsMfUpdate($id){

		$listProductsMf = $this

		->where('idProductsManufacture','=',$id)

		->first();

		return $listProductsMf; 

	}

	// upadate

	public function updateProductsMf($id,$data_pd){

			$this ->where('idProductsManufacture','=',$id)
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

		->where('idProductsManufacture','=',$id)

		->update(array(

				'enable_products_manufacture'=>$status

			));

	}

	//remove products Cat

	public function removeProductsMf($id){

		$this

		->where('idProductsManufacture','=',$id)

		->delete();

	}

	public function SetNullProducts($id){

		DB::table('products')

		->where('manufacture_id',$id)

       ->update(array('manufacture_id' => 0));
	}

	public function orderCat($id,$value){

		$this->where('idProductsManufacture','=',$id)

			->update(array('ordering_products_manufacture'=>$value));

		return true;

	}
	// count products in categories
	public function totalProducts($idProductsManufacture){
		$qty = $this
			->join('products','idProductsManufacture','=','products.categories_id')
			->where('idProductsManufacture','=',$idProductsManufacture)
			->get();
		return count($qty);
	}

	/*------------------USER-------------------------- */

	// get Id ordering min 

	public function getIdOrder(){

		$value = $this->min('ordering_products_manufacture');

		return $value;

	}

	// get all products Catagories 

	public function getAllProductsMf(){

		$listProductsMf = $this

		->orderBy('idProductsManufacture','desc')

		->where('enable_products_manufacture','=',1)

		->get();

		return $listProductsMf; 

	}

	// get Products Categories ordering Max  

	public function getProductsMfFirst(){

		$id_max = $this->min('ordering_products_manufacture');

		$categories = $this

		->where('ordering_products_manufacture','=',$id_max)

		->first();

		return $categories; 

	}

	// get products categories have alias

	public function getProductsMfDetails($alias){

	   $listProductsMf = $this

  	 		->where('alias_products_manufacture','=',$alias)

			->first();

		return $listProductsMf; 

	}

}