<?php
class AdminDownloadController extends \BaseController {
	//protected $layout = 'user.main';
	protected $layout = 'admin.main';
	public $data = array();
	// load all Download
	public function getHome()
	{
		$Download = new Download();
		$data['list_download'] = $Download->getHomeDownload();
		$this->layout->content = View::make('admin.content_right.download.home',$data);
	}
	public function getAdd()
	{
		$download_cat = new DownloadCat();
		$data['list_downloadcat'] = $download_cat->getHomeDownloadcat();
		$this->layout->content = View::make('admin.content_right.Download.add',$data);
	}
	// call update Download
	public function getUpdate()
	{
		$id=0;
		$id = Input::get('id');
		$Download = new Download();
		$download_cat = new DownloadCat();
		$data['list_downloadcat'] = $download_cat->getHomeDownloadcat();
		$data['list_download'] = $Download->getDownloadUpdate($id);
		$this->layout->content = View::make('admin.content_right.Download.update',$data);
	}
	// update Download
	public function postUpdate()
	{
		// load data form
		$idDownload = 0; $idDownload = Input::get('txt_id');
		$data_pd= array(
			'title_download'=> Input::get('txt_title'),
			'url_download' => Input::get('txt_url'),
			'categories_id' => Input::get('sl_cat'),
			'enable_download' => Input::get('rd_status'),
			'ordering_download' => Input::get('txt_sort')
		);
		// update Download
		$Download = new Download();
		$Download->updateDownload($idDownload,$data_pd);
		// update gallery of Download
		return Redirect::to("administrator/download/home")->with('message','Success!!!');
	}
	 // insert Download
	public function postInsert()
	{
		$data_pd= array(
			'title_download'=> Input::get('txt_title'),
			'url_download' => Input::get('txt_url'),
			'categories_id' => Input::get('sl_cat'),
			'enable_download' => Input::get('rd_status'),
			'ordering_download' => Input::get('txt_sort')
		);
		// call model insert data
		$Download = new Download();
		$Download->insert($data_pd);
		// send data
		return Redirect::back()->with('message','Success!!!');
	}
	// enable Download
	public function getEnable(){
		$id = Input::get('id');
		$status = Input::get('stt');
		$Download = new Download();
		$Download->enable($id,$status);
		return Redirect::back();
	}
	public function postRemove(){
		if( isset($_POST['bt_Update']) )
		{
			if ( isset($_POST['delete']) )
				{
					$Download = new Download();
					// get total record  in array
					$ordering = $_POST['ordering'];
					$idhide = $_POST['idhide'];
					$total = count($idhide);
					// ordering menu footer
					 foreach($_POST['delete'] as $id)
					 {
						for($i=0;$i<$total; $i++){
							if( $idhide[$i] == $id )
							{
								$value = $ordering[$i];
							  	$Download->orderDownload($id,$value);
							}	
						}
					}
				return Redirect::back()->with('message','Success!!!');
				}// end if isset()
		}
		// checking delete 
		else if ( isset($_POST['bt_Delete']) )
		{
		 	$Download = new Download();
		 	if( isset($_POST['delete']) )
		 	{
				foreach($_POST['delete'] as $id)
				{
					$Download->removeDownload($id);
				}
				return Redirect::back()->with('message','Success!!!');
			}
		}
		return Redirect::back();
	}
	
}