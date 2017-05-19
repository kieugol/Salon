<?php
class Download extends \Eloquent {
	public static $rules = array();
	protected $table = 'download';
	protected $fillable = array('idDownload','title_download',
		'ordering_download','categories_id','enable_download','created_at','updated_at');
	/*------------------ADMIN-------------------------- */
	// insert data
	public function insert($data_pd){
		$this::create($data_pd);
	}
	// get Download homes
	public function getHomeDownload(){
		$listDownload = $this
		->orderBy('ordering_download', 'asc')
		->get();
		return $listDownload; 
	}
	// get Download update
	public function getDownloadUpdate($id){
		$listDownload = $this
		->where('idDownload','=',$id)
		->first();
		return $listDownload; 
	}
	// upadate
	public function updateDownload($id,$data_pd){
		  $this
		 ->where('idDownload','=',$id)
		 ->update($data_pd);
		 return true;
	}
	//enable Download
	public function enable($id,$status){
		if($status==0)
			$status=1;
			else
			$status=0;
		$this
		->where('idDownload','=',$id)
		->update(array('enable_download'=>$status));
		return true;
	}
	//remove Download
	public function removeDownload($id){
		$this
		->where('idDownload','=',$id)
		->delete();
	}
	public function orderDownload($id,$value){
		$this
		->where('idDownload','=',$id)
		->update( array('ordering_download'=>$value) );
		return true;
	}
	/*------------------USER-------------------------- */
	
	// get all Download 
	public function getAllDownload(){
		$result = $this
		->orderBy('ordering_download','asc')
		->where('enable_download','=',1)
		->get();
		return $result;
	}
}
	// get all Download hot 
	