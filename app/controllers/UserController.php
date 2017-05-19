<?php

class UserController extends \BaseController {

	protected $layout = 'admin.main';
	public $_data = array();
	// Load All user
	public function getHome() {
		$user = new User();
		$_data['list_user'] = $user->getAllUser();
		$this->layout->content = View::make('admin.content_right.users.home', $_data);
	}
	// Load All userGroups
	public function getHomeGroup() {
		$user = new User();
		$_data['list_userGroup'] = $user->getAllUserGroup();
		$this->layout->content = View::make('admin.content_right.users.home_group', $_data);
	}
	// load form insert
	public function getAdd() {
		//$images = new Media();
		$user = new User();
                $salon = new Salon();
		$_data['list_level'] = $user->getLevel();
                $_data['list_salon'] = $salon->getAllSalonProvince();
		$this->layout->content = View::make('admin.content_right.users.add', $_data);
	}
	// insert articles new
	public function postInsert() {

		$data_pd = array(
			'username' => trim(Input::get('txt_account')),
			'password' => Hash::make(trim(Input::get('txt_pass'))),
			'name_users' => trim(Input::get('txt_name')),
			'email' => trim(Input::get('txt_email')),
			'address_users' => Input::get('txt_address'),
			'phone_users' => trim(Input::get('txt_phone')),
			'gid' => Input::get('sl_level'),
                        'enable_users' => 1,
			'id_salon' => Input::get('sl_salon')
		);
                //dd($data_pd);
		// call model
		$userslog = new User();
		// insert
		$userslog->insert($data_pd);
		// send data
		return Redirect::back()->with('message', 'Success!!!');
	}
	// enable products
	public function getEnable() {
		$id = Input::get('id');
		$status = Input::get('status');
		$user = new User();
		$user->enable($id, $status);
		return Redirect::back();
	}
	// call update products
	public function getUpdate() {
		$id = Input::get('id');
		$user = new User();
		$_data['list_user'] = $user->getUserUpdate($id);
		$_data['list_level'] = $user->getLevel();
		$this->layout->content = View::make('admin.content_right.users.update', $_data);
	}
	// update products
	public function postUpdate() {

		$user = new User();
		if (isset($_POST['bt_info'])) {
			$id = 0;
			$id = Input::get('txt_id1');
			$data_pd = array(
				'name_users' => trim(Input::get('txt_name')),
				'email' => trim(Input::get('txt_email')),
				'address_users' => Input::get('txt_address'),
				'phone_users' => trim(Input::get('txt_phone')),
				'enable_users' => Input::get('rd_status'),
				'gid' => Input::get('sl_level'),
			);
			$user->updateUser($id, $data_pd);
		} else if (isset($_POST['bt_account'])) {
			$id = 0;
			$id = Input::get('txt_id');
			$data_pd = array('password' => Hash::make(trim(Input::get('txt_pass'))));
			$user->updateUser($id, $data_pd);
			// check if update yoursefl
			if (Session::get('idUsers') == $id) {
				Session::flush();
				return Redirect::to('/admin');
			}
		}
		return Redirect::to("administrator/user/home")->with('message', 'Vui lòng đăng nhập lại...');
	}
	//
	public function postRemove() {

		if (isset($_POST['delete'])) {
			$user = new User();
			foreach ($_POST['delete'] as $id) {
				$user->removeUser($id);
			}
			return Redirect::back()->with('message', 'Success!!!');
		}
		return Redirect::back();
	}
	/*--------------------------------logs--------------------------------- */
	// show log users
	public function getLog() {
		$user = new User();
		$_data['list_log'] = $user->getAllLog();
		$this->layout->content = View::make('admin.content_right.users.log', $_data);
	}
	public function postRemoveLog() {

		if (isset($_POST['delete'])) {
			$user = new User();
			foreach ($_POST['delete'] as $id) {
				$user->removeLog($id);
			}
			return Redirect::back()->with('message', 'Success!!!');
		}
		return Redirect::back();
	}

}
