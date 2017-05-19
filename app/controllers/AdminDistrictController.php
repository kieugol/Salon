<?php

class AdminDistrictController extends \BaseController {

	protected $layout = 'admin.main';

	public $_data = array();

	public function getHome() {

		$district = new District();

		$_data['list_district'] = $district->getdistrictHome();

		$this->layout->content = View::make('admin.content_right.district.home', $_data);

	}

	// load form insert

	public function getAdd() {

		$province = new Province();

		$_data['list_province'] = $province->getAllprovince();

		$this->layout->content = View::make('admin.content_right.district.add', $_data);

	}

	// insert articles new

	public function postInsert() {

		$data_pd = array(

			'name_district' => Input::get('txt_name'),

			'id_province' => Input::get('sl_province'),

			'alias_district' => $this->getAlias(Input::get('txt_name')),
			'ordering_district' => 1,

		);

		// call model

		$ship = new District();

		// insert

		$ship->insert($data_pd);

		return Redirect::to("administrator/district/add")->with('message', 'Success!!!');

	}

	// enable products

	public function getEnable() {

		$id = Input::get('id');

		$status = Input::get('status');

		$district = new District();

		$district->enable($id, $status);

		return Redirect::back();

	}

	// call update products

	public function getUpdate() {

		$id = Input::get('id');

		$district = new District();

		$province = new Province();

		//

		$_data['list_province'] = $province->getAllprovince();

		$_data['list_district'] = $district->getdistrictUpdate($id);

		$this->layout->content = View::make('admin.content_right.district.update', $_data);

	}

	// update products

	public function postUpdate() {

		$id = 0;

		$id = Input::get('txt_id');

		$data_pd = array(

			'name_district' => Input::get('txt_name'),

			'id_province' => Input::get('sl_province'),

			'alias_district' => $this->getAlias(Input::get('txt_name')),
			'ordering_district' => 1,
		);

		$district = new District();

		// update districtegories

		$district->updatedistrict($id, $data_pd);

		return Redirect::to("administrator/district/home")->with('message', 'Success!!!');

	}

	public function postRemove() {

		if (isset($_POST['bt_Update'])) {

			if (isset($_POST['delete'])) {

				$district = new District();

				// get total record  in array

				$ordering = $_POST['ordering'];

				$idhide = $_POST['idhide'];

				$total = count($idhide);

				// ordering menu footer

				foreach ($_POST['delete'] as $id) {

					for ($i = 0; $i < $total; $i++) {

						if ($idhide[$i] == $id) {

							$value = $ordering[$i];

							$district->orderDistrict($id, $value);

						}

					}

				}

				return Redirect::back()->with('message', 'Success!!!');

			} // end if isset()

		} else if (isset($_POST['bt_Delete'])) {

			// checking delete

			$district = new District();

			if (isset($_POST['delete'])) {

				foreach ($_POST['delete'] as $id) {

					$district->removeDistrict($id);

				}

				return Redirect::back()->with('message', 'Success!!!');

			}

		}

		return Redirect::back();

	}

}