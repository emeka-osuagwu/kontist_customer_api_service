<?php
namespace Emeka\Http\Handlers;

use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\Handlers\IExceptionHandler;

class CustomExceptionHandler implements IExceptionHandler
{
    /**
     * @param Request $request
     * @param \Exception $error
     * @throws \Exception
     */
    public function handleError(Request $request, \Exception $error): void
	{

		/* You can use the exception handler to format errors depending on the request and type. */

		if ($request->getUrl()->contains('/api')) {

			response()->json([
				'error' => $error->getMessage(),
				'code'  => $error->getCode(),
			]);
		}

		/* The router will throw the NotFoundHttpException on 404 */
		if($error instanceof NotFoundHttpException) {
			response()->json([
				'error' => $error->getMessage(),
				'code'  => $error->getCode(),
			]);
		}

		throw $error;

	}

}