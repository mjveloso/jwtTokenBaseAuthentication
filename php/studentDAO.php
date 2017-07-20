<?php

	require_once('database/connectionDAO.php');

	class StudentDAO extends ConnectionDAO {

		public function fetchAllStudents() {
			try {
				$this->openConnection();
				$stmt = $this->dbh->query("SELECT students.studentID, students.firstname, students.lastname, students.age, students.gender, students.contact_num, students.country, students.address_1, students.address_2, guardians.firstname AS gFirstname, guardians.lastname AS gLastname, guardians.address AS gAddress, guardians.contact_num As gContactNumber FROM `students` INNER JOIN `guardians` ON students.studentID = guardians.studentID");
				$stmt->execute();
				$counter = 0;

				while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
					$returnData[$counter] = $result;
					$counter++;
				} if($counter > 0) {
					return $returnData;
				} else {
					return false;
				}
			} catch(Exception $e) {
				$e->getMessage();
			}
		} // End for fetchAllStudents method

		public function addStudentGuardians($id, $data) {
			try {
				$stmt = $this->dbh->prepare("INSERT INTO `guardians`(`studentID`,`firstname`, `lastname`, `address`, `contact_num`) VALUE(?,?,?,?,?)");
				$stmt->bindparam(1,$id);
				$stmt->bindparam(2,$data['g_firstname']);
				$stmt->bindparam(3,$data['g_lastname']);
				$stmt->bindparam(4,$data['g_address']);
				$stmt->bindparam(5,$data['g_contact_number']);
				$stmt->execute();

				$rowCount = $stmt->rowCount();
				if($rowCount > 0) {
					return true;
				} else {
					return false;
				}
			} catch(Exception $e) {
				$e->getMessage();
			}
		}

		public function addStudent($data) {

			try {
				$this->openConnection();
				//begin transaction
				$this->dbh->beginTransaction();
				$stmt = $this->dbh->prepare("INSERT INTO `students` (`firstname`, `lastname`, `age`, `gender`, `contact_num`, `country`, `address_1`, `address_2`) 
					VALUE(?,?,?,?,?,?,?,?)");
				$stmt->bindparam(1,$data['firstname']);
				$stmt->bindparam(2,$data['lastname']);
				$stmt->bindparam(3,$data['age']);
				$stmt->bindparam(4,$data['gender']);
				$stmt->bindparam(5,$data['contact_number']);
				$stmt->bindparam(6,$data['country']);
				$stmt->bindparam(7,$data['address_1']);
				$stmt->bindparam(8,$data['address_2']);
				$stmt->execute();

				$rowCount = $stmt->rowCount();
				$lastInsertId = $this->dbh->lastInsertId();
				if($rowCount > 0) {
					$addGuardians = $this->addStudentGuardians($lastInsertId, $data);
					if($addGuardians) {
						$this->dbh->commit();
					} else {
						$this->dbh->rollBack();
					}
					return true;
				} else {
					return false;
					$this->dbh->rollBack();
				}

			} catch(Exception $e) {
				$e->getMessage();
				$this->dbh->rollBack();
			}
		} // End for addStudent method

		public function updateStudentGuardians($data) {
			try {
				$this->openConnection();
				$stmt = $this->dbh->prepare("UPDATE `guardians` SET `firstname`=?, `lastname`=?, `address`=?, `contact_num`=? WHERE `studentID`=?");
				$stmt->bindparam(1, $data['g_firstname']);
				$stmt->bindparam(2, $data['g_lastname']);
				$stmt->bindparam(3, $data['g_address']);
				$stmt->bindparam(4, $data['g_contact_number']);
				$stmt->bindparam(5, $data['studentID']);
				$stmt->execute();

				$rowCount = $stmt->rowCount();
				if($rowCount > 0) {
					return true;
				} else {
					return false;
				}
				
				
			} catch (Exception $e) {
				$e->getMessage();
			}
		}

		public function updateStudent($data) {

			try {
				$this->openConnection();
				$stmt = $this->dbh->prepare("UPDATE `students` SET `firstname`=?, `lastname`=?, `age`=?, `gender`=?,
					`contact_num`=?, `country`=?, `address_1`=?, `address_2`=? WHERE `studentID`=?");
				$stmt->bindparam(1, $data['firstname']);
				$stmt->bindparam(2, $data['lastname']);
				$stmt->bindparam(3, $data['age']);
				$stmt->bindparam(4, $data['gender']);
				$stmt->bindparam(5, $data['contact_number']);
				$stmt->bindparam(6, $data['country']);
				$stmt->bindparam(7, $data['address_1']);
				$stmt->bindparam(8, $data['address_2']);
				$stmt->bindparam(9, $data['studentID']);
				$stmt->execute();

				$rowCount = $stmt->rowCount();
				if($rowCount > 0) {
					return true;
				} else {
					return false;
				}
				

			} catch (Exception $e) {
				$e->getMessage();
			}

		}

	} //End for StuudentDAO object