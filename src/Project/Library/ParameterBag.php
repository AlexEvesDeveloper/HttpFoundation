<?php

namespace Project\Library;

class ParameterBag
{
	protected $parameters;

	public function __construct(array $parameters = array())
	{
		$this->parameters = $parameters;
	}

	public function get($path, $default = null, $deep = false)
	{
		return array_key_exists($path, $this->parameters) ? $this->parameters[$path] : $default;
	}
}