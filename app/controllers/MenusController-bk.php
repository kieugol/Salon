<?php

class MenusController extends \BaseController {
	protected $layout = 'user.main';
	public $data = array();
	
	// Menus Navigations header
	public function loadMenusAlias($alias){
		$nav = new Menu();
		$default_menus = $nav->getMenusAlias($alias);
		if($default_menus=='default')
			return $this->loadDetailsMenu($alias);
		if($default_menus=='news')
			return $this->loadNews($alias);
		if($default_menus=='download')
		 	return $this->loadDownload($alias);
		return Redirect::to('/');
	}
	// load articles menus
	public function loadNews($alias){
		$Articles = new Articles();
		$menu = new Menu();
		$adv = new Adv();
		$data['menus'] = $menu->getTitleMenus($alias);
		$data['list_adv'] = $adv->getAlladv(); 
		$data['listArticles'] = $Articles->getArticles($alias);
		return $this->layout->content = View::make('user.body.news_dir.news',$data);
	}
	// load products menus
	public function loadProducts($alias){
		$menu = new Menu();
		$products = new Products();
		$pdCat = new ProductsCat();
		$ordering = $pdCat->getIdOrder();
		// send data
		$data['menus'] = $menu->getTitleMenus($alias);
		$data['alias'] = $alias;
		$data['list_productsCat']= $pdCat->getAllproductsCat();
		$data['list_products_hits']= $products->getAllProductsHits();
		$data['productsCat_hits']= $pdCat->getProductsCatFirst();

		$data['list_products']= $products->getProductsCategoriesID($ordering);
		return View::make('user.body.products_dir.all_products',$data);
	}
	
	// load Introduction
	public function loadIntroduction($alias){
		$project = new Projects();
		$products = new Products();
		$adv = new Adv();
		$menu = new Menu();
		$contact = new Contact();
		$data['articles_details'] = $menu->getArticles($alias);
		$data['list_products'] = $products->get6ProductsHits();
		$data['projects_hot'] = $project->GetProjectIndex(); 
		$data['list_adv']= $adv->getAlladv();
		$data['contact_details']= $contact->getContactIndex();
		$this->layout->content = View::make('user.body.news_dir.articles_menu',$data);
	}
	// load articles menu footer
	public function loadDetailsMenu($alias){
		$menu = new Menu();
		$adv = new Adv();
		$data['list_adv'] = $adv->getAlladv(); 
		$data['articles_details'] = $menu->getArticles($alias);
		$data['list_footer_other'] = $menu->getMenuFooterOther($alias);
		$this->layout->content = View::make('user.body.news_dir.articles_menu',$data);
	}
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