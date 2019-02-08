<?php

use DI\ContainerBuilder;
use function DI\create;
use Emeka\Http\Services\CustomerService;
use Emeka\Http\Services\Contracts\CustomerServiceInterface;

use Emeka\Database\DatabaseConnection;
use Illuminate\Database\Capsule\Manager as Capsule;

$config = [
    // Bind an interface to an implementation
    CustomerServiceInterface::class => create(CustomerService::class)
];

$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions($config);
$container = $containerBuilder->build();

return $container;
