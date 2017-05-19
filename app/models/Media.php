<?php

class Media extends \Eloquent {
	public static $rules = array();
	protected $table = 'medias';
	protected $fillable = array('name_display','name_file','size_file','type_file');
	public function insert($data){
		$data_insert =array(
			'name_display' => $data['name_display'],
			'name_file' => $data['name_file'],
			'size_file' => $data['size_file'],
			'type_file' => $data['type_file']
			);
		DB::table('medias')->insert($data_insert);
	}
	public function data_media(){
		$value = $this
		->orderBy('id','DESC')
		->get();
		return $value;
	}
	// Insert iamges Gallery
	public function insertGallery($idMedia,$idProjects){
		DB::table('images')->insert(
			array('idProjects' => $idProjects,'idMedia' => $idMedia)
			);
	}
	// get all images Gallery
	public function getGallery(){
	$list_gallery = DB::table('images')->get();
	return $list_gallery;
	}
	// get all images Gallery
	public function getGalleryId($id){
		$list_gallery = DB::table('images')
		->where('idProjects','=',$id)
		->get();
		return $list_gallery;
	}
	// delete images Gallery with id
	public function deleteGallery($id){
		$list_gallery = DB::table('images')
		->where('idProjects','=',$id)
		->delete();
	}
	// delete images Gallery with id Media
	public function deleteGalleryIdMedia($id){
		$list_gallery = DB::table('images')
		->where('idMedia','=',$id)
		->delete();
	}
	public function get_data_media(){
		$value = $this
		->orderBy('id','DESC')
		->take(100)
		->get();
		return $value;
	}
	// display all gallery
	public function getAllDataMedia(){
		$value = $this
		->orderBy('id','DESC')
		->paginate(100);
		return $value;
	}
	public function loadMore($id){
		$value = $this
		->orderBy('id','DESC')
		->where('id','<',$id)
		->take(100)
		->get();
		return $value;
	}
	// max id
	public function getMinId(){
		$result = $this
		->orderBy('id','DESC')
		->take(100)
		->get();
		return $result;
	}
	// max id differcent id
	public function getMinId_have($id){
		return $this
		->orderBy('id','DESC')
		->where('id','<',$id)
		->take(100)
		->get();
	}
	public function get_data_media_id($id){
		$value = $this
		->where('id','=',$id)
		->first();
		return $value;
	}
	public function delete_media_id($id){
		$this
		->where('id','=',$id)
		->delete();
	}
	public function media_update($data){
		$this
		->where('id','=',$data['id'])
		->update(array(
			'name_display' => $data['name_display']
			));
		return 1;
	}
	/*-----------------------------------Display-index------------------------------------------------*/
	// Insert iamges Gallery index
	public function insertGalleryIndex($data){
		DB::table('gallery')->insert($data);
	}
	// get all images Gallery index
	public function getGalleryIndex(){
	$list_gallery = DB::table('gallery')->get();
	return $list_gallery;
	}
	// get all images Gallery index
	public function getGalleryIdIndex($id){
		$list_gallery = DB::table('images')
		->where('idGallery','=',$id)
		->get();
		return $list_gallery;
	}
	// delete images Gallery index with id
	public function deleteGalleryIndex(){
		$list_gallery = DB::table('gallery')
		->delete();
	}
	// delete images Gallery index with id Media
	public function deleteGalleryIdMediaIndex($id){
		$list_gallery = DB::table('gallery')
		->where('idMedia','=',$id)
		->delete();
	}
	/*-----------------------------------Stackholder-------------------------------------*/
	// get all images not cotainer images stack 
	public function getGalleryNotStack(){
		$data = $this->getArrayId();
		$list_gallery = $this
		->orderBy('id','desc')
		->whereNotIn('id',$data)
		->paginate(100);
		return $list_gallery;
	}
	// get array id media have in stack()
	public function getArrayId(){
		$list_stack =  DB::table('images_stackholder')->get();
		$data = array(); 
		foreach ($list_stack as $key => $value) {
			$data[$key]= $list_stack[$key]->idMedia;
		}
		if(count($data)>0)
			return $data;
		else
		{
			$data[0] = 0;
			return $data;
		}
	}
	// Insert images Gallery stackholder
	public function insertGalleryStackholder($data){
		DB::table('images_stackholder')->insert($data);
	}
	// delete images Gallery stackholder
	public function deleteGalleryStackholder(){
		$list_gallery = DB::table('images_stackholder')
		->delete();
	}
	// get all images stack holder
	public function getStackholder(){
		$list_stackholder = DB::table('images_stackholder')
		->join('medias','images_stackholder.idMedia','=','medias.id')
		->get();
		return $list_stackholder;
	}
	/* --------------------------------------User---------------------------------------*/
	// get all images Gallery index
	public function getGalleryHome(){
	$list_gallery = DB::table('gallery')
	->join('medias','idMedia','=','medias.id')
	->take(6)
	->get();
	return $list_gallery;
	}
}