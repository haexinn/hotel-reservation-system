<?php
require "../conn.php";
$roomId = $_POST["roomId"];
$title = $_POST["room_title"];
$desc = $_POST['room_desc'];
$price = $_POST['room_price'];
$count = $_POST['room_count'];
if (empty($title)) {
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/portal/rooms/add-room.php?error=room_title");
    exit();
}
if (empty($price)) {
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/portal/rooms/add-room.php?error=room_price");
    exit();
}
if (empty($count)) {
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/portal/rooms/add-room.php?error=room_count");
    exit();
}
if (empty($desc)) {
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/portal/rooms/add-room.php?error=room_desc");
    exit();
} else {
    $convertedPrice = floatval(str_replace(',', '', $price));

    $formattedDesc = nl2br(htmlspecialchars($desc));

    $sql = "UPDATE `rooms` SET roomname = '$title', price = '$convertedPrice', count = '$count', description = '$formattedDesc' WHERE id = '$roomId'";
    $result = $conn->query($sql);



    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/portal/rooms.php");
}