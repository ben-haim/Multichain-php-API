<?php

namespace models;

use \PDO;
use \Model;
use \Connect;
class Product extends Model
{
	
	protected $setable = [
		"name"
	];

	protected function __construct(){}

	static function all(){
		$conn = Connect::getInstance();
		$q = "SELECT * FROM products";

		$stmt = $conn->_dbh->prepare($q);

		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	static function byId(int $id): Product{
		$conn = Connect::getInstance();
		$q = "SELECT * FROM products WHERE id = :id";

		$stmt = $conn->_dbh->prepare($q);

		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	static function apiSearchLike(array $keys){
		$conn = Connect::getInstance();

		$q = "SELECT * FROM products ".Model::parseWhereLike($keys);

		$stmt = $conn->_dbh->prepare($q);

		foreach (Model::$whereValues as $key => $value) {
			$stmt->bindParam($key, $value);
		}

		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}