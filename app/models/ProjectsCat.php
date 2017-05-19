<?php

class ProjectsCat extends \Eloquent {
	public static $rules = array();
	protected $table = 'projects_categories';
		protected $fillable = array('name_projects_categories','id_menus','des_projects_categories','alias_projects_categories',
			'ordering_projects_categories','thumb_projects_categories','parentid','meta_title_projects_categories','meta_key_projects_categories','enable_projects_categories','meta_desc_projects_categories','created_at','updated_at');
	
	/*------------------ADMIN-------------------------- */
	// insert data
	public function insert($data_pd){
		$this::create($data_pd);
	}
	// get projects homes
	public function getHomeProjectsCatAd(){
		$listprojectsCat = $this
		->orderBy('ordering_projects_categories', 'asc')
		->get();
		return $listprojectsCat; 
	}
	// get projects update
	public function getProjectsCatUpdate($id){
		$listprojectsCat = $this
		->where('idProjectsCategories','=',$id)
		->first();
		return $listprojectsCat; 
	}
	// upadate
	public function updateProjectsCat($id,$data_pd){
		  $this->where('idProjectsCategories','=',$id)
			 ->update($data_pd);
	}
	//enable projects
	public function enable($id,$status){
		if($status==0)
			$status=1;
			else
			$status=0;
		$this->where('idProjectsCategories','=',$id)
			->update(array('enable_projects_categories'=>$status));
	}
	//remove projects Cat
	public function removeProjectsCat($id){
		$this
		->where('idProjectsCategories','=',$id)
		->delete();
	}
	public function SetNullprojects($id){
		DB::table('projects')
		->where('Categories_id',$id)
       ->update(array('Categories_id' => 0));
	}
	public function orderCat($id,$value){
		$this->where('idprojectsCategories','=',$id)
			->update(array('ordering_projects_categories'=>$value));
		return true;
	}
		// get Filter admin
		public function getFilter(){
		  $menu = $this->MenulevelFilter(0);
		  $data = array();
		  $i =0;
		  foreach($menu as $k => $row)
		  {
		  	$data[$i]=  $row['name_projects_categories'];
		  	$i++;
		  }
		  return $data;
	 }
	 public function MenulevelFilter($parentid = 0, $space = "", $trees = array())
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
				$trees = $this->MenulevelFilter($rs->idProjectsCategories, $space."   ", $trees); 
			}
			return $trees;
	}
	/*------------------USER-------------------------- */
	// get all projects paginate
	public function getAllprojectsCat(){
		$listprojectsCat = $this->orderBy('parentid','asc')
		->where('enable_projects_categories','=',1)
		->where('parentid','>=',0)
		->paginate(15);
		return $listprojectsCat; 
	}
	
	// get all projects  root
	public function getprojectsCatRoot(){
		$listprojectsCat = $this->orderBy('idProjectsCategories','desc')
		->where('enable_projects_categories','=',1)
		->where('parentid','=',0)
		->get();
		return $listprojectsCat; 
	}
	// get all projects  child
	public function getCatChild(){
		$listprojectsCat = $this->orderBy('idProjectsCategories','desc')
		->where('enable_projects_categories','=',1)
		->where('parentid','!=',0)
		->get();
		return $listprojectsCat; 
	}
	// get projectscat have alias 
	public function getProjectsCatAlias($alias){
		$listprojectsCat = $this->orderBy('idProjectsCategories','desc')
		->where('alias_projects_categories','=',$alias)
		->where('enable_projects_categories','=',1)
		->first();
		return $listprojectsCat; 
	}
	// get all projects of categories 
		// count projects in categories
	public function totalProjects($idProjectsCategories){
		$qty = $this
			->join('projects','idProjectsCategories','=','projects.categories_id')
			->where('idProjectsCategories','=',$idProjectsCategories)
			->get();
		return count($qty);
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
			   			$html.='<option value="'.$row['idProjectsCategories'].'">'.'-- '.$row['name_projects_categories'].'</option>';
			   		else
			   			$html.='<option disabled="disabled" value="'.$row['idProjectsCategories'].'">'.'-- '.$row['name_projects_categories'].'</option>';
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