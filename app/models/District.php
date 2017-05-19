<?php

class District extends \Eloquent {
	public static $rules = array();
	protected $table = 'district';
	protected $fillable = array('name_district', 'alias_district', 'id_province', 'ordering_district');
	/* --------------------Admin---------------------------*/
	public function getdistrictHome() {
		$listdistrict = $this
			->orderBy('ordering_district', 'asc')
			->get();
		return $listdistrict;
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

		$this->where('id_district', '=', $id)
			->update(array('enable_district' => $status));
	}
	// get district update
	public function getdistrictUpdate($id) {
		$listdistrict = $this
			->where('id_district', '=', $id)
			->leftJoin('province', 'district.id_province', '=', 'province.id_province')
			->first();
		return $listdistrict;
	}
	// upadate
	public function updatedistrict($id, $data_pd) {
		$this->where('id_district', '=', $id)
			->update($data_pd);
		return true;
	}

	//remove
	public function removedistrict($id) {
		$this
			->where('id_district', '=', $id)
			->delete();
	}
	// sort order
	public function orderDistrict($id, $value) {
		$this
			->where('id_district', '=', $id)
			->update(array('ordering_district' => $value));
		return true;
	}
	// get district add salon
	public function getDistrictForSalon() {
		$listdistrict = $this
			->orderBy('ordering_province', 'desc')
			->orderBy('ordering_district', 'desc')
			->join('province', 'district.id_province', '=', 'province.id_province')
			->get(array('district.id_province', 'id_district', 'name_district', 'name_province'));
		return $listdistrict;
	}

	/* --------------------User---------------------------*/

	/**
	 * /
	 * @param  [type] $alias_province [description]
	 * @return [type]                 [description]
	 */
	public function getDistrictHavingSalon() {
		$listdistrict = $this
			->orderBy('ordering_district', 'asc')
			->join('province', 'district.id_province', '=', 'province.id_province')
			->join('salon', 'district.id_district', '=', 'salon.id_district')
			->groupBy('district.id_district')
			->get();
		return $listdistrict;
	}

    /**
	 * /
	 * @param  [type] $alias_province [description]
	 * @return [type]                 [description]
	 */
	public function getDistrictHavingHiring() {
		$listdistrict = $this
			->orderBy('ordering_district', 'asc')
			->join('province', 'district.id_province', '=', 'province.id_province')
			->join('articles1', 'district.id_district', '=', 'articles1.id_district')
			->where('enable_articles', '=', 1)
			->groupBy('district.id_district')
			->get();
		return $listdistrict;
	}
	
	public function getdistrictDetails($alias) {
		$listdistrict = $this
			->where('alias_district', '=', $alias)
			->leftJoin('province', 'district.id_province', '=', 'province.id_province')
			->first();
		return $listdistrict;
	}
}