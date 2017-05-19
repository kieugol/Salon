<?php

class Home extends \Eloquent {

	public function insertRegistry($data){
		DB::table('registry')->insert($data);
	}
	// get unit
	public function getUnit(){
		$list_unit = DB::table('unit')->get();
		return $list_unit;
	}
}