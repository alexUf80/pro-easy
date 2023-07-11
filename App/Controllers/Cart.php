<?php

namespace App\Controllers;

use App\Controller;
use \App\Models\Product_groups;

class Cart extends Controller 
{

    protected function assign($view)
	{
		if(isset($_POST) && count($_POST) > 0){
			$this->address = $_POST['popup-address'];
			$this->tel = $_POST['popup-tel'];
			$this->products = $_POST['popup-prod'];

			if ($_POST['popup-cap'] != 'q123') {
				$view->assign('address', $this->address);
				$view->assign('tel', $this->tel);
				$view->assign('posted', 1);
				return;
			}

			if($this->address && (strripos($this->tel, '_') == 0)){
				$orders = new \App\Models\Orders;

				$orders->address = $this->address;
				$orders->tel = $this->tel;
				$orders->products = $this->products;
				$orders->insert();

				$view->assign('posted', 2);
			}
			else{
				$view->assign('address', $this->address);
				$view->assign('tel', $this->tel);
				$view->assign('posted', 1);
			}
		}

		$homePath = \App\Controllers\ControllerFunctions::homePath();
		$view->assign('homePath', $homePath);

		$products = \App\Models\Products::get_all_products();
		$view->assign('products', $products);
	}

}
