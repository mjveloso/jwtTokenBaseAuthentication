<?php

	class ConnectionDAO {

		protected $username = 'root';
		protected $password = '';
		protected $db_name = 'test';
		protected $host = 'localhost';
		protected $dbh = null; //pdo container

		public function openConnection() {
			try {
				$this->dbh = new PDO("mysql:host=". $this->host . ";dbname=". $this->db_name, $this->username, $this->password);
			} catch(PDOException $e) {
				$e->getMessage();
			}
		}

		public function closeConnection() {
			try {
				$this->dbh = null;
			} catch(PDOException $e) {
				$e->getMessage();
			}
		}


	} // End for class ConnectionDAO