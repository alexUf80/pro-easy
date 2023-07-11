<?php

namespace App;

use App\Db;

abstract class Model
{

	protected const TABLE = '';

	public $db;
	public $id;

	public function __construct()
	{
		$this->db = new Db;
	}

	public static function findAll()
	{
		$db = new Db;
		// return $db->querySelectClass('SELECT * FROM ' . static::TABLE, [], static::class);
		return $db->querySelectClass('SELECT * FROM ' . static::TABLE, [], static::class);
	}


	public function insert()
	{
		$db = new Db;
		$props = get_object_vars($this);
		$columns = [];
		$data = [];
		

		foreach ($props as $name => $value) {
			if (($name == 'id') && ($value == '') || ($name == 'db')) {
				continue;
			}
			$columns[] = $name;
			$data[$name] = $value;
		}

		$query = 'INSERT INTO ' . static::TABLE . ' (' . implode(',', $columns) . ') VALUES(:' . implode(',:', $columns) . ')';

		$ret = $this->db->execute($query, $data);
		return $ret;
	}


	// public function deleteAll()
	// {
	// 	$db = new Db;
	// 	// $query = 'DELETE FROM ' . static::TABLE ;
	// 	$query = 'TRUNCATE ' . static::TABLE ;
	// 	$db->execute($query, []);
	// }

}
