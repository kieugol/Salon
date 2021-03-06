<?php
class AdminEventController extends \BaseController {
	//protected $layout = 'user.main';
	protected $layout = 'admin.main';
	public $data = array();
	// load all event
	public function getHome() {
		$event = new EventTicket();
		$data['list_event'] = $event->getHomeEventAd();
		$this->layout->content = View::make('admin.content_right.event.home', $data);
	}

	// load all event
	public function getHomeAutoRegister() {
		$event = new EventTicket();
		$data['list_event'] = $event->getEventAutoRegisterAd();
		$this->layout->content = View::make('admin.content_right.event.home_auto', $data);
	}

	// load all event
	public function getTicket() {
		$event = new EventTicket();
		$data['list_ticket'] = $event->getHomeEventTicketAd();
		$this->layout->content = View::make('admin.content_right.event.ticket', $data);
	}

	public function getAdd() {
		$images = new Media();
		$eventCat = new EventCat();
		$salon = new Salon();
		$service = new Service();
		$result = $service->getAllservice();
		$tmp = array();
		foreach ($result as $r) {
			if (isset($tmp[$r->id_salon])) {
				$value = $tmp[$r->id_salon];
				$tmp[$r->id_salon] = $value . '<label>' . $r->name_service . '(' . $r->price_service . ')'
				. '&nbsp;&nbsp;<input type="checkbox"  name="service[]" value="' . $r->id_service . '">'
					. '</label>&nbsp;&nbsp;';
			} else {
				$tmp[$r->id_salon] = '<label>  ' . $r->name_service . '(' . $r->price_service . ')'
				. '&nbsp;&nbsp;<input type="checkbox" name="service[]" value="' . $r->id_service . '">'
					. '</label>&nbsp;&nbsp;';
			}
		}

		$data['list_service'] = $tmp;
		$data['list_salon'] = $salon->getAllSalonProvince();
		$data['list_eventcat'] = $eventCat->getAllEventCat();
		$data['list_images'] = $images->get_data_media();
		$data['max_id'] = $images->getMinId();
		$this->layout->content = View::make('admin.content_right.event.add', $data);
	}
	// call update decorate
	public function getUpdate() {
		$id = Input::get('id');
		$event = new EventTicket();
		$images = new Media();
		$eventCat = new EventCat();
		$salon = new Salon();
		$images = new Media();
		$gallery = new MediaEvent();
		$service = new Service();
		$result = $service->getAllservice();
		$tmp = array();
		foreach ($result as $r) {
			if (isset($tmp[$r->id_salon])) {
				$value = $tmp[$r->id_salon];
				$tmp[$r->id_salon] = $value . '<label>' . $r->name_service . '(' . $r->price_service . ')'
				. '&nbsp;&nbsp;<input type="checkbox"  name="service[]" value="' . $r->id_service . '">'
					. '</label>&nbsp;&nbsp;';
			} else {
				$tmp[$r->id_salon] = '<label>  ' . $r->name_service . '(' . $r->price_service . ')'
				. '&nbsp;&nbsp;<input type="checkbox" name="service[]" value="' . $r->id_service . '">'
					. '</label>&nbsp;&nbsp;';
			}
		}

		$data['list_service_init'] = $tmp;

		$data['list_images'] = $gallery->get_images($id);
		$data['list_gallery'] = $gallery->getGallery($id);
		$data['max_id'] = $images->getMinId();
		$data['event_details'] = $event->getEventUpdate($id);
		$arrIdService = explode(',', $data['event_details']->id_service);
		$data['list_service'] = $service->getServiceForSalon($arrIdService);
		// dd($arrIdService);exit;
		//dd($data['list_service']);exit;
		$data['list_salon'] = $salon->getAllSalonProvince();
		$data['list_eventcat'] = $eventCat->getAllEventCat();
		$this->layout->content = View::make('admin.content_right.event.update', $data);
	}
	// update event
	public function postUpdate() {
		$arrSv = array();
		if (isset($_POST['service'])) {
			foreach ($_POST['service'] as $value) {
				$arrSv[] = $value;
			}
		}
		// load data form
		$idevent = 0;
		$idevent = Input::get('txt_id');
		$data_pd = array(
			'name_event' => trim(Input::get('txt_name')),
			'alias_event' => $this->getAlias(Input::get('txt_name')),
			'thumb_event' => Input::get('txt_thumb'),
			'enable_event' => 1,
			'ordering_event' => Input::get('txt_sort'),
			'short_desc_event' => trim(Input::get('txt_sort_des')),
			'des_event' => Input::get('txt_des'),
			'id_salon' => Input::get('sl_salon'),
			'id_event_categories' => Input::get('sl_categories'),
			'id_service' => implode(',', $arrSv),
			'percent_event' => Input::get('txt_percent'),
			'price_sale_event' => Input::get('txt_sale_price'),
		);
		//var_dump($data_pd);exit;
		// update event
		$event = new EventTicket();
		$event->updateEvent($idevent, $data_pd);
		// update gallery of salon
		$images = new MediaEvent();
		$images->deleteGallery($idevent);
		if (isset($_POST['imglist'])) {
			foreach ($_POST['imglist'] as $id) {
				$images->insertGallery($id, $idevent);
			}
		}
		// send data
		return Redirect::to("administrator/event/home")->with('message', 'Success!!!');
	}
	// update event decorare

	// insert event
	public function postInsert() {
		$arrSv = array();
		if (isset($_POST['service'])) {
			foreach ($_POST['service'] as $value) {
				$arrSv[] = $value;
			}
		}
		// get values form
		$data_pd = array(
			'name_event' => trim(Input::get('txt_name')),
			'alias_event' => $this->getAlias(Input::get('txt_name')),
			'thumb_event' => Input::get('txt_thumb'),
			'enable_event' => 1,
			'ordering_event' => Input::get('txt_sort'),
			'short_desc_event' => trim(Input::get('txt_sort_des')),
			'des_event' => Input::get('txt_des'),
			'id_salon' => Input::get('sl_salon'),
			'id_event_categories' => Input::get('sl_categories'),
			'id_service' => implode(',', $arrSv),
			'percent_event' => Input::get('txt_percent'),
			'price_sale_event' => Input::get('txt_sale_price'),
		);

		// call model insert data
		$event = new EventTicket();
		$event->insert($data_pd);
		// insert gallery
		$images = new MediaEvent();
		$idEvent = DB::getPdo()->lastInsertId();
		if (isset($_POST['imglist'])) {
			foreach ($_POST['imglist'] as $id) {
				$images->insertGallery($id, $idEvent);
			}
		}
		// send data
		return Redirect::to("administrator/event/add")->with('message', 'Success!!!');
	}
	// enable event
	public function getEnable() {
		$id = Input::get('id');
		$status = Input::get('stt');
		$event = new EventTicket();
		$event->enable($id, $status);
		return Redirect::back();
	}
	public function postRemove() {
		if (isset($_POST['bt_Update'])) {
			if (isset($_POST['delete'])) {
				$event = new EventTicket();
				// get total record  in array
				$ordering = $_POST['ordering'];
				$idhide = $_POST['idhide'];
				$total = count($idhide);
				// ordering menu footer
				foreach ($_POST['delete'] as $id) {
					for ($i = 0; $i < $total; $i++) {
						if ($idhide[$i] == $id) {
							$value = $ordering[$i];
							$event->orderEvent($id, $value);
						}
					}
				}
				return Redirect::back()->with('message', 'Success!!!');
			} // end if isset()
		}
		// checking delete
		else if (isset($_POST['bt_Delete'])) {
			$event = new EventTicket();
			if (isset($_POST['delete'])) {
				foreach ($_POST['delete'] as $id) {
					$event->removeEvent($id);
				}
				return Redirect::back()->with('message', 'Success!!!');
			}
		}
		return Redirect::back();
	}

	/* --------------------- Event display index ----------------------------*/
	public function getDisplayIndex() {
		$data = array();
		$eventIndex = new EventIndex();
		$data['list_event'] = $eventIndex->getEventDispIndexAd();
		$this->layout->content = View::make('admin.content_right.event.display_index', $data);
	}
	public function getAddIndex() {
		$data = array();
		$event = new EventTicket();
		$data['list_event'] = $event->getEventAddIndex();
		$this->layout->content = View::make('admin.content_right.event.add_index', $data);
	}

	public function postInsertIndex() {
		$eventIndex = new EventIndex();
		if (isset($_POST['id'])) {
			foreach (Input::get('id') as $id_event) {
				$eventIndex->insert(array('id_event' => $id_event, 'ordering_event_index' => 1));
			}
			return Redirect::back()->with('message', 'Success!!!');
		}
		return Redirect::back();
	}

	public function postActionIndex() {
		$eventIndex = new EventIndex();
		if (isset($_POST['delete'])) {
			if (isset($_POST['bt_Delete'])) {
				$arrDelete = [];
				foreach (Input::get('delete') as $id_event_index) {
					$arrDelete[] = $id_event_index;
				}
				$eventIndex->removeEventIndex($arrDelete);
			} else {
				$ordering = $_POST['ordering'];
				foreach (Input::get('delete') as $key => $id_event_index) {
					$eventIndex->orderEventIndex($id_event_index, $ordering[$key]);
				}
			}
			return Redirect::back()->with('message', 'Success!!!');
		}
		return Redirect::back();
	}

}