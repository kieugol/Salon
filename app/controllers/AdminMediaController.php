<?php

class AdminMediaController extends \BaseController {
	protected $layout = 'admin.main';
	public $_data = array();
	// get data home
	public function getHome() {
		$images = new Media();
		$data['list_images'] = $images->getAllDataMedia();
		$this->layout->content = View::make('admin.content_right.gallery.home', $data);

	}
	// remove media
	public function postRemove() {
		if (isset($_POST['imglist'])) {
			$images = new Media();
			foreach ($_POST['imglist'] as $id) {
				$data_img = $images->get_data_media_id($id);
				$filename = 'store/upload/images/' . $data_img['name_file'];
				if (File::exists($filename)) {
					File::delete($filename);
				}
				$images->delete_media_id($id);
				// remove gallery
				$images->deleteGalleryIdMedia($id);
				$images->deleteGalleryIdMediaIndex($id);
				//remove images from folder
			}
		}
		return Redirect::back();
	}
	public function postMediaUpload() {
		$output_dir = 'store/upload/images/';
		if (isset($_FILES["myfile"])) {
			$ret = array();
			$error = $_FILES["myfile"]["error"];
			{

				if (!is_array($_FILES["myfile"]['name'])) //single file
				{
					$dataFile = array(
						'name_display' => substr($_FILES["myfile"]["name"], 0, strpos($_FILES["myfile"]["name"], '.')),
						'name_file' => $_FILES["myfile"]["name"],
						'size_file' => $_FILES["myfile"]["size"],
						'type_file' => strtoupper(end((explode(".", $_FILES["myfile"]["name"])))),
					);
					$fileName = $_FILES["myfile"]["name"];
					move_uploaded_file($_FILES["myfile"]["tmp_name"], $output_dir . $fileName);

					$ret[$fileName] = $output_dir . $fileName;
					$media = new Media();
					$media->insert($dataFile);
				} else {
					$dataFile = array(
						'name_display' => substr($_FILES["myfile"]["name"], 0, strpos($_FILES["myfile"]["name"], '.')),
						'name_file' => $_FILES["myfile"]["name"],
						'size_file' => $_FILES["myfile"]["size"],
						'type_file' => strtoupper(end((explode(".", $_FILES["myfile"]["name"])))),
					);
					$fileCount = count($_FILES["myfile"]['name']);
					for ($i = 0; $i < $fileCount; $i++) {
						$fileName = $_FILES["myfile"]["name"][$i];
						$media = new Media();
						$media->insert($dataFile);
						$ret[$fileName] = $output_dir . $fileName;
						move_uploaded_file($_FILES["myfile"]["tmp_name"][$i], $output_dir . $fileName);
					}

				}
			}
			echo json_encode($ret);

		}
	}

	public function getDeleteMedia() {
		$base_url = Asset('/');
		$id = Input::get('id');
		$media = new Media();
		$urlImage = $media->get_data_media_id($id);
		$filename = 'upload/images/' . $urlImage['name_file'];
		Croppa::delete($filename);
		$media->delete_meida_id($id);
		return Redirect::back();
	}
	public function postMediaUpdate() {
		$data = Input::all();
		$media = new Media();
		if ($media->media_update($data)) {
			return Redirect::back();
		}
	}
	public function postGetMedia() {
		$media = new Media();
		$dataMedia = $media->get_data_media();
		$stringMedia = '';
		foreach ($dataMedia as $key => $value) {
			$stringMedia .= '<td><img src="' . Croppa::url('/laravel-happy/upload/images/' . $value->name_file . '', 155, 155) . '" class="img-responsive img-check" alt="Image"/><b class="hidden">' . $value->name_display . '</b>
			<input type="checkbox" class="hidden" name="imgCheck" value="' . $value->id . '" /><ul class="hidden"><li><strong>Tập tin: </strong><b>' . $value->name_file . '</b></li><li><strong>Định dạng: </strong>' . $value->type_file . '</li><li><strong>Kích thước: </strong>' . floor($value->size_file / 1024) . ' kB</li><li><input type="text" name="" id="input" class="form-control" value="' . Asset('upload/images') . '/' . $value->name_file . '"></li></ul></td>';
		}
		return $stringMedia;
	}
	public function postLoadImagesList() {
		$images = new Media();
		$data['list_images'] = $images->get_data_media();
		$data['max_id'] = $images->getMinId();
		return View::make('admin.content_right.products.gallery', $data);
		//$this->layout->content = View::make('admin.content_right.products.update',$data);
	}
	// load more iamges
	public function postLoadMore() {
		$images = new Media();
		$id_max = Input::get('id_max');
		$data['list_images'] = $images->loadMore($id_max);
		$data['max_id'] = $images->getMinId_have($id_max);
		return View::make('admin.content_right.products.list_more', $data);
		//$this->layout->content = View::make('admin.content_right.products.update',$data);
	}
	/*----------------------------------Gallery index------------------------------------- */
	public function getDisplayIndex() {
		$images = new Media();
		$data['list_images'] = $images->get_data_media();
		$data['list_gallery'] = $images->getGalleryIndex();
		$this->layout->content = View::make('admin.content_right.gallery.display_home', $data);
	}
	public function postUpdateGallery() {
		$images = new Media();
		$images->deleteGalleryIndex();
		$name = $_POST['projects_name'];
		$idhide = $_POST['idhide'];
		$total = count($name);
		if (isset($_POST['imglist'])) {
			foreach ($_POST['imglist'] as $id) {
				for ($i = 0; $i < $total; $i++) {
					if ($idhide[$i] == $id) {
						$data_pd = array(
							'idMedia' => $id,
							'name_projects' => $name[$i],
							'alias' => $this->getAlias($name[$i]),
						);
						$images->insertGalleryIndex($data_pd);
					}
				}

			}
		}
		return Redirect::back();
	}
	// gallery stackholder
	public function getStackholder() {
		$images = new Media();
		$data['list_stack'] = $images->getStackholder();
		$data['list_images'] = $images->getGalleryNotStack();
		$this->layout->content = View::make('admin.content_right.gallery.stackholder', $data);
	}
	// update gallery stackholder
	public function postUpdateStackholder() {
		$images = new Media();
		$images->deleteGalleryStackholder();
		$url = $_POST['url'];
		$idhide = $_POST['idhide'];
		$total = count($url);
		if (isset($_POST['imglist'])) {
			foreach ($_POST['imglist'] as $id) {
				for ($i = 0; $i < $total; $i++) {
					if ($idhide[$i] == $id) {
						$data_pd = array('idMedia' => $id, 'url' => $url[$i]);
						$images->insertGalleryStackholder($data_pd);
					}
				}

			}
		}
		return Redirect::back();
	}
}