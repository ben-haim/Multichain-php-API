<?php 
declare(strict_types=1);

require_once "classes/Connect.php";

use PHPUnit\Framework\TestCase;

class apiValidateText extends TestCase
{
	
	public function testIsValid()
    {
    	$this->assertTrue(API::validateKey("b33e3110-f021-11e6-bc64-92361f002671"));
    	$this->assertFalse(API::validateKey("b33daewadwadwFAEW"));
	}
}