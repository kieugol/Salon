<?php
class Hiring extends \Eloquent {

	protected $table = 'articles1';
	protected $fillable = array('categories_id', 'meta_title_articles',
		'meta_desc_articles', 'enable_articles', 'id_salon', 'id_district','id_province',
		'meta_key_articles', 'hits_articles', 'thumb_articles', 'ordering_articles',
		'introtext_articles', 'fulltext_articles', 'title_articles','salon_id',
		'related_articles', 'alias_articles', 'created_at', 'updated_at', 'id_menus');
	/* -------------------------Admin------------------------------*/
	// insert data
	public function insert($data_pd) {
		$this::create($data_pd);
	}
	//get Articles home
	public function getArticlesHome($id_salon = 0) {
		if (Session::get('id_salon') > 0) {
			$listArticles = $this
			    ->orderBy('articles1.id_salon', 'asc')
				->orderBy('ordering_articles', 'asc')
				->join('salon', 'salon.id_salon', '=', 'articles1.id_salon')
				->join('province', 'articles1.id_province', '=', 'province.id_province')
				->where('salon.id_salon', '=', Session::get('id_salon'))
				->where('enable_articles', '=', 1)
				->paginate(100);
		} else {
			$listArticles = $this
			    ->orderBy('articles1.id_salon', 'asc')
				->orderBy('ordering_articles', 'asc')
				->join('salon', 'salon.id_salon', '=', 'articles1.id_salon')
				->join('province', 'articles1.id_province', '=', 'province.id_province')
				->where('enable_articles', '=', 1)
				->paginate(100);
		}

		return $listArticles;
	}
	
	//get Articles home
	public function getArticlesHomeWaiting($id_salon = 0) {
		if (Session::get('id_salon') > 0) {
			$listArticles = $this
				->orderBy('ordering_articles', 'asc')
			->join('salon', 'salon.id_salon', '=', 'articles1.id_salon')
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'district.id_province', '=', 'province.id_province')
				->where('salon.id_salon', '=', Session::get('id_salon'))
				->where('enable_articles', '=', 0)
				->take(100)
				->get();
		} else {
			$listArticles = $this
				->orderBy('ordering_articles', 'asc')
			->join('salon', 'salon.id_salon', '=', 'articles1.id_salon')
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'district.id_province', '=', 'province.id_province')
				->where('enable_articles', '=', 0)
				->take(100)
				->get();
		}

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
			->join('salon', 'salon.id_salon', '=', 'articles1.id_salon')
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'district.id_province', '=', 'province.id_province')
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
	// get all articles with alias articles_categories
	public function getHiringIndex() {
		$listArticles = $this
			->orderBy('idArticles', 'desc')
			->join('salon', 'salon.id_salon', '=', 'articles1.id_salon')
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'district.id_province', '=', 'province.id_province')
			->where('enable_articles', '=', 1)
			->take(10)
			->get();
		return $listArticles;
	}
	// get articles details
	public function getHiringDetails($id) {
		$details = $this
			->where('idArticles', '=', $id)
			->join('salon', 'salon.id_salon', '=', 'articles1.id_salon')
			->join('district', 'salon.id_district', '=', 'district.id_district')
			->join('province', 'district.id_province', '=', 'province.id_province')
			->where('enable_articles', '=', 1)
			->first();
		return $details;
	}
	// get link articles categories have idArticlesCategories
	public function getLinkArticles($alias, $idArticlesCategories) {
		$listArticles = $this
			->orderBy('idArticles', 'desc')
			->join('articles_categories', 'categories_id', '=', 'articles_categories.idArticlesCategories')
			->join('menus', 'articles_categories.id_menus', '=', 'menus.idMenus')
			->where('alias_articles', '!=', $alias)
			->where('enable_articles', '=', 1)
			->where('categories_id', '=', $idArticlesCategories)
			->get();
		return $listArticles;
	}
	
	public function getHiringFilterProvince($aProvineAlias) {
		$listHiring = $this
			->orderBy('ordering_articles', 'asc')
			->orderBy('articles1.id_district', 'asc')
			->join('salon', 'salon.id_salon', '=', 'articles1.id_salon')
			->join('province', 'province.id_province', '=', 'articles1.id_province')
			->join('district', 'articles1.id_district', '=', 'district.id_district')
			->where('province.alias_province', '=', $aProvineAlias)
			->where('enable_articles', '=', 1)
			->paginate(10);
		return $listHiring;
	}

	public function getHiringFilterDistrict($aProvineAlias, $aDistrictAlias) {
		$listHiring = $this
			->orderBy('ordering_articles', 'asc')
			->join('salon', 'salon.id_salon', '=', 'articles1.id_salon')
			->join('district', 'articles1.id_district', '=', 'district.id_district')
			->join('province', 'articles1.id_province', '=', 'province.id_province')
			->where('province.alias_province', '=', $aProvineAlias)
			->where('district.alias_district', '=', $aDistrictAlias)
			->where('articles1.enable_articles', '=', 1)
			->paginate(10);
		return $listHiring;
	}

	public function getHiringOther($adistrict, $id) {
		$listHiring = $this
			->orderBy('ordering_articles', 'asc')
			->join('salon', 'salon.id_salon', '=', 'articles1.id_salon')
			->join('district', 'articles1.id_district', '=', 'district.id_district')
			->join('province', 'articles1.id_province', '=', 'province.id_province')
			->where('district.alias_district', '=', $adistrict)
			->where('idArticles', '!=', $id)
			->where('articles1.enable_articles', '=', 1)
			->take(10)
			->get();
		return $listHiring;
	}
	
	// get id articles
	public function getArticlesID($alias) {
		$result = $this
			->where('alias_articles', '=', $alias)
			->first();
		return $result['idArticles'];
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
