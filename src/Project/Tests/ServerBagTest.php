<?php

require_once __DIR__.'/../../../vendor/autoload.php';

use Project\Library\ServerBag;

class ServerBagTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @covers Project\Library\ServerBag::getHeaders
	 */
	public function testShouldExtractHeadersFromServerArray()
	{
		$server = array(
            'SOME_SERVER_VARIABLE' => 'value',
            'SOME_SERVER_VARIABLE2' => 'value',
            'ROOT' => 'value',
            'HTTP_CONTENT_TYPE' => 'text/html',
            'CONTENT_LENGTH' => '0',
            'HTTP_ETAG' => 'asdf',
            'PHP_AUTH_USER' => 'foo',
            'PHP_AUTH_PW' => 'bar',
        );

        $bag = new ServerBag($server);

        $this->assertEquals(array(
        	'CONTENT_TYPE' => 'text/html',
        	'CONTENT_LENGTH' => '0',
        	'ETAG' => 'asdf',
        	'AUTHORIZATION' => 'Basic '.base64_encode('foo:bar'),
        	'PHP_AUTH_USER' => 'foo',
        	'PHP_AUTH_PW' => 'bar'
        ), $bag->getHeaders());
	}
}