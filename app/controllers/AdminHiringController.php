<?php

class AdminHiringController extends \BaseController {

	protected $layout = 'admin.main';
	public $_data = array();
	public function getHome() {
		$hiring = new Hiring();
		$articlesCat = new ArticlesCat();
		$_data['list_articles'] = $hiring->getArticlesHome();
		$this->layout->content = View::make('admin.content_right.hiring.home', $_data);
	}

	public function getHomeWaiting() {
		$hiring = new Hiring();
		$articlesCat = new ArticlesCat();
		$_data['list_articles'] = $hiring->getArticlesHomeWaiting();
		$this->layout->content = View::make('admin.content_right.hiring.home', $_data);
	}

	// load form insert
	public function getAdd() {
		$images = new Media();
		$articleCat = new ArticlesCat();
		$salon = new Salon();
		$data['max_id'] = $images->getMinId();
		$data['list_salon'] = $salon->getAllSalonProvince();
		$data['list_images'] = $images->get_data_media();
		$this->layout->content = View::make('admin.content_right.hiring.add', $data);
	}
	// insert articles new
	public function postInsert() {
		// get values form
		$salon_detail = $salon->getsalonDetailsAsId(Input::get('sl_salon'));
		$data = [
			'categories_id' => 0,
			'related_articles' => '',
			'id_salon' => $salon_detail['id_salon'],
			'id_district' => $salon_detail['id_district'],
			'alias_articles' => $this->getAlias(Input::get('txt_title')),
			'title_articles' => Input::get('txt_title'),
			'thumb_articles' => Input::get('txt_thumb'),
			'introtext_articles' => Input::get('txt_introtext'),
			'fulltext_articles' => Input::get('txt_des'),
			'meta_title_articles' => Input::get('txt_title'),
			'meta_key_articles' => Input::get('txt_title'),
			'meta_desc_articles' => Input::get('txt_title'),
			'enable_articles' => Input::get('rd_status'),
		];

		// call model
		$articles = new Hiring();
		// insert
		$articles->insert($data);
		// send data
		return Redirect::to("administrator/hiringad/add")->with('message', 'Success!!!');
	}
	// enable products
	public function getEnable() {
		$id = Input::get('id');
		$status = Input::get('status');
		$articles = new Hiring();
		$articles->enable($id, $status);
		return Redirect::back();
	}
	// call update products
	public function getUpdate() {
		$id = Input::get('ID');
		$articles = new Hiring();
		$images = new Media();
		$salon = new Salon();
		$_data['list_salon'] = $salon->getAllSalonProvince();
		$_data['list_images'] = $images->get_data_media();
		$_data['max_id'] = $images->getMinId();
		$_data['list_articles'] = $articles->getArticlesUpdate($id);
		$this->layout->content = View::make('admin.content_right.hiring.update', $_data);
	}
	// update products
	public function postUpdate() {
		$salon = new Salon();
		$salon_detail = $salon->getsalonDetailsAsId(Input::get('sl_salon'));
		$id = Input::get('txt_id');
		$data = [
			'categories_id' => 0,
			'related_articles' => '',
			'id_salon' => $salon_detail['id_salon'],
			'id_district' => $salon_detail['id_district'],
			'alias_articles' => $this->getAlias(Input::get('txt_title')),
			'title_articles' => Input::get('txt_title'),
			'thumb_articles' => Input::get('txt_thumb'),
			'introtext_articles' => Input::get('txt_introtext'),
			'fulltext_articles' => Input::get('txt_des'),
			'meta_title_articles' => Input::get('txt_title'),
			'meta_key_articles' => Input::get('txt_title'),
			'meta_desc_articles' => Input::get('txt_title'),
			'enable_articles' => Input::get('rd_status'),
		];
		// call model
		$articles = new Hiring();
		$articles->updateArticles($id, $data);
		return Redirect::to("administrator/hiringad/home")->with('message', 'Success!!!');
	}
	public function postRemove() {

		if (isset($_POST['bt_Update'])) {
			if (isset($_POST['delete'])) {
				$articles = new Hiring();
				// get total record  in array
				$ordering = $_POST['ordering'];
				$idhide = $_POST['idhide'];
				$total = count($idhide);
				echo $total;
				// ordering menu footer
				foreach ($_POST['delete'] as $id) {
					for ($i = 0; $i < $total; $i++) {
						if ($idhide[$i] == $id) {
							$value = $ordering[$i];
							$articles->orderArticles($id, $value);
						}
					}
				}
				return Redirect::back()->with('message', 'Success!!!');
			} // end if isset()
		} else if (isset($_POST['bt_Delete'])) {
			if (isset($_POST['delete'])) {
				$articles = new Hiring();
				foreach ($_POST['delete'] as $id) {
					$articles->removeArticles($id);
				}
				return Redirect::back()->with('message', 'Success!!!');
			}
		}
		return Redirect::back();
	}
}