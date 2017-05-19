<?php

class AdminProjectsCatController extends \BaseController {

	protected $layout = 'admin.main';
	public $data = array();
	// load all products
	public function getHome()
	{
		$ProjectsCat = new ProjectsCat();
		$data['list_projectsCat'] = $ProjectsCat->getHomeProjectsCatAd();
		$this->layout->content = View::make('admin.content_right.projects_cat.home',$data);
	}
	public function getAdd()
	{
		$images = new Media();
		$menu = new Menu();
		$ProjectsCat = new ProjectsCat();
		$data['max_id'] = $images->getMinId();
		$data['list_images'] = $images->get_data_media();
		$data['list_menus'] = $menu->getTypeMenus('projects');
		$data['combobox_menu'] = $ProjectsCat->getMulti(0);
		$this->layout->content = View::make('admin.content_right.projects_cat.add',$data);

	}
	// call update products
	public function getUpdate()
	{
		$id = Input::get('id');
		$ProjectsCat = new ProjectsCat();
		$images = new Media();
		$menu = new Menu();
		$data['list_images'] = $images->get_data_media();
		$data['max_id'] = $images->getMinId();
		$data['list_menus'] = $menu->getTypeMenus('projects');
		$data['list_projectsCat'] = $ProjectsCat->getProjectsCatUpdate($id);
		$data['combobox_menu'] = $ProjectsCat->getMulti(0);
		$this->layout->content = View::make('admin.content_right.projects_cat.update',$data);
	}
	// update products
	public function postUpdate()
	{
		$id = Input::get('txt_id');
		$check_parent = Input::get('sl_parent');
		$data_pd;
		if($check_parent<=-1){
			$data_pd= array(
				'thumb_projects_categories'=> Input::get('txt_thumb'),
				'name_projects_categories' => Input::get('txt_name'),
				'des_projects_categories' => Input::get('txt_des'),
				'alias_projects_categories' =>	$this->getAlias(Input::get('txt_name')),
				'enable_projects_categories' => Input::get('rd_status'),
				'meta_desc_projects_categories' =>  Input::get('txt_seodesc'),
				'meta_key_projects_categories' =>  Input::get('txt_key'),
				'meta_title_projects_categories' =>  Input::get('txt_title'),
				'ordering_projects_categories' => 	Input::get('txt_sort'),
				'id_menus'=> Input::get('sl_menus')
				);
		}
		else {
			$data_pd= array(
				'thumb_projects_categories'=> Input::get('txt_thumb'),
				'name_projects_categories' => Input::get('txt_name'),
				'des_projects_categories' => Input::get('txt_des'),
				'alias_projects_categories' =>	$this->getAlias(Input::get('txt_name')),
				'enable_projects_categories' => Input::get('rd_status'),
				'parentid'=>$check_parent,
				'meta_desc_projects_categories' =>  Input::get('txt_seodesc'),
				'meta_key_projects_categories' =>  Input::get('txt_key'),
				'meta_title_projects_categories' =>  Input::get('txt_title'),
				'ordering_projects_categories' => 	Input::get('txt_sort'),
				'id_menus'=> Input::get('sl_menus')
				);
		}
		// call model update
		$ProjectsCat = new ProjectsCat();
		$ProjectsCat->updateProjectsCat($id,$data_pd);
		return Redirect::to('administrator/projectsCategories/home')->with('message','Success!!!');
	}
	 // insert products
	public function postInsert()
	{
		$data_pd= array(
			'thumb_projects_categories'=> Input::get('txt_thumb'),
			'name_projects_categories' => Input::get('txt_name'),
			'des_projects_categories' => Input::get('txt_des'),
			'parentid'=>Input::get('sl_parent'),
			'alias_projects_categories' =>	$this->getAlias(Input::get('txt_name')),
			'enable_projects_categories' => Input::get('rd_status'),
			'meta_desc_projects_categories' =>  Input::get('txt_seodesc'),
			'meta_key_projects_categories' =>  Input::get('txt_key'),
			'meta_title_projects_categories' =>  Input::get('txt_title'),
			'ordering_projects_categories' => 	Input::get('txt_sort'),
			'id_menus'=> Input::get('sl_menus')
		);
		// call model insert data
		$ProjectsCat = new ProjectsCat();
		$ProjectsCat->insert($data_pd);
		return Redirect::to('administrator/projectsCategories/add')->with('message','Success!!!');
	}
	// enable products
	public function getEnable(){
		$id = Input::get('id');
		$status = Input::get('status');
		$ProjectsCat = new ProjectsCat();
		$ProjectsCat->enable($id,$status);
		return Redirect::back();
	}
	public function postRemove(){
	
			 if ( isset($_POST['delete']) )
			{
			 	$ProjectsCat = new ProjectsCat();
				foreach($_POST['delete'] as $id)
				{
					$ProjectsCat->removeProjectsCat($id);
					$ProjectsCat->SetNullProjects($id);
				}
				return Redirect::to('administrator/projectsCategories/home')->with('message','Success!!!');
			}
	return Redirect::back();
	}
}