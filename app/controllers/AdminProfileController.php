<?php



class AdminProfileController extends \BaseController {



	

	protected $layout = 'admin.main';

	public $_data = array();

	public function getHome()

	{

		

		$profile = new Profile();

		$_data['list_profile'] = $profile->getProfile();

		$this->layout->content = View::make('admin.content_right.profile.home',$_data);

	

	}

	// load form insert 

	public function getAdd()

	{

		

		$this->layout->content = View::make('admin.content_right.profile.add');

		

	}

	// insert articles new

	public function postInsert()

	{

		$data_pd= array(

			'name' => Input::get('txt_name'),

			'value' => Input::get('txt_value'),

		);

		// call model

		$profile = new Profile();

		// insert

		$profile->insert($data_pd);

		

		return Redirect::to("administrator/profile/add")->with('message','Success!!!');

	}

	// enable products

	public function getEnable(){

		$id=Input::get('id');

		$status=Input::get('status');

		$profile = new Profile();

		$profile->enable($id,$status);

		return Redirect::back();

	}

	// call update products

	public function getUpdate()

	{

		$id = Input::get('id');

		$profile = new Profile();

		$_data['list_profile'] = $profile->getProfileUpdate($id);

		$this->layout->content = View::make('admin.content_right.profile.update',$_data);

	}

	// update products

	public function postUpdate()

	{

		$id = 0; $id = Input::get('txt_id');

		$data_pd= array(
			'value' => Input::get('txt_value'),

		);

		$profile = new Profile();

		// update profileegories

		$profile->updateProfile($id,$data_pd);

		return Redirect::to("administrator/profile/home")->with('message','Success!!!');

	}

	public function postRemove(){

			 if ( isset($_POST['delete']) )

			{

			 	$profile = new Profile();

				foreach($_POST['delete'] as $id)

				{

					$profile->removeProfile($id);

				}

				return Redirect::back()->with('message','Success!!!');

			}

			return Redirect::back();

	}



}