<?php

namespace Emeka\Http\Services\Contracts;

interface CustomerServiceInterface
{
	/**
	 * fetch and return all customer from database
	 * @return json|null
	 */
	public function getAll();

	/**
	 * fetch customer by dynamic {field} and {value} from the database
	 * @param string $field
	 * @param string | int $value
	 * @return json|null
	 */
	public function findBy($field, $value);

	/**
	 * insert new customer into the database
	 * @param array $data
	 * @return json|null
	 */
	public function createRecipe($data);
	/**
	 * update customer record in the database
	 * @param array data
	 * @return json|null
	 */
	public function updateRecipe($data);
}