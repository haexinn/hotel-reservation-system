<?php
session_name('novotel');
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
    <div x-data="{tab: 1}">
        <?php require './layouts/header.php' ?>
        <main class="scroll-mt-20 flex items-center justify-center">
            <section class="py-4 mx-auto space-y-8 lg:py-20">
                <div class="container flex flex-wrap items-stretch justify-center w-full max-w-4xl">
                    <!-- Tab bar in footer -->
                    <div class="block lg:hidden bg-white py-4">
                        <div class="flex justify-between w-full max-w-lg mx-auto">
                            <a class="flex-1 px-4 py-2 text-sm text-center rounded-t-lg"
                                :class="{'bg-white': tab === 1, 'text-blue-500': tab === 1}" href="#"
                                @click.prevent="tab = 1">
                                MY RESERVATIONS
                            </a>
                            <a class="flex-1 px-4 py-2 text-sm text-center rounded-t-lg"
                                :class="{'bg-white': tab === 2, 'text-blue-500': tab === 2}" href="#"
                                @click.prevent="tab = 2">
                                ACCOUNT SETTINGS
                            </a>
                            <!-- <a class="flex-1 px-4 py-2 text-sm text-center rounded-t-lg"
                                :class="{'bg-white': tab === 3, 'text-blue-500': tab === 3}" href="#"
                                @click.prevent="tab = 3">
                                FEEDBACK
                            </a> -->
                        </div>
                    </div>
                    <div class="hidden lg:flex flex-col justify-start w-1/4 space-y-4">
                        <a class="px-4 py-2 text-sm"
                            :class="{'z-20 border-l-2 transform translate-x-2 border-blue-500 font-bold': tab === 1, ' transform -translate-x-2': tab !== 1}"
                            href="#" @click.prevent="tab = 1">
                            MY RESERVATIONS
                        </a>
                        <a class="px-4 py-2 text-sm"
                            :class="{'z-20 border-l-2 transform translate-x-2 border-blue-500 font-bold': tab === 2, ' transform -translate-x-2': tab !== 2}"
                            href="#" @click.prevent="tab = 2" @click.prevent="tab = 2">
                            ACCOUNT SETTINGS
                        </a>
                        <!-- <a class="px-4 py-2 text-sm"
                            :class="{'z-20 border-l-2 transform translate-x-2 border-blue-500 font-bold': tab === 3, ' transform -translate-x-2': tab !== 3}"
                            href="#" @click.prevent="tab = 3" @click.prevent="tab = 3">
                            FEEDBACK
                        </a> -->
                    </div>
                    <div class="w-full lg:w-3/4 pl-0 px-10 lg:pl-16">
                        <div class="space-y-6" x-show="tab === 1">
                            <h3 class="text-xl font-bold leading-tight" x-show="tab === 1"
                                x-transition:enter="transition duration-500 transform ease-in"
                                x-transition:enter-start="opacity-0">
                                MY RESERVATIONS
                            </h3>

                            <?php
                            require './requires/conn.php';
                            $delay = 0;
                            $sql = "SELECT reservations.id as resId, reservations.check_in_date as resCheckIn, reservations.check_out_date as resCheckOut, reservations.adult_count as resAdultCount, reservations.child_count as resChildCount, reservations.room_count as resRoomCount, reservations.total_price as resTotalPrice, reservations.reserve_status as resStatus, rooms.roomname as roomName, rooms.photo as roomPhoto FROM reservations INNER JOIN rooms ON reservations.room_id = rooms.id WHERE reservations.user_id = " . $_SESSION['id'] . " ORDER BY reservations.reserve_date DESC";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0):
                                while ($data = $result->fetch_assoc()):
                                    $delay += 100;
                                    ?>
                                    <div class="bg-white rounded-lg shadow-2xl md:flex" x-show="tab === 1"
                                        x-transition:enter="transition <?php echo 'delay-' . $delay ?> duration-500 transform ease-in"
                                        x-transition:enter-start="opacity-0">
                                        <img src="../uploads/<?php echo $data['roomPhoto'] ?>" class="rounded-lg md:w-1/3">
                                        <!-- over-ride with rounded none -->

                                        <div class="p-4 w-full flex flex-row items-center justify-between">
                                            <div>
                                                <h2 class="mb-2 font-bold text-2xl text-[#1e22aa]">
                                                    <?php echo $data['roomName'] ?>
                                                </h2>
                                                <p class="text-gray-700 flex flex-col">
                                                <div class="text-sm flex flex-row *:font-semibold">
                                                    <span>Total Rooms:&nbsp;</span>
                                                    <span
                                                        class="underline"><?php echo $data['resRoomCount'] . " Rooms" ?></span>
                                                </div>
                                                <div class="text-sm flex flex-row *:font-semibold">
                                                    <span>In:&nbsp;</span>
                                                    <span><?php echo date_format(new DateTime($data['resCheckIn']), 'M d, Y') ?></span>
                                                </div>
                                                <div class="text-sm flex flex-row *:font-semibold">
                                                    <span>Out:&nbsp;</span>
                                                    <span><?php echo date_format(new DateTime($data['resCheckOut']), 'M d, Y') ?></span>
                                                </div>
                                                </p>
                                            </div>
                                            <div class="flex flex-row-reverse">
                                                <div class="flex flex-col justify-end">
                                                    <span
                                                        class="relative text-sm text-center inline-block px-3 py-1 font-semibold <?php if ($data['resStatus'] == 'PENDING'): ?>text-orange-900<?php elseif ($data['resStatus'] == 'CONFIRMED'): ?>text-green-900<?php elseif ($data['resStatus'] == 'CANCELLED'): ?>text-red-900<?php endif; ?> leading-tight mb-2">
                                                        <span aria-hidden
                                                            class="absolute inset-0 <?php if ($data['resStatus'] == 'PENDING'): ?>bg-orange-200<?php elseif ($data['resStatus'] == 'CONFIRMED'): ?>bg-green-200<?php elseif ($data['resStatus'] == 'CANCELLED'): ?>bg-red-200<?php endif; ?> opacity-50 rounded-full"></span>
                                                        <span class="relative"><?php echo $data['resStatus'] ?></span>
                                                    </span>
                                                    <p class="font-bold text-gray-700 text-sm text-right">Total Price</p>
                                                    <h2 class="mb-2 font-bold text-lg text-[#1e22aa]">
                                                        <?php echo number_format($data['resTotalPrice'], 2, '.', ',') . " PHP" ?>
                                                    </h2>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- <tr class="*:p-2">
                                                <td><?php echo $data['roomName'] ?></td>
                                                <td><?php echo $data['resRoomCount'] ?></td>
                                                <td><?php echo date_format(new DateTime($data['resCheckIn']), 'M d, Y') . " - " . date_format(new DateTime($data['resCheckOut']), 'M d, Y') ?></td>
                                                <td><?php echo $data['resTotalPrice'] ?></td>
                                                <td><?php echo $data['resId'] ?></td>
                                            </tr> -->
                                <?php endwhile; ?>
                            <?php else: ?>
                                <div class="bg-white rounded-lg shadow-2xl md:flex w-[600px]" x-show="tab === 1"
                                    x-transition:enter="transition delay-100 duration-500 transform ease-in"
                                    x-transition:enter-start="opacity-0">
                                    <!-- over-ride with rounded none -->
                                    <div class="p-4 w-full flex flex-row items-center justify-center">
                                        <span class="font-semibold">No Reservations Yet</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- </tbody>
                            </table> -->
                        </div>

                        <div class="space-y-6" x-show="tab === 2">
                            <h3 class="text-xl font-bold leading-tight" x-show="tab === 2"
                                x-transition:enter="transition duration-500 transform ease-in"
                                x-transition:enter-start="opacity-0">
                                ACCOUNT SETTINGS
                            </h3>
                            <div class="p-4 bg-white rounded-lg shadow-2xl md:flex w-[600px]" x-show="tab === 2"
                                x-transition:enter="transition delay-100 duration-500 transform ease-in"
                                x-transition:enter-start="opacity-0">
                                <!-- over-ride with rounded none -->
                                <form method="POST" action="requires/account/updateEmail.php" class="w-full">
                                    <div class="w-full flex flex-row items-center justify-start">
                                        <div class="w-full flex flex-col mb-2">
                                            <label for='email' class="mb-1 font-semibold">Email</label>
                                            <input type="email" id="email" name="email"
                                                class="w-full text-lg px-3 py-2 border border-gray-500 rounded-xl"
                                                value="<?php echo $_SESSION['email'] ?>" required>
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="bg-[#1e22aa] py-3 px-6 text-white text-center rounded-xl font-bold mb-2">Update
                                        Email</button>
                                </form>

                            </div>
                            <div class="bg-white rounded-lg shadow-2xl md:flex w-[600px]" x-show="tab === 2"
                                x-transition:enter="transition delay-200 duration-500 transform ease-in"
                                x-transition:enter-start="opacity-0">
                                <!-- over-ride with rounded none -->
                                <form method="POST" action="requires/account/updatePassword.php" class="w-full">
                                    <div class="p-4 w-full flex flex-col items-start justify-start">
                                        <div class="w-full flex flex-col">
                                            <label for='newPassword' class="mb-1 font-semibold">New Password</label>
                                            <input type="password" id="newPassword" name="newPassword"
                                                class="text-lg px-3 py-2 border border-gray-500 rounded-xl" required>
                                        </div>
                                        <div class="w-full flex flex-col mb-2">
                                            <label for='conirmPassword' class="mb-1 font-semibold">Conirm
                                                Password</label>
                                            <input type="password" id="conirmPassword" name="conirmPassword"
                                                class="text-lg px-3 py-2 border border-gray-500 rounded-xl" required>
                                        </div>
                                        <button
                                            class="bg-[#1e22aa] py-3 px-6 text-white text-center rounded-xl font-bold mb-2">Update
                                            Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- <div class="space-y-6" x-show="tab === 3">
                            <h3 class="text-xl font-bold leading-tight" x-show="tab === 3"
                                x-transition:enter="transition duration-500 transform ease-in"
                                x-transition:enter-start="opacity-0">
                                FEEDBACK
                            </h3>
                            <div class="p-4 bg-white rounded-lg shadow-2xl md:flex w-[600px]" x-show="tab === 3"
                                x-transition:enter="transition delay-100 duration-500 transform ease-in"
                                x-transition:enter-start="opacity-0">
                                <form class="w-full">
                                    <div class="w-full flex flex-col items-center justify-start">
                                        <div class="w-full flex flex-col mb-2">
                                            <label for='message' class="mb-1 font-semibold">Rating</label>
                                            <select name="rating"
                                                class="w-full text-lg px-3 py-2 border border-gray-500 rounded-xl">
                                                <option value="5">5 Stars</option>
                                                <option value="4">4 Stars</option>
                                                <option value="3">3 Stars</option>
                                                <option value="2">2 Stars</option>
                                                <option value="1">1 Star</option>
                                            </select>
                                        </div>
                                        <div class="w-full flex flex-col mb-2">
                                            <label for='message' class="mb-1 font-semibold">Message</label>
                                            <textarea id="message" name="feedback"
                                                class="w-full text-lg px-3 py-2 border border-gray-500 rounded-xl"
                                                required></textarea>
                                        </div>
                                    </div>
                                    <button
                                        class="bg-[#1e22aa] py-3 px-6 text-white text-center rounded-xl font-bold mb-2">Submit</button>
                                </form>

                            </div>
                        </div> -->
                    </div>
                </div>
            </section>
        </main>

    </div>
    <!-- end -->
    <script src="../src/fontawesome/js/all.js?<?php echo time(); ?>"></script>
    <script src="../src/js/layouts/header.js?<?php echo time(); ?>"></script>
    <script defer src="../src/js/alpine.js?<?php echo time(); ?>"></script>


</body>


</html>