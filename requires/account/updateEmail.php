<?php
session_name('novotel');
session_start();
require '../conn.php';
$email = $_POST['email'];
if (empty($email)) {
    header("Location: ../../account.php?error=email");
    exit();
}
$sql = "UPDATE users SET email = '". $email ."' WHERE id=" . $_SESSION['id'];
$result = $conn->query($sql);
if($result){
    $_SESSION['email'] = $email;
    header("Location: ../../account.php?update_email=success");
} else {
    header("Location: ../../account.php?update_email=failed");
}



