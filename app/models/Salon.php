<?php
class Salon extends \Eloquent {
	public static $rules = array();
	protected $table = 'salon';
	protected $fillable = array(
		'id_district', 'name_salon', 'alias_salon', 'thumb_salon', 'enable_salon', 'address_salon', 'auto_register_salon',
		'ordering_salon', 'maps_salon', 'contact_salon', 'price_salon', 'banner_salon', 'phone_salon',
	);
	/*------------------ADMIN-------------------------- */
	// insert data
	public function insert($data_pd) {
		$this::create($data_pd);
	}
	// get salon homes
	public function getHomesalonAd() {
		$listsalon = $this
			->orderBy('ordering_salon', 'desc')
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'district.id_province', '=', 'province.id_province')
			->paginate(100);
		return $listsalon;
	}
	//get salon homes
	public function getHomesalonAutoRegisterAd() {
		$listsalon = $this
			->orderBy('ordering_salon', 'desc')
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'district.id_province', '=', 'province.id_province')
			->where('enable_salon', '=', 0)
			->where('auto_register_salon', '=', 1)
			->paginate(100);
		return $listsalon;
	}

	public function getSalonForAddService() {
		$listsalon = $this
			->orderBy('ordering_salon', 'desc')
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'district.id_province', '=', 'province.id_province')
			->get();
		return $listsalon;
	}
	// get max id
	public function getMaxId() {
		return $this->max('id_salon');
	}
	// get salon homes
	public function getHomesalonAd_categories($categories_id) {
		$listsalon = $this
			->orderBy('categories_id', 'asc')
			->orderBy('ordering_salon', 'asc')
			->join('salon_categories', 'categories_id', '=', 'salon_categories.id_salonCategories')
			->where('categories_id', '=', $categories_id)
			->paginate(100);
		return $listsalon;
	}
	// get salon update
	public function getsalonUpdate($id) {
		$listsalon = $this
			->where('id_salon', '=', $id)
			->first();
		return $listsalon;
	}
	public function getDecorateUpdate($id) {
		$listsalon = $this
			->where('id_salon', '=', $id)
			->first();
		return $listsalon;
	}
	// update
	public function updatesalon($id, $data_pd) {
		DB::table('salon')
			->where('id_salon', '=', $id)
			->update($data_pd);
	}
	public function updateDecorate($id, $data_pd) {
		$this
			->where('id_salon', '=', $id)
			->update($data_pd);
	}
	//enable salon
	public function enable($id, $status) {
		if ($status == 0) {
			$status = 1;
		} else {
			$status = 0;
		}

		$this
			->where('id_salon', '=', $id)
			->update(array('enable_salon' => $status));
	}
	//remove salon
	public function removesalon($id) {
		$this
			->where('id_salon', '=', $id)
			->delete();
	}
	public function ordersalon($id, $value) {
		$this
			->where('id_salon', '=', $id)
			->update(array('ordering_salon' => $value));
		return true;
	}
	// get id salonCategories
	public function getid_salonCat($id) {
		$listsalon = $this
			->join('salon_categories', 'categories_id', '=', 'salon_categories.id_salonCategories')
			->where('id_salon', '=', $id)
			->first();
		if (count($listsalon) > 0) {
			return $listsalon['id_salonCategories'];
		} else {
			return 0;
		}

	}

	public function getSalonAddIndex() {
		$listsalon = $this
			->orderBy('ordering_salon', 'asc')
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'district.id_province', '=', 'province.id_province')
			->whereRaw('kc_salon.id_salon not in (select id_salon from kc_salon_index)')
			->paginate(100);
		return $listsalon;
	}
	/*------------------USER-------------------------- */

	/**
	 * get Salon to display at home page
	 * @return [type] [description]
	 */
	public function getSalonDisplayHomePage() {
		$listsalon = $this
			->orderBy('ordering_salon_index', 'asc')
			->join('salon_index', 'salon_index.id_salon', '=', 'salon.id_salon')
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'district.id_province', '=', 'province.id_province')
			->where('enable_salon', '=', 1)
			->get();
		return $listsalon;
	}

	/**
	 * get Salon filter province
	 * @param  [type] $aProvineAlias [description]
	 * @return [type]                [description]
	 */
	public function getSalonFilterProvince($aProvineAlias) {
		$listsalon = $this
			->orderBy('ordering_district', 'asc')
			->orderBy('ordering_salon', 'asc')
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'district.id_province', '=', 'province.id_province')
			->where('province.alias_province', '=', $aProvineAlias)
			->where('enable_salon', '=', 1)
			->get();
		return $listsalon;
	}

	public function getSalonSameDistrict($aIdSalon, $aIdDistrict) {
		$listsalon = $this
			->orderBy('ordering_district', 'asc')
			->orderBy('ordering_salon', 'asc')
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'district.id_province', '=', 'province.id_province')
			->where('salon.id_salon', '!=', $aIdSalon)
			->where('district.id_district', '=', $aIdDistrict)
			->where('enable_salon', '=', 1)
			->get();
		return $listsalon;
	}

	public function getAllSalonProvince() {
		$listsalon = $this
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'district.id_province', '=', 'province.id_province')
			->where('enable_salon', '=', 1)
			->orderBy('province.ordering_province', 'asc')
			->orderBy('district.ordering_district', 'asc')
			->orderBy('ordering_salon', 'asc')
			->get();
		return $listsalon;
	}

	/**
	 * /
	 * @param  [type] $aProvineAlias  [description]
	 * @param  [type] $aDistrictAlias [description]
	 * @return [type]                 [description]
	 */
	public function getSalonFilterDistrict($aProvineAlias, $aDistrictAlias) {
		$listsalon = $this
			->orderBy('ordering_salon', 'asc')
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'district.id_province', '=', 'province.id_province')
			->where('province.alias_province', '=', $aProvineAlias)
			->where('district.alias_district', '=', $aDistrictAlias)
			->where('enable_salon', '=', 1)
			->get();
		return $listsalon;
	}

	public function checkName($name) {
		$listsalon = $this
			->where('name_salon', '=', $name)
			->first();
		return empty($listsalon->name_salon) ? '' : $listsalon->name_salon;
	}

	/**
	 * /
	 * @param  [type] $alias [description]
	 * @return [type]        [description]
	 */
	public function getsalonDetails($alias) {
		$listsalon = $this
			->where('salon.alias_salon', '=', $alias)
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'district.id_province', '=', 'province.id_province')
			->first();
		return $listsalon;
	}
	public function getsalonDetailsAsId($id) {
		$listsalon = $this
			->where('salon.id_salon', '=', $id)
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'district.id_province', '=', 'province.id_province')
			->first();
		return $listsalon;
	}

	// get all salon have id categories
	public function getsalonCategoriesID($ordering) {
		$listsalon = $this
			->where('salon_categories.ordering_salon_categories', '=', $ordering)
			->join('unit', 'unit_id', '=', 'unit.id_unit')
			->join('salon_categories', 'categories_id', '=', 'salon_categories.id_salonCategories')
			->where('enable_salon', '=', 1)
			->paginate(6);
		return $listsalon;
	}

	// get gallery salon
	public function GetGallery($alias) {
		$result = $this
			->where('alias_salon', '=', $alias)
			->join('images_salon', 'salon.id_salon', '=', 'images_salon.id_salon')
			->join('medias', 'idMedia', '=', 'medias.id')
			->select('medias.name_file')
			->get();
		return $result;
	}
	// get three gallery salon
	public function GetGalleryLimit($alias) {
		$result = $this
			->where('alias_salon', '=', $alias)
			->join('images_salon', 'salon.id_salon', '=', 'images_salon.id_salon')
			->join('medias', 'idMedia', '=', 'medias.id')
			->select('medias.name_file')
			->take(3)
			->get();
		return $result;
	}
	/* insert view */
	public function insertView($id) {
		DB::table('view_salon')->insert(array('ip' => $_SERVER['REMOTE_ADDR'], 'id_salon' => $id));
	}
	// get view
	public function getView($id) {
		$result = DB::table('view_salon')
			->where('id_salon', '=', $id)
			->distinct()
			->select('ip')
			->get();
		return count($result);
	}
	// get searching salon
	public function getSearch($keywords) {
		$listsalon = $this->orderBy('ordering_salon', 'asc')
			->orderBy('ordering_salon_categories', 'asc')
			->orderBy('ordering_salon', 'asc')
			->join('unit', 'unit_id', '=', 'unit.id_unit')
			->join('salon_categories', 'categories_id', '=', 'salon_categories.id_salonCategories')
			->where('enable_salon', '=', 1)
			->where('name_salon', 'LIKE', '%' . $keywords . '%')
			->orWhere('code_salon', 'LIKE', '%' . $keywords . '%')
			->orWhere('salon_categories.name_salon_categories', 'LIKE', '%' . $keywords . '%')
			->take(200)
			->get();
		return $listsalon;
	}

}