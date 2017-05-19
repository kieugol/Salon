<?php
class EventCat extends \Eloquent {
	public static $rules = array();
	protected $table = 'event_categories';
	protected $fillable = array('ordering_event_categories', 'name_event_categories', 'alias_event_categories', 'des_event_categories',
		'meta_title_event_categories', 'meta_key_event_categories', 'meta_desc_event_categories', 'enable_event_categories');
	/*------------------ADMIN-------------------------- */

	// insert data
	public function insert($data_pd) {
		$this::create($data_pd);
	}
	// get products homes
	public function getHomeEventCatAd() {
		$listEventCat = $this
			->orderBy('ordering_event_categories', 'asc')
			->get();
		return $listEventCat;
	}
	// get products update
	public function getEventCatUpdate($id) {
		$listEventCat = $this
			->where('id_event_categories', '=', $id)
			->first();
		return $listEventCat;
	}
	// upadate
	public function updateEventCat($id, $data_pd) {
		DB::table('event_categories')
			->where('id_event_categories', '=', $id)
			->update($data_pd);
	}
	//enable products
	public function enable($id, $status) {
		if ($status == 0) {
			$status = 1;
		} else {
			$status = 0;
		}

		$this
			->where('id_event_categories', '=', $id)
			->update(array(
				'enable_event_categories' => $status,
			));
	}
	//remove products Cat
	public function removeEventCat($id) {
		$this
			->where('id_event_categories', '=', $id)
			->delete();
	}
	public function SetNullProducts($id) {
		DB::table('products')
			->where('Categories_id', $id)
			->update(array('Categories_id' => 0));
	}
	public function orderCat($id, $value) {
		$this->where('id_event_categories', '=', $id)
			->update(array('ordering_event_categories' => $value));
		return true;
	}
	// count products in categories
	public function totalProducts($idEventCategories) {
		$qty = $this
			->join('products', 'idEventCategories', '=', 'products.categories_id')
			->where('idEventCategories', '=', $idEventCategories)
			->get();
		return count($qty);
	}
	/*------------------USER-------------------------- */
	// get Id ordering min
	public function getIdOrder() {
		$value = $this->min('ordering_event_categories');
		return $value;
	}

	public function getAllEventCat() {
		$listEventCat = $this
			->orderBy('ordering_event_categories', 'asc')
			->where('enable_event_categories', '=', 1)
			->get();
		return $listEventCat;
	}
	// get all products Categories child
	public function getAllCatChild() {
		$listEventCat = $this
			->orderBy('ordering_event_categories', 'asc')
			->where('enable_event_categories', '=', 1)
			->where('parentid', '!=', 0)
			->get();
		return $listEventCat;
	}
	// get all products Categories child
	public function getAllEventCatChild($idEventCategories) {
		$listEventCat = $this
			->orderBy('ordering_event_categories', 'asc')
			->where('enable_event_categories', '=', 1)
			->where('parentid', '=', $idEventCategories)
			->get();
		return $listEventCat;
	}
	// get Products Categories ordering Max
	public function getEventCatFirst() {
		$id_max = $this->min('ordering_event_categories');
		$categories = $this
			->where('ordering_event_categories', '=', $id_max)
			->first();
		return $categories;
	}
	// get products categories have alias
	public function getEventCatDetails($alias) {
		$listEventCat = $this
			->where('alias_event_categories', '=', $alias)
			->first();
		return $listEventCat;
	}
	// get list id products Cat
	public function getArrayParentId() {
		$list_cat = $this->get();
		$data = array();
		$i = 0;
		foreach ($list_cat as $key => $value) {
			if ($list_cat[$key]->parentid != 0) {
				$data[$i] = $list_cat[$key]->parentid;
				$i++;
			}
		}
		if (count($data) > 0) {
			return $data;
		} else {
			$data[0] = 0;
			return $data;
		}
	}
	// get list id products Cat Root
	public function getArrayParentRoot() {
		$list_cat = $this->get();
		$data = array();
		$i = 0;
		foreach ($list_cat as $key => $value) {
			if ($list_cat[$key]->parentid == 0) {
				$data[$i] = $list_cat[$key]->idEventCategories;
				$i++;
			}
		}
		if (count($data) > 0) {
			return $data;
		} else {
			$data[0] = 0;
			return $data;
		}
	}
	// get all products Categories child != $idEventCategories
	public function getEventCatChild($idEventCategories) {
		$listEventCat = $this
			->orderBy('ordering_event_categories', 'asc')
			->where('enable_event_categories', '=', 1)
			->where('parentid', '=', $idEventCategories)
			->get();
		return $listEventCat;
	}
	// get products_cat is hit display index
	public function getEventCatHit() {
		$data = $this->getArrayParentRoot();
		$listEventCat = $this
			->orderBy('ordering_event_categories', 'asc')
			->whereIn('parentid', $data)
			->get();
		return $listEventCat;
	}
	// get array id producstCategories
	public function getArrayid() {
		$result = $this->get();
		$data = array();
		if (count($result) > 0) {
			foreach ($result as $key => $value) {
				$data[$key] = $result[$key]->parentid;
			}
		} else {
			$data[0] = 0;
		}

		return $data;
	}
	// check if categories is parent
	public function checkCategoriesParent($idEventCategories) {
		$result = $this
			->where('idEventCategories', '!=', $idEventCategories)
			->get();
		$check = 0;
		foreach ($result as $key => $value) {
			if ($result[$key]->parentid == $idEventCategories) {
				$check = 1;
				break;
			}
		}
		return $check;
	}
	// get products categories have id
	public function getEventCatDetailsID($idEventCategories) {
		$listEventCat = $this
			->where('idEventCategories', '=', $idEventCategories)
			->first();
		return $listEventCat;
	}
}