<?php

class AdminContactController extends \BaseController {

protected $layout = 'admin.main';
	public $_data = array();
	public function getHome()
	{
		$contact = new Contact();
		$_data['list_contact'] = $contact-> getcontactHome();
		$this->layout->content = View::make('admin.content_right.contact.home',$_data);
	}
	// load form insert 
	public function getAdd()
	{
		$images = new Media();
		$this->layout->content = View::make('admin.content_right.contact.add');
	}
	// insert articles new
	public function postInsert()
	{
		// get values form
		$data_pd= array(
			'name_contact' => Input::get('txt_name'),
			'address_contact' => Input::get('txt_add'),
			'email_contact' => Input::get('txt_email'),
			'telephone_contact' => Input::get('txt_telephone'),
			'mobilephone_contact' =>  Input::get('txt_mobile'),
			'yahoo_contact' =>  Input::get('txt_yahoo'),
			'skype_contact' =>  Input::get('txt_skype'),
			'facebook_contact' =>  Input::get('txt_facebook'),
			'ordering_contact' => 	Input::get('txt_sort'),
			'enable_contact'=> Input::get('rd_status'),
			'created_at'=>date('Y-m-d')
		);
		// call model
		$contact = new Contact();
		// insert
		$contact->insert($data_pd);
		// send data
		return Redirect::back()->with('message','Success!!!');
	}
	// enable products
	public function getEnable(){
		$id=Input::get('id');
		$status=Input::get('status');
		$contact = new Contact();
		$contact->enable($id,$status);
		return Redirect::back()->with('message','Success!!!');
	}
	// call update products
	public function getUpdate()
	{
		$id = Input::get('ID');
		$contact = new Contact();
		$_data['list_contact'] = $contact->getcontactUpdate($id);
		$this->layout->content = View::make('admin.content_right.contact.update',$_data);
	}
	// update products
	public function postUpdate()
	{
		$id = 0; $id = Input::get('txt_id');
		$data_pd= array(
			'name_contact' => Input::get('txt_name'),
			'address_contact' => Input::get('txt_add'),
			'email_contact' => Input::get('txt_email'),
			'telephone_contact' => Input::get('txt_telephone'),
			'mobilephone_contact' =>  Input::get('txt_mobile'),
			'yahoo_contact' =>  Input::get('txt_yahoo'),
			'skype_contact' =>  Input::get('txt_skype'),
			'facebook_contact' =>  Input::get('txt_facebook'),
			'ordering_contact' => 	Input::get('txt_sort'),
			'enable_contact'=> Input::get('rd_status'),
			'updated_at'=>date('Y-m-d')
		);
		$contact = new Contact();
		$contact->updatecontact($id,$data_pd);
		return Redirect::to("administrator/contact/home")->with('message','Success!!!');
	}
	public function postRemove(){

		if( isset($_POST['bt_Update']) )
		{
			if ( isset($_POST['delete']) )
				{
					$contact = new Contact();
					// get total record  in array
					$ordering = $_POST['ordering'];
					$idhide = $_POST['idhide'];
					$total = count($idhide);
					echo $total;
					// ordering menu footer
					 foreach($_POST['delete'] as $id)
					 {
						for($i=0;$i<$total; $i++){
							if( $idhide[$i] == $id )
							{
								$value = $ordering[$i];
							  	$contact->orderCat($id,$value);
							}	
						}
					}
				return Redirect::back()->with('message','Success!!!');
				}// end if isset()
		}
		else if(isset($_POST['bt_Delete']))
		{
			 if ( isset($_POST['delete']) )
			{
			 	$contact = new Contact();
				foreach($_POST['delete'] as $id)
				{
					$contact->removecontact($id);
				}
				return Redirect::back()->with('message','Success!!!');
			}
		}
			return Redirect::back();
	}

}