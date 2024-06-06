<?php
require "conn.php";
$user = $_POST["user"];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirm-password'];
$phone = $_POST['phone'];
$usertype = 2;

if (empty($user)) {
    header("Location: ../homepage.php?error=user");
    exit();
}
if (empty($email)) {
    header("Location: ../homepage.php?error=email");
    exit();
}
if (empty($password)) {
    header("Location: ../homepage.php?error=password");
    exit();
}
if (empty($confirmpassword)) {
    header("Location: ../homepage.php?error=confirmpassword");
    exit();
}
if($password != $confirmpassword){
	header("Location: ../homepage.php?error=notmatch");	
	exit();
}
if (empty($phone)) {
    header("Location: ../homepage.php?error=phone");
    exit();
} else {
    $sql = "SELECT email FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    $usercheck = mysqli_num_rows($result);
    if ($usercheck > 0) {
        header("Location: ../homepage.php?error=alreadyusedemail");
        exit();
    } else {
        $encpass = password_hash($confirmpassword, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `usertype`) VALUES (NULL, '$user', '$email', '$encpass', '$phone', '$usertype')";
        $result = $conn->query($sql);

        header("Location: ../index.php");
    }
}