<?php

namespace App\Models;

use App\Model;
use App\Db;

class Products extends Model
{

	protected const TABLE = 'products';


	public function get_all_products() {
		$db = new Db;
		$ret = $db->querySelectClass('SELECT * FROM products', [], 'Products');		
		return $ret;
	}

	
}
