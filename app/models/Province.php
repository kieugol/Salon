<?php

class Province extends \Eloquent {
	public static $rules = array();
	protected $table = 'province';
	protected $fillable = array('name_province', 'alias_province', 'enable_province', 'ordering_province');
	/* --------------------Admin---------------------------*/
	public function getprovinceHome() {
		$listprovince = $this
			->orderBy('id_province', 'desc')
			->get();
		return $listprovince;
	}

	public function getAllprovince() {
		$listprovince = $this
			->orderBy('id_province', 'desc')
			->get();
		return $listprovince;
	}
	// insert data
	public function insert($data_pd) {
		$this::create($data_pd);
		return true;
	}
	//enable products
	public function enable($id, $status) {
		if ($status == 0) {
			$status = 1;
		} else {
			$status = 0;
		}

		$this
			->where('id_province', '=', $id)
			->update(array(
				'enable_province' => $status,
			));
	}
	// get articles update
	public function getprovinceUpdate($id) {
		$listprovince = $this
			->where('id_province', '=', $id)
			->first();
		return $listprovince;
	}
	// upadate
	public function updateprovince($id, $data_pd) {
		$this->where('id_province', '=', $id)
			->update($data_pd);
		return true;
	}

	//remove
	public function removeprovince($id) {
		$this
			->where('id_province', '=', $id)
			->delete();
	}
	// sort order
	public function orderCat($id, $value) {
		$this
			->where('id_provinceegories', '=', $id)
			->update(array('ordering_province' => $value));
		return true;
	}

	public function getProvinceHavingEvent() {
		$listevent = $this
			->orderBy('province.ordering_province', 'asc')
			->join('district', 'province.id_province', '=', 'district.id_province')
			->join('salon', 'salon.id_district', '=', 'district.id_district')
			->join('event', 'event.id_salon', '=', 'salon.id_salon')
			->groupBy('province.id_province')
			->get();
		return $listevent;
	}
}