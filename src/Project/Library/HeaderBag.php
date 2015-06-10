<?php

namespace Project\Library;

class HeaderBag
{
	protected $headers = array();

	public function __construct(array $headers = array())
	{
		foreach($headers as $key => $values)
		{
			$this->set($key, $values);
		}
	}

	public function set($key, $values, $replace = true)
	{
		$key = strtr(strtolower($key), '_', '-');

		$values = array_values((array) $values);

		if (true === $replace || ! isset($this->headers[$key])) {
			$this->headers[$key] = $values;
		}
		else {
			$this->headers[$key] = array_merge($this->headers[$key], $values);
		}

	}

	public function get($key, $default = null, $first = true)
	{
		$key = strtr(strtolower($key), '_', '-');

		return count($this->headers[$key]) ? $this->headers[$key][0] : $default;
	}
}