<?php
class Products extends \Eloquent {
	public static $rules = array();
	protected $table = 'products';
	protected $fillable = array(
		'idProducts','code_products','name_products','alias_products','thumb_products','enable_products',
		'price_products','ordering_products','is_new_products','des_products','short_desc_products',
		'price_products','hits_products','quanlity_products','manufacture_id','madein_id','guarantee_products',
		'is_empty_products','is_sale_products','categories_id','unit_id','meta_desc_products',
		'meta_title_products','meta_key_products','created_at','updated_at','id_menus','size_products'
	);
	/*------------------ADMIN-------------------------- */
	// insert data
	public function insert($data_pd){
		$this::create($data_pd);
	}
	// get products homes
	public function getHomeProductsAd(){
		$listProducts = $this
		->orderBy('categories_id', 'asc')
		->orderBy('ordering_products', 'asc')
		->join('products_categories', 'categories_id', '=', 'products_categories.idProductsCategories')
		->paginate(100);
		return $listProducts; 
	}
	// get max id 
	public function getMaxId(){
		return $this->max('idProducts');
	}
	// get products homes
	public function getHomeProductsAd_categories($categories_id){
		$listProducts = $this
		->orderBy('categories_id', 'asc')
		->orderBy('ordering_products', 'asc')
		->join('products_categories', 'categories_id', '=', 'products_categories.idProductsCategories')
		->where('categories_id','=',$categories_id)
		->paginate(100);
		return $listProducts; 
	}
	// get products update
	public function getProductsUpdate($id){
		$listProducts = $this
		->where('idProducts','=',$id)
		->first();
		return $listProducts; 
	}
	public function getDecorateUpdate($id){
			$listProducts = $this
			->where('idProducts','=',$id)
			->first();
			return $listProducts; 
		}
	// update
	public function updateProducts($id,$data_pd){
		  DB::table('products')
		 ->where('idProducts','=',$id)
		 ->update($data_pd);
	}
	public function updateDecorate($id,$data_pd){
		  $this
		  	  ->where('idProducts','=',$id)
			 ->update($data_pd);
	}
	//enable products
	public function enable($id,$status){
		if($status==0)
			$status=1;
			else
			$status=0;
		$this
		->where('idProducts','=',$id)
		->update(array(
				'enable_products'=>$status
			));
	}
	//remove products
	public function removeProducts($id){
		$this
		->where('idProducts','=',$id)
		->delete();
	}
	public function orderProducts($id,$value){
		$this
		->where('idProducts','=',$id)
		->update( array('ordering_products'=>$value) );
		return true;
	}
	// get id ProductsCategories 
	public function getIdProductsCat($id){
		$listProducts = $this
		->join('products_categories','categories_id', '=','products_categories.idProductsCategories')
		->where('idProducts','=',$id)
		->first();
		if(count($listProducts)>0)
			return $listProducts['idProductsCategories'];
		else
			return 0;
	}
	/*------------------USER-------------------------- */
	
	// get all products 
	public function getAllProducts(){
		$listProducts = 
                $this->orderBy('ordering_products','asc')
		->where('enable_products','=',1)
                ->join('products_madein','madein_id','=','products_madein.idProductsMadein')
		->join('products_categories','categories_id','=','products_categories.idProductsCategories')
		->paginate(12);
		return $listProducts; 
	}
	// get all products hot 
	public function getAllProductsHits(){
		$listProducts = $this->orderBy('ordering_products','asc')
		->where('enable_products','=',1)
		->where('hits_products','=',1)
		->join('unit','unit_id','=','unit.id_unit')
		->join('products_categories','categories_id','=','products_categories.idProductsCategories')
		->where('enable_products','=',1)
		->get();
		return $listProducts; 
	}
	// get products have id
	public function getProductsID($id){
		$listProducts = $this
		->where('enable_products','=',1)
		->where('idProducts','=',$id)
		->where('enable_products','=',1)
		->join('products_categories','categories_id','=','products_categories.idProductsCategories')
		->first();
		return $listProducts; 
	}
	// get products new have categories_id limit 12 products 
	public function getProductsNewLimit($id_categories){

		$product_cat = new ProductsCat();
		$list_cat = $product_cat->getAllCatChild();
		$data_idcat = array(); 
		$data_idcat[0]=$id_categories;
		$i=1;
		// check if id have cat child
		foreach ($list_cat as $cat) {
			if($cat->parentid == $id_categories ){
			 	$data_idcat[$i]= $cat->idProductsCategories;
			 	$i++;
			}
		}
		$listProducts = $this->orderBy('idProducts','asc')
			->join('unit','unit_id','=','unit.id_unit')
			->join('products_categories','categories_id','=','products_categories.idProductsCategories')
			->where('enable_products','=',1)
			->where('is_new_products','=',1)
			->whereIn('categories_id',$data_idcat)
			->take(12)
			->get();
		return $listProducts; 
	}
	// get  all products new have categories_id 
	public function getAllProductsNew($id_categories){

		$product_cat = new ProductsCat();
		$list_cat = $product_cat->getAllCatChild();
		$data_idcat = array(); 
		$data_idcat1 = array(); 
		$data_idcat1[0]=0;
		$i=0;
		// check if id have cat child
		foreach ($list_cat as $cat) {
			if($cat->parentid == $id_categories ){
			 	$data_idcat[$i]= $cat->idProductsCategories;
			 	$i++;
			}
		}
		// if id_categories isn't cat child
		if($i==0){
			$data_idcat = array(); 
			$data_idcat[0]= $id_categories;
		}
		$listProducts = $this->orderBy('idProducts','asc')
			->join('unit','unit_id','=','unit.id_unit')
			->join('products_categories','categories_id','=','products_categories.idProductsCategories')
			->where('enable_products','=',1)
			->whereIn('categories_id',$data_idcat)
			->get();
		return $listProducts; 
	}
	// get all products hots != alias products  
	public function getProductsHot($alias,$alias1){
	   $listProducts = $this
	   		->distinct('products.idProducts')
  	 		->join('unit','unit_id','=','unit.id_unit')
			->join('products_categories','categories_id','=','products_categories.idProductsCategories')
  	 		->where('products_categories.alias_products_categories','=',$alias)
  	 		->where('alias_products','!=',$alias1)
  	 		->where('hits_products','=',1)
  	 		->where('enable_products','=',1)
			->get();
		 return $listProducts; 
	}
	// get products details have alias 
	public function getProductsDetails($aIdProducts){
		$listProducts = $this
//		->join('unit','unit_id','=','unit.id_unit')
//		->join('products_manufacture','manufacture_id','=','products_manufacture.idProductsManufacture')
		->join('products_madein','madein_id','=','products_madein.idProductsMadein')
		->join('products_categories','categories_id','=','products_categories.idProductsCategories')
		//->Join('menus','products_categories.id_menus','=','menus.idMenus')
                ->where('products.idProducts','=',$aIdProducts)
		->where('enable_products','=',1)
		->first();
		return $listProducts; 
	}
	// get all products have id categories   
	public function getProductsCategoriesID($ordering){
		$listProducts = $this
		->where('products_categories.ordering_products_categories','=',$ordering)
		->join('unit','unit_id','=','unit.id_unit')
		->join('products_categories','categories_id','=','products_categories.idProductsCategories')
		->where('enable_products','=',1)
		->paginate(6);
		return $listProducts; 
	}


	public function getProductsSameCategories($id_categories, $aIdProducts){
	  $listProducts = $this
                ->join('products_madein','madein_id','=','products_madein.idProductsMadein')
                ->join('products_categories','categories_id','=','products_categories.idProductsCategories')
                ->where('products.categories_id','==',$id_categories)
                ->where('products.idProducts','!=',$aIdProducts)
                ->get();
		 return $listProducts; 
	}
	// get products new index
	public function getProductsNewIndex(){
		 $listProducts = $this
		 ->orderBy('ordering_products','asc')
		 ->where('is_new_products','=',1)
		 ->join('unit','unit_id','=','unit.id_unit')
		 ->join('products_categories','categories_id','=','products_categories.idProductsCategories')
		 ->take(4)
		 ->get();
		 return $listProducts;
	}
	// get gallery products
	public function GetGallery($alias){
		$result = $this
		->where('alias_products','=',$alias)
		->join('images_products','products.idProducts','=','images_products.idProducts')
		->join('medias','idMedia','=','medias.id')
		->select('medias.name_file')
		->get();
		return $result;
	}
	// get three gallery products
	public function GetGalleryLimit($alias){
		$result = $this
		->where('alias_products','=',$alias)
		->join('images_products','products.idProducts','=','images_products.idProducts')
		->join('medias','idMedia','=','medias.id')
		->select('medias.name_file')
		->take(3)
		->get();
		return $result;
	}
	/* insert view */
	 public function insertView($id){
	 	DB::table('view_products')->insert(array('ip'=>$_SERVER['REMOTE_ADDR'],'idProducts'=>$id));
	 }
	 // get view
	 public function getView($id){
	 	$result = DB::table('view_products')
	 			->where('idProducts','=',$id)
	 			->distinct()
	 			->select('ip')
	 			->get();
	 	return count($result);
	 }
	 // get searching products 
	public function getSearch($keywords){
		$listProducts = $this->orderBy('ordering_products','asc')
		->orderBy('ordering_products_categories','asc')
		->orderBy('ordering_products','asc')
		->join('unit','unit_id','=','unit.id_unit')
		->join('products_categories','categories_id','=','products_categories.idProductsCategories')
		->where('enable_products','=',1)
		->where('name_products','LIKE','%'.$keywords.'%')
		 ->orWhere('code_products','LIKE','%'.$keywords.'%')
		 ->orWhere('products_categories.name_products_categories','LIKE','%'.$keywords.'%')
		->take(200)
		->get();
		return $listProducts; 
	}
	
}