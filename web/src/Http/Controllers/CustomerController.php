<?php

namespace Emeka\Http\Controllers;

use Emeka\Http\Services\ValidationService;
use Emeka\Http\Services\Contracts\CustomerServiceInterface;

/**
 * Class CustomerController
 * @package Emeka\Http\Controllers
 */
class CustomerController
{
	/**
	 * RecipeService Service
	 * @var RecipeService
	 */
	protected $customerService;

	/**
	 * Validation Service
	 * @var RecipeService
	 */
	protected $validationService;

	function __construct
	(
		ValidationService $validationService,
		CustomerServiceInterface $customerService
	)
	{
		$this->customerService = $customerService;
		$this->validationService = $validationService;
	}

	/**
	 * handle index request
	 * @return json|null
	 */
	public function index()
	{
		return response()->httpCode(200)->json([
			"message" => "welcome to kontist customer api 😋"
		]);
	}

	/**
	 * handle get recipes request
	 * @return json|null
	 */
	public function customers()
	{
		return response()->httpCode(200)->json([
			"data" => $this->customerService->getAll(),
			"status" => 200
		]);
	}

	/**
	 * handle getCustomer  request
	 * @return json|null
	 */
	public function customer($id)
	{
		// validate getCustomer 
		$validation = $this->validationService->getCustomerValidation(['id' => $id]);

		// check if validation fails
		if ($validation->fails()) {
		    $errors = $validation->errors();
		    return response()->httpCode(400)->json([
		    	"status" => 400,
		    	"data" => $errors->firstOfAll() 
		    ]);
		}

		return response()->httpCode(200)->json([
			"data" => $this->customerService->findBy('id', $id)->get(),
			"status" => 200
		]);
	}

	/**
	 * handle createCustomer s request
	 * @return json|null
	 */
	public function create()
	{
		if (!request()->authenticated) {
			return response()->httpCode(200)->json([
				"status" => 400,
				"message" => "authentication required",
				"auth" => request()->authenticated
			]);
		}

		// validate request
		$validations = $this->validationService->createCustomerValidation(input()->all());
		
		// return error is validation fails
		if (count($validations)) {
		    return response()->httpCode(200)->json([
		    	"status" => 400,
		    	"data" => $validations
		    ]);
		}

		// check ifCustomer  exist in the database
		$findRecipeByName = $this->customerService->findBy('email', input()->all(['email']))->get()->count();

		// return error is exist
		if ($findRecipeByName) {
			return response()->httpCode(200)->json([
				"message" => "Customer already exit",
				"status" => 400,
			]);
		}	

		return response()->httpCode(200)->json([
			"data" => $this->customerService->createRecipe(input()->all()),
			"status" => 200
		]);
	}

	/**
	 * handle deleteCustomer s request
	 * @param int id
	 * @return json|null
	 */
	public function delete($id)
	{	
		if (!request()->authenticated) {
			return response()->httpCode(200)->json([
				"status" => 400,
				"message" => "authentication required",
				"auth" => request()->authenticated
			]);
		}

		// validate deleteCustomer 
		$validation = $this->validationService->getCustomerValidation(['id' => $id]);

		// check if validation fails
		if ($validation->fails()) {
		    $errors = $validation->errors();
		    return response()->httpCode(400)->json([
		    	"status" => 400,
		    	"data" => $errors->firstOfAll() 
		    ]);
		}

		// check if record exist
		if ($this->customerService->findBy('id', $id)->count() < 1) {
			return response()->httpCode(400)->json([
				"message" => "record not round",
				"status" => 400
			]);
		}

		$this->customerService->findBy('id', $id)->delete();
		
		return response()->httpCode(200)->json([
			"message" => "record deleted",
			"status" => 200
		]);
	}

	/**
	 * handle updateCustomer  request
	 * @return json|null
	 * @param int $id
	 */
	public function update($id)
	{
		if (!request()->authenticated) {
			return response()->httpCode(200)->json([
				"status" => 400,
				"message" => "authentication required",
				"auth" => request()->authenticated
			]);
		}
		
		$request = input()->all();

		$request_data = [];


		// check ifCustomer  exist in the database
		if ($this->customerService->findBy('id', $id)->count() < 1) {
			return response()->httpCode(400)->json([
				"message" => "cant find record",
				"status" => 400,
			]);
		}	

		if (isset($request['email']) && isset($request['email']) != null) {
			$request_data['email'] = $request['email'];
		}

		if (isset($request['first_name']) && isset($request['first_name']) != null) {
			$request_data['first_name'] = $request['first_name'];
		}

		if (isset($request['last_name']) && isset($request['last_name']) != null) {
			$request_data['last_name'] = $request['last_name'];
		}

		if (isset($request['sex']) && isset($request['sex']) != null) {
			$request_data['sex'] = $request['sex'];
		}

		if (isset($request['phone_number']) && isset($request['phone_number']) != null) {
			$request_data['phone_number'] = $request['phone_number'];
		}

		if (isset($request['location']) && isset($request['location']) != null) {
			$request_data['location'] = $request['location'];
		}

		if (isset($request['image']) && isset($request['image']) != null) {
			$request_data['image'] = $request['image'];
		}

		$request_data['id'] = $id;

		$validation = $this->validationService->updateCustomerValidation($request_data);

		if ($validation->fails()) {
		    $errors = $validation->errors();
		    return response()->httpCode(400)->json([
		    	"status" => 400,
		    	"data" => $errors->firstOfAll() 
		    ]);
		}

		return response()->httpCode(200)->json([
			"data" => $this->customerService->updateRecipe($request_data),
			"status" => 200
		]);
	}
}