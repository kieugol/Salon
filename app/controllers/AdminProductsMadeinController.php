<?php
class AdminProductsMadeinController extends \BaseController {
	protected $layout = 'admin.main';
	public $data = array();
	// load all products
	public function getHome()
	{
		$productsMade = new productsMade();
		$data['list_productsMade'] = $productsMade->getHomeproductsMadeAd();
		$this->layout->content = View::make('admin.content_right.products_madein.home',$data);
	}
	public function getAdd()
	{
		//$images = new Media();
		//$data['list_images'] = $images->get_data_media();
		$this->layout->content = View::make('admin.content_right.products_madein.add');
	}
	// call update products
	public function getUpdate()
	{
		$id = Input::get('id');
		$productsMade = new ProductsMade();
		$data['list_productsMade'] = $productsMade->getproductsMadeUpdate($id);
		$this->layout->content = View::make('admin.content_right.products_madein.update',$data);
	}
	// update products
	public function postUpdate()
	{
		// load data form
		$id = 0; $id = Input::get('txt_id');
		$tmp = "";$tmp = Input::get('txt_name');
		$data_pd= array(
			'name_products_madein' => Input::get('txt_name'),
			'des_products_madein' => Input::get('txt_des'),
			'alias_products_madein' =>	$this->getAlias($tmp),
			'enable_products_madein' => Input::get('rd_status'),
			'ordering_products_madein' => 	Input::get('txt_sort'),
			'updated_at'=>date('Y-m-d H:i:s')
		);
		// call model update
		$productsMade = new productsMade();
		$productsMade->updateproductsMade($id,$data_pd);
		return Redirect::to('administrator/productsMade/home')->with('message','Success!!!');
	}
	 // insert products
	public function postInsert()
	{
		// get values form
		$tmp = "";$tmp = Input::get('txt_name');
		$data_pd= array(
			'name_products_madein' => Input::get('txt_name'),
			'des_products_madein' => Input::get('txt_des'),
			'alias_products_madein' =>	$this->getAlias($tmp),
			'enable_products_madein' => Input::get('rd_status'),
			'ordering_products_madein' => 	Input::get('txt_sort'),
			'created_at'=>date('Y-m-d H:i:s')
		);
		// call model insert data
		$productsMade = new ProductsMade();
		$productsMade->insert($data_pd);
		return Redirect::back()->with('message','Success!!!');
	}
	// enable products
	public function getEnable(){
		$id = Input::get('id');
		$status = Input::get('status');
		$productsMade = new productsMade();
		$productsMade->enable($id,$status);
		return Redirect::back();
	}
	public function postRemove(){
		if( isset($_POST['bt_Update']) )
		{
			if ( isset($_POST['delete']) )
				{
					$productsMade = new productsMade();
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
							  	$productsMade->orderCat($id,$value);
							}	
						}
					}
					return Redirect::to('administrator/productsMadeegories/home')->with('message','Success!!!');
				}// end if isset()
		}
		else if(isset($_POST['bt_Delete']))
		{
			 if ( isset($_POST['delete']) )
			{
			 	$productsMade = new productsMade();
				foreach($_POST['delete'] as $id)
				{
					$productsMade->removeproductsMade($id);
					$productsMade->SetNullProducts($id);
				}
				return Redirect::back()->with('message','Success!!!');
			}
		}
	return Redirect::back();
	}
}