<?php
class DownloadCat extends \Eloquent {
	public static $rules = array();
	protected $table = 'download_categories';
	protected $fillable = array('idDownloadCategories','name_download_categories','alias_download_categories','des_download_categories',
		'ordering_download_categories','enable_download_categories','created_at','updated_at');
	/*------------------ADMIN-------------------------- */
	// insert data
	public function insert($data_pd){
		$this::create($data_pd);
	}
	// get Downloadcat homes
	public function getHomeDownloadcat(){
		$listDownloadcat = $this
		->orderBy('ordering_download_categories', 'asc')
		->get();
		return $listDownloadcat; 
	}
	// get Downloadcat update
	public function getDownloadcatUpdate($id){
		$listDownloadcat = $this
		->where('idDownloadCategories','=',$id)
		->first();
		return $listDownloadcat; 
	}
	// upadate
	public function updateDownloadcat($id,$data_pd){
		  $this
		 ->where('idDownloadCategories','=',$id)
		 ->update($data_pd);
		 return true;
	}
	//enable Downloadcat
	public function enable($id,$status){
		if($status==0)
			$status=1;
			else
			$status=0;
		$this
		->where('idDownloadCategories','=',$id)
		->update(array('enable_download_categories'=>$status));
		return true;
	}
	//remove Downloadcat
	public function removeDownloadcat($id){
		$this
		->where('idDownloadCategories','=',$id)
		->delete();
	}
	public function orderDownloadcat($id,$value){
		$this
		->where('idDownloadCategories','=',$id)
		->update( array('ordering_download_categories'=>$value) );
		return true;
	}
	/*------------------USER-------------------------- */
	
	// get all Downloadcat 
	public function getAllDownloadcat(){
		$result = $this
		->where('enable_download_categories','=',1)
		->groupBy('ordering_download_categories')
		->get();
		return $result;
	}
	// get all Downloadcat hot 
	
}