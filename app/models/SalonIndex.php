<?php
class SalonIndex extends \Eloquent {
	public static $rules = array();
	protected $table = 'salon_index';
	protected $fillable = array('id_salon_index', 'id_salon', 'ordering_salon_index');
	/*------------------ADMIN-------------------------- */
	// insert data
	public function insert($data_pd) {
		$this::create($data_pd);
	}
	// get salon homes
	public function getSalonDispIndexAd() {
		$listsalon = $this
			->orderBy('ordering_salon_index', 'asc')
			->join('salon', 'salon.id_salon', '=', $this->table . '.id_salon')
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'district.id_province', '=', 'province.id_province')
			->paginate(100);
		return $listsalon;
	}

	//remove salon
	public function removeSalonIndex($id = array()) {
		$this
			->whereIn('id_salon_index', $id)
			->delete();
	}
	public function orderSalonIndex($id, $value) {
		$this
			->where('id_salon_index', '=', $id)
			->update(array('ordering_salon_index' => $value));
		return true;
	}

}