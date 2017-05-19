<?php

class ProjectsController extends \BaseController {

	protected $layout = 'user.main';
	public $data = array();
	// load All products of Categories
	public function LoadAllProjects(){
		$pj = new Projects();
		$data['list_projects'] = $pj->getAllprojects();
		$this->layout->content = View::make('user.body.projects_dir.projects',$data);
	}
	// load projects Details
	public function LoadProjectsDetails($alias1,$alias2){
		$pj = new Projects();
		$data['projects_details'] = $pj->getProjectsDetails($alias2);
		if(count($data['projects_details'])>0)
		{
			$data['projects_other'] = $pj->getProjectsOther($alias2);
			return $this->layout->content = View::make('user.body.projects_dir.projects_details',$data);
		}
		return Redirect::to('/');
	}
	//  load all design parent
	public function LoadDesignParent($alias){
			$pj = new Projects();
			$projectsCat = new ProjectsCat();
		 	$data['details_cat'] =$details_Cat= $projectsCat->getProjectsCatAlias($alias);
			// check if alias have id menus
			if(count($details_Cat)>0)
				$data['list_projects'] = $pj->getDesignCategoriesParent($details_Cat['idProjectsCategories']);
			else
				$data['list_projects'] = $pj->getDesignCategoriesParent(0);
			$data['list_projectsCat'] = $projectsCat->getprojectsCatRoot();
			$this->layout->content = View::make('user.body.projects_dir.design_categories',$data);
	}
	//  load all design parent
	public function LoadDesignChild($alias1,$alias2){
			$pj = new Projects();
			$projectsCat = new ProjectsCat();
		 	$data['details_cat'] = $details_cat= $projectsCat->getProjectsCatAlias($alias2);
			// check if alias have id menus
			if(count($details_cat)>0)
				$data['list_projects'] = $pj->getDesignCategoriesChild($details_cat['idProjectsCategories']);
			else
				$data['list_projects'] = $pj->getDesignCategoriesChild(0);
			// get menu is have 
			$data['list_projectsCat'] = $projectsCat->getprojectsCatRoot();
			$this->layout->content = View::make('user.body.projects_dir.design_categories',$data);
	}
}