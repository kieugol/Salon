<?php
class AdvController extends \BaseController {
	//protected $layout = 'user.main';
	protected $layout = 'user.main';
	public $data = array();

	public function loadDetails($alias){

		$adv = new Adv();
		$data['adv_details'] = $adv->getAdvDetails($alias);
		return $this->layout->content = View::make('user.body.adv_dir.adv_details',$data);	
	}
}