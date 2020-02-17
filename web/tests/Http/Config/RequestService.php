<?php

namespace Test\Http\Config;

use GuzzleHttp\Client;

class RequestService
{
	public $http;

	function __construct()
	{
		$this->http = new Client;		
	}

	public function handel($method, $url, $data=null)
	{
		$data ? $data : json_encode($data);

		$response = $this->http->request($method, $url, $data);
		return json_decode($response->getBody(), true);
	}


}