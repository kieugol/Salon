<?php
class EventController extends \BaseController {
	//protected $layout = 'user.main';
	protected $layout = 'user.main';
	public $data = array();
	// load all event
	public function getHome() {
		$event = new EventTicket();
		$data['list_event'] = $event->getHomeEventAd();
		$this->layout->content = View::make('admin.content_right.event.home', $data);
	}
	public function LoadEventCat($alias) {
		$list_event_cat = array();
		$event = new EventTicket();
		$data['list_event'] = $event->getEventDisplayFilterProvince($alias);
		foreach ($data['list_event'] as $r) {
			if (!array_key_exists($r->id_event_categories, $list_event_cat)) {
				$list_event_cat[$r->id_event_categories] = array($r->alias_event_categories, $r->name_event_categories);
			}
		}
		$data['list_event_cat'] = $list_event_cat;
		$this->layout->content = View::make('user.body.event_dir.event_cat', $data);
	}

	public function LoadEventDetails($alias1, $alias2, $id_event) {
		$event = new EventTicket();
		$Salon = new Salon();
		$data['event_details'] = $event->getEventDetails($alias2, $id_event);
		$tmp = $data['event_details'];
		$data['list_event_cat'] = $event->geteventCategories($tmp['alias_event_categories']);
		$data['list_event_same_cat'] = $event->getEventSameCategories($tmp['id_event_categories'], $tmp['id_event']);
		$data['salon_details'] = $Salon->getsalonDetails($tmp['alias_salon']);
		$data['list_gallery'] = $Salon->GetGallery($tmp['alias_salon']);
		$data['list_gallery_event'] = $event->GetGallery($tmp['id_event']);
		$this->layout->content = View::make('user.body.event_dir.event_details', $data);
	}

	public function LoadEventBookTicket($alias1, $alias2, $id_event) {
		$event = new EventTicket();
		$Salon = new Salon();
		$data['event_details'] = $event->getEventDetails($alias2, $id_event);
		return $this->layout->content = View::make('user.body.event_dir.event_ticket', $data);
	}

	public function postBookTicket() {

		$arr_service = array();
		$service = $_POST['sv_ticket'];
		foreach ($service as $r) {
			array_push($arr_service, $r);
		}

		$event_ticket = new EventTicket();
		$data = array(
			'id_event' => trim(Input::get('id_event')),
			'service_ticket' => implode(',', $arr_service),
			'name_customer' => trim(Input::get('name_ticket')),
			'address_customer' => trim(Input::get('addr_ticket')),
			'phone_customer' => trim(Input::get('phone_ticket')),
			'email_customer' => trim(Input::get('email_ticket')),
			'message_customer' => trim(Input::get('message_ticket')),
			'date_ticket' => '',
			'hour_ticket' => '',
		);
		$event_ticket->insert_ticket($data);
		return Redirect::to('/')->with('message', 'Success!!!');
	}

}