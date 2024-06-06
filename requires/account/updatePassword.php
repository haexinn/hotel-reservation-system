<?php
session_name('novotel');
session_start();
require '../conn.php';
$newPassword = $_POST['newPassword'];
$conirmPassword = $_POST['conirmPassword'];
if (empty($newPassword)) {
    header("Location: ../../account.php?error=password");
    exit();
}
if (empty($conirmPassword)) {
    header("Location: ../../account.php?error=confirm_password");
    exit();
}
if ($newPassword !== $conirmPassword) {
    header("Location: ../../account.php?error=password_not_match");
    exit();
}
$encpass = password_hash($conirmPassword, PASSWORD_DEFAULT);
$sql = "UPDATE users SET password = '". $encpass ."' WHERE id=" . $_SESSION['id'];
$result = $conn->query($sql);
if($result){
    header("Location: ../../account.php?update_password=success");
} else {
    header("Location: ../../account.php?update_password=failed");
}
