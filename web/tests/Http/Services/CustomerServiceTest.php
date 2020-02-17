<?php

namespace Emeka\Test\Http\Services;

use Faker\Factory;
use Emeka\Http\Models\Customer;
use PHPUnit\Framework\TestCase;
use Test\Http\Config\DBConnection;
use Emeka\Http\Services\CustomerService;
use Emeka\Database\DatabaseConnection;
use Illuminate\Database\Capsule\Manager;
use Emeka\Database\Schemes;

class CustomerServiceTest extends TestCase
{
    /**
     * $faker
     * @var Faker\Factory
     */
    public $faker;

    /**
     * $customerService
     * @var Emeka\Http\Services\CustomerService
     */
    private $customerService;

    public function setUp()
    {
        parent::setUp();

        $this->database = new DBConnection();
        $this->database->getConnection();
        $this->database->setUpDatabase();
        
        $this->faker = Factory::create();
        $this->customerService = new CustomerService();
    }

    /**
     * Test CustomerService getAll method
     */
    public function testGetAll()
    {
        $customers = $this->customerService->getAll();
        $this->assertNotNull($customers);
        $this->assertGreaterThan(0, $customers->count());
    }

    /**
     * Test CustomerService findBy method
     */
    public function testFindBy()
    {
        $customer = $this->customerService->findBy('id', 1);
        $this->assertEquals(1, $customer->count());
    }

    /**
     * Test CustomerService create method
     */
    public function testCreateAndFindNewRecord()
    {
        $new_customer = [
            'email' => $this->faker->email,
            'first_name' => $this->faker->firstNameMale,
            'last_name' => $this->faker->firstNameMale,
            'phone_number' => $this->faker->e164PhoneNumber,
            'image' => $this->faker->imageUrl,
            'location' => $this->faker->city,
            'sex' => rand(0, 1) ? "male" : "female",
        ];

        $this->customerService->createRecipe($new_customer);
        
        $customer = $this->customerService->findBy('email', $new_customer['email']);
        
        $this->assertEquals(1, $customer->count());
    }

    /**
     * Test CustomerService update method
     */
    public function testFindAndUpdateCustomer()
    {

        $customer = $this->customerService->findBy('id', 1);
        
        $customer->update(['first_name' => "new name"]);

        $find_updated_customer = $this->customerService->findBy('first_name', 'new name');

        $this->assertEquals(1, $find_updated_customer->count());
    }

    /**
     * Test CustomerService delete method
     */
    public function testDeleteCustomer()
    {

        $customer = $this->customerService->findBy('id', 1);
        
        $customer->delete();

        $find_deleted_customer = $this->customerService->findBy('id', 1);

        $this->assertEquals(0, $find_deleted_customer->count());
    }

    /**
     * Delete all records from database after test
     */
    protected function tearDown()
    {
        parent::tearDown();
        Customer::truncate();
    }
}