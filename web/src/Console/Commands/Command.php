<?php

namespace Emeka\Console\Commands;

use Emeka\Http\Services\CustomerService;
use Illuminate\Database\Query\Builder;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

class Command extends SymfonyCommand
{
	protected $customerService;

	/**
	* Creates an instance of Command
	*/
	function __construct()
	{
		$this->customerService = new CustomerService;
		parent::__construct();
	}

	/**
	* Command showResult
	*/
	public function showResult($output, $data)
	{
		$table = new Table($output);

		$table->setHeaders(['id'])
			->setRows($data)
			->render();
	}

	/**
	* Command showStatus
	*/
	public function showStatus($output, $data)
	{
		$table = new Table($output);

		$table->setHeaders(['pending', 'processed',])
			->setRows($data)
			->render();
	}
}