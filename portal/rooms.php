<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novotel - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../src/fontawesome/css/all.css" />
</head>

<body>
    <div class="flex flex-row min-h-screen">
        <div class="h-screen w-1/6 bg-white shadow flex-none">
            <?php require '../layouts/portal/sidebar.php' ?>
        </div>
        <div class="flex flex-col w-5/6 overflow-y-auto">
            <div class="flex flex-row items-center text-2xl text-white bg-[#1e22aa] py-6 pl-4">
                <i class="fas fa-bed mr-2"></i>
                Rooms
            </div>
            <div class="p-6">
                <div class="flex flex-row-reverse">
                    <a href="rooms/add-room.php"
                        class="w-1/6 border-2 border-[#1e22aa] rounded-full py-2 hover:text-white hover:bg-[#1e22aa] text-center text-[#1e22aa] font-bold">
                        <i class="fas fa-plus mr-2"></i>
                        Add Room
                    </a>
                </div>
                <?php
                require $_SERVER['DOCUMENT_ROOT'] . "/requires/conn.php";
                $sql = "SELECT * FROM rooms";
                $result = $conn->query($sql);
                if ($result->num_rows > 0): ?>
                    <div class="flex flex-wrap">
                        <?php while ($data = $result->fetch_assoc()):
                            ?>
                            <div class="flex flex-col w-1/3 px-4 py-6 h-full">
                                <img src="../uploads/<?php echo $data['photo'] ?>" class="z-10 rounded-t-xl w-full h-48 object-cover" />
                                <div class="z-20 bg-white border border-gray-500 -mt-8 px-4 py-3 rounded-xl">
                                    <div class="flex flex-row items-center justify-between">
                                        <span class="font-bold">
                                            <?php echo $data['roomname'] ?>
                                        </span>
                                        <a href="../portal/rooms/view-room.php?room=<?php echo $data['id']?>" class="px-4 py-2 bg-[#1e22aa] text-white font-bold rounded-xl">
                                            See Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="flex items-center justify-center">
                        <span class="font-bold text-4xl text-gray-400">NO ROOMS</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="../src/js/font-awesome.js"></script>
    <script defer src="../src/js/alpine.js"></script>
</body>

</html>