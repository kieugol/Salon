<?php
class ProductsCat extends \Eloquent {
	public static $rules = array();
	protected $table = 'products_categories';
	
	/*------------------ADMIN-------------------------- */
	
	// insert data
	public function insert($data_pd){
		DB::table('products_categories')->insert($data_pd);
	}
	// get products homes
	public function getHomeProductsCatAd(){
		$listProductsCat = $this
		->leftJoin('menus','idMenus','=','id_menus')
		->orderBy('products_categories.parentid', 'asc')
		->orderBy('ordering_products_categories', 'asc')
		->get();
		return $listProductsCat; 
	}
	// get products update
	public function getProductsCatUpdate($id){
		$listProductsCat = $this
		->where('idProductsCategories','=',$id)
		->first();
		return $listProductsCat; 
	}
	// upadate
	public function updateProductsCat($id,$data_pd){
		  DB::table('products_categories')
		 ->where('idProductsCategories','=',$id)
		 ->update($data_pd);
	}
	//enable products
	public function enable($id,$status){
		if($status==0)
			$status=1;
			else
			$status=0;
		$this
		->where('idProductsCategories','=',$id)
		->update(array(
				'enable_products_categories'=>$status
			));
	}
	//remove products Cat
	public function removeProductsCat($id){
		$this
		->where('idProductsCategories','=',$id)
		->delete();
	}
	public function SetNullProducts($id){
		DB::table('products')
		->where('Categories_id',$id)
       ->update(array('Categories_id' => 0));
	}
	public function orderCat($id,$value){
		$this->where('idProductsCategories','=',$id)
			->update(array('ordering_products_categories'=>$value));
		return true;
	}
	// count products in categories
	public function totalProducts($idProductsCategories){
		$qty = $this
			->join('products','idProductsCategories','=','products.categories_id')
			->where('idProductsCategories','=',$idProductsCategories)
			->get();
		return count($qty);
	}
	/*------------------USER-------------------------- */
	// get Id ordering min 
	public function getIdOrder(){
		$value = $this->min('ordering_products_categories');
		return $value;
	}
	// get all products Categories parent
	public function getAllProductsCatParent(){
		$listProductsCat = $this
		->orderBy('ordering_products_categories','asc')
		->where('enable_products_categories','=',1)
		->where('parentid','=',0)
		->get();
		return $listProductsCat; 
	}
	// get all products Categories child 
	public function getAllCatChild(){
		$listProductsCat = $this
		->orderBy('ordering_products_categories','asc')
		->where('enable_products_categories','=',1)
		->where('parentid','!=',0)
		->get();
		return $listProductsCat; 
	}
	// get all products Categories child 
	public function getAllProductsCatChild($idProductsCategories){
		$listProductsCat = $this
		->orderBy('ordering_products_categories','asc')
		->where('enable_products_categories','=',1)
		->where('parentid','=',$idProductsCategories)
		->get();
		return $listProductsCat; 
	}
	// get Products Categories ordering Max  
	public function getProductsCatFirst(){
		$id_max = $this->min('ordering_products_categories');
		$categories = $this
		->where('ordering_products_categories','=',$id_max)
		->first();
		return $categories; 
	}
	// get products categories have alias
	public function getProductsCatDetails($alias){
	   $listProductsCat = $this
  	 		->where('alias_products_categories','=',$alias)
			->first();
		return $listProductsCat; 
	}
	// get list id products Cat 
	public function getArrayParentId(){
		$list_cat = $this->get();
		$data = array(); $i=0;
		foreach ($list_cat as $key => $value) {
			if($list_cat[$key]->parentid!=0)
			{
				$data[$i]= $list_cat[$key]->parentid;
				$i++;
			}
		}
		if(count($data)>0){
			return $data;
		}
		else
		{
			$data[0] = 0;
			return $data;
		}
	}
	// get list id products Cat Root
	public function getArrayParentRoot(){
		$list_cat = $this->get();
		$data = array(); $i=0;
		foreach ($list_cat as $key => $value) {
			if($list_cat[$key]->parentid==0)
			{
				$data[$i]= $list_cat[$key]->idProductsCategories;
				$i++;
			}
		}
		if(count($data)>0){
			return $data;
		}
		else
		{
			$data[0] = 0;
			return $data;
		}
	}
	// get all products Categories child != $idProductsCategories
	public function getProductsCatChild($idProductsCategories){
		$listProductsCat = $this
		->orderBy('ordering_products_categories','asc')
		->where('enable_products_categories','=',1)
		->where('parentid','=',$idProductsCategories)
		->get();
		return $listProductsCat; 
	}
	// get products_cat is hit display index
	public function getProductsCatHit(){
		$data = $this->getArrayParentRoot();
	   	$listProductsCat = $this
	   		->orderBy('ordering_products_categories','asc')
  	 		->whereIn('parentid',$data)
			->get();
		return $listProductsCat; 
	}
	 // get array id producstCategories
	 public function getArrayid(){
	 	$result = $this->get();
			$data = array();
		if(count($result)>0)
		{
			foreach ($result as $key => $value)
			{
				$data[$key]= $result[$key]->parentid;	
			}
		}
		else $data[0]=0;
		return $data;
	 }
	 // check if categories is parent
	 public function checkCategoriesParent($idProductsCategories){
	 	$result = $this
	 	->where('idProductsCategories','!=',$idProductsCategories)
	 	->get();
	 	$check =0;
			foreach ($result as $key => $value)
			{
				if($result[$key]->parentid == $idProductsCategories ){
					$check=1;
					break;
				}	
			}
		return $check;
	 }
	 // get products categories have id
	public function getProductsCatDetailsID($idProductsCategories){
	   $listProductsCat = $this
  	 	->where('idProductsCategories','=',$idProductsCategories)
			->first();
		return $listProductsCat; 
	}
	/*-------------------------------------------categories multi level---------------------------------------------------*/
			// get all products cat Multi 
		public function getMulti($level){
		  $menu = $this->Menulevel($level);
		  $html="";
		  foreach($menu as $k => $row)
		  {
		   $html.='<option value="'.$row['idProductsCategories'].'">'.'--'.$row['name_products_categories'].'</option>';
		  }
		  return $html;
	 }
	 // get all menu Multi 
		public function getMultiHome($level,$stament){
		  $menu = $this->Menulevel($level);
		  $html="";
		  foreach($menu as $k => $row)
		  {
		  	if($stament==1)
		   	$html.='<option disabled="disabled" value="'.$row['idProductsCategories'].'">'.'--'.$row['name_products_categories'].'</option>';
		  }
		  return $html;
	 }
		// get menu multi update for products
	public function getMultiUpdate($id,$idparent){
		  $menu = $this->Menulevel(0);
		  $html="";
		  	if($id>0)
			  foreach($menu as $k => $row)
			  {
			  	if($row['idProductsCategories']!=$id)
			  	{
				  	if($row['idProductsCategories']==$idparent)
				   		$html.='<option selected="selected" value="'.$row['idProductsCategories'].'">'.'--'.$row['name_products_categories'].'</option>';
				  	else
				  		$html.='<option value="'.$row['idProductsCategories'].'">'.'--'.$row['name_products_categories'].'</option>';
			  	}
			  }
		  return $html;
	 }
	 	// get menu multi update for products
	public function getMultiUpdateProducts($id){
		  $menu = $this->Menulevel(0);
		  $html="";
		  foreach($menu as $k => $row)
		  {
			  	if($row['idProductsCategories']==$id)
			   		$html.='<option selected="selected" value="'.$row['idProductsCategories'].'">'.'--'.$row['name_products_categories'].'</option>';
			  	else
			  		$html.='<option value="'.$row['idProductsCategories'].'">'.'--'.$row['name_products_categories'].'</option>';
		  }
		  return $html;
	 }
	 	 // get menu multi Add
	 	public function getMultiAdd($level){
	 	// start loop array parentid
	 		$result = $this->get();
			$data = array();
			foreach ($result as $key => $value)
			{
				$data[$key]= $result[$key]->parentid;	
			}
			$length = count($data);
			$checkChild=0;
		// end loop array parentid
		  $menu = $this->Menulevel($level);
		  $html="";
		  	foreach($menu as $k => $row)
		  	{
			  		for($i=0;$i<$length;$i++)
			  		{
			  			if($data[$i]==$row['idProductsCategories'] || $row['parentid']==0){
			  				$checkChild=1;
			   			}
			   		}
			   		if($checkChild==0)
			   			$html.='<option value="'.$row['idProductsCategories'].'">'.'-- '.$row['name_products_categories'].'</option>';
			   		else
			   			$html.='<option disabled="disabled" value="'.$row['idProductsCategories'].'">'.'-- '.$row['name_products_categories'].'</option>';
			  		$checkChild=0;
		  	}
		  return $html;
	 }
	 public function Menulevel($parentid = 0, $space = "", $trees = array())
	{
			if(!$trees) 
			{
				$trees = array();
			}
			$query = $this
				   ->where('parentid','=',$parentid)
				   ->get();
	  		$listMenu=$query;
			foreach($listMenu as $rs)
	  		{
				$trees[] = array( 'idProductsCategories' => $rs->idProductsCategories,
								  'name_products_categories'=>$space.$rs->name_products_categories,
								   'parentid'=>$rs->parentid,
									); 
				$trees = $this->Menulevel($rs->idProductsCategories, $space.' --', $trees); 
			}
			return $trees;
	}
	// insert submenu
	public function insertSub($data){
		DB::table('menus')->insert($data);
		return true;
	}
	// get list parent id
		public function checkParentId($id){
			$result = $this->select('parentid')->get();
			$data = array();
			foreach ($result as $key => $value) {
				$data[$key]= $result[$key]->parentid;	
			}
			$row = $this
			->whereIn('idProductsCategories',$data)
			->where('idProductsCategories','=',$id)
			->get();
			return $row;
		}
	// get menu level 1
 	public function getMenuChild($id){
 		$listmenu = $this->where('parentid','=',$id)
 		->get();
 		return $listmenu;
 	}
 	
	/*---------------------------------end_multi-----------------------------------------*/
}