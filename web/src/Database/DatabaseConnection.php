<?php

namespace Emeka\Database;

use Dotenv\Dotenv;

class DatabaseConnection
{
    private $capsule;

    /**
     * This constructor accept Capsule; a connection
     * string for connecting to the database.
     *
     * @param $capsule
     */
    public function __construct($capsule)
    {
        $this->capsule = $capsule;
        self::loadEnv();
        $this->setUpDatabase();
    }

    /**
     * setting up database config
     */
    private function setUpDatabase()
    {
        $this->capsule->addConnection([
            'driver'    => getenv('DATABASE_DRIVER'),
            'host'      => getenv('DATABASE_HOST'),
            'database'  => getenv('DATABASE'),
            'username'  => getenv('DATABASE_USERNAME'),
            'password'  => getenv('DATABASE_PASSWORD'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'port'      => getenv('DATABASE_PORT'),
            'prefix'    => '',
            'strict'    => true,
        ]);
        
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }

    /**
     * Load env from app root dir
     */
     public static function loadEnv()
     {
        $dotenv = new Dotenv(__DIR__.'/../../');
        $dotenv->load();
     }
}