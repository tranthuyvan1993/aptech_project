<?php
$usernameErr = $addressErr = $passwordErr = $fullnameErr = $passwordCheckErr= $telErr= $emailErr="" ;
$username = $email = $address = $password = $fullname =$passwordCheck= "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["username"])) {
		$usernameErr = "username is required";
	}
	if (empty($_POST["email"])) {
		$emailErr = "Email is required";
	}
	if (empty($_POST["fullname"])) {
		$fullnameErr = "fullname is required";
	}
	if (empty($_POST["password"])) {
		$passwordErr = "password is required";
	}
	if (empty($_POST["passwordCheck"])) {
		$passwordCheckErr = "password is required";
	}
	if (empty($_POST["address"])) {
		$addressErr = "address is required";
	}
	if (empty($_POST["tel"])) {
		$telErr = "phone number is required";
	}
}
?>