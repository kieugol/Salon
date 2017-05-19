<?php

class Contact extends \Eloquent {
	protected $table = 'contact';
	
	/* --------------------Admin---------------------------*/ 
	public function getContactHome(){
		$listContact = $this
		->orderBy('idContact','asc')
		->get();
		return $listContact; 
	}
	// insert data
	public function insert($data_pd){
		DB::table('contact')->insert($data_pd);
	}	
	//enable products
	public function enable($id,$status){
		if($status==0)
			$status=1;
			else
			$status=0;
		$this
		->where('idContact','=',$id)
		->update(array(
				'enable_contact'=>$status
			));
	}
	// get Contact update
	public function getContactUpdate($id){
		 $listContact = $this
		->where('idContact','=',$id)
		->first();
		return  $listContact; 
	}
	// upadate
	public function updateContact($id,$data_pd){
		$this->where('idContact','=',$id)
		 	 ->update($data_pd);
	}
	//remove 
	public function removeContact($id){
		$this
		->where('idContact','=',$id)
		->delete();
	}
	// sort order
	public function order($id,$value){
		$this
		->where('idContact','=',$id)
		->update( array('ordering_contact'=>$value) );
		return true;
	}
	/* --------------------User---------------------------*/
	public function getContactIndex(){
		$max= $this->max('idContact');
		 $listContact = $this
			->orderBy('idContact','desc')
			->where('enable_contact','=',1)
			->where('idContact','=',$max)
			->first();
		return  $listContact; 
	} 
	//get Contact home 
}