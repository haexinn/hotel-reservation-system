<?php

if (!isset($_GET['reservationId'])) {
    header('../reservations.php?error=noselected');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novotel - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style type="text/tailwindcss">
        [x-cloak] { display: none !important; }
  </style>
    <link rel="stylesheet" href="../../src/fontawesome/css/all.css?<?php echo time(); ?>" />
</head>

<body>
    <div x-data="reservationPortal" class="flex flex-row min-h-screen">
        <div class="h-screen w-1/6 bg-white shadow flex-none">
            <?php require '../../layouts/portal/sidebar.php' ?>
        </div>
        <?php
        require $_SERVER['DOCUMENT_ROOT'] . "/requires/conn.php";
        $sql = "SELECT reservations.id as resId, reservations.check_in_date as resCheckIn, reservations.check_out_date as resCheckOut, reservations.adult_count as resAdultCount, reservations.child_count as resChildCount, reservations.room_count as resRoomCount, reservations.total_price as resTotalPrice, reservations.reserve_status as resStatus, rooms.roomname as roomName, rooms.photo as roomPhoto, users.id as userId, users.username as userName FROM reservations INNER JOIN rooms ON reservations.room_id = rooms.id INNER JOIN users ON reservations.user_id = users.id WHERE reservations.id = " . $_GET['reservationId'];
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
        }
        ?>
        <div class="flex flex-col w-5/6 overflow-y-auto">
            <div class="flex flex-row justify-between items-center text-xl text-white bg-[#1e22aa] py-6 px-4">
                <div>
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Reservation Details for Customer:&nbsp;<span
                        class="font-bold underline"><?php echo $data['userName']; ?></span>
                </div>
                <a class="hover:underline" href="../reservations.php"><i class="fas fa-arrow-left mr-2"></i> Go Back</a>
            </div>
            <div class="p-6 flex flex-col *:mb-4">
                <div class="text-xl">
                    <h1 class="text-2xl mb-4 font-bold italic underline">Guest Details</h1>
                    <div class="flex flex-row mb-2">
                        <span class="font-bold">Adult Count:&nbsp;</span><?php echo $data['resAdultCount']; ?>
                    </div>
                    <div class="flex flex-row mb-2">
                        <span class="font-bold">Children Count:&nbsp;</span><?php echo $data['resChildCount']; ?>
                    </div>
                </div>
                <div class="text-xl">
                    <h1 class="text-2xl mb-4 font-bold italic underline">Room Details</h1>
                    <div class="flex flex-row mb-2">
                        <span class="font-bold">Room:&nbsp;</span><?php echo $data['roomName']; ?>
                    </div>
                    <div class="flex flex-row mb-2">
                        <span class="font-bold">Room Count:&nbsp;</span><?php echo $data['resRoomCount']; ?>
                    </div>
                </div>
                <div class="text-xl">
                    <h1 class="text-2xl mb-4 font-bold italic underline">Reservation Details</h1>
                    <div class="flex flex-row mb-2">
                        <span class="font-bold">Status:&nbsp;</span>
                        <span
                            class="relative inline-block px-3 py-1 font-semibold <?php if ($data['resStatus'] == 'PENDING'): ?>text-orange-900<?php elseif ($data['resStatus'] == 'CONFIRMED'): ?>text-green-900<?php elseif ($data['resStatus'] == 'CANCELLED'): ?>text-red-900<?php elseif ($data['resStatus'] == 'DONE'): ?>text-blue-900<?php endif; ?> leading-tight">
                            <span aria-hidden
                                class="absolute inset-0 <?php if ($data['resStatus'] == 'PENDING'): ?>bg-orange-200<?php elseif ($data['resStatus'] == 'CONFIRMED'): ?>bg-green-200<?php elseif ($data['resStatus'] == 'CANCELLED'): ?>bg-blue-200<?php elseif ($data['resStatus'] == 'DONE'): ?>bg-red-200<?php endif; ?> opacity-50 rounded-full"></span>
                            <span class="relative"><?php echo $data['resStatus'] ?></span>
                        </span>
                    </div>
                    <div class="flex flex-row mb-2">
                        <span class="font-bold">Total
                            Price:&nbsp;</span><?php echo number_format($data['resTotalPrice'], 2, '.', ',') . " PHP" ?>
                    </div>
                    <div class="flex flex-row mb-2">
                        <span class="font-bold">Check
                            In:&nbsp;</span><?php echo date_format(new DateTime($data['resCheckIn']), 'M d, Y') ?>
                    </div>
                    <div class="flex flex-row mb-2">
                        <span class="font-bold">Check
                            Out:&nbsp;</span><?php echo date_format(new DateTime($data['resCheckOut']), 'M d, Y') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../src/fontawesome/js/all.js?<?php echo time(); ?>"></script>
    <script defer
        src="https://cdn.jsdelivr.net/npm/@alpinejs/anchor@3.x.x/dist/cdn.min.js?<?php echo time(); ?>"></script>
    <script defer src="../src/js/alpine.js?<?php echo time(); ?>"></script>
</body>

</html>