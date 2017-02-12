<?php

namespace models;

use \Chain;
use \Connect;
use \Model;
use \PDO;

class Blog extends Model
{
	
	protected $setable = [
		"chain"
	];

	public static function save(string $tx){
		$dbh = Connect::getInstance()->_dbh;
		$q = "INSERT INTO transactions(txid) VALUES (:tx)";

		$stmt =	$dbh->prepare($q);

		$stmt->bindValue(":tx", $tx);

		$stmt->execute();
	}

	public static function get($id){
		$dbh = Connect::getInstance()->_dbh;
		$q = "SELECT txid FROM transactions WHERE id = :id";

		$stmt =	$dbh->prepare($q);

		$stmt->bindValue(":id", $id);

		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}