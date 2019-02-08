<?php

namespace Emeka\Http\Services;

use Rakit\Validation\Validator;

class ValidationService
{
	protected $validator;
	
	public function __construct()
	{
		$this->validator = new Validator;
	}

	/**
	 */
	public function getCustomerValidation($data)
	{
		$validation = $this->validator->make($data, [
		    'id' => 'required|numeric',
		]);

		$validation->validate();

		return $validation;
	}

	/**
	 * createCustomerValidation
	 */
	public function createCustomerValidation($data)
	{
		$validation = $this->validator->make($data, [
		    'email' => 'required|email',
		    'first_name' => 'required|alpha',
		    'last_name' => 'required|alpha',
		    'sex' => 'required|alpha',
		    'phone_number' => 'required|numeric',
		    'location' => 'required|alpha_spaces',
		    'image' => 'required|url',
		]);

		$validation->validate();

		return $validation;
	}

	/**
	 * updateCustomerValidation
	 */
	public function updateCustomerValidation($data)
	{
		$validation = $this->validator->make($data, [
		    'id' => 'required|numeric',
		    'email' => 'required_if:email|email',
		    'first_name' => 'required_if:first_name|alpha',
		    'last_name' => 'required_if:last_name|alpha',
		    'sex' => 'required_if:sex|alpha',
		    'phone_number' => 'required_if:phone_number|numeric',
		    'location' => 'required_if:location|alpha_spaces',
		    'image' => 'required_if:image|url',
		]);

		$validation->validate();

		return $validation;
	}
}