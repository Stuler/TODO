<?php

namespace App\Model;
use Nette;

class Repository {

     /** @var Nette\Database\Context */
	private $database;

	public function __construct(Dibi\Connection $database)
	{
		$this->database = $database;
	}
}
