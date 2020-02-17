<?php
/**
 * Custom router which handles default middlewares, default exceptions and things
 * that should be happen before and after the router is initialised.
 */
namespace Emeka\Router;

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::enableDependencyInjection(require_once $_SERVER['DOCUMENT_ROOT'] . '/app/config.php');

class RouterConfig extends SimpleRouter
{
    /**
     * @throws \Exception
     * @throws \Pecee\Http\Middleware\Exceptions\TokenMismatchException
     * @throws \Pecee\SimpleRouter\Exceptions\HttpException
     * @throws \Pecee\SimpleRouter\Exceptions\NotFoundHttpException
     */
    public static function start(): void
	{
		// Load our helpers
		require_once 'helper.php';

		// Load our custom routes
		require_once 'router.php';

		// Do initial stuff
		parent::start();
	}

}