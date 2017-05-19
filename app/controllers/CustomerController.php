<?php
require_once 'ImageManipulator.php';
require_once 'resize-class.php';
require 'UploadHandler.php';
class CustomerController extends \BaseController {

	public $path_img = './store/upload/images/';
	protected $layout = 'user.main';

	public function getDangKySalon() {

		$district = new District();
		$data['list_district'] = $district->getDistrictForSalon();
		return $this->layout->content = View::make('user.body.customer_dir.register_salon', $data);
	}

	public function getUploadFile() {
	}

	public function postUploadFile() {
		error_reporting(E_ALL | E_STRICT);
		$upload_handler = new UploadHandler();
	}
	public function postInsertSalon() {
		$validator = $this->validate(Input::all());
		if ($validator->fails()) {
			$this->removeAlbum();
			return Redirect::back()->withErrors($validator);
		}
		$is_err_district = true;
		$district = new District();
		$list_district = $district->getDistrictForSalon();
		foreach ($list_district as $d) {
			if ($d->id_district == Input::get('sl_district')) {
				$is_err_district = false;
				break;
			}
		}
		if ($is_err_district || $this->_checkNameSalon() != '') {
			$this->removeAlbum();
			return Redirect::back();
		}

		$_path_img = 'store/upload/images/';
		$logo = $this->uploadSingleImg('thumb_logo');
		if ($logo != '') {
			$resizeObj = new resize($_path_img . $logo);
			$resizeObj->resizeImage(264, 190, 0);
			$resizeObj->saveImage($_path_img . $logo, 100);
		} else {
			$logo = 'diachilamtoc.png';
		}
		$banner = $this->uploadSingleImg('thumb_banner');
		if ($banner != '') {
			$resizeObj = new resize($_path_img . $banner);
			$resizeObj->resizeImage(1800, 350, 0);
			$resizeObj->saveImage($_path_img . $banner, 100);
		} else {
			$banner = 'banner.jpg';
		}
		// get values form
		$data = [
			'name_salon' => trim(Input::get('txt_name')),
			'alias_salon' => $this->getAlias(Input::get('txt_name')),
			'thumb_salon' => $logo,
			'maps_salon' => Input::get('txt_maps'),
			'contact_salon' => Input::get('txt_contact'),
			'price_salon' => Input::get('txt_price'),
			'id_district' => Input::get('sl_district'),
			'address_salon' => trim(Input::get('txt_address')),
			'banner_salon' => $banner,
			'phone_salon' => trim(Input::get('txt_phone')),
			'enable_salon' => 0,
			'auto_register_salon' => 1
		];
		// call model insert data 1020 X 500
		$salon = new Salon();
		$images = new MediaSalon();
		$rating = new Rating();
		$salon->insert($data);
		// insert gallery
		$idsalon = DB::getPdo()->lastInsertId();
		// insert rating
		$rating->insert(['product_id' => $idsalon]);

		if (isset($_POST['id_album'])) {
			foreach ($_POST['id_album'] as $key => $id) {
				$images->insertGallery($id, $idsalon);
			}
		}
		// send data
		return Redirect::to("/")->with('message', 'Chúc mừng bạn đã đăng ký salon thành công!');
	}

	protected function uploadSingleImg($aFile) {
		$output_dir = 'store/upload/images/';
		if (isset($_FILES[$aFile])
			&& preg_match('[png|jpg|jpeg|gif]', $_FILES[$aFile]['type'])) {
			if (!is_array($_FILES[$aFile]['name'])) {
				$dataFile = array(
					'name_display' => substr($_FILES[$aFile]["name"], 0, strpos($_FILES[$aFile]["name"], '.')),
					'name_file' => $_FILES[$aFile]["name"],
					'size_file' => $_FILES[$aFile]["size"],
					'type_file' => 'jpg/jpeg',
				);
				$fileName = $_FILES[$aFile]["name"];
				move_uploaded_file($_FILES[$aFile]["tmp_name"], $output_dir . $fileName);

				$media = new Media();
				$media->insert($dataFile);
			}
			return $_FILES[$aFile]["name"];
		}
		return '';
	}

	public function validate($input) {

		$rules = array(
			'txt_name' => 'Required|Min:3|Max:100',
			'sl_district' => 'Required|numeric',
			'txt_phone' => 'numeric|Required|digits_between:10,11',
			'txt_address' => 'Required|Min:10|Max:200',
			'txt_contact' => 'Required|Min:10|Max:200',
		);
		return Validator::make($input, $rules);
	}
	public function postCheckNameSalon() {
		$salon = new Salon();
		if ($salon->checkName(Input::get('txt_name')) != null) {
			return json_encode(['error' => true]);
		}
		return json_encode(['error' => false]);
	}

    protected function _checkNameSalon() {
		$salon = new Salon();
		return $salon->checkName(Input::get('txt_name'));
	}
	public function removeAlbum() {
		if (isset($_POST['id_album'])) {
			$media = new Media();
			foreach ($_POST['id_album'] as $id) {
				$media->delete_media_id($id);
			}
		}
	}

	// Handle event
	public function getDangKySuKien() {
		$eventCat = new EventCat();
		$data['list_eventcat'] = $eventCat->getAllEventCat();
		return $this->layout->content = View::make('user.body.customer_dir.register_event', $data);
	}

	public function postCheckUserSalon() {
		$err = ['error' => true];
		$userInfo = [
			'username' => Input::get('txt_user'),
			'password' => Input::get('txt_pass'),
		];

		if (Auth::attempt($userInfo)) {
			$user = new User();
			$result = $user->getInfoUser($userInfo['username']);
			if ($result['id_salon'] > 0) {
				$err['error'] = false;
			}
		}
		return json_encode($err);
	}

	public function postInsertSuKien() {
		$validator = $this->validateEvent(Input::all());
		if ($validator->fails()) {
			$this->removeAlbum();
			return Redirect::back()->withErrors($validator);
		}
		$is_err_event_cat = true;
		$eventCat = new EventCat();
		$list_eventcat = $eventCat->getAllEventCat();
		foreach ($list_eventcat as $cat) {
			if ($cat->id_event_categories == Input::get('sl_categories')) {
				$is_err_event_cat = false;
				break;
			}
		}

		if ($is_err_event_cat) {
			$this->removeAlbum();
			return Redirect::back();
		}
		// get id salon valid
		$id_salon = 0;
		if (Input::get('txt_user') != '' && Input::get('txt_pass') != '') {
			$userInfo = [
				'username' => Input::get('txt_user'),
				'password' => Input::get('txt_pass'),
			];
			if (Auth::attempt($userInfo)) {
				$user = new User();
				$result = $user->getInfoUser($userInfo['username']);
				if ($result['id_salon'] > 0) {
					$id_salon = $result['id_salon'];
				} else {
					return Redirect::back();
				}
			}
		}

		$_path_img = 'store/upload/images/';
		$logo = $this->uploadSingleImg('thumb_logo');
		if ($logo != '') {
			$resizeObj = new resize($_path_img . $logo);
			$resizeObj->resizeImage(560, 480, 0);
			$resizeObj->saveImage($_path_img . $logo, 100);
		} else {
			$logo = 'event.png';
		}
		// calculating percent price
		$price = Input::get('txt_price');
		$price_sale = Input::get('txt_price_sale');

		$percent_event = 100 - round(($price_sale * 100) / $price);
		$data = [
			'name_event' => trim(Input::get('txt_name')),
			'alias_event' => $this->getAlias(Input::get('txt_name')),
			'thumb_event' => $logo,
			'enable_event' => 0,
			'is_new_event' => 1,
			'ordering_event' => 1,
			'short_desc_event' => trim(Input::get('txt_sort_des')),
			'des_event' => Input::get('txt_des'),
			'id_salon' => $id_salon,
			'id_event_categories' => Input::get('sl_categories'),
			'id_service' => 0,
			'percent_event' => $percent_event,
			'price_sale_event' => $price_sale,
			'enable_salon' => 0,
		];
		// call model insert data
		$event = new EventTicket();
		$event->insert($data);
		// insert gallery
		$images = new MediaEvent();
		$idEvent = DB::getPdo()->lastInsertId();
		if (isset($_POST['id_album'])) {
			foreach ($_POST['id_album'] as $id) {
				$images->insertGallery($id, $idEvent);
			}
		}
		// send data
		return Redirect::to("/")->with('message', 'Chúc mừng bạn đã đăng ký sự kiện thành công!');
	}

	public function validateEvent($input) {
		$price = Input::get('txt_price');
		$rules = array(
			'txt_name' => 'Required|Min:3|Max:100',
			'txt_price' => 'Required|numeric|digits_between:6,10',
			'txt_price_sale' => 'numeric|Max:' . $price . '|digits_between:6,10',
			'txt_sort_des' => 'Required|Min:20|Max:600',
		);

		return Validator::make($input, $rules);
	}
	
	public function getDangKyTinTuyenDung() {
	    $district = new District();
		$data['list_district'] = $district->getDistrictForSalon();
		$this->layout->content = View::make('user.body.customer_dir.register_news', $data);
	}

	public function postInsertHiring() {

		$errMgs = '';
		$isErrorUpload = false;
		$title = Input::get('title');
		$content = Input::get('content');
		// get id salon valid
		$id_salon = 0;
		$id_district = 0;
		if (Input::get('txt_user') != '' && Input::get('txt_pass') != '') {
			$userInfo = [
				'username' => Input::get('txt_user'),
				'password' => Input::get('txt_pass'),
			];
			if (Auth::attempt($userInfo)) {
				$user = new User();
				$userData = $user->getInfoUser($userInfo['username']);
				if ($userData['id_salon'] > 0) {
					$id_salon = $userData['id_salon'];
					$id_district = $userData['id_district'];
				} else {
					return Redirect::back();
				}
			}
		}
		//validation
		$validator = $this->validateNews(Input::all());
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		}
		
		if (isset($_FILES['thumb'])) {
			if ($_FILES['thumb']['error'] > 0) {
				$isErrorUpload = true;
			} else {
				$tmpName = $_FILES['thumb']['tmp_name'];
				$filePath = './store/upload/images/' . $_FILES['thumb']['name'];
				$result = move_uploaded_file($tmpName, $filePath);
				$orig_image = imagecreatefromjpeg($filePath);
				$image_info = getimagesize($filePath);
				$width_orig = $image_info[0]; // current width as found in image file
				$height_orig = $image_info[1]; // current height as found in image file
				$width = 1024; // new image width
				$height = 768; // new image height
				$destination_image = imagecreatetruecolor($width, $height);
				imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
				imagejpeg($destination_image, $filePath, 100);
				$dataFile = array(
					'name_display' => substr($_FILES["thumb"]["name"], 0, strpos($_FILES["thumb"]["name"], '.')),
					'name_file' => $_FILES["thumb"]["name"],
					'size_file' => $_FILES["thumb"]["size"],
					'type_file' => '',
				);
				$media = new Media();
				$media->insert($dataFile);
			}
		} else { 
			$isErrorUpload = true;
		}

		$data = [
			'categories_id' => 0,
			'related_articles' => '',
			'alias_articles' => $this->getAlias(Input::get('title')),
			'title_articles' => Input::get('title'),
			'thumb_articles' => $isErrorUpload ? 'our-section2-img.jpg' : $_FILES['thumb']['name'],
			'introtext_articles' => Input::get('short_content'),
			'fulltext_articles' => Input::get('content'),
			'id_district' => $id_district,
			'id_salon' => $id_salon,
			'meta_title_articles' => Input::get('title'),
			'meta_key_articles' => Input::get('title'),
			'meta_desc_articles' => Input::get('title'),
			'enable_articles' => 0,
		];
		// call model
		$Hiring = new Hiring();
		// insert
		$Hiring->insert($data);
		return Redirect::to('/')->with('message', 'Tin của bạn được đăng ký thành công!<br/>Vui lòng đợi duyệt tin từ quản trị!');
	}
	public function validateNews($input) {
	    $district = new District();
		$tmp = $district->getDistrictForSalon();
		$arrDistrict = [];
		foreach($tmp as $value) {
			$arrDistrict[] = $value->id_district;
		}
		$rules = array(
			'title' => 'Required|Min:10|Max:200',
			'sl_salon' => 'in:'.implode(',', $arrDistrict),
			'content' => 'Required',
		);
		return Validator::make($input, $rules);
	}
}