<?php

	require_once('database/connectionDAO.php');

	class UserDAO extends ConnectionDAO {

		public function verifyUser($username, $password) {
			try {
				$this->openConnection();
				$stmt = $this->dbh->prepare("SELECT * FROM `users` WHERE username=? AND password=?");
				$stmt->bindparam(1, $username);
				$stmt->bindparam(2, $password);
				$stmt->execute();

				if($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$returnData = array(
						"status" => true,
						"firstname" => $result["firstname"],
						"lastname" => $result["lastname"],
						"userID" => $result["userID"]
					);
				} else {
					$returnData = array("status" => false);
				}

				return $returnData;

			} catch(PDOException $e) {
				$e->getMessage();
			}
 		}


	} // End for UserDAO object
