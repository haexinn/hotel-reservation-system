<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novotel - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/src/css/global/font-awesome.css" />
</head>

<body>
    <div class="flex flex-row min-h-screen">
        <div class="h-screen w-1/6 bg-white shadow flex-none">
            <?php require $_SERVER['DOCUMENT_ROOT']. '/layouts/portal/sidebar.php' ?>
        </div>
        <?php
                require $_SERVER['DOCUMENT_ROOT'] . "/requires/conn.php";
                $sql = "SELECT * FROM rooms WHERE id = " . $_GET['room'];
                $result = $conn->query($sql);
                if ($result->num_rows > 0): 
                    while ($data = $result->fetch_assoc()):
                ?>
        <div class="flex flex-col w-5/6 overflow-y-auto">
            <div class="flex flex-row items-center text-2xl text-white bg-[#1e22aa] py-6 pl-4">
                <div class="mr-2">
                    <i class="fas fa-bed"></i>
                    <span>Rooms</span>
                </div>
                <i class="fa-solid fa-angle-right mr-2"></i>
                <div class="mr-2">
                    <span><?php echo $data['roomname'] ?></span>
                </div>
            </div>
            <div class="p-6">
                <form method="POST" action="<?php echo "http://" . $_SERVER['HTTP_HOST'] ?>/requires/rooms/update.php">
                    <input type="hidden" name="roomId" value="<?php echo $data['id'] ?>" />
                    <div class="flex flex-col mb-2">
                        <label for='room_title' class="mb-1 font-semibold">Room Name</label>
                        <input type="text" id="room_title" name="room_title"
                        class="text-lg px-3 py-2 border border-gray-500 rounded-xl" value="<?php echo $data['roomname'] ?>" required>
                    </div>
                    <div class="flex flex-col mb-2">
                        <label for='room_title' class="mb-1 font-semibold">Room Price</label>
                        <input x-data x-mask:dynamic="$money($input, '.', ',')" id="room_price" name="room_price"
                        class="text-lg px-3 py-2 border border-gray-500 rounded-xl" value="<?php echo $data['price'] ?>" required>
                    </div>
                    <div class="flex flex-col mb-2">
                        <label for='room_title' class="mb-1 font-semibold">Room Count</label>
                        <input type="number" id="room_count" name="room_count"
                        class="text-lg px-3 py-2 border border-gray-500 rounded-xl" value="<?php echo $data['count'] ?>" required>
                    </div>
                    <div class="flex flex-col mb-2">
                        <label for='room_desc' class="mb-1 font-semibold">Room Description</label>
                        <textarea rows="4" cols="50" id="room_desc" name="room_desc"
                            class="text-lg px-3 py-2 border border-gray-500 rounded-xl" required><?php echo str_replace('<br />',"\n", htmlspecialchars_decode($data['description'])) ?></textarea>
                    </div>
                    <div class="flex flex-row-reverse">
                        <button type="submit"
                            class="w-1/6 rounded-full py-2 text-white bg-[#1e22aa] text-center font-bold">
                            <i class="fas fa-save mr-2"></i>
                            Update Room
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endwhile; endif; ?>
    <script src="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/src/js/font-awesome.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>
    <script defer src="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/src/js/alpine.js"></script>
</body>

</html>