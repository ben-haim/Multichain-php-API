<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "classes/Autoloader.php";
 
Route::post("/create", 'BlogController@create');
Route::post("/pull", 'BlogController@pull');
Route::post("/get", 'BlogController@byId');