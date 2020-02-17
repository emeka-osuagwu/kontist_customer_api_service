<?php

namespace Test\Http\Config;

use Emeka\Database\Schemes;
use Emeka\Http\Models\Customer;
use Emeka\Database\DatabaseConnection;
use Illuminate\Database\Capsule\Manager;

class DBConnection
{
	/**
	 * @return DatabaseConnection
	 */
	public function getConnection()
	{
	    return new DatabaseConnection(new Manager());
	}

	/**
	 * Create records in the database
	 */
	public function setUpDatabase()
	{
		$schemes = new Schemes;
		$schemes->createRequestTable();

	    Customer::create([
	        'email' => 'emekaosuagwu@hotmail.com',
	        'first_name' => 'Osuagwu',
	        'last_name' => 'Emeka',
	        'phone_number' => "09095685594",
	        'image' => 'https://github.com/rakit/validation',
	        'location' => 'Lagos, Nigeria',
	        'sex' => 'Male',
	    ]);

	    Customer::create([
	        'email' => 'mustafa.ozyurt@hotmail.com',
	        'first_name' => 'Mustafa',
	        'last_name' => 'Ozyurt',
	        'phone_number' => "09095685594",
	        'image' => 'https://github.com/rakit/validation',
	        'location' => 'Berlin, Germany',
	        'sex' => 'Male',
	    ]);
	}
	
}