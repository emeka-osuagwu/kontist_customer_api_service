<?php

namespace Test;

use Faker\Factory;
use PHPUnit\Framework\TestCase;
use Emeka\Http\Models\Customer;
use Test\Http\Config\DBConnection;
use Emeka\Http\Services\JWTService;
use Test\Http\Config\RequestService;

class RouteTest extends TestCase
{
	/**
	 * $faker
	 * @var Faker\Factory
	 */
	public $faker;

	/**
	 * $token
	 * @var Emeka\Http\Services\JWTService
	 */
	public $token;

	/**
	 * $request
	 * @var Test\Http\Config\RequestService;
	 */
	public $request;

	public function setUp()
	{
	    parent::setUp();
	    $this->faker = Factory::create();
	    $this->request = new RequestService;
	    	
	    $jwtService = new JWTService;
	    $this->token = $jwtService->generate();
	}

	/**
	 * Test index route returns welcome message
	 */
	public function testIndexRoute()
	{
		$response = $this->request->handel('GET', 'http://localhost', []);
	    $this->assertSame("welcome to kontist customer api 😋", $response['message']);
	}

	/**
	 * Test invalid route error
	 */
	public function testGetErrorOnInvalidRoute()
	{
		$response = $this->request->handel('GET', 'http://localhost/something-route', []);
	    $this->assertSame(404, $response['code']);
	}

	/**
	 * Test get all customer endpoint
	 */
	public function testGetRecipes()
	{
		$response = $this->request->handel('GET', 'http://localhost/api', []);
	    $this->assertSame(200, $response['status']);
	}

	/**
	 * Test create endpoint requires authentication
	 */
	public function testProtectedRoute()
	{
		$response = $this->request->handel('POST', 'http://localhost/api/customer', []);
	    $this->assertSame(400, $response['status']);
	    $this->assertSame("authentication required", $response['message']);
	}

	/**
	 * Test create customer endpoint
	 */
	public function testCreateRecipe()
	{
		$customer = [
			'email' => $this->faker->email,
			'first_name' => $this->faker->firstNameMale,
			'last_name' => $this->faker->firstNameMale,
			'phone_number' => $this->faker->e164PhoneNumber,
			'image' => $this->faker->imageUrl,
			'location' => $this->faker->city,
			'sex' => rand(0, 1) ? "male" : "female",
		];

		$data = [
			'headers' => [
				'authorization' => $this->token,
			],
			'form_params' => $customer
		];

		$response = $this->request->handel('POST', 'http://localhost/api/customer', $data);
		
	    $this->assertSame(200, $response['status']);
	    $this->assertArrayHasKey('email', $response['data']);
	}

	/**
	 * Test get customer endpoint
	 */
	public function testGetRecipe()
	{

		$data = [
			'headers' => [
				'authorization' => $this->token,
			],
			'form_params' => []
		];

		$response = $this->request->handel('GET', 'http://localhost/api/customer/1', $data);
	    $this->assertSame(200, $response['status']);
		$this->assertArrayHasKey('email', $response['data'][0]);
	}

	/**
	 * Test update customer endpoint
	 */
	public function testUpdateRecipe()
	{
		$customer = [
			'first_name' => 'randomname'
		];

		$data = [
		    'form_params' => $customer,
		    'headers' => [
		    	'authorization' => $this->token,
		    ],
		];

		$response = $this->request->handel('POST', 'http://localhost/api/customer/1', $data);
	    
	    $this->assertSame(200, $response['status']);
	    $this->assertSame($customer['first_name'], $response['data'][0]['first_name']);
	}

	/**
	 * Test delete custom endpoint
	 */
	public function testDeleteRecipe()
	{
		$data = [
		    'headers' => [
		    	'authorization' => $this->token,
		    ]
		];

		$response = $this->request->handel('DELETE', 'http://localhost/api/customer/1', $data);
	   
	    $this->assertSame(200, $response['status']);
	    $this->assertSame("record deleted", $response['message']);
	}

	/**
	 * Test rate recipe endpoint
	 */
	public function testMiniLoginRecipe()
	{
		$response = $this->request->handel('POST', 'http://localhost/api/login', []);
	    $this->assertSame(200, $response['status']);
	    $this->assertSame("mini auth successful 😋", $response['message']);
	}


}