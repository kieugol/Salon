<?php

class AdminSaleController extends \BaseController {

	
	
	protected $layout = 'admin.main';
	public $_data = array();
	public function getHome()
	{
		$sale = new Sale();
		$_data['list_sale'] = $sale->getsale();
		$this->layout->content = View::make('admin.content_right.products_sale.home',$_data);
	}
	// load form insert 
	public function getAdd()
	{
		$this->layout->content = View::make('admin.content_right.products_sale.add');
	}
	// insert articles new
	public function postInsert()
	{
		$start =Input::get('txt_start');
		$end = Input::get('txt_end');
		$data_pd= array(
			'des_sale' => Input::get('txt_des'),
			'start_sale' => date_format(date_create($start),'Y-m-d'),
			'end_sale' => date_format(date_create($end),'Y-m-d'),
			'enable_sale' => Input::get('rd_status'),
		);
		// call model
		$sale = new Sale();
		// insert
		$sale->insert($data_pd);
		return Redirect::to("administrator/sale/add")->with('message','Success!!!');
	}
	// enable products
	public function getEnable(){
		$id=Input::get('id');
		$status=Input::get('status');
		$sale = new Sale();
		$sale->enable($id,$status);
		return Redirect::back();
	}
	// call update products
	public function getUpdate()
	{
		$id = Input::get('id');
		$sale = new Sale();
		$_data['list_sale'] = $sale->getSaleUpdate($id);
		$this->layout->content = View::make('admin.content_right.products_sale.update',$_data);
	}
	// update products
	public function postUpdate()
	{
		$id = 0; $id = Input::get('txt_id');
		$start =Input::get('txt_start');
		$end = Input::get('txt_end');
		$data_pd= array(
			'des_sale' => Input::get('txt_des'),
			'start_sale' => date_format(date_create($start),'Y-m-d'),
			'end_sale' => date_format(date_create($end),'Y-m-d'),
			'enable_sale' => Input::get('rd_status'),
		);
		$sale = new Sale();
		// update saleegories
		$sale->updateSale($id,$data_pd);
		return Redirect::to("administrator/sale/home")->with('message','Success!!!');
	}
	public function postRemove(){
			 if ( isset($_POST['delete']) )
			{
			 	$sale = new Sale();
				foreach($_POST['delete'] as $id)
				{
					$sale->removeSale($id);
				}
				return Redirect::back()->with('message','Success!!!');
			}
			return Redirect::back();
	}

}