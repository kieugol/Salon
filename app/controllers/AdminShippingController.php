<?php

class AdminShippingController extends \BaseController {

	
	protected $layout = 'admin.main';
	public $_data = array();
	public function getHome()
	{
		$shipping = new Shipping();
		$_data['list_shipping'] = $shipping-> getShippingHome();
		$this->layout->content = View::make('admin.content_right.shipping.home',$_data);
	}
	// load form insert 
	public function getAdd()
	{
		$this->layout->content = View::make('admin.content_right.shipping.add');
	}
	// insert articles new
	public function postInsert()
	{
		$data_pd= array(
			'name_shipping' => Input::get('txt_name'),
			'des_shipping' => Input::get('txt_des'),
			'alias_shipping' =>	$this->getAlias(Input::get('txt_name')),
			'enable_shipping' => Input::get('rd_status'),
			'meta_desc_shipping' =>  Input::get('txt_seodesc'),
			'meta_key_shipping' =>  Input::get('txt_key'),
			'meta_title_shipping' =>  Input::get('txt_title')
		);
		// call model
		$ship = new Shipping();
		// insert
		$ship->insert($data_pd);
		
		return Redirect::to("administrator/shipping/add")->with('message','Success!!!');
	}
	// enable products
	public function getEnable(){
		$id=Input::get('id');
		$status=Input::get('status');
		$shipping = new Shipping();
		$shipping->enable($id,$status);
		return Redirect::back();
	}
	// call update products
	public function getUpdate()
	{
		$id = Input::get('id');
		$shipping = new Shipping();
		$_data['list_shipping'] = $shipping->getShippingUpdate($id);
		$this->layout->content = View::make('admin.content_right.shipping.update',$_data);
	}
	// update products
	public function postUpdate()
	{
		$id = 0; $id = Input::get('txt_id');
		$data_pd= array(
			'name_shipping' => Input::get('txt_name'),
			'des_shipping' => Input::get('txt_des'),
			'alias_shipping' =>	$this->getAlias(Input::get('txt_name')),
			'enable_shipping' => Input::get('rd_status'),
			'meta_desc_shipping' =>  Input::get('txt_seodesc'),
			'meta_key_shipping' =>  Input::get('txt_key'),
			'meta_title_shipping' =>  Input::get('txt_title')
		);
		$shipping = new Shipping();
		// update shippingegories
		$shipping->updateShipping($id,$data_pd);
		return Redirect::to("administrator/shipping/home")->with('message','Success!!!');
	}
	public function postRemove(){
			 if ( isset($_POST['delete']) )
			{
			 	$shipping = new Shipping();
				foreach($_POST['delete'] as $id)
				{
					$shipping->removeShipping($id);
				}
				return Redirect::back()->with('message','Success!!!');
			}
			return Redirect::back();
	}

}