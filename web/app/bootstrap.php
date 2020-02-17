<?php
/*
|-----------------------------------
| Services Namespaces
|-----------------------------------
*/
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

/*
|-----------------------------------
| Services Namespaces
|-----------------------------------
*/
use Emeka\Router\RouterConfig;
use Emeka\Database\DatabaseConnection;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();
new DatabaseConnection($capsule);


/*
|-----------------------------------
| Services Namespaces
|-----------------------------------
*/
RouterConfig::start();