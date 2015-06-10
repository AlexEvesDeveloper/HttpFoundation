<?php

namespace Project\Library;

class Request
{
	public $query;

	public $request;

	public $attributes;

	public $cookies;

	public $files;

	public $server;

	public $headers;

	public function initialize(
		array $query = array(), 
		array $request = array(), 
		array $attributes = array(),
		array $cookies = array(),
		array $files = array(),
		array $server = array()
	)
	{
		$this->query = new ParameterBag($query);
		$this->request = new ParameterBag($request);
		$this->attributes = new ParameterBag($attributes);
		$this->server = new ServerBag($server);
		$this->headers = new HeaderBag($this->server->getHeaders());
	}
}
