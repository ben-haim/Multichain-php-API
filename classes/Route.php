<?php 

class Route
{
	private function __construct(){}

	private static $_methods = [];

	private static function addMethod(string $method){
		if(!isset(self::$_methods[$method])){
			self::$_methods[$method] = [];
		}
	}

	public static function __callStatic(string $name, array $args){
		$method = strtoupper($name);
		self::addMethod($method);

		$tmp = explode("@", $args[1]);

		self::$_methods[$method][$args[0]] = [
			'\controllers\\'.$tmp[0],
			$tmp[1]
		];

	}

	public static function exec(){
		API::validate();
		$uri = $_SERVER["REQUEST_URI"];
		$method = $_SERVER["REQUEST_METHOD"];
		if(isset(self::$_methods[$method]) && isset(self::$_methods[$method][$uri])){
			$class = new self::$_methods[$method][$uri][0]();
			call_user_func(array($class, self::$_methods[$method][$uri][1]), []);
			return;
		}
		API::error(404);
	}
}