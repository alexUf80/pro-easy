<?php

namespace App\Models;

use App\Model;
use App\Db;

class ProductsGroups extends Model
{

	protected const TABLE = 'products_groups';

	// public $name;
	// public $visibility;

	public function get_all_products_groups() {
		$db = new Db;
		$ret = $db->querySelectClass('SELECT * FROM products_groups', [], 'ProductsGroups');		return $ret;
	}

	// public static function colCount()
	// {
	// 	return 14;
	// }

	// public function parseAndCreate($tempFile)
	// {
	// 	$this->deleteAll();

	// 	$fileStringNumber = 1;
	// 	$colCount = \App\Models\Product::colCount();

	// 	$stringCount =  count(file($tempFile)) - 1;

	// 	if (($fh = fopen($tempFile, "r")) !== false) {
	// 		while (!feof($fh)) {
	// 			$line = fgets($fh);
	// 			$lineArray = explode(";", $line);

	// 			$tooLongArray = false;
	// 			foreach ($lineArray as $key => $value) {
	// 				if ($key > $colCount - 1) {
	// 					$lineArray[$colCount - 1] .=  ';'.$value;
	// 					$tooLongArray = true;
	// 				}
	// 			}
	// 			if ($tooLongArray) {
	// 				array_splice($lineArray, 14);
	// 			}
				
	// 			if ($fileStringNumber != 1) {
	// 				$this->code = $lineArray[0];
	// 				$this->name = $lineArray[1];
	// 				$this->level1 = $lineArray[2];
	// 				$this->level2 = $lineArray[3];
	// 				$this->level3 = $lineArray[4];
	// 				$this->price = $lineArray[5];
	// 				$this->priceSP = $lineArray[6];
	// 				$this->count = $lineArray[7];
	// 				$this->propertyFields = $lineArray[8];
	// 				$this->jointPurchases = $lineArray[9];
	// 				$this->unit = $lineArray[10];
	// 				$this->picture = $lineArray[11];
	// 				$this->displayOmMain = $lineArray[12];
	// 				$this->description = $lineArray[13];
	// 				$this->insert();
	// 			}
	
	// 			$fileStringNumber++;
	// 		}
			
	// 		fclose($fh);
	// 	}
	// }

	// public function getRows($file) {
	// 	$handle = fopen($file, 'r');
	// 	if ($handle === false) {
	// 		throw new Exception();
	// 	}
	// 	while (feof($handle) === false) {
	// 		yield fgetcsv($handle, 2000, ";");
	// 	}
	// 	fclose($handle);
	// }

}
