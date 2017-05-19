<?php

class MediaSalon extends \Eloquent {
	// Insert iamges Gallery
	public function insertGallery($idMedia, $id_salon) {
		DB::table('images_salon')->insert(
			array('id_salon' => $id_salon, 'idMedia' => $idMedia)
		);
	}
	// delete images_salon Gallery with id
	public function deleteGallery($id) {
		$list_gallery = DB::table('images_salon')
			->where('id_salon', '=', $id)
			->delete();
	}
	// delete images_salon Gallery with id Media
	public function deleteGalleryIdMedia($id) {
		$list_gallery = DB::table('images_salon')
			->where('idMedia', '=', $id)
			->delete();
	}
	// get all images_salon Gallery
	public function getGallery($id_salon) {
		$list_gallery = DB::table('medias')
			->join('images_salon', 'images_salon.idMedia', '=', 'medias.id')
			->where('id_salon', '=', $id_salon)
			->get();
		return $list_gallery;
	}

	public function get_images($id_salon) {
		$arrID = $this->getArrayId($id_salon);
		if (empty($arrID)) {
			$arrID = array(0);
		}
		$list_gallery = DB::table('medias')
			->orderBy('id', 'DESC')
			->whereNotIn('id', $arrID)
			->paginate(100);
		return $list_gallery;
		//
	}
	// get all images_salon Gallery
	public function getArrayId($id) {
		$list_gallery = DB::table('images_salon')
			->where('id_salon', '=', $id)
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