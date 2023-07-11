<?php

namespace App\Controllers;

use App\Controller;
use \App\Models\Product_groups;

class Home extends Controller 
{

    protected function assign($view)
	{
		$homePath = \App\Controllers\ControllerFunctions::homePath();
		$view->assign('homePath', $homePath);

		$productsGroups = \App\Models\ProductsGroups::get_all_products_groups();
		$view->assign('productsGroups', $productsGroups);
		$products = \App\Models\Products::get_all_products();
		$view->assign('products', $products);

		$configArr = (include __DIR__ . '/../../config.php');
		$view->assign('dir', $configArr['dir']);
	}

}
