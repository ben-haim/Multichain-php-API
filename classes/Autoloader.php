<?php
	class Autoloader {
	    static public function loader($className) {
	        $filename = __DIR__."/".str_replace('\\', '/', $className) . ".php";
	        if (file_exists($filename)) {
	            require_once($filename);
	            if (class_exists($className)) {
	                return true;
	            }
	        }
	        return false;
	    }
	}
	spl_autoload_register('Autoloader::loader');
	register_shutdown_function('Route::exec');
?>
