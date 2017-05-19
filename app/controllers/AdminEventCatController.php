<?php
class AdminEventCatController extends \BaseController {
	protected $layout = 'admin.main';
	public $data = array();
	// load all products
	public function getHome() {
		$EventCat = new EventCat();
		$data['list_eventCat'] = $EventCat->getHomeEventCatAd();
		$this->layout->content = View::make('admin.content_right.event_cat.home', $data);
	}
	public function getAdd() {
		$this->layout->content = View::make('admin.content_right.event_cat.add');
	}
	// call update products
	public function getUpdate() {
		$id = Input::get('id');
		$EventCat = new EventCat();
		$data['list_eventCat'] = $details = $EventCat->getEventCatUpdate($id);

		$this->layout->content = View::make('admin.content_right.event_cat.update', $data);
	}
	// update products
	public function postUpdate() {
		$id = Input::get('txt_id');
		// get values form
		$data_pd = array(
			'name_event_categories' => Input::get('txt_name'),
			'des_event_categories' => Input::get('txt_des'),
			// 'thumb_event_categories' => Input::get('txt_thumb'),
			'alias_event_categories' => $this->getAlias(Input::get('txt_name')),
			'enable_event_categories' => 1,
			// 'meta_desc_event_categories' => Input::get('txt_seodesc'),
			// 'meta_key_event_categories' => Input::get('txt_key'),
			// 'meta_title_event_categories' => Input::get('txt_title'),
			'ordering_event_categories' => Input::get('txt_sort'),
		);
		// call model update
		$EventCat = new EventCat();
		$EventCat->updateEventCat($id, $data_pd);
		return Redirect::to('administrator/eventCat/home')->with('message', 'Success!!!');
	}
	// insert products
	public function postInsert() {
		// get values form
		$data_pd = array(
			'name_event_categories' => Input::get('txt_name'),
			'des_event_categories' => Input::get('txt_des'),
			// 'thumb_event_categories' => Input::get('txt_thumb'),
			'alias_event_categories' => $this->getAlias(Input::get('txt_name')),
			'enable_event_categories' => 1,
			// 'meta_desc_event_categories' => Input::get('txt_seodesc'),
			// 'meta_key_event_categories' => Input::get('txt_key'),
			// 'meta_title_event_categories' => Input::get('txt_title'),
			'ordering_event_categories' => Input::get('txt_sort'),
		);
		// call model insert data
		$EventCat = new EventCat();
		$EventCat->insert($data_pd);
		return Redirect::to('administrator/eventCat/add')->with('message', 'Success!!!');
	}
	// enable products
	public function getEnable() {
		$id = Input::get('id');
		$status = Input::get('status');
		$EventCat = new EventCat();
		$EventCat->enable($id, $status);
		return Redirect::back();
	}
	public function postRemove() {
		if (isset($_POST['bt_Update'])) {
			if (isset($_POST['delete'])) {
				$EventCat = new EventCat();
				// get total record  in array
				$ordering = $_POST['ordering'];
				$idhide = $_POST['idhide'];
				$total = count($idhide);
				echo $total;
				// ordering menu footer
				foreach ($_POST['delete'] as $id) {
					for ($i = 0; $i < $total; $i++) {
						if ($idhide[$i] == $id) {
							$value = $ordering[$i];
							$EventCat->orderCat($id, $value);
						}
					}
				}
				return Redirect::to('administrator/eventCat/home')->with('message', 'Success!!!');
			} // end if isset()
		} else if (isset($_POST['btn_Delete'])) {
			if (isset($_POST['delete'])) {
				$EventCat = new EventCat();
				foreach ($_POST['delete'] as $id) {
					$EventCat->removeEventCat($id);
				}
				return Redirect::to('administrator/eventCat/home')->with('message', 'Success!!!');
			}
		}
		return Redirect::back();
	}
}