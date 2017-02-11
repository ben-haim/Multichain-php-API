<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "classes/Autoloader.php";
 
Route::get("/products/all", 'ProductController@all');

Route::post("/products/search", 'ProductController@search');

Route::post('/users/create', 'UserController@create');

