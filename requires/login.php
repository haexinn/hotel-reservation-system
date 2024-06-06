<?php
session_name('novotel');
session_start();
require "conn.php";
$email = $_POST['email'];
$password = $_POST['password'];
$sql = "SELECT password FROM users WHERE email='$email'";
$result = $conn->query($sql);
	if($result->num_rows > 0) {
		while($data = $result->fetch_assoc()) {
			$hash_pass = $data['password'];
		}
	}
$hash = password_verify($password, $hash_pass);
if(!$hash){
	header("Location: ../homepage.php?error=empty");
	exit();
}
else{
	$sql = "SELECT id, username, email, usertype FROM users WHERE email='$email' AND password ='$hash_pass'";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		while($data = $result->fetch_assoc()) {
			$_SESSION['id'] = $data['id'];
			$_SESSION['username'] = $data['username'];
			$_SESSION['usertype'] = $data['usertype'];
			$_SESSION['email'] = $data['email'];
		}
		header("Location: ../index.php");
	}
	else{
		header("Location: ../homepage.php?error=wrong");
	}
}