<?php
class Eventv extends \Eloquent {
	public static $rules = array();
	protected $table = 'event';
	protected $fillable = array(
		'id_event', 'name_event', 'alias_event', 'thumb_event', 'enable_event', 'ordering_event',
		'short_desc_event', 'date_start', 'date_end', 'des_event', 'meta_title_event',
		'meta_key_event', 'meta_desc_event', 'id_salon', 'id_event_categories',
	);
	/*------------------ADMIN-------------------------- */
	// insert data
	public function insert($data_pd) {
		$this::create($data_pd);
	}
	// get event homes
	public function getHomeEventAd() {
		$listevent = $this
			->orderBy('ordering_event', 'asc')
			->join('event_categories', 'event.id_event_categories', '=', 'event_categories.id_event_categories')
			->join('salon', 'salon.id_salon', '=', 'event.id_salon')
			->paginate(100);
		return $listevent;
	}
	// get max id
	public function getMaxId() {
		return $this->max('id_event');
	}
	// get event homes
	public function getHomeeventAd_categories($categories_id) {
		$listevent = $this
			->orderBy('categories_id', 'asc')
			->orderBy('ordering_event', 'asc')
			->join('event_categories', 'categories_id', '=', 'event_categories.id_eventCategories')
			->where('categories_id', '=', $categories_id)
			->paginate(100);
		return $listevent;
	}
	// get event update
	public function geteventUpdate($id) {
		$listevent = $this
			->where('id_event', '=', $id)
			->first();
		return $listevent;
	}
	public function getDecorateUpdate($id) {
		$listevent = $this
			->where('id_event', '=', $id)
			->first();
		return $listevent;
	}
	// update
	public function updateEvent($id, $data_pd) {
		$this->where('id_event', '=', $id)
			->update($data_pd);
	}
	public function updateDecorate($id, $data_pd) {
		$this
			->where('id_event', '=', $id)
			->update($data_pd);
	}
	//enable event
	public function enable($id, $status) {
		if ($status == 0) {
			$status = 1;
		} else {
			$status = 0;
		}

		$this
			->where('id_event', '=', $id)
			->update(array(
				'enable_event' => $status,
			));
	}
	//remove event
	public function removEevent($id) {
		$this
			->where('id_event', '=', $id)
			->delete();
	}
	public function orderEvent($id, $value) {
		$this
			->where('id_event', '=', $id)
			->update(array('ordering_event' => $value));
		return true;
	}
	// get id eventCategories
	public function getid_eventCat($id) {
		$listevent = $this
			->join('event_categories', 'categories_id', '=', 'event_categories.id_eventCategories')
			->where('id_event', '=', $id)
			->first();
		if (count($listevent) > 0) {
			return $listevent['id_eventCategories'];
		} else {
			return 0;
		}

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

	/**
	 * get event filter province
	 * @param  [type] $aProvineAlias [description]
	 * @return [type]                [description]
	 */
	public function geteventFilterProvince($aProvineAlias) {
		$listevent = $this
			->orderBy('ordering_event', 'asc')
			->orderBy('ordering_event', 'asc')
			->join('event', 'event.id_event', '=', 'event.id_event')
			->join('province', 'event.id_province', '=', 'province.id_province')
			->where('province.alias_province', '=', $aProvineAlias)
			->where('enable_event', '=', 1)
			->get();
		return $listevent;
	}

	/**
	 * /
	 * @param  [type] $aProvineAlias  [description]
	 * @param  [type] $aeventAlias [description]
	 * @return [type]                 [description]
	 */
	public function geteventCategories($alias) {
		$listevent = $this
			->orderBy('event_categories.ordering_event_categories', 'asc')
			->orderBy('event.ordering_event', 'asc')
			->join('event_categories', 'event.id_event_categories', '=', 'event_categories.id_event_categories')
			->join('salon', 'salon.id_salon', '=', 'event.id_salon')
			->where('event.enable_event', '=', 1)
			->where('event_categories.alias_event_categories', '=', $alias)
			->take(10)
			->get();
		return $listevent;
	}

	/**
	 * /
	 * @param  [type] $alias [description]
	 * @return [type]        [description]
	 */
	public function getEventDetails($alias) {
		$listevent = $this
			->orderBy('event_categories.ordering_event_categories', 'asc')
			->orderBy('event.ordering_event', 'asc')
			->join('event_categories', 'event.id_event_categories', '=', 'event_categories.id_event_categories')
			->join('salon', 'salon.id_salon', '=', 'event.id_salon')
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'province.id_province', '=', 'district.id_province')
			->where('event.enable_event', '=', 1)
			->where('event.alias_event', '=', $alias)
			->first();
		return $listevent;
	}
	// get all event have id categories
	public function geteventCategoriesID($ordering) {
		$listevent = $this
			->where('event_categories.ordering_event_categories', '=', $ordering)
			->join('unit', 'unit_id', '=', 'unit.id_unit')
			->join('event_categories', 'categories_id', '=', 'event_categories.id_eventCategories')
			->where('enable_event', '=', 1)
			->paginate(6);
		return $listevent;
	}

	// get gallery event
	public function GetGallery($alias) {
		$result = $this
			->where('alias_event', '=', $alias)
			->join('images_event', 'event.id_event', '=', 'images_event.id_event')
			->join('medias', 'idMedia', '=', 'medias.id')
			->select('medias.name_file')
			->get();
		return $result;
	}
	// get three gallery event
	public function GetGalleryLimit($alias) {
		$result = $this
			->where('alias_event', '=', $alias)
			->join('images_event', 'event.id_event', '=', 'images_event.id_event')
			->join('medias', 'idMedia', '=', 'medias.id')
			->select('medias.name_file')
			->take(3)
			->get();
		return $result;
	}
	/* insert view */
	public function insertView($id) {
		DB::table('view_event')->insert(array('ip' => $_SERVER['REMOTE_ADDR'], 'id_event' => $id));
	}
	// get view
	public function getView($id) {
		$result = DB::table('view_event')
			->where('id_event', '=', $id)
			->distinct()
			->select('ip')
			->get();
		return count($result);
	}
	// get searching event
	public function getSearch($keywords) {
		$listevent = $this->orderBy('ordering_event', 'asc')
			->orderBy('ordering_event_categories', 'asc')
			->orderBy('ordering_event', 'asc')
			->join('unit', 'unit_id', '=', 'unit.id_unit')
			->join('event_categories', 'categories_id', '=', 'event_categories.id_eventCategories')
			->where('enable_event', '=', 1)
			->where('name_event', 'LIKE', '%' . $keywords . '%')
			->orWhere('code_event', 'LIKE', '%' . $keywords . '%')
			->orWhere('event_categories.name_event_categories', 'LIKE', '%' . $keywords . '%')
			->take(200)
			->get();
		return $listevent;
	}

}