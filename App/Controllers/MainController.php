<?php

namespace App\Controllers;

use \App\Db;
use \App\View;
use \App\Models\Product;

class MainController
{

	protected $configArr;

	public function __invoke()
	{

		$this->view = new View;
		$before = [];
		$after = [];

		$db = new Db;
		$ctrlArray = \App\Controllers\ControllerFunctions::ctrlArray();
		// $homePath = \App\Controllers\ControllerFunctions::homePath();
		
		// route
		$ctrl = 'home';
		
		$before = ['head', 'header'];
		$after = ['footer'];

		if (!count($ctrlArray) == 0 && $ctrlArray[0] != '') {
			$ctrl = $ctrlArray[0];
		}
		
		if ($ctrl == 'home'){
			$before[] = 'about';
		}
		
		$class = '\\App\\Controllers\\' . ucfirst($ctrl);
		
		if ($ctrl == 'crm') {
			$before = [];
			$after = [];
		}

		if (class_exists($class)) {
			$ctrl = new $class;
		} else {
			$ctrl = new \App\Controllers\Page404;
		}

		$ctrl($this->view, $before, $after);
	}
}
