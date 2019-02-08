<?php

namespace Emeka\Console\Commands\Database;

use Emeka\Database\Schemes;
use Emeka\Console\Commands\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterFace;
use Symfony\Component\Console\Output\OutputInterFace;

class DropMigrations extends Command
{
	/**
	* command configure
	*/
	public function configure()
	{
		$this->setName('kontist:drop-table')->setDescription('Drop database table');
	}

	/**
	* command execute
	*/
	public function execute(InputInterFace $input, OutputInterFace $output)
	{
		$database = new Schemes;

        $output->writeln(array(
	        '<info> kontist: ' . $database->dropDatabaseTable() . '</>',
	        '<info> ===============</>',
        ));
	}
}