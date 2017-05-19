<?php
class Slider extends \Eloquent {
	public static $rules = array();
	protected $table = 'slideshow';
	protected $fillable = array('idSlideshow', 'image_slide_show', 'url_slide_show', 'text1_slide_show',
		'text2_slide_show', 'text3_slide_show', 'ordering_slide_show', 'enable_slide_show', 'created_at', 'updated_at');
	/*------------------ADMIN-------------------------- */
	// insert data
	public function insert($data_pd) {
		$this::create($data_pd);
	}
	// get Slider homes
	public function getHomeSlider() {
		$listSlider = $this
			->orderBy('ordering_slide_show', 'asc')
			->get();
		return $listSlider;
	}
	// get Slider update
	public function getSliderUpdate($id) {
		$listSlider = $this
			->where('idSlideshow', '=', $id)
			->first();
		return $listSlider;
	}
	// upadate
	public function updateSlider($id, $data_pd) {
		$this
			->where('idSlideshow', '=', $id)
			->update($data_pd);
		return true;
	}
	//enable Slider
	public function enable($id, $status) {
		if ($status == 0) {
			$status = 1;
		} else {
			$status = 0;
		}

		$this
			->where('idSlideshow', '=', $id)
			->update(array('enable_slide_show' => $status));
		return true;
	}
	//remove Slider
	public function removeSlider($id) {
		$this
			->where('idSlideshow', '=', $id)
			->delete();
	}
	public function orderSlider($id, $value) {
		$this
			->where('idSlideshow', '=', $id)
			->update(array('ordering_slide_show' => $value));
		return true;
	}
	/*------------------USER-------------------------- */

	// get all Slider
	public function getAllSlider() {
		$result = $this
			->where('enable_slide_show', '=', 1)
			->groupBy('ordering_slide_show')
			->get();
		return $result;
	}
	// get all Slider hot

}