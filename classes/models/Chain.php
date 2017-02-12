<?php

namespace models;

use \PDO;
use \Model;
use \Connect;
class Chain extends Model
{

	protected $setable = [
		"name"
	];


	private static $user = "multichainrpc";
	private static $password = "GCY7FeJxvVk56hEzaAsHTRT6SrR88gj7DFWKu1x3uUeu";
	private static $url = "127.0.0.1:5792";


	protected function __construct(){}

	static function setParams($ch, $payload){
		curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, self::$user.':'.self::$password);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: '.strlen($payload)
        ));
	}

	static function push(string $name, string $data){
		$payload = '{"jsonrpc": "1.0", "id":"", "method": "publish", "params": ["Blogchain", "'.$name.'", "'.bin2hex($data).'"] }';
		$ch=curl_init(self::$url);
        
        self::setParams($ch, $payload);

        $response=curl_exec($ch);
        
        $result=json_decode($response, true);
        
        return $result["result"];
	}

	static function pull(string $tx){
		$payload = '{"jsonrpc": "1.0", "id":"", "method": "getstreamitem", "params": ["Blogchain", "'.$tx.'"] }';
		$ch=curl_init(self::$url);
        
        self::setParams($ch, $payload);

        $response=curl_exec($ch);
        
        $result=json_decode($response, true);
       
        return hex2bin($result["result"]["data"]);
	}
}
