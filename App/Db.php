<?php

namespace App;

use Exception;

class Db
{

	protected $configArr;

	public function __construct()
	{
		
		try {

			$this->configArr = (include __DIR__ . '/../config.php');

			$this->pdo_s = new \PDO('mysql:host=' . $this->configArr['host'] .
			'; dbname=' . $this->configArr['dbname'], $this->configArr['user'], 
			$this->configArr['password']);

		} catch (Exception $e) {
			echo('Ошибка подключения к базе данных');
			die();
		}
		
	}

	public function execute($sql, $data = [])
	{
		try {

			$sth = $this->pdo_s->prepare($sql);	
			$res = $sth->execute($data);	
			if (!$res) {
				throw new Exception("Ошибка запроса к базе данных");
			}

		} catch (Exception $e) {
			
			echo('Ошибка запроса к базе данных1');
			die();
		
		}
	}

	public function querySelectClass($sql, $data = [], $class)
	{
		try {

			$sth = $this->pdo_s->prepare($sql);
			$res = $sth->execute($data);
			if (!$res) {
				throw new Exception("Ошибка запроса к базе данных");
			}
			// return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
			return $sth->fetchAll(\PDO::FETCH_ASSOC);

		} catch (Exception $e) {
			
			echo('Ошибка запроса к базе данных');
			die();
			
		}
	}

}
