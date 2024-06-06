<?php
require "./conn.php";
$userId = $_POST['userId'];
$roomId = $_POST['roomId'];
$checkIn = $_POST['checkIn'];
$checkOut = $_POST['checkOut'];
$adults = $_POST['adults'];
$child = $_POST['child'];
$roomCount = $_POST['roomCount'];
if (empty($userId)) {
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/room.php?selected=".$roomId."&error=userId");
    exit();
}
if (empty($roomId)) {
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/room.php?selected=".$roomId."&error=roomId");
    exit();
}
if (empty($checkIn)) {
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/room.php?selected=".$roomId."&error=checkIn");
    exit();
}
if (empty($checkOut)) {
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/room.php?selected=".$roomId."&error=checkOut");
    exit();
}
if (empty($adults)) {
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/room.php?selected=".$roomId."&error=adults");
    exit();
}
// if (empty($child)) {
//     header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/room.php?selected=".$roomId."&error=child");
//     exit();
// }
if (empty($roomCount)) {
    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/room.php?selected=".$roomId."&error=roomCount");
    exit();
} else {
    $sql = "SELECT price FROM rooms WHERE id = '" . $roomId . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $roomPrice = $result->fetch_assoc()['price'];
        $daydiff = date_diff(date_create($checkIn), date_create($checkOut))->format('%a');
        $totalPrice = ($roomPrice * $daydiff) * $roomCount;
        $sql = "INSERT INTO `reservations` (`id`, `user_id`, `room_id`, `check_in_date`, `check_out_date`, `adult_count`, `child_count`, `room_count`, `total_price`, `reserve_status`, `reserve_date`) VALUES (NULL, '$userId', '$roomId', '$checkIn', '$checkOut', '$adults', '$child', '$roomCount', '$totalPrice', 'PENDING', NOW())";
        $result = $conn->query($sql);
    
        header("Location: ../rooms.php?reserve=success");
    } else {
        header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/room.php?selected=".$roomId."&error=missingRoom");
        exit();
    }
}



