<?php
class EventIndex extends \Eloquent {
	public static $rules = array();
	protected $table = 'event_index';
	protected $fillable = array('id_event', 'id_event_index', 'ordering_event_index');
	/*------------------ADMIN-------------------------- */
	// insert data
	public function insert($data_pd) {
		$this::create($data_pd);
	}
	// get event homes
	public function getEventDispIndexAd() {
		$listevent = $this
			->orderBy('ordering_event_index', 'asc')
			->join('event', 'event.id_event', '=', 'event_index.id_event')
			->join('event_categories', 'event.id_event_categories', '=', 'event_categories.id_event_categories')
			->join('salon', 'salon.id_salon', '=', 'event.id_salon')
			->paginate(100);
		return $listevent;
	}

	//remove event
	public function removeEventIndex($id = array()) {
		$this->whereIn('id_event_index', $id)
			->delete();
	}
	public function orderEventIndex($id, $value) {
		$this
			->where('id_event_index', '=', $id)
			->update(array('ordering_event_index' => $value));
		return true;
	}
	/*------------------USER-------------------------- */

	/**
	 * get event to display at home page
	 * @return [type] [description]
	 */
	public function getEventDisplayHomePage() {
		$listevent = $this
			->orderBy('event_categories.ordering_event_categories', 'asc')
			->orderBy('event.ordering_event', 'asc')
			->join('event_categories', 'event.id_event_categories', '=', 'event_categories.id_event_categories')
			->join('salon', 'salon.id_salon', '=', 'event.id_salon')
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'district.id_province', '=', 'province.id_province')
			->where('event.enable_event', '=', 1)
			->get();
		return $listevent;
	}

	public function getEventDisplayFilterProvince($alias) {
		$listevent = $this
			->orderBy('event_categories.ordering_event_categories', 'asc')
			->orderBy('event.ordering_event', 'asc')
			->join('event_categories', 'event.id_event_categories', '=', 'event_categories.id_event_categories')
			->join('salon', 'salon.id_salon', '=', 'event.id_salon')
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'district.id_province', '=', 'province.id_province')
			->where('event.enable_event', '=', 1)
			->where('province.alias_province', '=', $alias)
			->get();
		return $listevent;
	}
}