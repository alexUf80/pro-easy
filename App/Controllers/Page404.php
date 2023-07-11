<?php

namespace App\Controllers;

use App\Controller;

class Page404 extends Controller
{
	protected function assign($view)
	{
        $homePath = \App\Controllers\ControllerFunctions::homePath();
		$view->assign('homePath', $homePath);
	}
}
