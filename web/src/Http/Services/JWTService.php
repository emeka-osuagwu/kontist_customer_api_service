<?php

namespace Emeka\Http\Services;

use Firebase\JWT\JWT;
use Emeka\Http\Services\Contracts\JWTServiceContract;

class JWTService implements JWTServiceContract
{
	/**
	 * @var jwt_key
	 */
	protected $jwt_key;

	/**
	 * @var jwt_issuer
	 */
	protected $jwt_issuer;

	/**
	 * @var jwt_issuer_at
	 */
	protected $jwt_issuer_at;

	/**
	 * @var jwt_not_before
	 */
	protected $jwt_not_before;

	/**
	 * @var jwt_expiration_time
	 */
	protected $jwt_expiration_time;

	/**
	 * @var jwt_algorithm
	 */
	protected $jwt_algorithm;

	public function __construct()
	{
		$this->jwt_key  			= getenv('JWT_KEY');
		$this->jwt_issuer     		= getenv('JWT_ISS');
		$this->jwt_issuer_at      	= getenv('JWT_IAT');
		$this->jwt_not_before      	= getenv('JWT_NBF');
		$this->jwt_audience      	= getenv('JWT_AUD');
		$this->jwt_expiration_time  = time() + 3600;
		$this->jwt_algorithm 		= array('HS256');
	}

	/**
	 * generate jwt
	 */
	public function generate()
	{
		$token = [
		    "iss" => $this->jwt_issuer,
		    "aud" => $this->jwt_audience,
		    "iat" => $this->jwt_issuer_at,
		    "nbf" => $this->jwt_not_before,
		    "exp" => $this->jwt_expiration_time,
		];

		return $jwt = JWT::encode($token, $this->jwt_key);
	}

	/**
	 * decode jwt
	 */
	public function decode($token)
	{
		return $decoded = JWT::decode($token, $this->jwt_key, $this->jwt_algorithm);
	}
}