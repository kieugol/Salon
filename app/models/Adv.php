<?php

class Adv extends \Eloquent {
	public static $rules = array();
	protected $table = 'adv_right';
	protected $fillable = array('idAdvRight','image_adv_right','position_adv_right','url_adv_right','text_adv_right','ordering_adv_right','enable_adv_right','created_at','updated_at');
		/*------------------ADMIN-------------------------- */
	// insert data
	public function insert($data_pd){
		$this::create($data_pd);
	}
	// get adv homes
	public function getHomeadv(){
		$listadv = $this
		->orderBy('position_adv_right', 'asc')
		->orderBy('ordering_adv_right', 'asc')
		->get();
		return $listadv; 
	}
	// get adv update
	public function getadvUpdate($id){
		$listadv = $this
		->where('idAdvRight','=',$id)
		->first();
		return $listadv; 
	}
	// upadate
	public function updateadv($id,$data_pd){
		 $this->where('idAdvRight','=',$id)
		 ->update($data_pd);
	}
	//enable adv
	public function enable($id,$status){
		if($status==0)
			$status=1;
			else
			$status=0;
		$this
		->where('idAdvRight','=',$id)
		->update(array(
				'enable_adv_right'=>$status
			));
	}
	//remove adv
	public function removeAdv($id){
		$this
		->where('idAdvRight','=',$id)
		->delete();
	}
	public function orderAdv($id,$value){
		$this
		->where('idAdvRight','=',$id)
		->update( array('ordering_adv_right'=>$value) );
		return true;
	}
	/*------------------USER-------------------------- */
	// get all adv 
	public function getAlladv(){
		$listadv = $this->orderBy('ordering_adv_right','asc')
		->orderBy('position_adv_right', 'asc')
		->orderBy('ordering_adv_right', 'asc')
		->where('enable_adv_right','=',1)
		->get();
		return $listadv; 
	}
	// get adv Cart
	public function getadvID($alias){
		$listadv = $this
		->where('alias_adv','=',$alias)
		->first();
		if(count($listadv)>0)
			return $listadv['idadv']; 
		else
			return 0;
	}
	// get adv details
	public function getAdvDetails($alias){
		$result = $this
		->where('alias_adv_right','=',$alias)
		->first();
		return $result;
	}
	
}