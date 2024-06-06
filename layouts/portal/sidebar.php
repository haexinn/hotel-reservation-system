<div class="flex flex-col py-4 mb-4">
    <img src="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/src/img/logo.png" class="w-full px-3">
    <span class="text-center font-bold italic">Reservation Dashboard</span>
</div>
<nav>
    <ul class="*:mb-2 *:px-4">
        <li>
            <a href="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/portal/index.php"
                class="flex items-center py-3 px-4 <?php if (str_contains($_SERVER['REQUEST_URI'], 'index')): ?> bg-[#1e22aa] text-white <?php endif; ?> hover:bg-[#1e22aa] hover:text-white rounded-md">
                <i class="fas fa-tachometer-alt mr-2"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/portal/reservations.php"
                class="flex items-center py-3 px-4 <?php if (str_contains($_SERVER['REQUEST_URI'], 'reservations')): ?> bg-[#1e22aa] text-white <?php endif; ?> hover:bg-[#1e22aa] hover:text-white rounded-md">
                <i class="fas fa-calendar-alt mr-2"></i>
                Reservations
            </a>
        </li>
        <li>
            <a href="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/portal/rooms.php"
                class="flex items-center py-3 px-4 <?php if (str_contains($_SERVER['REQUEST_URI'], 'rooms')): ?> bg-[#1e22aa] text-white <?php endif; ?> hover:bg-[#1e22aa] hover:text-white rounded-md">
                <i class="fas fa-bed mr-2"></i>
                Rooms
            </a>
        </li>
        <hr>
        <li>
            <a href="<?php echo "http://".$_SERVER['HTTP_HOST'] ?>/requires/logout.php"
                class="flex items-center py-3 px-4 hover:bg-[#1e22aa] hover:text-white rounded-md">
                <i class="fas fa-sign-out-alt mr-2"></i>
                Logout
            </a>
        </li>
    </ul>
</nav>