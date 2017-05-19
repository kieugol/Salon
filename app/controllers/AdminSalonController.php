<?php
class AdminSalonController extends \BaseController {
	//protected $layout = 'user.main';
	protected $layout = 'admin.main';
	public $data = array();
	// load all salon
	public function getHome() {
		$salon = new Salon();
		$service = new Service();
		$result = $service->getAllservice();
		$tmp = array();
		$tmp_val = '';
		foreach ($result as $r) {
			if (isset($tmp[$r->id_salon])) {
				$tmp_val = $tmp[$r->id_salon];
				$tmp[$r->id_salon] = $tmp_val . '<div>' . '<b>' . $r->name_service . '</b>' . ':   ' . number_format($r->price_service, 0, ",", ".") . 'VND</div>';
			} else {
				$tmp[$r->id_salon] = '<a class="btn btn-info btn-flat" href="' . Asset('administrator/service/edit-service-salon?id=')
				. $r->id_salon . '"><span class="glyphicon glyphicon-pencil"></span>  update dịch vụ</a><br><br>'
				. '<div>' . '<b>' . $r->name_service . '</b>' . ':   ' . number_format($r->price_service, 0, ",", ".") . 'VND</div>';
			}
		}
		$data['list_service'] = $tmp;
		$data['list_salon'] = $salon->getHomesalonAd();
		$this->layout->content = View::make('admin.content_right.salon.home', $data);
	}
    public function getHomeAutoRegister() {
		$salon = new Salon();
		$service = new Service();
		$data['list_salon'] = $salon->getHomesalonAutoRegisterAd();
		$this->layout->content = View::make('admin.content_right.salon.home-auto-register', $data);
	}
	public function getHomeCategories() {
		$id_categories = 0;
		$id_categories = Input::get('id');
		$salon = new Salon();
		$salonMf = new salonMf();
		$data['list_salonMf'] = $salonMf->getAllsalonMf();
		$data['list_salon'] = $salon->getHomesalonAd_categories($id_categories);
		$this->layout->content = View::make('admin.content_right.salon.home_categories', $data);
	}
	public function getAdd() {
		$images = new Media();
		$district = new District();
		$data['list_district'] = $district->getDistrictForSalon();
		$data['list_images'] = $images->get_data_media();
		$data['max_id'] = $images->getMinId();
		$this->layout->content = View::make('admin.content_right.salon.add', $data);
	}
	// call update decorate
	public function getUpdate() {
		$id = 0;
		$id = Input::get('id');
		$salon = new Salon();
		$district = new District();
		$images = new Media();
		$gallery = new MediaSalon();
		$data['list_images'] = $gallery->get_images($id);
		$data['list_gallery'] = $gallery->getGallery($id);
		$data['max_id'] = $images->getMinId();
		$data['list_salon'] = $salon->getsalonUpdate($id);
		$data['list_district'] = $district->getDistrictForSalon();
		$this->layout->content = View::make('admin.content_right.salon.update', $data);
	}
	// update salon
	public function postUpdate() {
		// load data form
		$idsalon = 0;
		$idsalon = Input::get('txt_id');
		$data_pd = array(
			'name_salon' => trim(Input::get('txt_name')),
			'alias_salon' => $this->getAlias(Input::get('txt_name')),
			'thumb_salon' => Input::get('txt_thumb'),
			'maps_salon' => Input::get('txt_maps'),
			'contact_salon' => Input::get('txt_contact'),
			'price_salon' => Input::get('txt_price'),
			'id_district' => Input::get('sl_district'),
			'address_salon' => trim(Input::get('txt_address')),
			'banner_salon' => trim(Input::get('txt_banner')),
			'phone_salon' => trim(Input::get('txt_phone'))
		);
		//print_r($data_pd);exit;
		// update salon
		$salon = new Salon();
		$salon->updatesalon($idsalon, $data_pd);
		// update gallery of salon
		$images = new MediaSalon();
		$images->deleteGallery($idsalon);
		if (isset($_POST['imglist'])) {
			foreach ($_POST['imglist'] as $id) {
				$images->insertGallery($id, $idsalon);
			}
		}
		// send data
		return Redirect::to("administrator/salon/home")->with('message', 'Success!!!');
	}
	// update salon decorare

	// insert salon
	public function postInsert() {
		$salon = new Salon();
		$idmax = 0;
		$idmax = $salon->getMaxId();
		// get values form
		$data_pd = array(
			'name_salon' => trim(Input::get('txt_name')),
			'alias_salon' => $this->getAlias(Input::get('txt_name')),
			'thumb_salon' => Input::get('txt_thumb'),
			'maps_salon' => Input::get('txt_maps'),
			'contact_salon' => Input::get('txt_contact'),
			'price_salon' => Input::get('txt_price'),
			'id_district' => Input::get('sl_district'),
			'address_salon' => trim(Input::get('txt_address')),
			'banner_salon' => trim(Input::get('txt_banner')),
			'phone_salon' => trim(Input::get('txt_phone'))
		);
		// call model insert data
		$images = new MediaSalon();
                $rating = new Rating();
		$salon->insert($data_pd);
		// insert gallery
		$idsalon = DB::getPdo()->lastInsertId();
                // insert rating
                $rating->insert(['product_id' => $idsalon]);
		if (isset($_POST['imglist'])) {
			$salon = new Salon();
			foreach ($_POST['imglist'] as $id) {
				$images->insertGallery($id, $idsalon);
			}
		}
		// send data
		return Redirect::to("administrator/salon/add")->with('message', 'Success!!!');
	}
	// enable salon
	public function getEnable() {
		$id = Input::get('id');
		$status = Input::get('stt');
		$salon = new Salon();
		$salon->enable($id, $status);
		return Redirect::back();
	}
	public function postRemove() {
		if (isset($_POST['bt_Update'])) {
			if (isset($_POST['delete'])) {
				$salon = new Salon();
				// get total record  in array
				$ordering = $_POST['ordering'];
				$idhide = $_POST['idhide'];
				$total = count($idhide);
				// ordering menu footer
				foreach ($_POST['delete'] as $id) {
					for ($i = 0; $i < $total; $i++) {
						if ($idhide[$i] == $id) {
							$value = $ordering[$i];
							$salon->ordersalon($id, $value);
						}
					}
				}
				return Redirect::back()->with('message', 'Success!!!');
			} // end if isset()
		}
		// checking delete
		else if (isset($_POST['bt_Delete'])) {
			$salon = new Salon();
			$images = new MediaSalon();
			if (isset($_POST['delete'])) {
				foreach ($_POST['delete'] as $id) {
					$salon->removesalon($id);
					$images->deleteGallery($id);
				}
				return Redirect::back()->with('message', 'Success!!!');
			}
		}
		return Redirect::back();
	}

	/* --------------------- Salon display index ----------------------------*/
	public function getDisplayIndex() {
		$data = array();
		$salonIndex = new SalonIndex();
		$data['list_salon'] = $salonIndex->getSalonDispIndexAd();
		$this->layout->content = View::make('admin.content_right.salon.display_index', $data);
	}
	public function getAddIndex() {
		$data = array();
		$salon = new Salon();
		$data['list_salon'] = $salon->getSalonAddIndex();
		$this->layout->content = View::make('admin.content_right.salon.add_index', $data);
	}

	public function postInsertIndex() {
		$salonIndex = new SalonIndex();
		if (isset($_POST['id'])) {
			foreach (Input::get('id') as $id_salon) {
				$salonIndex->insert(array('id_salon' => $id_salon, 'ordering_salon_index' => 1));
			}
			return Redirect::back()->with('message', 'Success!!!');
		}
		return Redirect::back();
	}

	public function postActionIndex() {
		$salonIndex = new SalonIndex();
		if (isset($_POST['delete'])) {
			if (isset($_POST['bt_Delete'])) {
				$arrDelete = [];
				foreach (Input::get('delete') as $id_salon) {
					$arrDelete[] = $id_salon;
				}
				$salonIndex->removeSalonIndex($arrDelete);
			} else {
				$ordering = $_POST['ordering'];
				foreach (Input::get('delete') as $key => $id_salon) {
					$salonIndex->orderSalonIndex($id_salon, $ordering[$key]);
				}
			}
			return Redirect::back()->with('message', 'Success!!!');
		}
		return Redirect::back();
	}

}