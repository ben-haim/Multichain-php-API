<?php 

class Model
{
	protected static $whereValues = [];


	private $constructing = true;
	protected $data = [];

	protected function __construct(array $values){
		foreach ($values as $key => $value) {
			$this->$key = $value;
		}
		unset($this->constructing);
	}


	function __set($name, $value){
		if(($this->setable && in_array($name, $this->setable)) || $this->constructing){
			$this->data[$name] = $value;
		}
	}


	function __get($name){
		if (isset($this->data[$name])) {
			return $this->data[$name];
		}
	}

	protected static function parseWhere(array $keys): string{
		$where = null;
		foreach ($keys as $key => $values) {
			$where = ($where ? $where.") AND (" : "WHERE (`").$key."`";
			foreach ($values as $subKey => $value) {
				self::$whereValues[":key".$subKey] = $value;
				$where .= " LIKE :key".$subKey." OR ".$key;
			}
			$where = preg_replace("/OR ".$key."$/", "", $where);
		}
		return $where.")";
	}

	protected static function parseWhereLike(array $keys): string{
		$where = null;
		foreach ($keys as $key => $values) {
			$where = ($where ? $where.") AND (" : "WHERE (`").$key."`";
			foreach ($values as $subKey => $value) {
				self::$whereValues[":key".$subKey] = $value;
				$where .= " LIKE ".Connect::getInstance()->_dbh->quote("%".$value."%")." OR ".$key;
			}
			$where = preg_replace("/OR ".$key."$/", "", $where);
		}
		return $where.")";
	}
}