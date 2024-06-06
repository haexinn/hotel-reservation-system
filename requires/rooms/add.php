<?php
require "../conn.php";
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

    $file = $_FILES['room_photo'];
    $filename = $_FILES['room_photo']['name'];
    $filetmp = $_FILES['room_photo']['tmp_name'];
    $filesize = $_FILES['room_photo']['size'];
    $fileerror = $_FILES['room_photo']['error'];
    $filetype = $_FILES['room_photo']['type'];

    $fileext = explode('.', $filename);
    $fileActualExt = strtolower(end($fileext));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileerror === 0) {
            if ($filesize < 1000000) {
                $filenewname = uniqid('', true) . "." . $fileActualExt;
                $filedestination = $_SERVER['DOCUMENT_ROOT']."/uploads/" . $filenewname;
                if (move_uploaded_file($filetmp, $filedestination)) {
                    $sql = "INSERT INTO `rooms` (`id`, `roomname`, `price`, `count`, `photo`,`description`) VALUES (NULL, '$title', '$convertedPrice', '$count', '$filenewname', '$formattedDesc')";
                    $result = $conn->query($sql);

                    header('Location ../rooms.php?success');
                } else {
                    header('Location ../rooms.php?error=fileupload');
                    exit();
                }
            } else {
                header('Location ../rooms.php?error=filesize');
                exit();
            }
        } else {
            header('Location ../rooms.php?error=picerror');
            exit();
        }
    } else {
        header('Location ../rooms.php?error=pictype');
        exit();
    }

    header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . "/portal/rooms.php");
}