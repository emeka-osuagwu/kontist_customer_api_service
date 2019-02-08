<?php

namespace Emeka\Database;

use Emeka\Database\DatabaseConnection;
use Illuminate\Database\Capsule\Manager as Capsule;

class Schemes
{
    /**
     * This method create users schema.
     */
    public function createRequestTable()
    {
        $capsule = new Capsule();
        new DatabaseConnection($capsule);

        if (! Capsule::schema()->hasTable('customers')) 
        {
            Capsule::schema()->create('customers', function ($table) {
                $table->increments('id');
                $table->string('email')->unique();
                $table->string('first_name');
                $table->string('last_name');
                $table->string('phone_number');
                $table->string('image');
                $table->string('location');
                $table->string('sex');
                $table->timestamps();
            });
            
            return "table created";
        }
        else
        {
            return "table exists";
        }
    }

    /**
     * This method create users schema.
     */
    public function dropDatabaseTable()
    {
        if (Capsule::schema()->hasTable('customers')){
            Capsule::schema()->drop('customers');
        }

        return "table dropped";
    }
}