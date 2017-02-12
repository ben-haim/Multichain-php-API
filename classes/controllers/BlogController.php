<?php 

namespace controllers;

use \API;
use \models\Blog as Blog;
use \models\Chain as Chain;
class BlogController{
	
	public function __construct(){}

	function create(){

		$payload = strlen($_POST["name"])."]".$_POST["name"].strlen($_POST["message"])."]".$_POST["message"].strlen($_POST["image"])."]".$_POST["image"];
		$tx = Chain::push($_POST["name"], $payload);

		Blog::save($tx);

		API::json();
	}

	function pull(){
		$result = Blog::get($_POST["id"]);
		API::json(Chain::pull($result["txid"]));
	}
}