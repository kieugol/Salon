<?php
class AdminAdvController extends \BaseController {
	//protected $layout = 'user.main';
	protected $layout = 'admin.main';
	public $data = array();
	// load all Adv
	public function getHome()
	{
		$Adv = new Adv();
		$data['list_adv'] = $Adv->getHomeAdv();
		$this->layout->content = View::make('admin.content_right.adv.home',$data);
	}
	public function getAdd()
	{
		$images = new Media();
		$data['list_images'] = $images->get_data_media();
		$this->layout->content = View::make('admin.content_right.Adv.add',$data);
	}
	// call update Adv
	public function getUpdate()
	{
		$id=0;
		$id = Input::get('id');
		$Adv = new Adv();
		$images = new Media();
		// get data
		$data['list_images'] = $images->get_data_media();
		$data['list_adv'] = $Adv->getAdvUpdate($id);
		$this->layout->content = View::make('admin.content_right.adv.update',$data);
	}
	// update Adv
	public function postUpdate()
	{
		$idAdv = Input::get('txt_id');
		$data_pd= array(
			'alias_adv_right'=>$this->getAlias(Input::get('txt_title')),
			'title_adv_right'=>Input::get('txt_title'),
			'image_adv_right'=> Input::get('txt_thumb'),
			'url_adv_right' => Input::get('txt_url'),
			'position_adv_right' => Input::get('sl_block'),
			'onpage_adv_right' => Input::get('sl_onpage'),
			'text_adv_right' => Input::get('txt_des'),
			'ordering_adv_right' => Input::get('txt_sort'),
			'enable_adv_right' => Input::get('rd_status'),
		);
		// update Adv
		$Adv = new Adv();
		// upadate data
		$Adv->updateAdv($idAdv,$data_pd);
		// send data
		return Redirect::to("administrator/adv/home")->with('message','Success!!!');
	}
	 // insert Adv
	public function postInsert()
	{
		// get values form
		$data_pd= array(
			'alias_adv_right'=>$this->getAlias(Input::get('txt_title')),
			'title_adv_right'=>Input::get('txt_title'),
			'image_adv_right'=> Input::get('txt_thumb'),
			'url_adv_right' => Input::get('txt_url'),
			'position_adv_right' => Input::get('sl_block'),
			'position_adv_right' => Input::get('sl_block'),
			'text_adv_right' => Input::get('txt_des'),
			'ordering_adv_right' => Input::get('txt_sort'),
			'enable_adv_right' => Input::get('rd_status'),
		);
		// call model insert data
		$Adv = new Adv();
		$Adv->insert($data_pd);
		// send data
		return Redirect::back()->with('message','Success!!!');
	}
	// enable Adv
	public function getEnable(){
		$id = Input::get('id');
		$status = Input::get('stt');
		$Adv = new Adv();
		$Adv->enable($id,$status);
		return Redirect::back();
	}
	public function postRemove(){
		if( isset($_POST['bt_Update']) )
		{
			if ( isset($_POST['delete']) )
				{
					$Adv = new Adv();
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
							  	$Adv->orderAdv($id,$value);
							}	
						}
					}
				return Redirect::to('administrator/adv/home')->with('message','Success!!!');
				}// end if isset()
		}
		// checking delete 
		else if ( isset($_POST['bt_Delete']) )
		{
		 	$Adv = new Adv();
		 	if( isset($_POST['delete']) )
		 	{
				foreach($_POST['delete'] as $id)
				{
					$Adv->removeAdv($id);
				}
				return Redirect::to('administrator/adv/home')->with('message','Success!!!');
			}
		}
		return Redirect::back();
	}
}