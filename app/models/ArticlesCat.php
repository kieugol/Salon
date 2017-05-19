<?php

class ArticlesCat extends \Eloquent {
	protected $table = 'articles_categories';
	
	/* --------------------Admin---------------------------*/ 
	public function getArticlesCatHome(){
		$listArticlesCat = $this
		->orderBy('ordering_articles_categories','asc')
		->get();
		return $listArticlesCat; 
	}
	// insert data
	public function insert($data_pd){
		DB::table('articles_categories')->insert($data_pd);
	}	
	//enable products
	public function enable($id,$status){
		if($status==0)
			$status=1;
			else
			$status=0;
		$this
		->where('idArticlesCategories','=',$id)
		->update(array(
				'enable_articles_categories'=>$status
			));
	}
	// get articles update
	public function getArticlesCatUpdate($id){
		$listArticlesCat = $this
		->where('idArticlesCategories','=',$id)
		->first();
		return $listArticlesCat; 
	}
	// upadate
	public function updateArticlesCat($id,$data_pd){
		$this->where('idArticlesCategories','=',$id)
		 	 ->update($data_pd);
	}
	public function SetNullArticles($id){
		DB::table('articles')
		->where('Categories_id',$id)
       ->update(array('Categories_id' => 0));
	}
	//remove 
	public function removeArticlesCat($id){
		$this
		->where('idArticlesCategories','=',$id)
		->delete();
	}
	// sort order
	public function orderCat($id,$value){
		$this
		->where('idArticlesCategories','=',$id)
		->update( array('ordering_articles_categories'=>$value) );
		return true;
	}
	// get list articles cat not in $data
	public function getArticlesCat_addMenu($data){
		$result = $this
				->whereNotIn('idArticlesCategories',$data)
				->get();
		return $result;
	}
	/* --------------------User---------------------------*/
	public function getArticlesCatHome1(){
		$listArticlesCat = $this
		->orderBy('idArticlesCategories','desc')
		->where('enable_articles_categories','=',1)
		->get();
		return $listArticlesCat; 
	} 
	//get Articles home 
	public function getArticlesHome(){
		$listArticles = $this
		->join('articles_categories', 'categories_id', '=', 'articles_categories.idArticlesCategories')
		->orderBy('idArticles', 'desc')
		->where('enable_articles_categories','=',1)
		->get();
		return $listArticles; 
	}
	// get articles Car
	public function getTitleArticlesCat($alias){
		$menu = $this
                    ->where('alias_articles_categories','=',$alias )
                    ->first(); 
		 return $menu; 
	}
	// min id articles categories
	public function getMinId(){
		$min = $this->min('ordering_articles_categories');
		return $min;
	}
}