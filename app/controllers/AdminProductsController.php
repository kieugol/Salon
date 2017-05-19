<?php
class AdminProductsController extends \BaseController {
	//protected $layout = 'user.main';
	protected $layout = 'admin.main';
	public $data = array();
	// load all products
	public function getHome()
	{
		$products = new Products();
		$productsCat = new ProductsCat();
		$productsMf = new ProductsMf();
		$data['list_products'] = $products->getHomeProductsAd();
		$this->layout->content = View::make('admin.content_right.products.home',$data);
	}
	public function getHomeCategories()
	{
		$id_categories =0;
		$id_categories = Input::get('id');
		$products = new Products();
		$productsMf = new ProductsMf();
		$data['list_productsMf'] = $productsMf->getAllProductsMf();
		$data['list_products'] = $products->getHomeProductsAd_categories($id_categories);
		$this->layout->content = View::make('admin.content_right.products.home_categories',$data);
	}
	public function getAdd()
	{
		$images = new Media();
		$productsCat = new ProductsCat();
		$productsMade = new ProductsMade();
		$data['list_productsMade'] = $productsMade->getAllProductsMade();
		$data['list_products_cat'] = $productsCat->getAllProductsCatParent();
		$data['list_images'] = $images->get_data_media();
		$data['max_id'] = $images->getMinId();
		$data['list_productsCat'] = $productsCat->getHomeProductsCatAd();
		
		$this->layout->content = View::make('admin.content_right.products.add',$data);
	}
	// call update decorate
	public function getUpdate()
	{
		$id=0;
		$id = Input::get('id');
		$products = new Products();
		$productsCat = new ProductsCat();
		$images = new Media();
		$gallery = new MediaProducts();
		$productsMade = new ProductsMade();
		$data['list_productsMade'] = $productsMade->getAllProductsMade();
		$data['list_images'] =  $gallery->get_images($id);
		$data['list_gallery'] = $gallery->getGallery($id);
		$data['max_id'] = $images->getMinId();
		$data['list_products'] = $products->getProductsUpdate($id);
		$data['list_products_cat'] = $productsCat->getHomeProductsCatAd();
		$this->layout->content = View::make('admin.content_right.products.update',$data);
	}
	// update products
	public function postUpdate()
	{
		// load data form
		$idProducts = 0; $idProducts = Input::get('txt_id');
		$data_pd= array(
			'name_products' => trim(Input::get('txt_name')),
			'code_products' => '',
			'thumb_products'=> Input::get('txt_thumb'),
			'guarantee_products' => '',
			'madein_id' => Input::get('sl_made'),
			'categories_id'=>	Input::get('sl_categories'),
			'manufacture_id'=>	0,
			'price_products'=> Input::get('txt_price'),
			'quanlity_products' => 0,
			'is_empty_products' => 0,
			'is_sale_products'=> Input::get('txt_percent'),
			'unit_id' => 1,
                        'size_products' =>  Input::get('txt_size'),
			'short_desc_products' => Input::get('txt_short_des'),
			'des_products' => Input::get('txt_des'),
			'is_new_products' => 1,
			'hits_products' => 0,
			'alias_products' =>	$this->getAlias(Input::get('txt_name')),
			'enable_products' => 1,
			'meta_desc_products' =>  '',
			'meta_key_products' =>  '',
			'meta_title_products' =>  '',
			'ordering_products' => 	Input::get('txt_sort')
		);
		// update products
		$products = new Products();
		$products->updateProducts($idProducts,$data_pd);
		// update gallery of products
		$images = new MediaProducts();
		$images->deleteGallery($idProducts);
		 if ( isset($_POST['imglist']) )
		{
			foreach($_POST['imglist'] as $id)
			{
				$images->insertGallery($id,$idProducts);
			}
		}
		// send data
		return Redirect::to("administrator/products/home")->with('message','Success!!!');
	}
	// update products decorare
	
	 // insert products
	public function postInsert()
	{
		$products = new Products();
		$idmax = 0;
		$idmax = $products->getMaxId();	
		// get values form
		$data_pd= array(
			'name_products' => trim(Input::get('txt_name')),
			'code_products' => '',
			'thumb_products'=> Input::get('txt_thumb'),
			'guarantee_products' => '',
			'madein_id' => Input::get('sl_made'),
			'categories_id'=>	Input::get('sl_categories'),
			'manufacture_id'=>	0,
			'type_products'=> 0,
			'price_products'=> Input::get('txt_price'),
			'quanlity_products' => 0,
			'is_empty_products' => 0,
			'is_sale_products'=> Input::get('txt_percent'),
			'unit_id' => 1,
                        'size_products' =>  Input::get('txt_size'),
			'short_desc_products' => Input::get('txt_short_des'),
			'des_products' => Input::get('txt_des'),
			'is_new_products' => 1,
			'hits_products' => 0,
			'alias_products' =>	$this->getAlias(Input::get('txt_name')),
			'enable_products' => 1,
			'meta_desc_products' =>  '',
			'meta_key_products' =>  '',
			'meta_title_products' =>  '',
			'ordering_products' => 	Input::get('txt_sort'),
			'created_products'=>date('Y-m-d')
		);
		// call model insert data
		$images = new MediaProducts();
		$products->insert($data_pd);
		// insert gallery
		$idProducts = DB::getPdo()->lastInsertId();
		 if ( isset($_POST['imglist']) )
		{
		 	$products = new Products();
			foreach($_POST['imglist'] as $id)
			{
				$images->insertGallery($id,$idProducts);
			}
		}
		// send data
		return Redirect::to("administrator/products/add")->with('message','Success!!!');
	}
	// enable products
	public function getEnable(){
		$id = Input::get('id');
		$status = Input::get('stt');
		$products = new Products();
		$products->enable($id,$status);
		return Redirect::back();
	}
	public function postRemove(){
		if( isset($_POST['bt_Update']) )
		{
			if ( isset($_POST['delete']) )
				{
					$products = new Products();
					// get total record  in array
					$ordering = $_POST['ordering'];
					$idhide = $_POST['idhide'];
					$total = count($idhide);
					// ordering menu footer
					 foreach($_POST['delete'] as $id)
					 {
						for($i=0;$i<$total; $i++){
							if( $idhide[$i] == $id )
							{
								$value = $ordering[$i];
							  	$products->orderProducts($id,$value);
							}	
						}
					}
				return Redirect::back()->with('message','Success!!!');
				}// end if isset()
		}
		// checking delete 
		else if ( isset($_POST['bt_Delete']) )
		{
		 	$products = new Products();
		 	$images = new MediaProducts();	
		 	if( isset($_POST['delete']) )
		 	{
				foreach($_POST['delete'] as $id)
				{
					$products->removeProducts($id);
					$images->deleteGallery($id);
				}
				return Redirect::back()->with('message','Success!!!');
			}
		}
		return Redirect::back();
	}
	
}