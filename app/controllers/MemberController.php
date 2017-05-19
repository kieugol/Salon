<?php

class MemberController extends \BaseController {

	protected $layout = 'user.main';

	public function LoadRegister() {
		if (Session::has('username_member')) {
			return Redirect::to('/');
		} else {
			return $this->layout->content = View::make('user.body.member.member_register');
		}
	}

	public function loadLogIn() {
		if (Session::has('username_member')) {
			return Redirect::to('/');
		} else {
			return $this->layout->content = View::make('user.body.member.member_login');
		}
	}
	// insert articles new
	public function postInsert() {

		$data = array(
			'name_users' => trim(Input::get('fullname')),
			'password' => Hash::make(trim(Input::get('password'))),
			'email' => trim(Input::get('email')),
			'address_users' => trim(Input::get('address')),
			'phone_users' => trim(Input::get('phone')),
			'ip_register_users' => $_SERVER['REMOTE_ADDR'],
			'gid' => 0,
			'enable_users' => 1,
		);

		$rules = [
			'fullname' => 'required|min:10|max:50',
			'email' => 'required',
			'password' => 'required|min:6|max:20',
		];
		// call model
		$member = new User();
		$member->insert($data);
		$MemberId = DB::getPdo()->lastInsertId();
		if ($MemberId > 0) {
			Session::put('username_member', $data['name_users']);
			return Redirect::to('/');
		}
		// send data
		return Redirect::back()->with('message', 'Success!!!');
	}

	public function postLogIn() {
		$data = [
			'email' => trim(Input::get('email')),
			'password' => trim(Input::get('password')),
		];
		if (Auth::attempt($data)) {
			$user = new User();
			$userInfo = $user->getInfoViaEmail($data['email']);
			Session::put('username_member', $userInfo['name_users']);
			return Redirect::to('/');
		} else {
			return Redirect::back()->with('message', 'Tên đăng nhập hay tài khoản không tồn tại!');
		}
	}
	// logout
	public function getLogOut() {
		Session::forget('username_member');
		return Redirect::to('/');
	}

	public function postLoginSocial() {
		$email = Input::get('email');
		$id = Input::get('id');
		$username = Input::get('name');
		$member = new User();
		$row = $member->getInfoUserApi($id, $email);
		if (count($row) > 0) {
			Session::put('username_member', $row['name_users']);
			Session::put('username_permisson', 5);
			Session::save();
			echo json_encode(['url' => Asset('/')]);
			exit;
		} else {
			if (!empty($id) && !empty($email) && is_numeric($id) && !empty($username)) {
				$data = array(
					'name_users' => (string) $username,
					'password' => Hash::make('user_api'),
					'email' => (string) $email,
					'address_users' => '',
					'phone_users' => '',
					'id_social' => (string) $id,
					'is_social' => 1,
					'ip_register_users' => $_SERVER['REMOTE_ADDR'],
					'gid' => 5, // user
					'enable_users' => 1,
				);
				$member->insert($data);
				$MemberId = DB::getPdo()->lastInsertId();
				if ($MemberId > 0) {
					Session::put('username_member', $username);
					Session::put('username_permisson', 5);
					Session::save();
					echo json_encode(['url' => Asset('/')]);
					exit;
				}
			} else {
				echo json_encode(['url' => 'login_false']);
				exit;
			}

		}
		echo json_encode(['url' => 'login_false']);
		exit;
	}

	public function postLoginGoogle() {

	}
}
?>