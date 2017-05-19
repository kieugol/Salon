<?php
class MenusController extends \BaseController {
	protected $layout = 'user.main';
	public $data = array();
	// Menus Navigations header
	public function loadMenusAlias($alias){
		$nav = new Menu();
		$default_menus = $nav->getMenusAlias($alias);
		if ($default_menus == 'products') {
			return $this->loadAllProductsCat($alias);
		}
		if ($default_menus == 'default') {
			return $this->loadDetailsMenu($alias);
		}
		if ($default_menus == 'news') {
			return $this->loadNews($alias);
		}
		if ($default_menus == 'projects') {
			return $this->loadProjects($alias);
		}
		if ($default_menus == 'customer') {
			return $this->loadCustomer($alias);
		}
		if($default_menus == 'download') {
		 	return $this->loadDownload($alias);
		}
		return Redirect::to('/');
	}
		// load articles menu footer
	public function loadDetailsMenu($alias){
		$menu = new Menu();
		$data['menus'] = $menu->getTitleMenus($alias);
		$this->layout->content = View::make('user.body.news_dir.articles_menu',$data);
	}
	// load articles menus
	public function loadNews($alias=''){
		$Articles = new Articles();
		$menu = new Menu();
		$data['menus'] = $menu->getTitleMenus($alias);
		$data['list_articles'] = $Articles->getArticles();
		return $this->layout->content = View::make('user.body.news_dir.news',$data);
	}
	// load articles menus
	public function loadArticles($alias){
		$menu = new Menu();
		$data['articles_details'] = $menu->getArticles($alias);
		$data['alias'] = $alias;
		return $this->layout->content = View::make('user.body.news_dir.articles_menu',$data);
	}
	// loadProjects
	public function loadProjects($alias){
		$menu = new Menu();
		$projects = new Projects();
		$data['menus'] = $menu->getTitleMenus($alias);
		$data['list_projects'] = $projects->getAllProjects(18);
		return View::make('user.body.projects_dir.projects',$data);
	}
	// load all products cat menus
	// public function loadAllProductsCat($alias){
	// 	$menu = new Menu();
	// 	$products = new Products();
	// 	$pdCat = new ProductsCat();
	// 	$ordering = $pdCat->getIdOrder();
	// 	// send data
	// 	$data['menus'] = $menu->getTitleMenus($alias);
	// 	if (count ($data['menus'])>0) {
	// 		$data['list_cat_parent']= $pdCat->getAllProductsCatParent( $data['menus']->idMenus);
	// 		$data['list_cat_child']= $pdCat->getAllProductsCatChild( $data['menus']->idMenus);
	// 		$data['list_cat_paginate']= $pdCat->getAllCatPaginate( $data['menus']->idMenus);
	// 		$data['list_products_hits']= $products->getAllProductsHits( $data['menus']->idMenus);
	// 		// var_dump($data['list_products_hits']);exit;
	// 		return $this->layout->content =  View::make('user.body.products_dir.all_products_cat',$data);
	// 	} else {
	// 		return Response::view('user.body.404', array(), 404);
	// 	}

	// }
	// load Introduction
	// public function loadIntroduction($alias){
	// 	$project = new Projects();
	// 	$products = new Products();
	// 	$pdCat = new ProductsCat();
	// 	$adv = new Adv();
	// 	$menu = new Menu();
	// 	$contact = new Contact();
	// 	$data['alias'] = $alias;
	// 	$data['articles_details'] = $menu->articlesMenu($alias);
	// 	$data['list_products'] = $products->get6ProductsHits();
	// 	$data['projects_hot'] = $project->GetProjectIndex();
	// 	$data['contact_details']= $contact->getContactIndex();
	// 	$this->layout->content = View::make('user.body.news_dir.articles_menu',$data);
	// }
	// load customer
	public function loadCustomer($alias){
		$menu = new Menu();
		$images = new Media();
		$data['menus'] = $menu->getTitleMenus($alias);
		$data['list_customer'] = $images->getStackholder();
		return View::make('user.body.customer_dir.customer',$data);
	}
	// load customer
	// public function loadCertificate($alias){
	// 	$menu = new Menu();
	// 	$gallery_pj = new Projects();
 //    $data['list_gallery'] = $gallery_pj->GetGalleryProject();
	// 	$data['menus'] = $menu->getTitleMenus($alias);
	// 	return View::make('user.body.certificate_dir.certificate',$data);
	// }
	// public download software
	public function loadDownload($alias){
		$menu = new Menu();
		$adv = new Adv();
		$dl = new Download();
		$dl_cat = new DownloadCat();
		$data['list_adv']= $adv->getAlladv();
		$data['menus'] = $menu->getTitleMenus($alias);
		$data['list_dlcat'] = $dl_cat->getAllDownloadcat();
		$data['list_dl'] = $dl->getAllDownload();
		$this->layout->content = View::make('user.body.news_dir.download',$data);
	}
}