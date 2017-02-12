<?php 

/**
* 
*/
class Connect
{
	private static $_instance;

	public $_dbh;

	private $_user = "root";
	private $_pass = "Melkpak32";

	private function __construct(){
		$this->_dbh = new PDO('mysql:host=localhost;dbname=blogchain', $this->_user, $this->_pass);
	}

	static function getInstance(): Connect{
		if(!self::$_instance){
			self::$_instance = new self();
		}
		return self::$_instance;
	}
}