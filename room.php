<?php
session_name("novotel");
session_start();
$reserveCount = 0;
?>
<!DOCTYPE html>

<head>
    <title>Novotel | My Account</title>
    <!-- <link rel="stylesheet" href="../src/css/homepage.css"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/fontawesome/css/all.css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div>
        <?php require './layouts/header.php' ?>
        <div class="scroll-mt-20">
            <?php
            require $_SERVER['DOCUMENT_ROOT'] . "/requires/conn.php";
            $sql = "SELECT * FROM rooms WHERE id =" . $_GET['selected'];
            $result = $conn->query($sql);
            if ($result->num_rows > 0):
                $data = $result->fetch_assoc();
                //print_r($data);
                    ?>
                    <div class="z-10 relative w-full flex flex-shrink-0 overflow-hidden shadow-2xl">
                        <div class="h-80 lg:h-96 w-full">
                            <img src=<?php echo "../uploads/" . $data['photo'] ?>
                                class="absolute inset-0 z-10 h-full w-full object-cover">
                        </div>
                    </div>
                    <div class="m-10">
                        <h1 class="text-5xl text-[#1e22aa] uppercase"><?php echo $data['roomname'] ?></h1>
                        <div class="flex flex-col lg:flex-row">
                            <div class="w-full lg:w-2/3 order-last lg:order-none">
                                <p class="text-[#666] text-xl leading-7 py-4 pr-8">
                                    <?php echo $data['description'] ?>
                                </p>
                            </div>
                            <div class="w-full lg:w-1/3 py-4 lg:py-0">
                                <div class="border border-gray-500 rounded-xl">
                                    <div class="py-4 px-8">
                                        <div class="flex flex-col">
                                            <div class="flex items-center justify-between py-2">
                                                <div class="text-gray-800 text-xl">
                                                    Price
                                                </div>
                                                <div class="text-[#1e22aa] text-2xl font-bold">
                                                    <?php echo number_format($data['price'], 2, '.', ',') . " PHP"; ?>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-between py-2">
                                                <div class="text-gray-800 text-xl">
                                                    Available Rooms
                                                </div>
                                                <div class="text-[#1e22aa] text-2xl font-bold">
                                                    <?php
                                                    require $_SERVER['DOCUMENT_ROOT'] . "/requires/conn.php";
                                                    $sql = "SELECT SUM(room_count) as reservedCount FROM reservations WHERE room_id =" . $_GET['selected'] . " AND reserve_status ='CONFIRMED'";
                                                    $result = $conn->query($sql);
                                                    if ($result->num_rows > 0) {
                                                        while ($data2 = $result->fetch_assoc()) {
                                                            echo $data['count'] - $data2['reservedCount'];
                                                            $reserveCount = $data2['reservedCount'];
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <hr>
                                            <?php if ($data['count'] === $reserveCount): ?>
                                                <a
                                                    class="w-full my-3 py-4 px-3 bg-gray-600 text-center text-white font-bold rounded-xl cursor-not-allowed">No Rooms Available</a>
                                            <?php else: ?>
                                                <?php if (isset($_SESSION['id'])): ?>
                                                    <?php 
                                                         require $_SERVER['DOCUMENT_ROOT'] . "/requires/conn.php";
                                                         $sql = "SELECT * FROM reservations WHERE room_id =" . $_GET['selected'] . " AND user_id =". $_SESSION['id'] ." AND reserve_status ='PENDING'";
                                                         $result = $conn->query($sql); ?>
                                                    <?php if ($result->num_rows > 0): ?>
                                                        <div class="font-bold text-xl p-6 text-center">You already reserved this room</div>
                                                    <?php else: ?>
                                                    <form method="POST" action="../requires/reserve.php" class="py-3 *:mb-2">
                                                        <input type="hidden" name="userId" value="<?php echo $_SESSION['id'] ?>"
                                                            required />
                                                        <input type="hidden" name="roomId" value="<?php echo $_GET['selected'] ?>"
                                                            required />
                                                        <div class="flex items-center justify-between *:w-1/2">
                                                            <div class="text-gray-800 text-xl">
                                                                Check In
                                                            </div>
                                                            <div class="text-gray-800 text-xl font-bold">
                                                                <input type="date" name="checkIn"
                                                                    class="border border-gray-500 w-full p-3 rounded" required />
                                                            </div>
                                                        </div>
                                                        <div class="flex items-center justify-between *:w-1/2">
                                                            <div class="text-gray-800 text-xl">
                                                                Check Out
                                                            </div>
                                                            <div class="text-gray-800 text-xl font-bold">
                                                                <input type="date" name="checkOut"
                                                                    class="border border-gray-500 w-full p-3 rounded" required />
                                                            </div>
                                                        </div>
                                                        <div class="flex items-center justify-between *:w-1/2">
                                                            <div class="text-gray-800 text-xl w-1/2">
                                                                Adults
                                                            </div>
                                                            <div class="text-gray-800 text-xl font-bold w-1/2">
                                                                <select name="adults" class="border border-gray-500 w-full p-3 rounded"
                                                                    required>
                                                                    <option value="1">1 adults</option>
                                                                    <option value="2">2 adults</option>
                                                                    <option value="3">3 adults</option>
                                                                    <option value="4">4 adults</option>
                                                                    <option value="5">5 adults</option>
                                                                    <option value="6">6 adults</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="flex items-center justify-between *:w-1/2">
                                                            <div class="text-gray-800 text-xl w-1/2">
                                                                Children
                                                            </div>
                                                            <div class="text-gray-800 text-xl font-bold w-1/2">
                                                                <select name="child" class="border border-gray-500 w-full p-3 rounded"
                                                                    required>
                                                                    <option value="0">No child</option>
                                                                    <option value="1">1 child</option>
                                                                    <option value="2">2 child</option>
                                                                    <option value="3">3 child</option>
                                                                    <option value="4">4 child</option>
                                                                    <option value="5">5 child</option>
                                                                    <option value="6">6 child</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="flex items-center justify-between *:w-1/2">
                                                            <div class="text-gray-800 text-xl w-1/2">
                                                                Rooms
                                                            </div>
                                                            <div class="text-gray-800 text-xl font-bold w-1/2">
                                                                <select name="roomCount"
                                                                    class="border border-gray-500 w-full p-3 rounded" required>
                                                                    <option value="1">1 rooms</option>
                                                                    <option value="2">2 rooms</option>
                                                                    <option value="3">3 rooms</option>
                                                                    <option value="4">4 rooms</option>
                                                                    <option value="5">5 rooms</option>
                                                                    <option value="6">6 rooms</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <button type="submit"
                                                            class="w-full py-4 bg-[#1e22aa] text-white font-bold rounded-xl">
                                                            Reserve Room
                                                        </button>
                                                    </form>   
                                                    <?php endif; ?>
                                                    <?php else: ?>
                                                    <a x-data @click="$dispatch('trigger-login')"
                                                        class="w-full my-3 py-4 px-3 bg-[#1e22aa] text-center text-white font-bold rounded-xl cursor-pointer">Login
                                                        to Reserve Room</a>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php endif; ?>
        </div>
        <!-- end -->
        <script src="../src/fontawesome/js/all.js?<?php echo time(); ?>"></script>
    <script src="../src/js/layouts/header.js?<?php echo time(); ?>"></script>
    <script defer src="../src/js/alpine.js?<?php echo time(); ?>"></script>



</body>


</html>