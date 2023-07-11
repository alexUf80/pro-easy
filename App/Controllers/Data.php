<?php

namespace App\Controllers;

use App\Controller;
use App\Models\Product;

class Data extends Controller 
{

    protected function assign($view)
	{
		$configArr = (include __DIR__ . '/../../config.php');
		$view->assign('dir', $configArr['dir']);

		$data = [];
		$dataToDo = \App\Models\Product::findAll();
		foreach ($dataToDo as $key => $value) {
			$data[] = json_decode(json_encode($dataToDo[$key]));
		}
		$view->assign('data', $data);
	}

}
