<?php

namespace App;

class View
{
	protected $data_before = [];
	protected $data_after = [];

	public function assign($key, $data, $before = true)
	{
		if ($before == true) {
			$this->data_before[$key] = $data;
		}
		else{
			$this->data_after[$key] = $data;
		}
	}
	
	public function display($template, $templateName)
	{
		echo $this->render($template, $templateName);
	}
	
	public function render($template, $templateName='')
	{

		foreach ($this->data_before as $name => $value) {
			if($value != '/Templates/'){
				${$name} = $value;
			}
		}

		if ($templateName != '') {
			$script = $templateName;
		}

		ob_start();
		foreach ($this->data_before as $name => $value) {
			if($value == '/Templates/'){
				include __DIR__ . '/Templates/' .strtolower($name).'.php';
			}
		}
	
		include $template;
		
		foreach ($this->data_after as $name => $value) {
			include __DIR__ . '/Templates/' .strtolower($name).'.php';
		}
		
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	public function assignConst($replaseArr = [])
	{
		$this->assign('path', \App\Controllers\ControllerFunctions::path());
		$this->assign('homePath', \App\Controllers\ControllerFunctions::homePath());
	}

	public function renderAndAssign($template, $path)
	{
		$$template = $this->render(__DIR__ . $path . $template . '.php');
		$this->assign($template, $$template);
	}

}
