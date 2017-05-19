<?php

class Email extends \Eloquent {
	protected $table = 'email';
	// get email customer
	public function getEmail(){
		$list_email=DB::table('email')->get();
		return $list_email;
	}
	public function insertEmail($data){
		DB::table('email')->insert($data);
	}
	public function removeEmail($id){
		DB::table('email')
		->where('idEmail','=',$id)
		->delete();
	}
	public function checkEmail($name_email=''){
		$list_email=DB::table('email')
		->where('name_email','=',$name_email)
		->first();
		return $list_email;
	}
}