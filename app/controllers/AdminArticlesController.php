<?php

class AdminArticlesController extends \BaseController {

	protected $layout = 'admin.main';
	public $_data = array();
	public function getHome() {
		$articles = new Articles();
		$articlesCat = new ArticlesCat();
		$_data['list_articles'] = $articles->getArticlesHome();
		$_data['list_articlesCat'] = $articlesCat->getArticlesCatHome();
		$this->layout->content = View::make('admin.content_right.articles.home', $_data);
	}
	// load form insert
	public function getAdd() {
		$images = new Media();
		$articleCat = new ArticlesCat();
		$data['max_id'] = $images->getMinId();
		$data['list_images'] = $images->get_data_media();
		$data['list_articlesCat'] = $articleCat->getArticlesCatHome();
		$this->layout->content = View::make('admin.content_right.articles.add', $data);
	}
	// insert articles new
	public function postInsert() {
		// get values form
		$data_pd = array(
			'categories_id' => Input::get('sl_categories'),
			'related_articles' => Input::get('txt_related_articles'),
			'alias_articles' => $this->getAlias(Input::get('txt_title')),
			'title_articles' => Input::get('txt_title'),
			'thumb_articles' => Input::get('txt_thumb'),
			'introtext_articles' => Input::get('txt_introtext'),
			'fulltext_articles' => Input::get('txt_des'),
			'hits_articles' => Input::get('rd_hits'),
			'meta_title_articles' => Input::get('txt_meta_title'),
			'meta_key_articles' => Input::get('txt_key'),
			'meta_desc_articles' => Input::get('txt_seodesc'),
			'enable_articles' => Input::get('rd_status'),
		);

		// call model
		$articles = new Articles();
		$images = new Media();
		$articleCat = new ArticlesCat();
		// insert
		$articles->insert($data_pd);
		// send data
		return Redirect::to("administrator/articles/add")->with('message', 'Success!!!');
	}
	// enable products
	public function getEnable() {
		$id = Input::get('id');
		$status = Input::get('status');
		$articles = new Articles();
		$articles->enable($id, $status);
		return Redirect::back();
	}
	// call update products
	public function getUpdate() {

		$id = Input::get('ID');
		$articles = new Articles();
		$images = new Media();
		$articleCat = new ArticlesCat();
		$_data['list_articlesCat'] = $articleCat->getArticlesCatHome();
		$_data['list_images'] = $images->get_data_media();
		$_data['max_id'] = $images->getMinId();
		$_data['list_articles'] = $articles->getArticlesUpdate($id);
		$this->layout->content = View::make('admin.content_right.articles.update', $_data);
	}
	// update products
	public function postUpdate() {
		$id = 0;
		$id = Input::get('txt_id');
		$data_pd = array(
			'categories_id' => Input::get('sl_categories'),
			'related_articles' => Input::get('txt_related_articles'),
			'alias_articles' => $this->getAlias(Input::get('txt_title')),
			'title_articles' => Input::get('txt_title'),
			'thumb_articles' => Input::get('txt_thumb'),
			'introtext_articles' => Input::get('txt_introtext'),
			'fulltext_articles' => Input::get('txt_des'),
			'hits_articles' => Input::get('rd_hits'),
			'meta_title_articles' => Input::get('txt_meta_title'),
			'meta_key_articles' => Input::get('txt_key'),
			'meta_desc_articles' => Input::get('txt_seodesc'),
			'enable_articles' => Input::get('rd_status'),
		);
		// call model
		$articles = new Articles();
		$articles->updateArticles($id, $data_pd);
		return Redirect::to("administrator/articles/home")->with('message', 'Success!!!');
	}
	public function postRemove() {

		if (isset($_POST['bt_Update'])) {
			if (isset($_POST['delete'])) {
				$articles = new Articles();
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
				$articles = new Articles();
				foreach ($_POST['delete'] as $id) {
					$articles->removeArticles($id);
				}
				return Redirect::back()->with('message', 'Success!!!');
			}
		}
		return Redirect::back();
	}
}