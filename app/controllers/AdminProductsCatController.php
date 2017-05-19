<?php
class AdminProductsCatController extends \BaseController {
	protected $layout = 'admin.main';
	public $data = array();
	// load all products
	public function getHome()
	{
		$productsCat = new ProductsCat();
		$data['list_productsCat'] = $productsCat->getHomeProductsCatAd();
		$this->layout->content = View::make('admin.content_right.products_cat.home',$data);
	}
	public function getAdd()
	{
		$images = new Media();
		$productsCat = new ProductsCat();
		$menu = new Menu();
		$data['list_images'] = $images->get_data_media();
		$data['max_id'] = $images->getMinId();
		$this->layout->content = View::make('admin.content_right.products_cat.add',$data);
	}
	// call update products
	public function getUpdate()
	{
		$id = Input::get('id');
		$details;
		$productsCat = new ProductsCat();
		$images = new Media();
		$menu = new Menu();
		$data['max_id'] = $images->getMinId();
		$data['list_images'] = $images->get_data_media();
		$data['list_menus'] = $menu->getTypeMenus('products');
		$data['list_productsCat'] = $details = $productsCat->getProductsCatUpdate($id);
		if(count($details)>0)
			$data['combobox_menu'] = $productsCat->getMultiUpdate($details['idProductsCategories'],$details['parentid']);
		else
			$data['combobox_menu'] = $productsCatCat->getMultiUpdate(0,0);
		$this->layout->content = View::make('admin.content_right.products_cat.update',$data);
	}
	// update products
	public function postUpdate()
	{
		// load data form
		$id = 0; $id = Input::get('txt_id');
		// get values form
		$tmp = "";$tmp = Input::get('txt_name');
		$data_pd= array(
			'name_products_categories' => Input::get('txt_name'),
			'des_products_categories' => '',
			'thumb_products_categories'=> Input::get('txt_thumb'),
			'hits_products_categories' => 1,
			'parentid'=> 0,
			'alias_products_categories' =>	$this->getAlias($tmp),
			'enable_products_categories' => 1,
			'meta_desc_products_categories' =>  '',
			'meta_key_products_categories' =>  '',
			'meta_title_products_categories' =>  '',
			'ordering_products_categories' => Input::get('txt_sort'),
			'created_at'=>date('Y-m-d'),
			'id_menus'=> 1
		);
		// call model update
		$productsCat = new ProductsCat();
		$productsCat->updateProductsCat($id,$data_pd);
		return Redirect::to('administrator/productsCategories/home')->with('message','Success!!!');
	}
	 // insert products
	public function postInsert()
	{
		// get values form
		$tmp = "";$tmp = Input::get('txt_name');
		$data_pd= array(
			'name_products_categories' => Input::get('txt_name'),
			'des_products_categories' => '',
			'thumb_products_categories'=> Input::get('txt_thumb'),
			'hits_products_categories' => 1,
			'parentid' => 0,
			'alias_products_categories' =>	$this->getAlias($tmp),
			'enable_products_categories' => 1,
			'meta_desc_products_categories' =>  '',
			'meta_key_products_categories' =>  '',
			'meta_title_products_categories' =>  '',
			'ordering_products_categories' => Input::get('txt_sort'),
			'created_at'=>date('Y-m-d'),
			'id_menus'=> 1
		);
		// call model insert data
		$productsCat = new ProductsCat();
		$productsCat->insert($data_pd);
		return Redirect::to('administrator/productsCategories/add')->with('message','Success!!!');
	}
	// enable products
	public function getEnable(){
		$id = Input::get('id');
		$status = Input::get('status');
		$productsCat = new ProductsCat();
		$productsCat->enable($id,$status);
		return Redirect::back();
	}
	public function postRemove(){
		if( isset($_POST['bt_Update']) ){
                    if ( isset($_POST['delete']) ){
                            $productsCat = new ProductsCat();
                            // get total record  in array
                            $ordering = $_POST['ordering'];
                            $idhide = $_POST['idhide'];
                            $total = count($idhide);
                            echo $total;
                            // ordering menu footer
                             foreach($_POST['delete'] as $id)
                             {
                                    for($i=0;$i<$total; $i++){
                                            if( $idhide[$i] == $id )
                                            {
                                                    $value = $ordering[$i];
                                                    $productsCat->orderCat($id,$value);
                                            }	
                                    }
                            }
                            return Redirect::to('administrator/productsCategories/home')->with('message','Success!!!');
                    }// end if isset()
		}
		else if(isset($_POST['btn_Delete']))
		{
			 if ( isset($_POST['delete']) )
			{
			 	$productsCat = new ProductsCat();
				foreach($_POST['delete'] as $id)
				{
					$productsCat->removeProductsCat($id);
					$productsCat->SetNullProducts($id);
				}
				return Redirect::to('administrator/productsCategories/home')->with('message','Success!!!');
			}
		}
	return Redirect::back();
	}
}