<?php

require_once __DIR__.'/../../../vendor/autoload.php';

use Project\Library\ParameterBag;

class ParameterBagTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @covers Project\Library\ParameterBag::get
	 */
	public function testGet()
	{
		$bag = new ParameterBag(array('foo' => 'bar'));

		$this->assertEquals('bar', $bag->get('foo'), '->get() gets the value of the parameter');
		$this->assertEquals('default', $bag->get('unknown', 'default'), '->get() returns the second argument as default if the key does not exist');
		$this->assertNull($bag->get('unknown'), '->get() returns null parameter is not found and default is not passed');
	}
}