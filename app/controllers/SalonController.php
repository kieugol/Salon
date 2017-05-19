<?php
class SalonController extends \BaseController {
	//protected $layout = 'user.main';
	protected $layout = 'user.main';
	public $data = array();
	/**
	 * load Salon details
	 *
	 * @param [type] $alias_1 [province]
	 * @param [type] $alias_2 [district]
	 * @param [type] $alias_3 [salon name]
	 */
	public function LoadSalonDetails($alias_1, $alias_2, $alias_3) {
		$Salon = new Salon();
		$event = new EventTicket();
                $rating = new Rating();
		$data['salon_details'] = $Salon->getsalonDetails($alias_3);
		if ($data['salon_details'] != null) {
			$data['list_gallery'] = $Salon->GetGallery($alias_3);
			$data['list_event'] = $event->getEventDisplayFilterSalon($data['salon_details']->id_salon);
			$data['list_salon_same_province'] = $Salon->getSalonSameDistrict($data['salon_details']->id_salon, $data['salon_details']->id_district);
                        $score = $rating->getRatingForSalon($data['salon_details']->id_salon);
                        $total_rating = $score['rate_1'] + $score['rate_2'] + $score['rate_3'] + $score['rate_4'] + $score['rate_5'];
                        $data['rating_details'] = $total_rating > 0 ? round((($score['rate_1'] * 1) + ($score['rate_2'] * 2) + ($score['rate_3'] * 3) + ($score['rate_4'] * 4) + ($score['rate_5'] * 5))/$total_rating, 0) : 0;
                        // send data to view
			return $this->layout->content = View::make('user.body.salon_dir.salon_details', $data);
		} else {
			return View::make('user.body.404');
		}
	}
	/**
	 * Load All salon filter province
	 * @param [type] $alias [province]
	 */
	public function LoadSalonFilterProvince($alias) {
		$Salon = new Salon();
		$arrDistrict = array();
		$result = $Salon->getSalonFilterProvince($alias);
		if (count($result) > 0) {
			foreach ($result as $r) {
				if (!array_key_exists($r->id_district, $arrDistrict)) {
					$arrDistrict[$r->id_district] = array($r->alias_district, $r->name_district);
					$data['name_province'] = $r->name_province;
				}
			}
			$data['list_salon'] = $result;
			$data['list_district'] = $arrDistrict;
			// send data to view
			return $this->layout->content = View::make('user.body.salon_dir.salon_province', $data);
		} else {
			return View::make('user.body.404');
		}
	}
	/**
	 * /
	 * @param [type] $alias1 [province]
	 * @param [type] $alias2 [district]
	 */
	public function LoadSalonFilterDistrict($alias1, $alias2) {
		$Salon = new Salon();
		$district = new District();
		$data['district'] = $district->getdistrictDetails($alias2);
		$data['list_salon'] = $Salon->getSalonFilterDistrict($alias1, $alias2);
		if (count($data['list_salon']) > 0) {
			return $this->layout->content = View::make('user.body.salon_dir.salon_district', $data);
		} else {
			return View::make('user.body.404');
		}
	}
        
    public function postAjaxRating(){
        $start = Input::get('rating');
        $id_salon = Input::get('salon_id');
        if(in_array($start, [1,2,3,4,5])){
            $rating = new Rating();
            $result = $rating->getRatingForSalon($id_salon);
            $rating->updateRating($id_salon, ['rate_'.$start => $result['rate_'.$start] + 1]);
            $score = $rating->getRatingForSalon($id_salon);
            $total_rating = $score['rate_1'] + $score['rate_2'] + $score['rate_3'] + $score['rate_4'] + $score['rate_5'];
            $score_sum = $total_rating > 0 ? round((($score['rate_1'] * 1) + ($score['rate_2'] * 2) + ($score['rate_3'] * 3) + ($score['rate_4'] * 4) + ($score['rate_5'] * 5))/$total_rating, 0) : 0;
            echo json_encode(['status' => 'success', 'rating' => $score_sum]);
          exit;
        } else {
          echo json_encode(['status' => 'failed']);
          exit;
        }
        
    } 
}