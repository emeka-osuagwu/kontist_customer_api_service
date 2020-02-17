<?php

namespace Emeka\Middlewares;

use Pecee\Http\Request;
use Pecee\Http\Response;
use Emeka\Http\Services\JWTService;
use Pecee\Http\Middleware\IMiddleware;

class ApiVerification implements IMiddleware
{
	public function handle(Request $request): void
	{
		if (isset(request()->getHeaders()['http_authorization'])) {

			$jwtService = new JWTService;

			$token = $jwtService->decode(request()->getHeaders()['http_authorization']);
			
			if (isset($token->code) && $token->code == 0) {
				$request->authenticated = false;		
			}			
			elseif ($token->iss === env('JWT_ISS')) {
				$request->authenticated = true;		
			}
			else
			{
				$request->authenticated = false;		
			}
		}
		else {
			$request->authenticated = false;		
		}
	}
}