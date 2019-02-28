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
		$validator = Validation::createValidator();

		$groups = new Assert\GroupSequence(['Default', 'custom']);

		$constraint = new Assert\Collection([
		    'email' => [
		    	new Assert\Email(),
		    	new Assert\NotBlank(),
		    ],
		    'last_name' => [
		    	new Assert\NotBlank(),
		    	new Assert\Type(['type' => 'string'])
		    ],
		    'first_name' => [
		    	new Assert\NotBlank(),
		    	new Assert\Type(['type' => 'string'])
		    ],
		    'sex' => [
		    	new Assert\NotBlank(),
		    	new Assert\Choice(["female", "male"]),
		    ],
		    'image' => [
		    	new Assert\Url(),
		    	new Assert\Type(['type' => 'string'])
		    ],
		    'phone_number' => [
		    	new Assert\NotBlank(),
		    	new Assert\Type(['type' => 'numeric'])
		    ],
		    'location' => [
		    	new Assert\NotBlank(),
		    	new Assert\Type(['type' => 'string'])
		    ],
		]);

		$violations = $validator->validate($data, $constraint, $groups);

		$error_bags = [];

		if (0 !== count($violations)) {
		    foreach ($violations as $violation) {
		    	array_push($error_bags, [$violation->getpropertyPath() => $violation->getMessage()]);
		    }
		}

		return $error_bags;
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