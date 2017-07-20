<?php

	use \Firebase\JWT\JWT;

	require_once("../../vendor/autoload.php");

	require_once("../userDAO.php");

	$postData = json_decode(file_get_contents("php://input"), true);

	$username = $postData["username"];
	$password = $postData["password"];

	$user = new UserDAO();

	$process  = $user->verifyUser($username, $password);

	//encode result to json
	$userInformation = $process;

	//if status is true create jwt
	if($userInformation["status"]) {
		//header
		$header = [
		  "alg" => "HS256",
		  "typ" => "JWT"
		];
		$header_encoded = base64_encode(json_encode($header));

		$tokenId = base64_encode(mcrypt_create_iv(32));

		//pay load
		$data = [
			"tokenID" =>  $tokenId,
			"data" =>  $userInformation	
		];
		$data_encoded = base64_encode(json_encode($header));

		$signature_key = $userInformation["userID"].uniqid().uniqid().uniqid();
		$signature_key_encoded = base64_encode(json_encode($signature_key));

		$token = JWT::encode($data, $signature_key);

		$decode = JWT::decode($token, $signature_key, array('HS256'));

		var_dump($decode);


	} else {
		$token = "failed";

		echo $token;
	}