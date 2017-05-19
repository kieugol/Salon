<?php

class MediaProducts extends \Eloquent {
	// Insert iamges Gallery
	public function insertGallery($idMedia,$idProducts){
		DB::table('images_products')->insert(
			array('idProducts' => $idProducts,'idMedia' => $idMedia)
			);
	}
	// delete images_products Gallery with id
	public function deleteGallery($id){
		$list_gallery = DB::table('images_products')
		->where('idProducts','=',$id)
		->delete();
	}
	// delete images_products Gallery with id Media
	public function deleteGalleryIdMedia($id){
		$list_gallery = DB::table('images_products')
		->where('idMedia','=',$id)
		->delete();
	}
	// get all images_products Gallery
	public function getGallery($idProducts){
		$list_gallery = DB::table('medias')
		->join('images_products','images_products.idMedia','=','medias.id')
		->where('idProducts','=',$idProducts)
		->get();
		return $list_gallery;
	}

	public function get_images($idProducts) {
		$arrID = $this->getArrayId($idProducts);
		$list_gallery = DB::table('medias')
		->orderBy('id','DESC')
		->whereNotIn('id',$arrID)
		->paginate(100);
		return $list_gallery;
		//
	}
	// get all images_products Gallery
	public function getArrayId($id){
		$list_gallery = DB::table('images_products')
		->where('idProducts','=',$id)
		->select('idMedia')
		->get();
		//
		$arrID = array();
		foreach ($list_gallery as $key => $value) {
			$arrID[$key] = $list_gallery[$key]->idMedia;
		}
		return $arrID;
	}
}