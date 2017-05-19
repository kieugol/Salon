<?php

class MediaEvent extends \Eloquent {
	// Insert iamges Gallery
	public function insertGallery($idMedia, $id_event) {
		DB::table('images_event')->insert(
			array('id_event' => $id_event, 'idMedia' => $idMedia)
		);
	}
	// delete images_event Gallery with id
	public function deleteGallery($id) {
		$list_gallery = DB::table('images_event')
			->where('id_event', '=', $id)
			->delete();
	}
	// delete images_event Gallery with id Media
	public function deleteGalleryIdMedia($id) {
		$list_gallery = DB::table('images_event')
			->where('idMedia', '=', $id)
			->delete();
	}
	// get all images_event Gallery
	public function getGallery($id_event) {
		$list_gallery = DB::table('medias')
			->join('images_event', 'images_event.idMedia', '=', 'medias.id')
			->where('id_event', '=', $id_event)
			->get();
		return $list_gallery;
	}

	public function get_images($id_event) {
		$arrID = $this->getArrayId($id_event);
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
	// get all images_event Gallery
	public function getArrayId($id) {
		$list_gallery = DB::table('images_event')
			->where('id_event', '=', $id)
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