<?php
session_name("novotel");
session_start();
?>
<!DOCTYPE html>

<head>
    <title>Novotel</title>
    <!-- <link rel="stylesheet" href="../src/css/homepage.css"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/fontawesome/css/all.css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div x-data="roomsPage">
        <?php require './layouts/header.php' ?>
        <div class="scroll-mt-20">
            <div class="text-center text-3xl font-bold uppercase text-[#1f2844] drop-shadow-md">Rooms</div>
            <div class="container mx-auto">
                <?php
                require $_SERVER['DOCUMENT_ROOT'] . "/requires/conn.php";
                $sql = "SELECT * FROM rooms ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0): ?>
                    <div class="flex flex-wrap">
                        <?php while ($data = $result->fetch_assoc()):
                            ?>
                            <div class="flex flex-col w-full lg:w-1/3 px-4 py-6 h-full">
                                <img src="../uploads/<?php echo $data['photo'] ?>" class="z-10 rounded-t-xl w-full h-48 object-cover" />
                                <div class="z-20 bg-white border border-gray-500 -mt-8 px-4 py-3 rounded-xl">
                                    <div class="flex flex-col">
                                        <div class="flex flex-row items-center justify-between">
                                            <span class="font-bold">
                                                <?php echo $data['roomname'] ?>
                                            </span>
                                            <a href="<?php echo "../room.php?selected=". $data['id'] ?>" class="px-4 py-2 bg-[#1e22aa] text-white font-bold rounded-xl">
                                                See Room
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- end -->
    <script src="../src/fontawesome/js/all.js?<?php echo time(); ?>"></script>
    <script src="../src/js/rooms.js?<?php echo time(); ?>"></script>
    <script src="../src/js/layouts/header.js?<?php echo time(); ?>"></script>
    <script defer src="../src/js/alpine.js?<?php echo time(); ?>"></script>


</body>


</html>