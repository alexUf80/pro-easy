<?php

namespace App\Controllers;

use App\Controller;
use \App\Models\Product_groups;

class Crm extends Controller 
{

    protected function assign($view)
	{
		if(isset($_POST)){
			if($_POST["allPwd"] == '1111'){
				setcookie("uid_all", 'lkfOhpodifh8ldjhf8er9fjhksfwi', time() + 1200);
				$view->assign('in', 'in');
			}
		}

		if (isset($_COOKIE["uid_all"]) && $_COOKIE["uid_all"] == 'lkfOhpodifh8ldjhf8er9fjhksfwi'){
			setcookie("uid_all", 'lkfOhpodifh8ldjhf8er9fjhksfwi', time() + 1200);
		}

		$orders = \App\Models\Orders::get_all_orders();
		$view->assign('orders', $orders);
		$products_tmp = \App\Models\Products::get_all_products();
		$products = [];
		foreach ($products_tmp as $product_key => $product) {
			$products[$product['id']] = $product;
		}
		$view->assign('products', $products);
	}

}
