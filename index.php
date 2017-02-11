<?php

echo $_GET["test"];

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "classes/Autoloader.php";

Route::get("/", function(){
	echo "Welcome to the multichain API";
});

Route::get("/products/all", 'ProductController', function(Controller $ProductController){
	$ProductController->all();
});

Route::post("/products/search", 'ProductController', function(Controller $ProductController){
	$q = $_POST["q"] ?? [];
	$ProductController->search($q);
});

Route::get('/users/create', 'ProductController', function(Controller $ProductController){
	$ProductController->show("test");
});

