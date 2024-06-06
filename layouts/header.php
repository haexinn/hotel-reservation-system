<!-- header -->
<header x-data="headerSection" class="z-30 sticky top-0 relative flex flex-col lg:flex-row py-4 lg:py-6 px-6 bg-white">
    <div class="flex flex-row items-center justify-between">
        <img src="../src/img/logo.png" class="w-1/3 lg:w-1/6">
        <!-- Bars Icon -->
        <a @click="toggleMenu" class="block lg:hidden">
            <i class="fa-solid" :class="isMenuOpen ? 'fa-x' : 'fa-bars'"></i>
        </a>
    </div>
    <div class="hidden lg:flex flex-row justify-evenly items-center">
        <a href="<?php echo "http://" . $_SERVER['HTTP_HOST'] ?>/homepage.php#home"
            class="mx-4 transition ease-in-out hover:font-bold hover:text-[#1e22aa]">Home</a>
        <a href="<?php echo "http://" . $_SERVER['HTTP_HOST'] ?>/homepage.php#about"
            class="mx-4 transition ease-in-out hover:font-bold hover:text-[#1e22aa]">About</a>
        <a href="<?php echo "http://" . $_SERVER['HTTP_HOST'] ?>/rooms.php"
            class="mx-4 transition ease-in-out hover:font-bold hover:text-[#1e22aa]">Rooms</a>
        <?php if (isset($_SESSION['id'])): ?>
            <a href="<?php echo "http://" . $_SERVER['HTTP_HOST'] ?>/account.php"
                class="mx-4 transition ease-in-out hover:font-bold hover:underline hover:text-[#1e22aa] flex flex-row whitespace-nowrap">
                Hi! <?php echo $_SESSION['username']; ?>
            </a>
            <a href="<?php echo "http://" . $_SERVER['HTTP_HOST'] ?>/requires/logout.php"
                class="mx-4 px-4 py-2 bg-[#1e22aa] text-white font-bold rounded-xl transition ease-in-out delay-150 hover:scale-110 duration-300 cursor-pointer">Logout</a>
        <?php else: ?>
            <a @click="openModal"
                class="mx-4 px-4 py-2 bg-[#1e22aa] text-white font-bold rounded-xl transition ease-in-out delay-150 hover:scale-110 duration-300 cursor-pointer">Login</a>
        <?php endif; ?>
    </div>

    <!-- Navigation Menu -->
    <div x-show="isMenuOpen" class="flex lg:hidden flex-col items-center">
        <a href="<?php echo "http://" . $_SERVER['HTTP_HOST'] ?>/homepage.php#home"
            class="py-2 px-4 text-gray-800">Home</a>
        <a href="<?php echo "http://" . $_SERVER['HTTP_HOST'] ?>/homepage.php#about"
            class="py-2 px-4 text-gray-800">About</a>
        <a href="<?php echo "http://" . $_SERVER['HTTP_HOST'] ?>/rooms.php" class="py-2 px-4 text-gray-800">Rooms</a>
        <?php if (isset($_SESSION['id'])): ?>
            <a href="<?php echo "http://" . $_SERVER['HTTP_HOST'] ?>/account.php" class="py-2 px-4 text-gray-800">Hi!
                <?php echo $_SESSION['username']; ?></a>
            <a href="<?php echo "http://" . $_SERVER['HTTP_HOST'] ?>/requires/logout.php"
                class="py-2 px-4 bg-[#1e22aa] text-white font-bold">Logout</a>
        <?php else: ?>
            <a @click="openModal" class="py-2 px-4 bg-[#1e22aa] text-white font-bold">Login</a>
        <?php endif; ?>
    </div>

    <!-- Modal -->
    <div x-show="isOpenModal" @trigger-login.window="openModal" @click.away="isOpenModal = false"
        class="fixed z-40 inset-0 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen">
            <div @click="isOpenModal = false" class="fixed inset-0 bg-gray-500 opacity-75"></div>
            <div class="z-50 bg-white p-14 rounded shadow-lg">
                <div class="flex justify-between items-center">
                    <template x-if="showLoginForm">
                        <h1 class="text-xl font-bold text-[#1e22aa] mb-2 uppercase">Login</h1>
                    </template>
                    <template x-if="showRegisterForm">
                        <h1 class="text-xl font-bold text-[#1e22aa] mb-2 uppercase">Register</h1>
                    </template>
                    <!-- Close Button -->
                    <button @click="isOpenModal = false" class="text-gray-700 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                <div class="mt-4">
                    <!-- Modal Content -->
                    <template x-if="showLoginForm">
                        <form class="flex flex-col" method="POST" action="requires/login.php">
                            <div class="flex flex-col mb-2">
                                <label for='email' class="mb-1 font-semibold">Email</label>
                                <input type="email" id="email" name="email"
                                    class="text-lg px-3 py-2 border border-gray-500 rounded-xl" required>
                            </div>

                            <div class="flex flex-col mb-4">
                                <label for='password' class="mb-1 font-semibold">Password</label>
                                <input type="password" id="password" name="password"
                                    class="text-lg px-3 py-2 border border-gray-500 rounded-xl" required>
                            </div>
                            <button type="submit"
                                class="block bg-[#1e22aa] py-3 text-white text-center rounded-xl font-bold mb-2 cursor-pointer">LOGIN</button>
                            <hr class="border border-gray-500">
                            <div class="mt-2 flex flex-col items-center justify-center">
                                <span class="mb-1">Don't Have an Account?</span>
                                <a @click="showRegister"
                                    class="block bg-[#363a47] py-3 text-white text-center rounded-xl font-bold mt-2 cursor-pointer w-full">REGISTER</a>
                            </div>
                        </form>
                    </template>
                    <template x-if="showRegisterForm">
                        <form class="flex flex-col" method="POST" action="requires/register.php">
                            <div class="flex flex-col mb-2">
                                <label for='user' class="mb-1 font-semibold">Username</label>
                                <input type="text" id="user" name="user"
                                    class="text-lg px-3 py-2 border border-gray-500 rounded-xl" required>
                            </div>

                            <div class="flex flex-col mb-2">
                                <label for='email' class="mb-1 font-semibold">Email</label>
                                <input type="email" id="email" name="email"
                                    class="text-lg px-3 py-2 border border-gray-500 rounded-xl" required>
                            </div>

                            <div class="flex flex-col mb-4">
                                <label for='password' class="mb-1 font-semibold">Password</label>
                                <input type="password" id="password" name="password"
                                    class="text-lg px-3 py-2 border border-gray-500 rounded-xl" required>
                            </div>

                            <div class="flex flex-col mb-4">
                                <label for='confirm-password' class="mb-1 font-semibold">Confirm Password</label>
                                <input type="password" id="confirm-password" name="confirm-password"
                                    class="text-lg px-3 py-2 border border-gray-500 rounded-xl" required>
                            </div>

                            <div class="flex flex-col mb-4">
                                <label for='phone' class="mb-1 font-semibold">Mobile Phone</label>
                                <input type="tel" id="phone" name="phone" pattern="09[0-9]{9}"
                                    class="text-lg px-3 py-2 border border-gray-500 rounded-xl" required>
                            </div>
                            <button type="submit"
                                class="block bg-[#1e22aa] py-3 text-white text-center rounded-xl font-bold mb-2 cursor-pointer">REGISTER</button>
                            <hr class="border border-gray-500">
                            <div class="mt-2 flex flex-col items-center justify-center">
                                <span class="mb-1">Already Have an Account?</span>
                                <a @click="showLogin"
                                    class="block bg-[#363a47] py-3 text-white text-center rounded-xl font-bold cursor-pointer w-full">LOGIN</a>
                            </div>
                        </form>
                    </template>
                </div>
            </div>
        </div>
    </div>
</header>