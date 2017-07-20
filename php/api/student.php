<?php

	require_once('../studentDAO.php');

	$student = new StudentDAO();

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$postData = json_decode(file_get_contents("php://input"), true);
		if($postData['action'] == 'create') {
			$addStudentResponse = $student->addStudent($postData); 
			echo json_encode($addStudentResponse);
		} elseif ($postData['action'] == 'update') {
			$updateStudentResponse = $student->updateStudent($postData);
			echo json_encode($updateStudentResponse);
		}

	} else if($_SERVER['REQUEST_METHOD'] == 'GET') {
		$fetchAllStudentResponse = $student->fetchAllStudents();
		echo json_encode($fetchAllStudentResponse);
	}