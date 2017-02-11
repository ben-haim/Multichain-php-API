<?php 

namespace controllers;

use \API;
use \Controller;
use \models\Product as Product;
class ProductController extends Controller
{
	
	function __construct()
	{
		
	}

	function all(){
		API::json(Product::all());
	}

	function search(array $keys){
		API::json(Product::apiSearchLike($keys));
	}
}