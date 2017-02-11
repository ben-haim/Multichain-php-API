<?php 

class Route
{
	private function __construct(){}

	// [Method][route, closure]
	private static $_methods = [

	];

	private static function addMethod(string $method){
		if(!isset(self::$_methods[$method])){
			self::$_methods[$method] = [];
		}
	}

	public static function __callStatic(string $name, array $args){
		$method = strtoupper($name);
		self::addMethod($method);
		if (sizeof($args) == 2) {
			self::$_methods[$method][$args[0]] = $args[1];
		}
		else if (sizeof($args) == 3) {
			self::$_methods[$method][$args[0]] = [
				"controller" => $args[1],
				"callback" => $args[2]
			];
		}
	}

	public static function exec(){
		API::validate();
		$uri = $_SERVER["REQUEST_URI"];
		$method = $_SERVER["REQUEST_METHOD"];
		if(isset(self::$_methods[$method]) && isset(self::$_methods[$method][$uri])){
			$callback = self::$_methods[$method][$uri];
			if(is_callable($callback)){
				$callback();
			}
			else{
				$controller = 'controllers\\'.$callback['controller'];
				$callback['callback'](new $controller());
			}
			return;
		}
		API::error(404);
	}
}