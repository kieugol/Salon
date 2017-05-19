<?php

class Gallery extends \Eloquent {
	protected $table = 'medias';
	protected $fillable = array('name_display','name_file','size_file','type_file');
	public $data = array();
	public function loadAllMedias(){
		$value = $this
		->orderBy('id','DESC')
		->get();
		return $value;
	} 
}