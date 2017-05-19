<?php
class HiringController extends \BaseController {
	protected $layout = 'user.main';
	public $data = array();
	
	
		/**
	 * /
	 * @param [type] $alias1 [province]
	 * @param [type] $alias2 [district]
	 */
	public function LoadHiringFilterDistrict($alias1, $alias2) {
		$Hiring = new Hiring();
		$articles = new Articles();
		$district = '';
		$result = $Hiring->getHiringFilterDistrict($alias1, $alias2);
		if (count($result) > 0) {
			foreach ($result as $r) {
					$district = $r->name_district;
					break;
			}
			$data['listArticles'] = $result;
			$data['list_news'] = $articles->getArticlesNew();
			$data['district'] = $district;
			// send data to view
			return $this->layout->content = View::make('user.body.hiring_dir.hiring_district', $data);
		} else {
			return View::make('user.body.404');
		}
	}
    /**
	 * Load All salon filter province
	 * @param [type] $alias [province]
	 */
	public function LoadHiringFilterProvince($alias) {
		$Hiring = new Hiring();
		$articles = new Articles();
		$province = array();
		$result = $Hiring->getHiringFilterProvince($alias);
		if (count($result) > 0) {
			foreach ($result as $r) {
					$province = $r->name_province;
					break;
			}
			$data['listArticles'] = $result;
			$data['list_news'] = $articles->getArticlesNew();
			$data['province'] = $province;
			// send data to view
			return $this->layout->content = View::make('user.body.hiring_dir.hiring_province', $data);
		} else {
			return View::make('user.body.404');
		}
	}
	// load details Articles
	public function loadHiringDetails($alias1,$alias2,$alias3, $alias4) {
		$Hiring = new Hiring();
		$data['articles_details'] = $Hiring->getHiringDetails($alias4);
		$data['list_news'] = $Hiring->getHiringOther($alias2, $alias4);
		$this->layout->content = View::make('user.body.hiring_dir.hiring_details', $data);
	}

}