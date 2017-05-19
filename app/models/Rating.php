<?php
class Rating extends \Eloquent {
	protected $table = 'rating';
	protected $fillable = ['product_id', 'rate_1', 'rate_2', 'rate_3', 'rate_4', 'rate_5'];
	/*------------------ADMIN-------------------------- */
	// insert data
	public function insert($data_pd) {
		$this::create($data_pd);
	}
	// get salon homes
	public function getRatingForSalon($id_salon) {
		$listRating = $this
                        ->where('product_id', '=', $id_salon)
			->first();
		return $listRating;
	}
        // update
	public function updateRating($id, $data_pd) {
               DB::table('rating')
                    ->where('product_id', '=', $id)
                    ->update($data_pd);
               
	}
	public function insertRating() {
		$listRating = $this
			->orderBy('ordering_salon', 'desc')
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'district.id_province', '=', 'province.id_province')
			->get();
		return $listsalon;
	}
	

}