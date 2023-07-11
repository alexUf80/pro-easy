<?php

namespace App\Models;

use App\Model;
use App\Db;

class Orders extends Model
{

	protected const TABLE = 'orders';
	public $address;
	public $tel;
	public $products;

	public function get_all_orders() {
		$db = new Db;
		$ret = $db->querySelectClass('SELECT * FROM orders', [], 'Products');		
		return $ret;
	}

}
