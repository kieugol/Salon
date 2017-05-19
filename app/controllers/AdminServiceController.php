<?php
class AdminServiceController extends \BaseController {
	//protected $layout = 'user.main';
	protected $layout = 'admin.main';
	// load all salon
	public function getHome() {
		$salon = new Salon();
		$data['list_salon'] = $salon->getHomesalonAd();
		$this->layout->content = View::make('admin.content_right.service.home', $data);
	}
	public function getAdd() {
		$salon = new Salon();
		$images = new Media();
		$data['list_images'] = $images->get_data_media();
		$data['max_id'] = $images->getMinId();
		$data['list_salon'] = $salon->getSalonForAddService();
		$this->layout->content = View::make('admin.content_right.service.add', $data);
	}
	// call get data service salon
	public function getEditServiceSalon() {
		$idSalon = Input::get('id');
		$service = new Service();
		$salon = new Salon();
		$data = array();
		$data['idSalon'] = $idSalon;
		$data['salon_details'] = $salon->getsalonDetailsAsId($idSalon);
		$data['list_service'] = $service->getServiceUpdateForSalon(array($idSalon));
		$this->layout->content = View::make('admin.content_right.service.update', $data);
	}

	// update service salon
	public function postUpdateServiceSalon() {
		$service = new Service();
		$name = Input::get('name_sv');
		$price = Input::get('price_sv');
		if (isset($_POST['bt_delete'])) {
			if (isset($_POST['id_sv'])) {
				foreach (Input::get('id_sv') as $key => $idSv) {
					$service->removeService($idSv);
				}
				return Redirect::to("administrator/salon/home")->with('message', 'Success!!!');
			}
		} else {
			if (isset($_POST['id_sv'])) {
				foreach (Input::get('id_sv') as $key => $idSv) {
					$data_pd = array(
						'name_service' => $name[$key],
						'alias_service' => $this->getAlias($name[$key]),
						'price_service' => $price[$key],
					);
					$service->updateService($idSv, $data_pd);
				}
				return Redirect::to("administrator/salon/home")->with('message', 'Success!!!');
			}
		}
		return Redirect::to("administrator/salon/home");
	}
	// call update decorate
	public function getUpdate() {
		$id = 0;
		$id = Input::get('id');
		$salon = new Salon();
		$district = new District();
	}
	// update salon
	public function postUpdate() {
		// send data
		return Redirect::to("administrator/salon/home")->with('message', 'Success!!!');
	}
	// update salon decorare

	// insert salon
	public function postInsert() {
		$service = new Service();
		// get values form
		$data_pd = array(
			'name_service' => trim(Input::get('txt_name')),
			'alias_service' => $this->getAlias(Input::get('txt_name')),
			'price_service' => Input::get('txt_price'),
			'enable_service' => 1,
			'id_salon' => Input::get('sl_salon'),
		);
		// call model insert data
		$service->insert($data_pd);
		return Redirect::to("administrator/service/add")->with('message', 'Success!!!');
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

}