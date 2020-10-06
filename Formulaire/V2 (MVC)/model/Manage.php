<?php

namespace model;

use PDO;
use PDOException;

class Manage
{
	private $server;
	private $dbname;
	private $user;
	private $pwd;

	/* Constructor Manage
		parameters :
			- $server = DataBase server
			- $dbname = DataBase name
			- $user = DataBase username
			- $pwd = DataBase password
	*/
	public function __construct(string $server, string $dbname, string $user, string $pwd)
	{
		$this->server = $server;
		$this->dbname = $dbname;
		$this->user = $user;
		$this->pwd = $pwd;
	}

	/* Allow connection to DataBase thanks to Manage object */

	public function connect(): PDO
	{
		try {
			return new PDO('mysql:host=' . $this->server . ';dbname=' . $this->dbname . '', $this->user, $this->pwd);
		} catch
		(PDOException $e) {
			print "ERROR !: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	/* Allow to insert data in DataBase thanks to Manage object and parameters :
		- $fields = fields array from Config.php
	*/

	public function insert(array $fields): bool
	{
		$connection = $this->connect();
		$request = $connection->prepare("insert into `people` values (null,:lastname,:firstname,:phone,:mail)");
		foreach ($fields as $field => $value) {
			$request->bindParam(':' . $field, $_POST[$field]);
		}
		$request->execute();
		$request->closeCursor();
		$connection = null;
		return true;
	}
}