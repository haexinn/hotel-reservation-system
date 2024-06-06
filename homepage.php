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
    <div x-data="homeSection">
        <?php require './layouts/header.php' ?>

        <!-- home -->
        <section id="home" class="scroll-mt-20">
            <article class="z-10 relative w-full flex flex-shrink-0 overflow-hidden shadow-2xl">
                <template x-for="(image, index) in images">
                    <figure class="h-80 lg:h-96 w-full" x-show="currentIndex == index + 1"
                        x-transition:enter="transition transform duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition transform duration-300"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        <img :src="image" alt="Image" class="absolute inset-0 z-10 h-full w-full object-cover" />
                        <!-- <figcaption
                        class="absolute inset-x-0 bottom-1 z-20 w-96 mx-auto p-4 font-light text-sm text-center tracking-widest leading-snug bg-gray-300">
                        Any kind of content here!
                        Primum in nostrane potestate est, quid meminerimus? Nulla erit controversia. Vestri haec
                        verecundius, illi fortasse constantius.
                    </figcaption> -->
                    </figure>
                </template>

                <div class="flex items-center">
                    <button @click="back()"
                        class="absolute left-14 top-1/2 w-11 h-11 flex justify-center items-center rounded-full shadow-md z-10 bg-gray-100 hover:bg-gray-200">
                        <svg class="w-8 h-8 font-bold transition duration-500 ease-in-out transform motion-reduce:transform-none text-gray-500 hover:text-gray-600 hover:-translate-x-0.5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </button>

                    <button @click="next()"
                        class="absolute right-14 top-1/2 w-11 h-11 flex justify-center items-center rounded-full shadow-md z-10 bg-gray-100 hover:bg-gray-200">
                        <svg class=" w-8 h-8 font-bold transition duration-500 ease-in-out transform motion-reduce:transform-none text-gray-500 hover:text-gray-600 hover:translate-x-0.5"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </button>
                </div>
            </article>
        </section>

        <!--availability-->
        <div class="bg-white -mt-10 flex flex-col items-center justify-center">
            <div class="z-20 py-4 px-4 bg-[#eee] border border-gray-500 rounded-xl">
                <form class="flex flex-col lg:flex-row items-center *:mb-4">
                    <div class="flex flex-row items-center w-full">
                        <div class="flex flex-col align-center mr-4 text-center w-full">
                            <span class="mb-1">Check In</span>
                            <input type="date" name="checkIn" class="p-3 rounded" required />
                        </div>
                        <div class="flex flex-col align-center mr-4 text-center w-full">
                            <span class="mb-1">Check Out</span>
                            <input type="date" name="checkOut" class="p-3 rounded" required />
                        </div>
                    </div>
                    <div class="flex flex-row items-center w-full">
                        <div class="flex flex-col align-center mr-4 text-center w-full">
                            <span class="mb-1">Adults</span>
                            <select name="adults" class="p-3 rounded">
                                <option value="1" selected>1 adults</option>
                                <option value="2">2 adults</option>
                                <option value="3">3 adults</option>
                                <option value="4">4 adults</option>
                                <option value="5">5 adults</option>
                                <option value="6">6 adults</option>
                            </select>
                        </div>
                        <div class="flex flex-col align-center mr-4 text-center w-full">
                            <span class="mb-1">Children</span>
                            <select name="child" class="p-3 rounded">
                                <option value="0" selected>No child</option>
                                <option value="1">1 child</option>
                                <option value="2">2 child</option>
                                <option value="3">3 child</option>
                                <option value="4">4 child</option>
                                <option value="5">5 child</option>
                                <option value="6">6 child</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-col align-center mr-4 text-center w-full">
                        <span class="mb-1">Rooms</span>
                        <select name="rooms" class="p-3 rounded">
                            <option value="1" selected>1 rooms</option>
                            <option value="2">2 rooms</option>
                            <option value="3">3 rooms</option>
                            <option value="4">4 rooms</option>
                            <option value="5">5 rooms</option>
                            <option value="6">6 rooms</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-[#363a47] px-4 py-3 text-white rounded-xl">Check
                        Availability</button>
                </form>
                <?php if (isset($_GET['checkIn']) && isset($_GET['checkOut'])): ?>
                    <?php
                    require $_SERVER['DOCUMENT_ROOT'] . "/requires/conn.php";
                    $sql = "SELECT rooms.id AS room_id, rooms.roomname AS room_name, (rooms.count - IFNULL(reservations.reservationCount, 0)) AS available_rooms FROM rooms LEFT JOIN ( SELECT room_id, COUNT(reservations.room_id) AS reservationCount FROM reservations WHERE reservations.reserve_status = 'CONFIRMED' AND (reservations.check_in_date <= '" . $_GET['checkOut'] . "' AND reservations.check_out_date >= '" . $_GET['checkIn'] . "') GROUP BY reservations.room_id ) AS reservations ON rooms.id = reservations.room_id WHERE (rooms.count - IFNULL(reservations.reservationCount, 0)) >= 1";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0): ?>
                        <div class="px-3 py-2 mt-2 rounded-xl text-center bg-green-200">
                            Here are some available rooms:<br>
                            <ul>
                                <?php while ($data = $result->fetch_assoc()):
                                    ?>
                                    <?php if ($data['available_rooms'] > 0): ?>
                                        <li>
                                            <a class="font-bold hover:underline"
                                                href="<?php echo "http://" . $_SERVER['HTTP_HOST'] . "/room.php?selected=" . $data['room_id'] ?>">
                                                <span class="capitalize">
                                                    <?php echo $data['room_name'] ?>
                                                </span>
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div class="px-3 py-2 mt-2 rounded-xl text-center bg-red-200">
                            There are no available rooms in your given details
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <!-- end -->

        <!-- About -->
        <section id="about" class="scroll-mt-16">
            <div class="flex flex-col lg:flex-row">
                <div class="w-full lg:w-2/3 py-14 px-10">
                    <img src="../src/img/homepage/pool-pic.jpg" class="w-full" alt="">
                </div>
                <div class="w-full p-4 lg:w-1/2 lg:p-0 flex flex-col justify-center items-center lg:items-start">
                    <div class="font-bold text-5xl text-[#1e22aa] drop-shadow-md">About Novotel</div>
                    <p class="text-[#666] text-lg lg:text-xl leading-7 py-4 px-4 lg:px-0">
                        Novotel Manila Araneta City, formerly named Novotel Manila Araneta Center, is a 5-star Hotel
                        located
                        at the Araneta Center in Quezon City, Philippines. The mid-scale, full-service hotel is part of
                        AccorHotels, and the first hotel under the Novotel brand in the Philippines.
                    </p>
                </div>
            </div>
        </section>
        <!-- end -->

        <!-- services -->
        <section id="services">

            <div class="text-center text-3xl lg:text-5xl font-bold uppercase text-[#1f2844] drop-shadow-md">
                Our offer and services
            </div>

            <div class="flex flex-col py-10 px-12">
                <div class="flex flex-wrap py-4">
                    <div class="w-1/2 lg:w-1/4 flex flex-col justify-evenly text-center py-4">
                        <i class="fa-solid fa-wifi text-5xl text-[#1e22aa]"></i>
                        <span class="text-2xl font-bold text-[#1f2844]">Free Wifi</span>
                    </div>

                    <div class="w-1/2 lg:w-1/4 flex flex-col justify-evenly text-center py-4">
                        <i class="fa-solid fa-mug-saucer text-5xl text-[#1e22aa]"></i>
                        <span class="text-2xl font-bold text-[#1f2844]">Free Breakfast</spa>
                    </div>

                    <div class="w-1/2 lg:w-1/4 flex flex-col justify-evenly text-center py-4">
                        <i class="fa-solid fa-car text-5xl text-[#1e22aa]"></i>
                        <span class="text-2xl font-bold text-[#1f2844]">Free Parking</spa>
                    </div>

                    <div class="w-1/2 lg:w-1/4 flex flex-col justify-evenly text-center py-4">
                        <i class="fa-solid fa-paw text-5xl text-[#1e22aa]"></i>
                        <span class="text-2xl font-bold text-[#1f2844]">Pet-Free</spa>
                    </div>

                    <div class="w-1/2 lg:w-1/4 flex flex-col justify-evenly text-center py-4">
                        <i class="fa-solid fa-spa text-5xl text-[#1e22aa]"></i>
                        <span class="text-2xl font-bold text-[#1f2844]">Beauty Spa</spa>
                    </div>

                    <div class="w-1/2 lg:w-1/4 flex flex-col justify-evenly text-center py-4">
                        <i class="fa-solid fa-person-swimming text-5xl text-[#1e22aa]"></i>
                        <span class="text-2xl font-bold text-[#1f2844]">Pool Area</span>
                    </div>
                    <div class="w-1/2 lg:w-1/4 flex flex-col justify-evenly text-center py-4">
                        <i class="fa-solid fa-smoking text-5xl text-[#1e22aa]"></i>
                        <span class="text-2xl font-bold text-[#1f2844]">Smoking Area</span>
                    </div>
                    <div class="w-1/2 lg:w-1/4 flex flex-col justify-evenly text-center py-4">
                        <i class="fa-solid fa-utensils text-5xl text-[#1e22aa]"></i>
                        <span class="text-2xl font-bold text-[#1f2844] flex flex-col">
                            Free Buffet
                            <span class="text-lg italic font-normal text-[#666]">for 15 y/o & below</span>
                        </span>
                    </div>
                </div>
            </div>

        </section>

        <!-- end -->
        <!-- Feedback -->
        <!-- <section id="Feedback">

        <div class="feedback-heading">
            <span>Feedback</span>
            <h1>Client Says</h1>
        </div>

        <div class="feedback-box-container">
            <div class="feedback-box">
                <div class="top-box">
                    <div class="profile">
                        <div class="profile-img">
                            <img src="images/1 (1).jpg">
                        </div>
                        <div class="name-user">
                            <strong>Anonymous</strong>
                            <span>@anonymous123</span>
                        </div>
                    </div>
                    <div class="reviews">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>

                </div>
                <div class="client-reviews">
                    <p>THIS IS GOOD!!</p>
                </div>



            </div>
    </section> -->
        <!--end-->
        <!-- gallery -->

        <!-- <section class="gallery" id="gallery">

        <h1 class="heading">our gallery</h1>

        <div class="swiper gallery-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide slide">
                    <img src="images/novotel (1).jpg" alt="">
                    <div class="icon">
                        <i class="fas fa-magnifying-glass-plus"></i>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/home-slide1.jpg" alt="">
                    <div class="icon">
                        <i class="fas fa-magnifying-glass-plus"></i>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/home-slide2(1).jpg" alt="">
                    <div class="icon">
                        <i class="fas fa-magnifying-glass-plus"></i>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/home-slide3(1).jpg" alt="">
                    <div class="icon">
                        <i class="fas fa-magnifying-glass-plus"></i>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/home-slide4(1).jpg" alt="">
                    <div class="icon">
                        <i class="fas fa-magnifying-glass-plus"></i>
                    </div>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/home-slide4(1).jpg" alt="">
                    <div class="icon">
                        <i class="fas fa-magnifying-glass-plus"></i>
                    </div>
                </div>

            </div>

        </div>

    </section> -->

        <!-- end -->


        <!-- footer -->

        <footer class="footer footer-center w-full p-4 bg-[#1e22aa] text-white">
            <div class="text-center">
                <p>
                    Copyright © 2022 -
                    <a class="font-semibold" href="#">Group 6</a>
                </p>
            </div>
        </footer>
    </div>
    <!-- end -->
    <script src="../src/fontawesome/js/all.js?<?php echo time(); ?>"></script>
    <script src="../src/js/homepage.js?<?php echo time(); ?>"></script>
    <script src="../src/js/layouts/header.js?<?php echo time(); ?>"></script>
    <script defer src="../src/js/alpine.js?<?php echo time(); ?>"></script>


</body>


</html>