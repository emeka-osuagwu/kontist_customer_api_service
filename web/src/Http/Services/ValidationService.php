<?php

namespace Emeka\Http\Services;

use Rakit\Validation\Validator;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Validator\Validator\ValidatorInterface;

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

		$violations = $validator_test->validate(json_encode($data), [
		    new Length(['min' => 10]),
		    new Assert\Email([
		    	'message' => 'The email "{{ value }}" is not a valid email.',
		    	'checkMX' => true,
		    ]),
		    new NotBlank(),
		]);

		return $violations;

		// if (0 !== count($violations)) {
		//     // there are errors, now you can show them
		//     foreach ($violations as $violation) {
		//         echo $violation->getMessage().'<br>';
		//     }
		// }

		// $validation = $this->validator->make($data, [
		//     'email' => 'required|email',
		//     'first_name' => 'required|alpha',
		//     'last_name' => 'required|alpha',
		//     'sex' => 'required|alpha',
		//     'phone_number' => 'required|numeric',
		//     'location' => 'required|alpha_spaces',
		//     'image' => 'required|url',
		// ]);

		// $validation->validate();

		// return $validation;
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