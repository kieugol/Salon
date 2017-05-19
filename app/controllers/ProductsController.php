<?php
class ProductsController extends \BaseController {
	//protected $layout = 'user.main';
	protected $layout = 'user.main';
	public $data = array();

	// load products details
	public function LoadProductsDetails($alias, $idProducts) {
		$products = new Products();

		$data['products_details'] = $tmp = $products->getProductsDetails($idProducts);
		if (count($data['products_details']) > 0) {
		}
		// end insert view
		$data['list_gallery'] = $products->GetGallery($alias);
		$data['list_products_categories'] = $products->getProductsSameCategories($tmp['idProductsCategories'], $tmp['idProducts']);
		// send data to view
		$this->layout->content = View::make('user.body.products_dir.products_details', $data);
	}
	// load products of Categories alias
	public function LoadProducstCategories($alias_products_categories) {
		$menu = new Menu();
		$products = new Products();
		$pdCat = new ProductsCat();
		$data['alias_active_parent'] = "";
		$data['alias_active_child'] = "";
		$data['productsCat_details'] = $details_cat = $pdCat->getProductsCatDetails($alias_products_categories);
		// checking alias  menu
		$data['child_cat'] = $child_cat = $pdCat->getProductsCatDetailsID($details_cat['parentid']);
		$data['parent_cat'] = $pdCat->getProductsCatDetailsID($child_cat['parentid']);
		// checking active menu
		$data['alias_active_child'] = $alias_products_categories;
		$data['alias_active_parent'] = $child_cat['alias_products_categories'];
		// send data to view
		$data['list_products'] = $products->getProductsCategoriesAlias($alias_products_categories);
		return View::make('user.body.products_dir.products_categories', $data);
	}
	
	public function LoadAllProducts() {
		$products = new Products();
		$data['list_products'] = $products->getAllProducts();
		return View::make('user.body.products_dir.products_all', $data);
	}
	// load all categories have alias_products categories
	public function LoadCategories($alias_products_categories) {
		$pdCat = new ProductsCat();
		$adv = new Adv();
		$idProductsCategories = 0;
		$check = 0;
		$data['alias_active_parent'] = "";
		$data['alias_active_child'] = "";
		$data['productsCat_details'] = $details_cat = $pdCat->getProductsCatDetails($alias_products_categories);
		// checking alias  menu
		$data['child_cat'] = $child_cat = $pdCat->getProductsCatDetailsID($details_cat['parentid']);
		$data['parent_cat'] = $pdCat->getProductsCatDetailsID($child_cat['parentid']);
		if (count($details_cat) > 0) {
			$idProductsCategories = $details_cat['idProductsCategories'];
		}

		//checking if categories is parent
		$check = $pdCat->checkCategoriesParent($idProductsCategories);
		if ($check == 0) {
			return $this->LoadProducstCategories($alias_products_categories);
		} else {
			//checking active menu
			$data['alias_active_parent'] = $details_cat['alias_products_categories'];
			//end checking active menu
			$data['list_adv'] = $adv->getAlladv();
			$data['list_cat_child'] = $pdCat->getProductsCatChild($idProductsCategories);
			return $this->layout->content = View::make('user.body.products_dir.categories', $data);
		}
		return Redirect::to('/');
	}

}