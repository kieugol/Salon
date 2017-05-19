<?php
class ArticlesController extends \BaseController {
	protected $layout = 'user.main';
	public $data = array();
	// load Articles Categories
	public function loadNewsCategories($alias) {
		//load model
		$Articles = new Articles();
		$ArticlesCat = new ArticlesCat();
		$data['details_cat'] = $ArticlesCat->getTitleArticlesCat($alias);
		$data['list_articles'] = $Articles->getArticlesCategories($alias);
		$this->layout->content = View::make('user.body.news_dir.news_hot_categories', $data);
	}
	// load News Home
	public function loadNewsHome() {
		$Articles = new Articles();
		$data['listArticles'] = $Articles->getArticlesNew();
		$data['listArticlesOther'] = $Articles->getArticlesCategoriesOther();
		$this->layout->content = View::make('user.body.news_dir.articles', $data);
	}
	// load details Articles
	public function loadArticlesDetails($alias_cat, $alias_artilces, $id_articles) {
		$Articles = new Articles();
		$data['articles_details'] = $Articles->getArticlesDetails($id_articles);
		$data['listArticles'] = $Articles->getArticlesSameCategories($alias_cat, $id_articles);
		$this->layout->content = View::make('user.body.news_dir.articles_details', $data);
	}
	public function loadArticlesCategories($alias1, $alias2) {
		$Articles = new Articles();
		$data['listArticles'] = $Articles->getArticlesCategories($alias2);
		$data['alias_menu'] = $alias1;
		$data['listLinkArticles'] = $Articles->getLinkArticlesCategories($alias1, $alias2);
		$this->layout->content = View::make('user.body.news_dir.articles_categories', $data);
	}
	// load articles details

}