<?php

namespace App;

use \App\View;

class Controller
{
	public function __invoke($view, $before=[], $after=[])
	{
		$this->assign($view);

		foreach ($before as $value) {
			$view->assign($value, '/Templates/');
		}
		foreach ($after as $value) {
			$view->assign($value, '/Templates/', false);
		}
		
		$classNameArray = explode('\\',static::class);
		$template = end($classNameArray);
		
		$view->display(__DIR__ . '/Templates/' .strtolower($template).'.php', strtolower($template));
	}


}
