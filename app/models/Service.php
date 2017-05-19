<?php
class Service extends \Eloquent {
	public static $rules = array();
	protected $table = 'service';
	protected $fillable = array(
		'id_salon', 'name_service', 'alias_service', 'price_service', 'enable_service');
	/*------------------ADMIN-------------------------- */
	// insert data
	public function insert($data_pd) {
		$this::create($data_pd);
	}
	// get salon homes
	public function getAllservice() {
		$listservice = $this
			->orderBy('id_salon')
			->get();
		return $listservice;
	}

	public function getServiceForSalon($id_service = array()) {
		$listservice = $this
			->orderBy('id_salon')
			->whereIn('id_service', $id_service)
			->get();
		return $listservice;
	}

	public function getServiceUpdateForSalon($id_salon = array()) {
		$listservice = $this
			->whereIn('id_salon', $id_salon)
			->get();
		return $listservice;
	}

	// get service update
	public function getserviceUpdate($id) {
		$listservice = $this
			->where('id_service', '=', $id)
			->first();
		return $listservice;
	}
	// update
	public function updateService($id, $data_pd) {
		DB::table('service')
			->where('id_service', '=', $id)
			->update($data_pd);
	}
	//enable service
	public function enable($id, $status) {
		if ($status == 0) {
			$status = 1;
		} else {
			$status = 0;
		}

		$this
			->where('id_service', '=', $id)
			->update(array(
				'enable_service' => $status,
			));
	}
	//remove service
	public function removeservice($id) {
		$this
			->where('id_service', '=', $id)
			->delete();
	}
	public function orderservice($id, $value) {
		$this
			->where('id_service', '=', $id)
			->update(array('ordering_service' => $value));
		return true;
	}
	/*------------------USER-------------------------- */

	/**
	 * get service to display at home page
	 * @return [type] [description]
	 */
	public function getserviceDisplayHomePage() {
		$listsalon = $this
			->orderBy('ordering_salon', 'desc')
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