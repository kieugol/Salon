<?php

class AdminProvinceController extends \BaseController {

	protected $layout = 'admin.main';
	public $_data = array();
	public function getHome() {
		$province = new Province();
		$_data['list_province'] = $province->getprovinceHome();
		$this->layout->content = View::make('admin.content_right.province.home', $_data);
	}
	// load form insert
	public function getAdd() {
		$this->layout->content = View::make('admin.content_right.province.add');
	}
	// insert articles new
	public function postInsert() {
		$data_pd = array(
			'name_province' => Input::get('txt_title'),
			'alias_province' => $this->getAlias(Input::get('txt_title')),
		);
		// call model
		$province = new Province();
		// insert
		$province->insert($data_pd);

		return Redirect::to("administrator/province/add")->with('message', 'Success!!!');
	}
	// enable products
	public function getEnable() {
		$id = Input::get('id');
		$status = Input::get('status');
		$province = new Province();
		$province->enable($id, $status);
		return Redirect::back();
	}
	// call update products
	public function getUpdate() {
		$id = Input::get('id');
		$province = new Province();
		$_data['list_province'] = $province->getprovinceUpdate($id);
		$this->layout->content = View::make('admin.content_right.province.update', $_data);
	}
	// update products
	public function postUpdate() {
		$id = 0;
		$id = Input::get('txt_id');
		$data_pd = array(
			'name_province' => Input::get('txt_name'),
			'alias_province' => $this->getAlias(Input::get('txt_name')),
		);
		$province = new Province();
		// update provinceegories
		$province->updateprovince($id, $data_pd);
		return Redirect::to("administrator/province/home")->with('message', 'Success!!!');
	}
	public function postRemove() {
		if (isset($_POST['delete'])) {
			$province = new Province();
			foreach ($_POST['delete'] as $id) {
				$province->removeprovince($id);
			}
			return Redirect::back()->with('message', 'Success!!!');
		}
		return Redirect::back();
	}

}