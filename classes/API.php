<?php 


class API
{

	static $_key;

	protected function __construct(string $key){

	}

	private static function allowHeaders(){
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: API_KEY, Content-Type");
	}

	public static function validate(){	
		self::allowHeaders();
		$headers = getallheaders();
		if (!self::validateKey($headers["API_KEY"])){
			API::error(403);
		}
	}

	public static function validateKey(string $key): bool{
		if ($key) {
			$dbh = Connect::getInstance()->_dbh;
			$q = "SELECT api FROM users WHERE api = :key";
			$stmt = $dbh->prepare($q);
			$stmt->bindValue(":key", $key, PDO::PARAM_STR);
			$stmt->execute();
			if ($stmt->rowCount()) {
				self::$_key = $key;
				return true;
			}
		}
		return false;
	}

	public static function json($data = []){
		header('Content-Type: application/json');
		header("HTTP/1.0 200 Ok");
		echo json_encode($data);
		exit();
	}

	public static function error(int $code){
		switch ($code) {
			case 403:
				header("HTTP/1.0 403 Not Found");
				break;
			case 404:
				header("HTTP/1.0 404 Not Found");
				break;
			default:
				header("HTTP/1.0 520 Unknow Error");
				break;
		}
		exit();
	}

	public static function generateKey(): string{
		return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
			mt_rand( 0, 0xffff ),
			mt_rand( 0, 0x0fff ) | 0x4000,
			mt_rand( 0, 0x3fff ) | 0x8000,
			mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		);
	}
}