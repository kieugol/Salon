<?php

class Menu extends \Eloquent {
	protected $table = 'menus';
	/* --------------------Admin---------------------------*/
	public function getMenuHome(){
		$listMenu = $this
		->orderBy('default_menus','asc')
		->get();
		return $listMenu;
	}
	// get menu add for header
	public function getMenuAddHeader(){
		$data = $this->getArrayIdHeader();
		$listMenu = $this
		->orderBy('idMenus','asc')
		->whereNotIn('idMenus',$data)
		->get();
		return $listMenu;
	}
	// get menu add for header
	public function getMenuAddFooter(){
		$data = $this->getArrayIdFooter();
		$listMenu = $this
		->orderBy('idMenus','asc')
		->whereNotIn('idMenus',$data)
		->get();
		return $listMenu;
	}
	// insert data
	public function insertMain($data){
		$this->insert($data);
		return true;
	}	
	//enable products
	public function enable($id,$status){
		if($status==0)
			$status=1;
			else
			$status=0;
		$this
		->where('idMenus','=',$id)
		->update(array(
				'enable_menus'=>$status
			));
	}
	// get menu update
	public function getMenuUpdate($id){
		$listMenu = $this
		->where('idMenus','=',$id)
		->first();
		return $listMenu; 
	}
	// update menu
	public function updateMenu($id,$data){
		$listMenu = $this
		->where('idMenus','=',$id)
		->update($data);
	}
	// update from Articles categories
	public function updateTitle($id,$data){
		$listMenu = $this
		->where('idArticlesCategories','=',$id)
		->update($data);
	}
	//delete 
	public function deleteTitle($id){
		$listMenu = $this
		->where('idArticlesCategories','=',$id)
		->delete();
	}
	// delete menu
	public function removeMenu($id){
		$listMenu = $this
		->where('idMenus','=',$id)
		->delete();
	}
	public function articlesMenu($alias){
		$articles = $this
		->where('alias_menus','=',$alias)
		->first();
		return $articles; 
		}
	/*------------------------------------ menu header----------------------------------------------*/
	
	// get all Menu_header is having
	public function getArrayIdHeader(){
		$lisHeader = DB::table('menu_header')->get();
		$data = array();
		foreach ($lisHeader as $key => $value) {
			$data[$key]= $lisHeader[$key]->idParent;
		}
		if(count($data)>0){
			return $data;
		}
		else
		{
			$data[0] = 0;
			return $data;
		}
	}
	// get all Menu_header is having
	public function getMenuCombobox(){
		$lisHeader = DB::table('menu_header')->get();
		$data = array();
		foreach ($lisHeader as $key => $value) {
			$data[$key]= $lisHeader[$key]->idParent;
		}
		if(count($data)>0){
			return $data;
		}
		else
		{
			$data[0] = 0;
			return $data;
		}
	}
	// get menu_header container in Menu
	public function getMenuheader(){
		$listMenu = $this
		->orderBy('ordering_header','asc')
		->join('menu_header','idMenus','=','menu_header.idParent')
		->where('enable_menus','=',1)
		->get();
		return $listMenu;
	}
	// get menu_header alias
	public function getHeaderAlias($alias){
		$listMenu = $this
		->where('alias_menus','=',$alias)
		->first();
		if(count($listMenu)>0)
			return $listMenu['title_menus'];
		else
			return "";
	}
	public function insertHeader($id){
		$listMenu = DB::table('menu_header')
		->insert(array(
						'idParent' =>$id,
						'ordering_header' =>1,  
						'created_at'=>date('Y-m-d H:i:s'),
						'updated_at'=>date('Y-m-d H:i:s')
					   )
				);
	}
	public function deleteHeader($id){
		$listMenu = DB::table('menu_header')
		->where('idMenuHeader','=',$id)
		->delete();
		return true;
	}
	public function orderHeader($id,$value){
		$listMenu = DB::table('menu_header')
		->where('idMenuHeader','=',$id)
		->update( array('ordering_header'=>$value) );
		return true;
	}
	/*------------------------------------ menu footer----------------------------------------------*/
	// get all Menu_footer is having
	public function getArrayIdFooter(){
		$listFooter = DB::table('menu_footer')->get();
		$data = array();
		foreach ($listFooter as $key => $value) {
			$data[$key]= $listFooter[$key]->idParent;
		}
		if(count($data)>0){
			return $data;
		}
		else
		{
			$data[0] = 0;
			return $data;
		}
	}
	public function getMenuFooter(){
		$listMenu = $this
		->orderBy('ordering_Footer','asc')
		->where('enable_menus','=',1)
		->join('menu_footer','idMenus','=','menu_footer.idParent')
		->get();
		return $listMenu;
	}
	// get all menu footer != alias
	public function getMenuFooterOther($alias){
		$listMenu = $this
		->orderBy('ordering_Footer','asc')
		->join('menu_footer','idMenus','=','menu_footer.idParent')
		->where('enable_menus','=',1)
		->where('alias_menus','!=',$alias)
		->get();
		return $listMenu;
	}
	public function insertFooter($id){
		$listMenu = DB::table('menu_footer')
		->insert(array(
						'idParent' =>$id,
						'ordering_footer' =>1,  
						'created_at'=>date('Y-m-d H:i:s'),
						'updated_at'=>date('Y-m-d H:i:s')
					   )
				);
	}
	public function deleteFooter($id){
		$listMenu = DB::table('menu_footer')
		->where('idMenuFooter','=',$id)
		->delete();
		return true;
	}
	public function orderFooter($id,$value){
		$listMenu = DB::table('menu_footer')
		->where('idMenuFooter','=',$id)
		->update( array('ordering_footer'=>$value) );
		return true;
	}
	/*----------------------------------------MenuSub----------------------------------------------*/
	
		// get all menu Multi 
		public function getMulti($level){
		  $menu = $this->Menulevel($level);
		  $html="";
		  foreach($menu as $k => $row)
		  {
		   $html.='<option value="'.$row['idMenus'].'">'.'--'.$row['title_menus'].'</option>';
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
		   	$html.='<option disabled="disabled" value="'.$row['idMenus'].'">'.'--'.$row['title_menus'].'</option>';
		  }
		  return $html;
	 }

	 // get menu multi update for menu
		public function getMultiUpdate($level,$id){
		  $menu = $this->Menulevel($level);
		  $html="";
		  foreach($menu as $k => $row)
		  {
		  	if($row['idMenus']!=$id)
		   	$html.='<option value="'.$row['idMenus'].'">'.'--'.$row['title_menus'].'</option>';
		  }
		  return $html;
		}
		// get menu multi update for products
	public function getMultiUpdateProducts($id,$type){
		  $menu = $this->Menulevel(0);
		  $html="";
		  foreach($menu as $k => $row)
		  {
		  	if($row['default_menus']==$type)
		  	{
			  	if($row['idMenus']==$id)
			   		$html.='<option selected="selected" value="'.$row['idMenus'].'">'.'--'.$row['title_menus'].'</option>';
			  	else
			  		$html.='<option value="'.$row['idMenus'].'">'.'--'.$row['title_menus'].'</option>';
			}
		  }
		  return $html;
	 }
	 	 // get menu multi Add
	 	public function getMultiAdd($level,$type){
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
		  		if($row['default_menus']==$type)
		  		{
			  		for($i=0;$i<$length;$i++)
			  		{
			  			if($data[$i]==$row['idMenus'] || $row['parentid']==0){
			  				$checkChild=1;
			   			}
			   		}
			   		if($checkChild==0)
			   			$html.='<option value="'.$row['idMenus'].'">'.'--'.$row['title_menus'].'</option>';
			   		else
			   			$html.='<option disabled="disabled" value="'.$row['idMenus'].'">'.'--'.$row['title_menus'].'</option>';
			  		$checkChild=0;
			  	}
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
				$trees[] = array( 'idMenus' => $rs->idMenus,
								  'title_menus'=>$space.$rs->title_menus,
								   'parentid'=>$rs->parentid,
								    'default_menus'=>$rs->default_menus,
									); 
				$trees = $this->Menulevel($rs->idMenus, $space.'-- ', $trees); 
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
			->whereIn('idMenus',$data)
			->where('idMenus','=',$id)
			->get();
			return $row;
		}
	// get menu level 1
 	public function getMenuChild($id){
 		$listmenu = $this->where('parentid','=',$id)
 		->get();
 		return $listmenu;
 	}
 	
 	public function getIdMenus($alias){
		$listMenu = $this
		->where('alias_menus','=',$alias)
		->first();
		return $listMenu; 
	}
	// get  type menus
	public function getTypeMenus($type_menus="") {

		$listMenu = $this
			->where('default_menus','=',$type_menus)
			->get();
		return $listMenu;
	}
	/*list menu*/
 	public	function listMenu(){
        $result=$this
        	->orderBy('ordering_menus','asc')
        	->get();
        foreach($result as $r){
            $data[$r->parentid][] = $r;
        }
        $menu=$this->getCategoryMenu($data,0);
        return $menu;
    }
 
 	public function getCategoryMenu($category,$parent){
 		$URL = Asset('/');
		  //echo $alias_menus;
 		$alias_menus = "";
		        static $i = 1;
		        if (array_key_exists($parent, $category)){
		            $menu = '<ul id="nav-collapse" ';
		            $i++;
		            foreach ($category[$parent] as $r) {
		                $child = $this->getCategoryMenu($category, $r->idMenus);
		    if($alias_menus != $r->alias_menus)
		    {
		     $active='class=""';
		    }
		    else
		    {
		     $active='class="active"';
		    }
		                $menu .= '<li '.$active.' id="'.$parent.'">';
		    if($r->default_menus==1)
		    {
		     $link=$URL;
		    }
		    else
		    {
		     $link=$URL.$r->alias_menus;
		    }
		                $menu .= '<a href="'.$link.'">'.$r->title_menus.'</a>';
		                if ($child) {
		                    $i--;
		                    $menu .= $child;
		                }
		                $menu .= '</li>';
		            }
		            $menu .= '</ul>';
		            return $menu;
		        } else {
		            return false;
		        }
    }
 	/*list menu*/
	/*------------------------------------ User----------------------------------------------*/
	// get menu_header alias
	public function getMenusAlias($alias){
		$listMenu = $this
		->where('alias_menus','=',$alias)
		->first();
		if(count($listMenu)>0)
			return $listMenu['default_menus'];
		else
			return "";
	}
	public function getTitleMenus($alias){
		$result = $this
				->where('alias_menus','=',$alias)
				->first();
			return $result;
	}
}


