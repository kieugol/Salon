<?php

class Sale extends \Eloquent {
	public static $rules = array();
	protected $table = 'sale';
	protected $fillable = array('start_sale','end_sale','des_sale','created_at','updated_at');
	/* --------------------Admin---------------------------*/ 
	public function getSale(){
		$list = $this
		->orderBy('id_sale','desc')
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
		->where('id_sale','=',$id)
		->update(array(
				'enable_sale'=>$status
			));
	}
	// get articles update
	public function getSaleUpdate($id){
		$listsale = $this
		->where('id_sale','=',$id)
		->first();
		return $listsale; 
	}
	// upadate
	public function updateSale($id,$data_pd){
		$this->where('id_sale','=',$id)
		 	 ->update($data_pd);
		 	 return true;
	}
	//remove 
	public function removeSale($id){
		$this
		->where('id_sale','=',$id)
		->delete();
		 return true;
	}

	/* user*/
	public function getSaleHome(){
		$data = $this
		->orderBy('id_sale','desc')
		->where('enable_sale','=',1)
		->first();
		return $data;
	}
}