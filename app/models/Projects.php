<?php

class projects extends \Eloquent {
	public static $rules = array();
	protected $table = 'projects';
	protected $fillable = array('name_projects','thumb_projects','categories_id','des_projects','alias_projects',
		'meta_desc_projects','meta_key_projects','type_projects','id_menus','meta_title_projects','enable_projects','created_at','updated_at','id_menus');
		/*------------------ADMIN-------------------------- */
	// insert data
	public function insert($data_pd){
		$this::create($data_pd);
	}
	// get projects homes
	public function getHomeprojectsAd(){
		$listprojects = $this
		->leftJoin('projects_categories', 'categories_id', '=', 'projects_categories.idProjectsCategories')
		->orderBy('ordering_projects', 'asc')
		->get();
		return $listprojects;
	}
	// get projects update
	public function getprojectsUpdate($id){
		$listprojects = $this
		->where('idProjects','=',$id)
		->first();
		return $listprojects; 
	}
	// get id ProjectCategories 
	public function getIdProjectCat($id){
		$listprojects = $this
		->join('projects_categories','categories_id', '=','projects_categories.idProjectsCategories')
		->where('idProjects','=',$id)
		->first();
		if(count($listprojects)>0)
			return $listprojects['idProjectsCategories'];
		else
			return 0;
	}
	// upadate
	public function updateProjects($id,$data_pd){
		 $this->where('idProjects','=',$id)
		 ->update($data_pd);
	}
	//enable projects
	public function enable($id,$status){
		if($status==0)
			$status=1;
			else
			$status=0;
		$this
		->where('idProjects','=',$id)
		->update(array(
				'enable_projects'=>$status
			));
	}
	//remove projects
	public function removeProjects($id){
		$this
		->where('idProjects','=',$id)
		->delete();
	}
	public function orderProjects($id,$value){
		$this
		->where('idProjects','=',$id)
		->update( array('ordering_projects'=>$value) );
		return true;
	}
	/*------------------USER-------------------------- */
	// get all projects
	public function getAllprojects($aPag = 12){
		$listprojects = $this->orderBy('ordering_projects','desc')
		->where('enable_projects','=',1)
		->join('projects_categories','categories_id','=','projects_categories.idProjectsCategories')
		->Join('menus','projects_categories.id_menus','=','menus.idMenus')
		->paginate($aPag);
		return $listprojects;
	}

	// get projects Cart
	public function getProjectsID($alias){
		$listprojects = $this
		->where('alias_projects','=',$alias)
		->first();
		if(count($listprojects)>0)
			return $listprojects['idProjects']; 
		else
			return 0;
	}
	// get projects details
	public function getProjectsDetails($alias){
		$listprojects = $this
		->join('projects_categories','categories_id','=','projects_categories.idProjectsCategories')
	  ->Join('menus','projects_categories.id_menus','=','menus.idMenus')
		->where('alias_projects','=',$alias)
		->where('enable_projects','=',1)
		->first();
		return $listprojects;
	}
	// get projects other alias
	public function getProjectsOther($alias){
		$listprojects = $this
		->orderBy('ordering_projects','desc')
		->join('projects_categories','categories_id','=','projects_categories.idProjectsCategories')
		->Join('menus','projects_categories.id_menus','=','menus.idMenus')
		->where('alias_projects','!=',$alias)
		->where('enable_projects','=',1)
		->take(10)
		->get();
		return $listprojects; 
	}
	// get all projects of categories 
	public function getProjectsCategories($alias){
		// get Id categories
		$id_categories=0;
		$categories = DB::table('categories')
                    ->where('alilas_category',$alias )
                    ->first();
       $id_categories = $categories->id;
       // get list projects	
	   $listprojects = $this
  	 		->where('Category_id','=',$id_categories)
  	 		->where('enable_projects','=',1)
			->get();
		 return $listprojects; 
	}
	// get 6 project new footer
	public function GetProjectFooter($aQty = 3){
			$result = $this
			->orderBy('idProjects','desc')
			->join('projects_categories','categories_id','=','projects_categories.idProjectsCategories')
			->Join('menus','projects_categories.id_menus','=','menus.idMenus')
			->where('enable_projects','=',1)
			->take($aQty)
			->get();
			return $result;
	}
	// get 9 gallery project new
	public function GetGalleryProject(){
		$result = DB::table('gallery')
		->join('medias','gallery.idMedia','=','medias.id')
		->join('projects','gallery.name_projects','=','projects.name_projects')
		->join('projects_categories','projects.categories_id','=','projects_categories.idProjectsCategories')
		->take(9)
		->get();
		return $result;
	}
	// get gallery projects
	public function GetGallery($alias){
		$result = $this
		->where('alias_projects','=',$alias)
		->join('images','projects.idProjects','=','images.idProjects')
		->join('medias','idMedia','=','medias.id')
		->select('medias.name_file')
		->get();
		return $result;
	}
	// searching like keywords
	public function getSearch($keywords){
		$listprojects = $this->orderBy('ordering_projects','asc')
		->join('projects_categories','projects.categories_id','=','projects_categories.idProjectsCategories')
		->Join('menus','projects_categories.id_menus','=','menus.idMenus')
		->where('enable_projects','=',1)
		->where('name_projects','LIKE','%'.$keywords.'%')
		->orWhere('name_projects_categories','LIKE','%'.$keywords.'%')
		->get();
		return $listprojects;
	}
	/*---------------------------------------Categories Multilevel------------------------------------------------*/
			// get all menu Multi 
		public function getMulti($level){
		  $menu = $this->Menulevel($level);
		  $html="";
		  foreach($menu as $k => $row)
		  {
		   $html.='<option value="'.$row['idProjectsCategories'].'">'.'--'.$row['name_projects_categories'].'</option>';
		  }
		  return $html;
	 }
	 // get all menu Multi 
		public function getMultiHome($level,$stament){
		  $menu = $this->Menulevel($level);
		  $html="";
		  foreach($menu as $k => $row)
		  {
		  	if($stament==1)
		   	$html.='<option disabled="disabled" value="'.$row['idProjectsCategories'].'">'.'--'.$row['name_projects_categories'].'</option>';
		  }
		  return $html;
	 }
	 // get menu multi update for menu
		public function getMultiUpdate($level,$id){
		  $menu = $this->Menulevel($level);
		  $html="";
		  foreach($menu as $k => $row)
		  {
		  	if($row['idProjectsCategories']!=$id)
		   	$html.='<option value="'.$row['idProjectsCategories'].'">'.'--'.$row['name_projects_categories'].'</option>';
		  }
		  return $html;
		}
		// get menu multi update for products
	public function getMultiUpdateProducts($id){
		  $menu = $this->Menulevel(0);
		  $html="";
		  foreach($menu as $k => $row)
		  {
			  	if($row['idProjectsCategories']==$id)
			   		$html.='<option selected="selected" value="'.$row['idProjectsCategories'].'">'.'--'.$row['name_projects_categories'].'</option>';
			  	else
			  		$html.='<option value="'.$row['idProjectsCategories'].'">'.'--'.$row['name_projects_categories'].'</option>';
		  }
		  return $html;
	 }
	 	 // get menu multi Add
	 	public function getMultiAdd($level){
	 	// start loop array parentid
	 		$result = $this->select('parentid')->get();
			$data = array();
			foreach ($result as $key => $value)
			{
				$data[$key]= $result[$key]->parentid;	
			}
			$length = count($data);
			$checkChild=0;
		// end loop array parentid
		  $menu = $this->Menulevel($level);
		  $html="";
		  	foreach($menu as $k => $row)
		  	{
			  		for($i=0;$i<$length;$i++)
			  		{
			  			if($data[$i]==$row['idProjectsCategories'] || $row['parentid']==0){
			  				$checkChild=1;
			   			}
			   		}
			   		if($checkChild==0)
			   			$html.='<option value="'.$row['idProjectsCategories'].'">'.'--'.$row['name_projects_categories'].'</option>';
			   		else
			   			$html.='<option disabled="disabled" value="'.$row['idProjectsCategories'].'">'.'--'.$row['name_projects_categories'].'</option>';
			  		$checkChild=0;
		  	}
		  return $html;
	 }
	 public function Menulevel($parentid = 0, $space = "", $trees = array())
	{
			if(!$trees) 
			{
				$trees = array();
			}
			$query = $this
				   ->where('parentid','=',$parentid)
				   ->get();
	  		$listMenu=$query;
			foreach($listMenu as $rs)
	  		{
				$trees[] = array( 'idProjectsCategories' => $rs->idProjectsCategories,
								  'name_projects_categories'=>$space.$rs->name_projects_categories,
								   'parentid'=>$rs->parentid,
									); 
				$trees = $this->Menulevel($rs->idProjectsCategories, $space.' --', $trees); 
			}
			return $trees;
	}
	// insert submenu
	public function insertSub($data){
		DB::table('menus')->insert($data);
		return true;
	}
	// get list parent id
	public function checkParentId($id){
			$result = $this->select('parentid')->get();
			$data = array();
			foreach ($result as $key => $value) {
				$data[$key]= $result[$key]->parentid;	
			}
			$row = $this
			->whereIn('idProjectsCategories',$data)
			->where('idProjectsCategories','=',$id)
			->get();
			return $row;
		}
	// get menu level 1
 	public function getMenuChild($id){
 		$listmenu = $this->where('parentid','=',$id)
 		->get();
 		return $listmenu;
 	}
 	
 	public function getidProjectsCategories($alias){
		$listMenu = $this
		->where('alias_menus','=',$alias)
		->first();
		return $listMenu; 
	}
}
