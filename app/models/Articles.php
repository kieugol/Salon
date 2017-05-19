<?php
class Articles extends \Eloquent {

	protected $table = 'articles';
	protected $fillable = array('categories_id', 'meta_title_articles', 'meta_desc_articles', 'enable_articles',
		'meta_key_articles', 'hits_articles', 'thumb_articles', 'introtext_articles', 'fulltext_articles', 'title_articles',
		'related_articles', 'alias_articles', 'created_at', 'updated_at', 'id_menus');
	/* -------------------------Admin------------------------------*/
	// insert data
	public function insert($data_pd) {
		$this::create($data_pd);
	}
	//get Articles home
	public function getArticlesHome() {
		$listArticles = $this
			->orderBy('ordering_articles', 'asc')
			->join('articles_categories', 'categories_id', '=', 'articles_categories.idArticlesCategories')
			->take(6)
			->get();
		return $listArticles;
	}
	//enable products
	public function enable($id, $status) {
		if ($status == 0) {
			$status = 1;
		} else {
			$status = 0;
		}

		$this
			->where('idArticles', '=', $id)
			->update(array(
				'enable_articles' => $status,
			));
	}
	// get articles update
	public function getArticlesUpdate($id) {
		$listArticles = $this
			->where('idArticles', '=', $id)
			->first();
		return $listArticles;
	}
	// upadate
	public function updateArticles($id, $data_pd) {
		$this->where('idArticles', '=', $id)
			->update($data_pd);
	}
	//remove
	public function removeArticles($id) {
		$this
			->where('idArticles', '=', $id)
			->delete();
	}
	// ordering
	public function orderArticles($id, $value) {
		$this->where('idArticles', '=', $id)
			->update(array('ordering_articles' => $value));
		return true;
	}
	/*---------------------User-----------------------------*/
	// get articles details
	public function getArticlesDetails($id) {
		$details = $this
			->where('idArticles', '=', $id)
			->join('articles_categories', 'categories_id', '=', 'articles_categories.idArticlesCategories')
			->first();
		return $details;
	}

	// get articles Categories
	public function getArticlesSameCategories($alias_cat, $id_articles) {
		$listArticles = $this
			->orderBy('ordering_articles', 'asc')
			->join('articles_categories', 'categories_id', '=', 'articles_categories.idArticlesCategories')
			->where('articles_categories.alias_articles_categories', '=', $alias_cat)
			->where('idArticles', '!=', $id_articles)
			->take(20)
			->get();
		return $listArticles;
	}
	// get id articles
	public function getArticlesID($alias) {
		$result = $this
			->where('alias_articles', '=', $alias)
			->first();
		return $result['idArticles'];
	}
	// get 10 articles new index with ordering articles categories
	public function getArticlesNew() {
		$result = $this
			->orderBy('ordering_articles', 'asc')
			->join('articles_categories', 'categories_id', '=', 'articles_categories.idArticlesCategories')
			->where('enable_articles', '=', 1)
			->where('hits_articles', '=', 1)
			->paginate(10);
		return $result;
	}

	public function getArticlesCategoriesOther() {
		$result = $this
			->orderBy('ordering_articles', 'asc')
			->join('articles_categories', 'categories_id', '=', 'articles_categories.idArticlesCategories')
			->where('enable_articles', '=', 1)
			->where('hits_articles', '!=', 1)
			->take(10)
			->get();
		return $result;
	}
	/* insert view */
	public function insertView($data) {
		DB::table('view_articles')->insert($data);
	}
	// get view
	public function getView($id) {
		$result = DB::table('view_articles')
			->where('idArticles', '=', $id)
			->distinct()
			->select('ip')
			->get();
		return count($result);
	}
	// get searching products
	public function getSearch($keywords) {
		$listArticles = $this
			->orderBy('idArticles', 'desc')
			->join('articles_categories', 'categories_id', '=', 'articles_categories.idArticlesCategories')
			->join('menus', 'articles_categories.id_menus', '=', 'menus.idMenus')
			->where('enable_articles', '=', 1)
			->where('title_articles', 'LIKE', '%' . $keywords . '%')
			->orWhere('articles_categories.name_articles_categories', 'LIKE', '%' . $keywords . '%')
			->take(200)
			->get();
		return $listArticles;
	}
}
