<?php

class AdminProjectsController extends \BaseController {

	//protected $layout = 'user.main';
	protected $layout = 'admin.main';
	public $data = array();
	// load all Projects
	public function getHome()
	{
		$Projects = new Projects();
		$data['list_projects'] = $Projects->getHomeProjectsAd();
		$this->layout->content = View::make('admin.content_right.projects.home',$data);
	}
	public function getAdd()
	{
		$images = new Media();
		$ProjectsCat = new ProjectsCat();
		$data['max_id'] = $images->getMinId();
		$data['list_images'] = $images->get_data_media();
		$data['list_projectsCat'] = $ProjectsCat->getHomeProjectsCatAd();
		$this->layout->content = View::make('admin.content_right.projects.add',$data);
	}
	// get add desing
	// public function getAddDesign()
	// {
	// 	$images = new Media();
	// 	$ProjectsCat = new ProjectsCat();
	// 	$data['list_images'] = $images->get_data_media();
	// 	$data['combobox_menu'] =$ProjectsCat->getMultiAdd(0);
	// 	$this->layout->content = View::make('admin.content_right.projects.add_design',$data);
	// }
	// call update Projects
	public function getUpdate()
	{
		$id=0;
		$id = Input::get('id');
		$Projects = new Projects();
		$ProjectsCat = new ProjectsCat();
		$images = new Media();
		// get data
		$data['list_images'] = $images->get_data_media();
		$data['max_id'] = $images->getMinId();
		$data['list_gallery'] = $images->getGalleryId($id);
		$data['list_projects'] = $Projects->getProjectsUpdate($id);
		$data['list_projectsCat'] = $ProjectsCat->getHomeProjectsCatAd();
		$this->layout->content = View::make('admin.content_right.projects.update',$data);
	}
	// call update Design
	public function getUpdateDesign()
	{
		$id=0;
		$id = Input::get('id');
		$Projects = new Projects();
		$ProjectsCat = new ProjectsCat();
		$images = new Media();
		// get data
		$data['list_images'] = $images->get_data_media();
		$data['list_projects'] = $list_projects= $Projects->getProjectsUpdate($id);
		$data['list_gallery'] = $images->getGalleryId($id);
		$idProjectsCat = $Projects->getIdProjectCat($id);
		$data['combobox_menu'] = $ProjectsCat->getMultiUpdateProducts($idProjectsCat);
		$this->layout->content = View::make('admin.content_right.projects.update_design',$data);
	}
	// update Projects
	public function postUpdate()
	{
		$idProjects = Input::get('txt_id');
		$data_pd= array(
			'name_projects' => Input::get('txt_name'),
			'thumb_projects'=> Input::get('txt_thumb'),
			'categories_id'=>	Input::get('sl_categories'),
			'des_projects' => Input::get('txt_des'),
			'alias_projects' =>	$this->getAlias(Input::get('txt_name')),
			'enable_projects' => Input::get('rd_status'),
			'meta_desc_projects' =>  Input::get('txt_seodesc'),
			'meta_key_projects' =>  Input::get('txt_key'),
			'meta_title_projects' =>  Input::get('txt_title'),
		);
		// update Projects
		$Projects = new Projects();
		$images = new Media();
		// upadate data
		$Projects->updateProjects($idProjects,$data_pd);
		$images->deleteGallery($idProjects);
		 if ( isset($_POST['imglist']) )
		{
			foreach($_POST['imglist'] as $id)
			{
				$images->insertGallery($id,$idProjects);
			}
		}
		// send data
		return Redirect::to("administrator/projects/home")->with('message','Success!!!');
	}
	// update design
	public function postUpdateDesign()
	{
		$idProjects = Input::get('txt_id');
		// get values form
		$data_pd= array(
			'name_projects' => Input::get('txt_name'),
			'thumb_projects'=> Input::get('txt_thumb'),
			'des_projects' => Input::get('txt_des'),
			'categories_id'=>Input::get('sl_parentid'),
			'type_projects'=>1,
			'alias_projects' =>	$this->getAlias(Input::get('txt_name')),
			'enable_projects' => Input::get('rd_status'),
			'meta_desc_projects' =>  Input::get('txt_seodesc'),
			'meta_key_projects' =>  Input::get('txt_key'),
			'meta_title_projects' =>  Input::get('txt_title'),
		);
		// update Projects
		$Projects = new Projects();
		$Projects->updateProjects($idProjects,$data_pd);
		$images = new Media();
		// upadate data
		$Projects->updateProjects($idProjects,$data_pd);
		$images->deleteGallery($idProjects);
		 if ( isset($_POST['imglist']) )
		{
			foreach($_POST['imglist'] as $id)
			{
				$images->insertGallery($id,$idProjects);
			}
		}
		return Redirect::to('administrator/projects/design')->with('message','Success!!!');
	}
	 // insert Projects
	public function postInsert()
	{
		// get values form
		$data_pd= array(
			'name_projects' => Input::get('txt_name'),
			'thumb_projects'=> Input::get('txt_thumb'),
			'categories_id'=>	Input::get('sl_categories'),
			'des_projects' => Input::get('txt_des'),
			'type_projects'=>0,
			'alias_projects' =>	$this->getAlias(Input::get('txt_name')),
			'enable_projects' => Input::get('rd_status'),
			'meta_desc_projects' =>  Input::get('txt_seodesc'),
			'meta_key_projects' =>  Input::get('txt_key'),
			'meta_title_projects' =>  Input::get('txt_title'),
		);
		// call model insert data
		$Projects = new Projects();
		$images = new Media();
		$Projects->insert($data_pd);
		// insert gallery
		$idProjects = DB::getPdo()->lastInsertId();
		 if ( isset($_POST['imglist']) )
		{
			foreach($_POST['imglist'] as $id)
			{
				$images->insertGallery($id,$idProjects);
			}
		}
		// send data
		return Redirect::to("administrator/projects/add")->with('message','Success!!!');
	}
	// insert design
	public function postInsertDesign()
	{
		// get values form
		$data_pd= array(
			'name_projects' => Input::get('txt_name'),
			'thumb_projects'=> Input::get('txt_thumb'),
			'des_projects' => Input::get('txt_des'),
			'categories_id'=>Input::get('sl_parentid'),
			'type_projects'=>1,
			'alias_projects' =>	$this->getAlias(Input::get('txt_name')),
			'enable_projects' => Input::get('rd_status'),
			'meta_desc_projects' =>  Input::get('txt_seodesc'),
			'meta_key_projects' =>  Input::get('txt_key'),
			'meta_title_projects' =>  Input::get('txt_title'),
		);
		// call model insert data
		$Projects = new Projects();
		$Projects->insertDesign($data_pd);
		$idProjects = DB::getPdo()->lastInsertId();
		 if ( isset($_POST['imglist']) )
		{
			foreach($_POST['imglist'] as $id)
			{
				$images->insertGallery($id,$idProjects);
			}
		}
		// send data
		return Redirect::back()->with('message','Success!!!');
	}
	// enable Projects
	public function getEnable(){
		$id = Input::get('id');
		$status = Input::get('stt');
		$Projects = new Projects();
		$Projects->enable($id,$status);
		return Redirect::back();
	}
	public function postRemove(){

		if( isset($_POST['bt_Update']) )
		{
			if ( isset($_POST['delete']) )
				{
					$Projects = new Projects();
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
							  	$Projects->orderProjects($id,$value);
							}	
						}
					}
				return Redirect::back()->with('message','Success!!!');
				}// end if isset()
		}
		// checking delete 
		else if ( isset($_POST['bt_Delete']) )
		{
		 	$Projects = new Projects();
		 	if( isset($_POST['delete']) )
		 	{
				foreach($_POST['delete'] as $id)
				{
					$Projects->removeProjects($id);
				}
				return Redirect::back()->with('message','Success!!!');
			}
		}

		return Redirect::back();
	}
	


}