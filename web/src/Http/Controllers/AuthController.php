<?php

namespace Emeka\Http\Controllers;

use Emeka\Http\Services\JWTService;

class AuthController
{
	/**
	 * JWTService Service
	 * @var JWTService
	 */
	protected $jwtService;

	function __construct
	(
		JWTService $jwtService
	)
	{
		$this->jwtService = $jwtService;
	}

	/**
	 * handle login request
	 * @return json|null
	 */
	public function login()
	{
		return response()->httpCode(200)->json([
			"token" => $this->jwtService->generate(),
			"message" => "mini auth successful 😋",
			"status" => 200
		]);
	}
}