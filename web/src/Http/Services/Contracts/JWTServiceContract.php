<?php

namespace Emeka\Http\Services\Contracts;

interface JWTServiceContract
{
	/**
	 * generate jwt
	 */
	public function generate();

	/**
	 * decode jwt
	 */
	public function decode($token);
}