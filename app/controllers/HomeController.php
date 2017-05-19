<?php
class HomeController extends \BaseController {
	/**
	 * Display a listing of the resource.
	 * GET /home
	 *
	 * @return Response
	 */
	protected $layout = 'admin.main';
	public $_data = array();
	public function index() {
		return $this->layout->content = View::make('admin.content_right.index');
	}
	// logIn
	public function postCheckLogin() {
		$name = Input::get('txt_userid');
		$pass = Input::get('txt_userpass');
		$log = new User();
		$user = array(
			'username' => $name,
			'password' => $pass,
		);
                //dd($user);
		// login success
		if (Auth::attempt($user)) {
                    //dd($result);
			$result = $this->infoUser($name);
			Session::put('idUsers', $result['idUsers']);
			Session::put('username', $name);
			Session::put('password', $pass);
			Session::put('fullname', $result['name_users']);
			Session::put('created_at', $result['created_at']);
			Session::put('level', md5($result['gid']));
                        Session::put('id_salon', $result['id_salon']);
			Session::put('email', $result['email_users']);
			Session::put('address', $result['address_users']);
			Session::put('rules', $result['name']);
			Session::put('permission', md5('$2y$10$wJPcY4RNfgZcMbXRdj4C3uKpUWGx0DtLvY3yUEy5MmqR2KgDaqORS'));
			return Redirect::to('administrator/');
		} else {
			$numberlogin = 1;
			$date = date("Y-m-d H:i:s");
			$ip = $_SERVER['REMOTE_ADDR'];
			$limitLogin = $log->checkIp($ip);
			// if ip haven't limitlogin
			if (count($limitLogin) == 0) {
				$data_limit = array(
					'ip' => $ip,
					'numberlogin' => 1,
					'time_first' => $date,
					'time_last' => $date,
				);
				$log->insertLimit($data_limit);
			} else {
				if ($limitLogin->numberlogin >= 3) {
					Session::put('limit', $numberlogin);
					return Redirect::back()->with('message', 'Tên đăng nhập hay tài khoản không tồn tại!');
				}
				$numberlogin = $limitLogin->numberlogin + 1;
				$data_limit = array(
					'ip' => $ip,
					'numberlogin' => $numberlogin,
					'time_first' => $date,
					'time_last' => $date,
				);
				$log->updateLimit($ip, $data_limit);
			}
			//return Response::json(array("result"=>0,"numberlogin"=>$numberlogin));
			return Redirect::back()->with('message', 'Tên đăng nhập hay tài khoản không tồn tại!');
		}
	}
	// get info user
	public function infoUser($username) {
		$user = new User();
		$result = $user->getInfoUser($username);
		return $result;
	}
	// logout
	public function getLogOut() {
		Session::flush();
		return Redirect::to('/');
	}

	// insert email customer
	public function postInsertEmail() {
		$name_email = Input::get('email_customer');
		if (!$name_email) {
			return Redirect::back();
		}

		$email = new Email();
		$email_details = $email->checkEmail($name_email);
		if (count($email_details) > 0) {
			$str = '<div style="color:#fc8727">Email của bạn đã được đăng ký!</div>';
			return Redirect::back()->with('message', $str);
		}

		if (strlen($name_email) == 0 || !preg_match("/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/", $name_email)) {
			$str = '<div style="color:#FC2020;">Vui lòng nhập một địa chỉ email hợp lệ!</div>';
			return Redirect::back()->with('message', $str);
		}

		$data = array('name_email' => $name_email, 'created_at' => date('Y-m-d'));
		$email->insertEmail($data);
		return Redirect::back()->with('message', 'Email <span style="color:#75bf97">[' . $name_email . ']</span> của bạn<br/>đã đăng ký thành công!');
	}

	// searching keywords
	public function SearchingKeywords() {
		$keywords = Input::get('txt_keywords');
		if (trim($keywords) != "") {
			$products = new Products();
			$projects = new Projects();
			$articles = new Articles();
			$_data['list_products'] = $products->getSearch($keywords);
			$_data['list_articles'] = $articles->getSearch($keywords);
			$_data['list_projects'] = $projects->getSearch($keywords);
			$_data['key'] = $keywords;
			return View::make('user.searching', $_data);
		}
		return Redirect::to('/');
	}
	/**
	 * Log In API
	 */
	function postLoginApi() {
		$responseTmp = Input::get($response);
		$responseData = json_decode($responseTmp, TRUE);
		print "<pre>";
		print_r($responseData);
		print "</pre>";
		exit;
	}
}