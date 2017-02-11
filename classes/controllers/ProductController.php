<?php 

namespace controllers;

use \API;
use \models\Product as Product;
class ProductController{
	
	public function __construct(){}

	function all(){
		API::json(Product::all());
	}

	function search(){
		API::json(Product::apiSearchLike($_POST["q"] ?? []));
	}
}