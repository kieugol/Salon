<?php

class Profile extends \Eloquent {
	public static $rules = array();
	protected $table = 'config';
	protected $fillable = array('name','value','created_at','updated_at');
	/* --------------------Admin---------------------------*/
	public function getProfile(){
		$list = $this
		->orderBy('idConfig','asc')
		->get();
		return $list;
	}
	// insert data
	public function insert($data_pd){
		$this::create($data_pd);
		return true;
	}	
	//enable products
	public function enable($id,$status){
		if($status==0)
			$status=1;
			else
			$status=0;
		$this
		->where('idprofile','=',$id)
		->update(array(
				'enable_profile'=>$status
			));
	}
	// get articles update
	public function getprofileUpdate($id){
		$listprofile = $this
		->where('idConfig','=',$id)
		->first();
		return $listprofile; 
	}
	// upadate
	public function updateProfile($id,$data_pd){
		$this->where('idConfig','=',$id)
		 	 ->update($data_pd);
		 	 return true;
	}
	//remove 
	public function removeprofile($id){
		$this
		->where('idConfig','=',$id)
		->delete();
		 return true;
	}
	public function getSeo(){
		return $this->get();
	}
	public function getAnalytics(){
		return $this
		->where('idConfig','=',6)
		->first();
	}
}