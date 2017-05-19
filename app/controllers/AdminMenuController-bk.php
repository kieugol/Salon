<?php
class AdminMenuController extends \BaseController {
	protected $layout = 'admin.main';
	public $_data = array();
	public function getHome()
	{
		$menu = new Menu();
		$_data['list_menu']= $menu->getMenuHome();
		$this->layout->content = View::make('admin.content_right.menu.home',$_data);
	}
	// load form insert 
	public function getAdd()
	{
		$menu = new Menu();
		$this->layout->content = View::make('admin.content_right.menu.add');
	}
	public function getAddCat()
	{
		$menu = new Menu();
		$articleCat = new ArticlesCat();
		$data_id = $menu->getArrayIdArticles();
		$data['list_articlesCat']= $articleCat->getArticlesCat_addMenu($data_id);
		$this->layout->content = View::make('admin.content_right.menu.add_categories',$data);
	}
	// insert articles new
	public function postInsert()
	{
		 	$menu = new Menu();
			$data= array(
				'title_menus'=>Input::get('txt_name'),
				'alias_menus' => $this->getAlias(Input::get('txt_name')),
				'default_menus'=>Input::get('sl_type'),
				'des_menus'=>Input::get('txt_des'),
				'meta_title_menus' =>Input::get('txt_meta_title'),
				'meta_key_menus' => Input::get('txt_key'),
				'meta_desc_menus'=>Input::get('txt_seodesc'),
				'enable_menus' => Input::get('rd_status'),
				'ordering_menus'=>0,
				'idArticlesCategories'=>0,
				);
			$menu->insertMain($data);
			return Redirect::back()->with('message','Success!!!');
	}
	// enable products
	public function getEnable(){
		$id=Input::get('id');
		$status=Input::get('status');;
		$menu = new Menu();
		$menu->enable($id,$status);
		return Redirect::back();
	}
	// call update products
	public function getUpdate()
	{
		$id = Input::get('ID');
		$menu = new Menu();
		$_data['list_menu'] = $menu->getMenuUpdate($id);
		$this->layout->content = View::make('admin.content_right.menu.update',$_data);
	}
	// update products
	public function postUpdate()
	{
		$id = 0; $id = Input::get('txt_id');
			$data_pd =array(
				'alias_menus' => $this->getAlias(Input::get('txt_title')),
				'title_menus' => Input::get('txt_title'),
				'default_menus' => Input::get('sl_type'), 
				'des_menus' => Input::get('txt_des'), 
				'meta_title_menus' =>Input::get('txt_meta_title'),
				'meta_key_menus' => Input::get('txt_key'),
				'meta_desc_menus'=>Input::get('txt_seodesc'),
				'enable_menus' => Input::get('rd_status'),
				'updated_at'=>date('Y-m-d H:i:s')
			);
		// call model
		$menu = new Menu();
		$menu->updateMenu($id,$data_pd);
		// check if Menu contains child , must set null products 
		//if( count($menu->checkParentId($id))>0 )
			//$menu->SetNullDecorate($id);
		return Redirect::to("administrator/menu/home")->with('message','Success!!!');
	}
	public function postRemove(){
		 if ( isset($_POST['delete']) )
		{
		 	$menu = new Menu();
			foreach($_POST['delete'] as $id)
			{
				$menu->removeMenu($id);
			}
			return Redirect::back()->with('message','Success!!!');
		}
			return Redirect::back();
	}
	/*---------------------------------------- menu header---------------------------------------------- */
	public function getHeader()
	{
		$menu = new Menu();
		$_data['list_header']= $menu->getMenuHeader();
		$this->layout->content = View::make('admin.content_right.menu_header.home',$_data);
	}
	// get menu and categoriesCat insert Menu Header
	public function getAddHeader(){
		$menu = new Menu();
		$_data['list_menu']= $menu->getMenuAddHeader();
		$this->layout->content = View::make('admin.content_right.menu_header.add',$_data);
	}
	public function postInsertHeader(){
		 if ( isset($_POST['list_header']) )
		{
		 	$menu = new Menu();
			foreach($_POST['list_header'] as $id)
			{
				$menu->insertHeader($id);
			}
			return Redirect::back()->with('message','Success!!!');
		}
			return Redirect::back();
	}
	public function postRemoveHeader(){
		$menu = new Menu();
		if( isset($_POST['bt_Update']) )
		{
			if ( isset($_POST['list_header']) )
				{
					$menu = new Menu();
					// get total record  in array
					$ordering = $_POST['ordering'];
					$idhide = $_POST['idhide'];
					$total = count($idhide);
					echo $total;
					// ordering menu footer
					 foreach($_POST['list_header'] as $id)
					 {
						for($i=0;$i<$total; $i++){
							if( $idhide[$i] == $id )
							{
								$value = $ordering[$i];
							  	$menu->orderHeader($id,$value);
							}	
						}
					}
					return Redirect::back()->with('message','Success!!!');
				}// end if isset()
		}
		// checking delete 
		else if ( isset($_POST['bt_Delete']) )
		{
			if( isset( $_POST['list_header'] ))
			{
				foreach($_POST['list_header'] as $id)
				{
					$menu->deleteHeader($id);
				}
				return Redirect::back()->with('message','Success!!!');
			}
		}
			return Redirect::back();
	}
	/*---------------------------------------- menu footer---------------------------------------------- */
	public function getFooter()
	{
		$menu = new Menu();
		$_data['list_footer']= $menu->getMenuFooter();
		$this->layout->content = View::make('admin.content_right.menu_footer.home',$_data);
	}
	// get menu and categoriesCat insert Menu footer
	public function getAddFooter(){
		$menu = new Menu();
		$_data['list_menu']= $menu->getMenuAddFooter();
		$this->layout->content = View::make('admin.content_right.menu_footer.add',$_data);
	}
	public function postInsertFooter(){
		 if ( isset($_POST['list_footer']) )
		{
		 	$menu = new Menu();
			foreach($_POST['list_footer'] as $id)
			{
				$menu->insertFooter($id);
			}
			return Redirect::back()->with('message','Success!!!');
		}
			return Redirect::back();
	}
	public function postRemoveFooter(){
		$menu = new Menu();
		// checking if update
		$total =0;
		
		if( isset($_POST['bt_Update']) )
		{
			if ( isset($_POST['list_footer']) )
				{
					$menu = new Menu();
					// get total record  in array
					$ordering = $_POST['order'];
					$idhide = $_POST['idhide'];
					$total = count($idhide);
					echo $total;
					// ordering menu footer
					 foreach($_POST['list_footer'] as $id)
					 {
						for($i=0;$i<$total; $i++){
							if( $idhide[$i] == $id )
							{
								$value = $ordering[$i];
							  	$menu->orderFooter($id,$value);
							}	
						}
					}
					return Redirect::to('administrator/menu/footer')->with('message','Success!!!');
				}// end if isset()
		}
		// checking if delete
		else if(isset($_POST['bt_Delete']))
		{
			if(isset($_POST['list_footer']) )
			{
				foreach($_POST['list_footer'] as $id)
				{
					$menu->deleteFooter($id);
				}
			  	return Redirect::to('administrator/menu/footer')->with('message','Success!!!');
			}
		}
		return Redirect::to('administrator/menu/footer');
	}
	/*----------------------------------------MenuSub-----------------------------------------------*/
	public function getSub()
	{
		$menu = new Menu();
		$_data['list_menu']= $menu->getMenuSub();
		$_data['combobox_menu'] = $menu->getMenuCombobox(0);
		$this->layout->content = View::make('admin.content_right.menu_sub.home',$_data);
	}
	// get menu and categoriesCat insert Menu Header
	public function getAddSub(){
		$menu = new Menu();
		$_data['combobox_menu'] = $menu->getMenuCombobox(0);
		$this->layout->content = View::make('admin.content_right.menu_sub.add',$_data);
	}
	public function postInsertSub(){
		$menu = new Menu();
		$_data['combobox_menu'] = $menu->getMenuCombobox(0);
		$data= array(
			'parentid'=>Input::get('sl_menusub'),
			'title_menus'=>Input::get('txt_name'),
			'alias_menus'=>$this->getAlias(Input::get('txt_name')),
			'meta_title_menus' =>Input::get('txt_meta_title'),
			'meta_key_menus' => Input::get('txt_key'),
			'meta_desc_menus'=>Input::get('txt_seodesc'),
			'enable_menus' =>1,
			);
		$menu->insertSub($data);
		return Redirect::back()->with('message','Success!!!');
	}
}
