<?php

class RootController extends \BaseController {

	protected $layout = 'admin.main';
	public $_data = array();
	public function index()
	{
		$articlesCat = new ArticlesCat();
		$_data['list_articlesCat'] = $articlesCat-> getArticlesCatHome();
		$this->layout->content = View::make('admin.content_right.articles_cat.home',$_data);
	}
	// load form insert 
	public function add()
	{
		$images = new Media();
		$data['list_images'] = $images->get_data_media();
		$this->layout->content = View::make('admin.content_right.articles_cat.add',$data);
	}
	// insert articles new
	public function postInsert()
	{
		$name_articles_categories=""; $alias_articles_categories="";$ordering_articles_categories=0;
		$des_articles_categories="";$enable_articles_categories=1; $meta_title_articles_categories="";
		$meta_key_articles_categories=""; $meta_desc_articles_categories="";$hits_articles_categories=1;
		// get values form
		$tmp = "";$tmp = Input::get('txt_name');
		$data_pd= array(
			'name_articles_categories' => Input::get('txt_name'),
			'des_articles_categories' => Input::get('txt_des'),
			'hits_articles_categories' => Input::get('rd_hits'),
			'alias_articles_categories' =>	$this->getAlias($tmp),
			'enable_articles_categories' => Input::get('rd_status'),
			'meta_desc_articles_categories' =>  Input::get('txt_seodesc'),
			'meta_key_articles_categories' =>  Input::get('txt_key'),
			'meta_title_articles_categories' =>  Input::get('txt_title'),
			'ordering_articles_categories' => 	Input::get('txt_sort'),
			'created_at'=>date('Y-m-d')
		);
		// call model
		$articlesCat = new ArticlesCat();
		// insert
		$articlesCat->insert($data_pd);
		// send data
		$_data['check']= 1;
		$this->layout->content = View::make('admin.content_right.articles_cat.add',$_data);
	}
	// enable products
	public function enableArticlesCat($id,$status){
		$articlesCat = new ArticlesCat();
		$articlesCat->enable($id,$status);
		return Redirect::back();
	}
	// call update products
	public function callUpdate($id)
	{
		$articlesCat = new ArticlesCat();
		$_data['list_articlesCat'] = $articlesCat->getArticlesCatUpdate($id);
		$this->layout->content = View::make('admin.content_right.articles_cat.update',$_data);
	}
	// update products
	public function postUpdate()
	{
		$id = 0; $id = Input::get('txt_id');
		$name_articles_categories=""; $alias_articles_categories="";$ordering_articles_categories=0;
		$des_articles_categories="";$enable_articles_categories=1; $meta_title_articles_categories="";
		$meta_key_articles_categories=""; $meta_desc_articles_categories="";$hits_articles_categories=1;
		// get values form
		$tmp = "";$tmp = Input::get('txt_name');
		$data_pd= array(
			'name_articles_categories' => Input::get('txt_name'),
			'des_articles_categories' => Input::get('txt_des'),
			'hits_articles_categories' => Input::get('rd_hits'),
			'alias_articles_categories' =>	$this->getAlias($tmp),
			'enable_articles_categories' => Input::get('rd_status'),
			'meta_desc_articles_categories' =>  Input::get('txt_seodesc'),
			'meta_key_articles_categories' =>  Input::get('txt_key'),
			'meta_title_articles_categories' =>  Input::get('txt_title'),
			'ordering_articles_categories' => 	Input::get('txt_sort'),
			'created_at'=>date('Y-m-d')
		);
		// call model
		$articlesCat = new ArticlesCat();
		$articlesCat->updateArticlesCat($id,$data_pd);
		return Redirect::to("administrator/home-articlesCategories");
	}
	public function postRemove(){

		 if ( isset($_POST['delete']) )
		{
		 	$articlesCat = new ArticlesCat();
			foreach($_POST['delete'] as $id)
			{
				$articlesCat->removeArticlesCat($id);
				$articlesCat->SetNullArticles($id);
			}
		}
			return Redirect::back();
	}

}