<?php
require '../conn.php';
$resId = $_POST['resId'];

$sql = "UPDATE reservations SET reserve_status = 'DONE' WHERE id=" . $resId;
$result = $conn->query($sql);

header("Location: ../../portal/reservations.php?update=success");