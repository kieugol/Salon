<?php

class AdminEmailcontroller extends \BaseController {


	protected $layout = 'admin.main';
	public $_data = array();

	
	public function getHome(){
		$email = new Email();
		$_data['list_email'] = $email->getEmail();
		$this->layout->content = View::make('admin.content_right.email.home',$_data);
	}
	public function postRemove(){

			 if ( isset($_POST['delete']) )
			{
			 	$email = new Email();
				foreach($_POST['delete'] as $id)
				{
					$email->removeEmail($id);
				}
			return Redirect::back()->with('message','Success!!!');
			}
	return Redirect::back();
	}
}