<?php

class AdminProductsManufactureController extends \BaseController {

	protected $layout = 'admin.main';
	public $data = array();
	// load all products
	public function getHome()
	{
		$productsMf = new ProductsMf();
		$data['list_productsMf'] = $productsMf->getHomeproductsMfAd();
		$this->layout->content = View::make('admin.content_right.products_manufacture.home',$data);

	}
	public function getAdd()
	{
		//$images = new Media();
		//$data['list_images'] = $images->get_data_media();
		$this->layout->content = View::make('admin.content_right.products_manufacture.add');

	}
	// call update products
	public function getUpdate()
	{
		$id = Input::get('id');
		$productsMf = new ProductsMf();
		$data['list_productsMf'] = $productsMf->getproductsMfUpdate($id);
		$this->layout->content = View::make('admin.content_right.products_manufacture.update',$data);
	}
	// update products
	public function postUpdate()
	{
		// load data form
		$id = 0; $id = Input::get('txt_id');
		$tmp = "";$tmp = Input::get('txt_name');
		$data_pd= array(
			'name_products_manufacture' => Input::get('txt_name'),
			'des_products_manufacture' => Input::get('txt_des'),
			'alias_products_manufacture' =>	$this->getAlias($tmp),
			'enable_products_manufacture' => Input::get('rd_status'),
			'ordering_products_manufacture' => 	Input::get('txt_sort'),
			'meta_desc_products_manufacture' =>  Input::get('txt_seodesc'),
			'meta_key_products_manufacture' =>  Input::get('txt_key'),
			'meta_title_products_manufacture' =>  Input::get('txt_title'),
			'updated_at'=>date('Y-m-d H:i:s')
		);
		// call model update
		$productsMf = new ProductsMf();
		$productsMf->updateproductsMf($id,$data_pd);
		return Redirect::to('administrator/productsManufacture/home')->with('message','Success!!!');
	}
	 // insert products
	public function postInsert()
	{
		// get values form
		$tmp = "";$tmp = Input::get('txt_name');
		$data_pd= array(
			'name_products_manufacture' => Input::get('txt_name'),
			'des_products_manufacture' => Input::get('txt_des'),
			'alias_products_manufacture' =>	$this->getAlias($tmp),
			'enable_products_manufacture' => Input::get('rd_status'),
			'ordering_products_manufacture' => 	Input::get('txt_sort'),
			'meta_desc_products_manufacture' =>  Input::get('txt_seodesc'),
			'meta_key_products_manufacture' =>  Input::get('txt_key'),
			'meta_title_products_manufacture' =>  Input::get('txt_title'),
			'created_at'=>date('Y-m-d H:i:s')
		);
		// call model insert data
		$productsMf = new ProductsMf();
		$productsMf->insert($data_pd);
		return Redirect::back()->with('message','Success!!!');
	}
	// enable products
	public function getEnable(){
		$id = Input::get('id');
		$status = Input::get('status');
		$productsMf = new ProductsMf();
		$productsMf->enable($id,$status);
		return Redirect::back();
	}
	public function postRemove(){

		if( isset($_POST['bt_Update']) )
		{
			if ( isset($_POST['delete']) )
				{
					$productsMf = new ProductsMf();
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
							  	$productsMf->orderCat($id,$value);
							}	
						}
					}
					return Redirect::to('administrator/productsMfegories/home')->with('message','Success!!!');
				}// end if isset()
		}
		else if(isset($_POST['bt_Delete']))
		{
			 if ( isset($_POST['delete']) )
			{
			 	$productsMf = new ProductsMf();
				foreach($_POST['delete'] as $id)
				{
					$productsMf->removeproductsMf($id);
					$productsMf->SetNullProducts($id);
				}
				return Redirect::back()->with('message','Success!!!');
			}
		}
	return Redirect::back();
	}
}