<?php

namespace models;

use \PDO;
use \Model;
use \Connect;
class Product extends Model
{
	
	protected function __construct(){}

	static function all(){
		$conn = Connect::getInstance();
		$q = "SELECT * FROM products";

		$stmt = $conn->_dbh->prepare($q);

		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}