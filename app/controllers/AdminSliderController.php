<?php
class AdminSliderController extends \BaseController {
	//protected $layout = 'user.main';
	protected $layout = 'admin.main';
	public $data = array();
	// load all Slider
	public function getHome() {
		$Slider = new Slider();
		$data['list_slider'] = $Slider->getHomeSlider();
		$this->layout->content = View::make('admin.content_right.slider.home', $data);
	}
	public function getAdd() {
		$images = new Media();
		$data['list_images'] = $images->get_data_media();
		$data['max_id'] = $images->getMinId();
		$this->layout->content = View::make('admin.content_right.slider.add', $data);
	}
	// call update Slider
	public function getUpdate() {
		$id = 0;
		$id = Input::get('id');
		$Slider = new Slider();
		$images = new Media();
		$data['list_images'] = $images->get_data_media();
		$data['max_id'] = $images->getMinId();
		$data['list_slider'] = $Slider->getSliderUpdate($id);
		$this->layout->content = View::make('admin.content_right.slider.update', $data);
	}
	// update Slider
	public function postUpdate() {
		// load data form
		$idSlider = 0;
		$idSlider = Input::get('txt_id');
		$text3 = Input::get('txt_text3');
		if ($text3 == null) {
			$text3 = '';
		}
		$data_pd = array(
			'image_slide_show' => Input::get('txt_thumb'),
			'url_slide_show' => Input::get('txt_url'),
			'text1_slide_show' => Input::get('txt_text1'),
			'enable_slide_show' => Input::get('rd_status'),
			'ordering_slide_show' => Input::get('txt_sort'),
		);
		// update Slider
		$Slider = new Slider();
		$Slider->updateSlider($idSlider, $data_pd);
		// update gallery of Slider
		return Redirect::to("administrator/slider/home")->with('message', 'Success!!!');
	}
	// insert Slider
	public function postInsert() {
		// get values form
		$text3 = Input::get('txt_text3');
		if ($text3 == null) {
			$text3 = '';
		}
		$data_pd = array(
			'image_slide_show' => Input::get('txt_thumb'),
			'url_slide_show' => Input::get('txt_url'),
			'text1_slide_show' => Input::get('txt_text1'),
			'enable_slide_show' => Input::get('rd_status'),
			'ordering_slide_show' => Input::get('txt_sort'),
		);
		// call model insert data
		$Slider = new Slider();
		$Slider->insert($data_pd);
		// send data
		return Redirect::back()->with('message', 'Success!!!');
	}
	// enable Slider
	public function getEnable() {
		$id = Input::get('id');
		$status = Input::get('stt');
		$Slider = new Slider();
		$Slider->enable($id, $status);
		return Redirect::back();
	}
	public function postRemove() {
		if (isset($_POST['bt_Update'])) {
			if (isset($_POST['delete'])) {
				$slider = new Slider();
				// get total record  in array
				$ordering = $_POST['ordering'];
				$idhide = $_POST['idhide'];
				$total = count($idhide);
				// ordering menu footer
				foreach ($_POST['delete'] as $id) {
					for ($i = 0; $i < $total; $i++) {
						if ($idhide[$i] == $id) {
							$value = $ordering[$i];
							$slider->orderSlider($id, $value);
						}
					}
				}
				return Redirect::back()->with('message', 'Success!!!');
			} // end if isset()
		}
		// checking delete
		else if (isset($_POST['bt_Delete'])) {
			$slider = new Slider();
			if (isset($_POST['delete'])) {
				foreach ($_POST['delete'] as $id) {
					$slider->removeSlider($id);
				}
				return Redirect::back()->with('message', 'Success!!!');
			}
		}
		return Redirect::back();
	}

}