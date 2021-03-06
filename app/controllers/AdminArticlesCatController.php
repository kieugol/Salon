<?php

class AdminArticlesCatController extends \BaseController {

	protected $layout = 'admin.main';
	public $_data = array();
	public function getHome() {
		$articlesCat = new ArticlesCat();
		$_data['list_articlesCat'] = $articlesCat->getArticlesCatHome();
		$this->layout->content = View::make('admin.content_right.articles_cat.home', $_data);
	}
	// load form insert
	public function getAdd() {
		$images = new Media();
		$menu = new Menu();
		$data['list_images'] = $images->get_data_media();
		$data['list_menus'] = $menu->getTypeMenus('news');
		$this->layout->content = View::make('admin.content_right.articles_cat.add', $data);
	}
	// insert articles new
	public function postInsert() {
		$name_articles_categories = "";
		$alias_articles_categories = "";
		$ordering_articles_categories = 0;
		$des_articles_categories = "";
		$enable_articles_categories = 1;
		$meta_title_articles_categories = "";
		$meta_key_articles_categories = "";
		$meta_desc_articles_categories = "";
		$hits_articles_categories = 1;
		// get values form
		$tmp = "";
		$tmp = Input::get('txt_name');
		$data_pd = array(
			'name_articles_categories' => Input::get('txt_name'),
			'des_articles_categories' => Input::get('txt_des'),
			'hits_articles_categories' => Input::get('rd_hits'),
			'alias_articles_categories' => $this->getAlias($tmp),
			'enable_articles_categories' => Input::get('rd_status'),
			'meta_desc_articles_categories' => Input::get('txt_seodesc'),
			'meta_key_articles_categories' => Input::get('txt_key'),
			'meta_title_articles_categories' => Input::get('txt_title'),
			'ordering_articles_categories' => Input::get('txt_sort'),
			'created_at' => date('Y-m-d'),
			'id_menus' => Input::get('sl_menus'),
		);
		// call model
		$articlesCat = new ArticlesCat();
		// insert
		$articlesCat->insert($data_pd);
		// send data
		return Redirect::to("administrator/articlesCategories/add")->with('message', 'Success!!!');
	}
	// enable products
	public function getEnable() {
		$id = Input::get('id');
		$status = Input::get('status');
		$articlesCat = new ArticlesCat();
		$articlesCat->enable($id, $status);
		return Redirect::back();
	}
	// call update products
	public function getUpdate() {
		$id = Input::get('ID');
		$articlesCat = new ArticlesCat();
		$menu = new Menu();
		$data['list_articlesCat'] = $articlesCat->getArticlesCatUpdate($id);
		$data['list_menus'] = $menu->getTypeMenus('news');
		$this->layout->content = View::make('admin.content_right.articles_cat.update', $data);
	}
	// update products
	public function postUpdate() {
		$id = 0;
		$id = Input::get('txt_id');
		$name_articles_categories = "";
		$alias_articles_categories = "";
		$ordering_articles_categories = 0;
		$des_articles_categories = "";
		$enable_articles_categories = 1;
		$meta_title_articles_categories = "";
		$meta_key_articles_categories = "";
		$meta_desc_articles_categories = "";
		$hits_articles_categories = 1;
		// get values form
		$tmp = "";
		$tmp = Input::get('txt_name');
		$data_pd = array(
			'name_articles_categories' => Input::get('txt_name'),
			'des_articles_categories' => Input::get('txt_des'),
			'hits_articles_categories' => Input::get('rd_hits'),
			'alias_articles_categories' => $this->getAlias($tmp),
			'enable_articles_categories' => Input::get('rd_status'),
			'meta_desc_articles_categories' => Input::get('txt_seodesc'),
			'meta_key_articles_categories' => Input::get('txt_key'),
			'meta_title_articles_categories' => Input::get('txt_title'),
			'ordering_articles_categories' => Input::get('txt_sort'),
			'created_at' => date('Y-m-d'),
			'id_menus' => Input::get('sl_menus'),
		);
		$data_menu = array(
			'alias_menus' => $this->getAlias(Input::get('txt_name')),
			'title_menus' => Input::get('txt_name'),
		);
		// call model
		$articlesCat = new ArticlesCat();
		$menu = new Menu();
		// update articlesCategories
		$articlesCat->updateArticlesCat($id, $data_pd);
		// update menu have articles
		$menu->updateTitle($id, $data_menu);
		return Redirect::to("administrator/articlesCategories/home")->with('message', 'Success!!!');
	}
	public function postRemove() {

		if (isset($_POST['bt_Update'])) {
			if (isset($_POST['delete'])) {
				$articlesCat = new ArticlesCat();
				// get total record  in array
				$ordering = $_POST['ordering'];
				$idhide = $_POST['idhide'];
				$total = count($idhide);
				echo $total;
				// ordering menu footer
				foreach ($_POST['delete'] as $id) {
					// tin tuc moi cap nhat
					for ($i = 0; $i < $total; $i++) {
						if ($idhide[$i] == $id) {
							$value = $ordering[$i];
							$articlesCat->orderCat($id, $value);
						}
					}
				}
				return Redirect::back()->with('message', 'Success!!!');
			} // end if isset()
		} else if (isset($_POST['bt_Delete'])) {
			if (isset($_POST['delete'])) {
				$articlesCat = new ArticlesCat();
				$menu = new Menu();
				foreach ($_POST['delete'] as $id) {
					// tin tuc moi cap nhat
					$articlesCat->removeArticlesCat($id);
					$articlesCat->SetNullArticles($id);
					// delete articles have table menu
					$menu->deleteTitle($id);
				}
				return Redirect::back()->with('message', 'Success!!!');
			}
		}
		return Redirect::back();
	}
}