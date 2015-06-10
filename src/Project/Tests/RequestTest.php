<?php

require_once __DIR__.'/../../../vendor/autoload.php';

use Project\Library\Request;

class RequestTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @covers Project\Library\Request::__construct
	 */
	public function testConstructor()
	{
		$this->testInitialize();
	}

	/**
	 * @covers Project\Library\Request::initialize
	 */
	public function testInitialize()
	{
		$request = new Request();

		$request->initialize(array('foo' => 'bar'));
		$this->assertEquals('bar', $request->query->get('foo'), '->initialize() takes an array of query parameters as its first argument');		

		$request->initialize(array(), array('foo' => 'bar'));
		$this->assertEquals('bar', $request->request->get('foo'), '->initialize() takes an array of request parameters as its second argument');	
	
		$request->initialize(array(), array(), array('foo' => 'bar'));
		$this->assertEquals('bar', $request->attributes->get('foo'), '->initialize() takes an array of request parameters as its third argument');

		$request->initialize(array(), array(), array(), array(), array(), array('HTTP_FOO' => 'bar'));
		$this->assertEquals('bar', $request->headers->get('FOO'), '->initialise() takes an array of header parameters as its sixth argument');
	}
}
