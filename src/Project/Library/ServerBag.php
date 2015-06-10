<?php

namespace Project\Library;

class ServerBag extends ParameterBag
{
	public function getHeaders()
	{
		$headers = array();
		$contentHeaders = array('CONTENT_LENGTH' => true, 'CONTENT_MD5' => true, 'CONTENT_TYPE' => true);

		foreach ($this->parameters as $key => $value)
		{
			if (0 === strpos($key, 'HTTP_')) {
				$headers[substr($key, 5)] = $value;
			}
			else if (isset($contentHeaders[$key])) {
				$headers[$key] = $value;
			}

			if (isset($this->parameters['PHP_AUTH_USER'])) {
				$headers['PHP_AUTH_USER'] = $this->parameters['PHP_AUTH_USER'];
				$headers['PHP_AUTH_PW'] = isset($this->parameters['PHP_AUTH_PW']) ? $this->parameters['PHP_AUTH_PW'] : '';
			}

			if (isset($headers['PHP_AUTH_USER'])) {
				$headers['AUTHORIZATION'] = sprintf('Basic %s', base64_encode($headers['PHP_AUTH_USER'].':'.$headers['PHP_AUTH_PW']));
			}
			else if (isset($headers['PHP_AUTH_DIGEST'])) {
				$headers['AUTHORIZATION'] = $this->parameters['PHP_AUTH_DIGEST'];
			}
		}

		return $headers;
	}
}