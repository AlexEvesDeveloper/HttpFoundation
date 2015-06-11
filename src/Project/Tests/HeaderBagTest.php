<?php

require_once __DIR__.'/../../../vendor/autoload.php';

use Project\Library\HeaderBag;

class HeaderBagTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @covers Project\Library\HeaderBag::__construct
	 */
	public function testConstructor()
	{
		$bag = new HeaderBag(array('foo' => 'bar'));
        
        $this->assertEquals('bar', $bag->get('foo'));
    }

    /**
     * @covers Project\Library\HeaderBag::get
     */
    public function testGet()
    {
        $bag = new HeaderBag(array('foo' => 'bar', 'content-length' => 'fizz'));

        $this->assertEquals('bar', $bag->get('foo'), '->get returns current value');
        $this->assertEquals('bar', $bag->get('FoO'), '->get is case insensitive');
        $this->assertEquals('fizz', $bag->get('CONTENT_LENGTH'), '->get converts to hyphenated lower case');
        $this->assertEquals(array('bar'), $bag->get('foo', null, false), '->get returns the value as an array');
    
        // defaults
        $this->assertNull($bag->get('none'), '->get unknown values returns null');
        $this->assertEquals('default', $bag->get('none', 'default'), '->get unknown value returns default if given');
        $this->assertEquals(array('default'), $bag->get('none', 'default', false), '->get unknown values returns default as array');

        // merging
        $bag->set('foo', 'bor', false);
        $this->assertEquals('bar', $bag->get('foo'), '->get returns the current value even when there are more');
        $this->assertEquals(array('bar', 'bor'), $bag->get('foo', null, false), '->get returns an array of all values');
    }

        /**
     * @covers Project\Library\HeaderBag::set
     */
    public function testSet()
    {
        $bag = new HeaderBag();

        $bag->set('CONTENT_TYPE', 'buzz');
        $this->assertEquals('buzz', $bag->get('content-type'), '->set converts key to hyphenated lower case');
    }
}