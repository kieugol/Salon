<?php
class AdminDownloadCatController extends \BaseController {
	//protected $layout = 'user.main';
	protected $layout = 'admin.main';
	public $data = array();
	// load all Downloadcat
	public function getHome()
	{
		$Downloadcat = new DownloadCat();
		$data['list_downloadcat'] = $Downloadcat->getHomeDownloadcat();
		$this->layout->content = View::make('admin.content_right.download_cat.home',$data);
	}
	public function getAdd()
	{
		// $images = new Media();
		// $data['list_images'] = $images->get_data_media();
		$this->layout->content = View::make('admin.content_right.download_cat.add');
	}
	// call update Downloadcat
	public function getUpdate()
	{
		$id=0;
		$id = Input::get('id');
		$Downloadcat = new Downloadcat();
		// $images = new Media();
		// $data['list_images'] = $images->get_data_media();
		$data['list_downloadcat'] = $Downloadcat->getDownloadcatUpdate($id);
		$this->layout->content = View::make('admin.content_right.download_cat.update',$data);
	}
	// update Downloadcat
	public function postUpdate()
	{
		$idDownloadcat=0;
		$idDownloadcat = Input::get('txt_id');
		$data_pd= array(
			'name_download_categories'=> Input::get('txt_title'),
			'alias_download_categories' => $this->getAlias(Input::get('txt_title')),
			'des_download_categories' => Input::get('txt_des'),
			'enable_download_categories' => Input::get('rd_status'),
			'ordering_download_categories' => Input::get('txt_sort')
		);
		// update Downloadcat
		$Downloadcat = new Downloadcat();
		$Downloadcat->updateDownloadcat($idDownloadcat,$data_pd);
		// update gallery of Downloadcat
		return Redirect::to("administrator/downloadCategories/home")->with('message','Success!!!');
	}
	 // insert Downloadcat
	public function postInsert()
	{
		$data_pd= array(
			'name_download_categories'=> Input::get('txt_title'),
			'alias_download_categories' => $this->getAlias(Input::get('txt_title')),
			'des_download_categories' => Input::get('txt_des'),
			'enable_download_categories' => Input::get('rd_status'),
			'ordering_download_categories' => Input::get('txt_sort')
		);
		// call model insert data
		$Downloadcat = new Downloadcat();
		$Downloadcat->insert($data_pd);
		// send data
		return Redirect::back()->with('message','Success!!!');
	}
	// enable Downloadcat
	public function getEnable(){
		$id = Input::get('id');
		$status = Input::get('stt');
		$Downloadcat = new Downloadcat();
		$Downloadcat->enable($id,$status);
		return Redirect::back();
	}
	public function postRemove(){
		if( isset($_POST['bt_Update']) )
		{
			if ( isset($_POST['delete']) )
				{
					$Downloadcat = new Downloadcat();
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
							  	$Downloadcat->orderDownloadcat($id,$value);
							}	
						}
					}
				return Redirect::back()->with('message','Success!!!');
				}// end if isset()
		}
		// checking delete 
		else if ( isset($_POST['bt_Delete']) )
		{
		 	$Downloadcat = new Downloadcat();
		 	if( isset($_POST['delete']) )
		 	{
				foreach($_POST['delete'] as $id)
				{
					$Downloadcat->removeDownloadcat($id);
				}
				return Redirect::back()->with('message','Success!!!');
			}
		}
		return Redirect::back();
	}
	
}