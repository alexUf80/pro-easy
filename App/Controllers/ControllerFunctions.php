<?php

namespace App\Controllers;

class ControllerFunctions
{
	
	protected static function subDomianGet()
	{
		$subDomain  = $_SERVER ["SCRIPT_NAME"];
		$subDomain = mb_substr($subDomain, 0, mb_strlen( $subDomain) - 9);
		
		$chars = ['\\','/'];
		
		if(strlen($subDomain) == 1 && in_array($subDomain[0], $chars)){
			$subDomain = '';
		}

		if($subDomain){
			
			if(in_array($subDomain[0], $chars)){
				$subDomain = mb_substr($subDomain, 1);
			}
			
			if(in_array($subDomain[strlen($subDomain)-1], $chars)){
				$subDomain = mb_substr($subDomain, 0, strlen($subDomain) - 1);
			}
		}

		return $subDomain;
	}

	public static function ctrlArray()
	{
		$ctrlArray = explode("/", $_SERVER['REQUEST_URI']);

		$subDomain = self::subDomianGet();
		
		$takeElementFrom = 1;
		if ($subDomain) {
			$subSubDomainCount = +substr_count($subDomain,'/') + +substr_count($subDomain,'\\');
			$takeElementFrom = 2 + +$subSubDomainCount;
		}


		return array_splice($ctrlArray, $takeElementFrom, 25);
	}
	
	public static function homePath()
	{
		$subDomain = self::subDomianGet();

		if ($subDomain) {
			$subDomain =  '/' . $subDomain;
		}
	
		return $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]  . $subDomain;
	
	}

	public static function path()
	{

		$ctrlArray = static::ctrlArray();

		$path = '';
		foreach ($ctrlArray as $key => $value) {

			$path .= ($key > 0) ? '../' : '';

		}
		return $path;
	}
}
