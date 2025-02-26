<nav class="bg-white shadow-md fixed top-0 w-full z-10">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-[70px]">
            <div class="flex items-center">
                <a href="#" class="flex items-center">
                    <img src="/imgs/logo.png" class="h-8 w-auto mr-2" alt="Tangerine Logo" />
                    <span class="text-xl font-bold text-stone-700">Tangerine</span>
                </a>
            </div>
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'text-stone-900 hover:text-stone-900 poppins-semibold' : 'text-stone-700 hover:text-stone-900 font-medium' }}">Home</a>
                <a href="{{ route('about') }}"
                    class="{{ request()->routeIs('about') ? 'text-stone-900 hover:text-stone-900 poppins-semibold' : 'text-stone-700 hover:text-stone-900 font-medium' }}">About</a>
                <a href="{{ route('trainer') }}"
                    class="{{ request()->routeIs('trainer') ? 'text-stone-900 hover:text-stone-900 poppins-semibold' : 'text-stone-700 hover:text-stone-900 font-medium' }}">Trainer</a>
                <a href="{{ route('classes') }}"
                    class="{{ request()->routeIs('classes') ? 'text-stone-900 hover:text-stone-900 poppins-semibold' : 'text-stone-700 hover:text-stone-900 font-medium' }}">Classes</a>
                <a href="{{ route('schedule') }}"
                    class="{{ request()->routeIs('schedule') ? 'text-stone-900 hover:text-stone-900 poppins-semibold' : 'text-stone-700 hover:text-stone-900 font-medium' }}">Schedule</a>
                @auth
                    <button id="dropdownAvatarNameButton"Mobile data-dropdown-toggle="dropdownAvatarName"
                        class="flex items-center text-sm pe-1 font-medium text-gray-900 rounded-full hover:text-stone-600 dark:hover:text-stone-500 md:me-0 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white"
                        type="button">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 me-2 rounded-full"
                            src="{{ auth()->user()->image ? '/uploads/users/' . auth()->user()->image : '/imgs/no-image.png' }}"
                            alt="user photo">
                        {{ auth()->user()->name }}
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdownAvatarName"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-md w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                            <div class="font-medium">{{ auth()->user()->name }}</div>
                            <div class="truncate py-1">{{ auth()->user()->email }}</div>
                        </div>
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownInformdropdownAvatarNameButtonationButtonMobile">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">My
                                    Profile</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Transaction
                                    History</a>
                            </li>
                        </ul>
                        <div class="py-2">
                            <a href="{{ route('logout') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Logout</a>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="text-white bg-stone-800 py-2.5 px-4 rounded-md hover:bg-stone-900 font-medium">Login</a>
                @endauth
            </div>

            <div class="flex items-center gap-2 md:hidden">
                @auth
                    <button id="dropdownAvatarNameButtonMobile" data-dropdown-toggle="dropdownAvatarNameMobile"
                        class="flex items-center text-sm pe-1 font-medium text-gray-900 rounded-full hover:text-stone-600 dark:hover:text-stone-500 md:me-0 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-white"
                        type="button">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 me-2 rounded-full"
                            src="{{ auth()->user()->image ? '/uploads/users/' . auth()->user()->image : '/imgs/no-image.png' }}"
                            alt="user photo">
                        {{ auth()->user()->name }}
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div id="dropdownAvatarNameMobile"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-md w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                            <div class="font-medium">{{ auth()->user()->name }}</div>
                            <div class="truncate py-1">{{ auth()->user()->email }}</div>
                        </div>
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownInformdropdownAvatarNameButtonationButtonMobile">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">My
                                    Profile</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Transaction
                                    History</a>
                            </li>
                        </ul>
                        <div class="py-2">
                            <a href="{{ route('logout') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Logout</a>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="text-white bg-stone-800 py-2.5 px-4 rounded-md hover:bg-stone-900 font-medium">Login</a>
                @endauth
                <div class="flex items-center">
                    <button type="button"
                        class="mobile-menu-button inline-flex items-center justify-center py-2 px-3 rounded-md text-stone-700 hover:text-stone-900 hover:bg-gray-100 !rounded-button">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="mobile-menu hidden md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t">
            <a href="{{ route('home') }}"
                class="block px-3 py-2 text-base {{ request()->routeIs('home') ? 'poppins-medium text-stone-900 bg-stone-100 poppins-semibold' : 'poppins-medium text-stone-700 hover:text-stone-900 hover:bg-gray-50' }} ">Beranda</a>
            <a href="{{ route('about') }}"
                class="block px-3 py-2 text-base {{ request()->routeIs('about') ? 'poppins-medium text-stone-900 bg-stone-100 poppins-semibold' : 'poppins-medium text-stone-700 hover:text-stone-900 hover:bg-gray-50' }}">About</a>
            <a href="{{ route('trainer') }}"
                class="block px-3 py-2 text-base {{ request()->routeIs('trainer') ? 'poppins-medium text-stone-900 bg-stone-100 poppins-semibold' : 'poppins-medium text-stone-700 hover:text-stone-900 hover:bg-gray-50' }}">Trainer</a>
            <a href="{{ route('classes') }}"
                class="block px-3 py-2 text-base {{ request()->routeIs('classes') ? 'poppins-medium text-stone-900 bg-stone-100 poppins-semibold' : 'poppins-medium text-stone-700 hover:text-stone-900 hover:bg-gray-50' }}">Classes</a>
            <a href="{{ route('schedule') }}"
                class="block px-3 py-2 text-base {{ request()->routeIs('schedule') ? 'poppins-medium text-stone-900 bg-stone-100 poppins-semibold' : 'poppins-medium text-stone-700 hover:text-stone-900 hover:bg-gray-50' }}">Schedule</a>
        </div>
    </div>
</nav>



<script>
    const mobileMenuButton = document.querySelector(".mobile-menu-button");
    const mobileMenu = document.querySelector(".mobile-menu");

    mobileMenuButton.addEventListener("click", () => {
        mobileMenu.classList.toggle("hidden");
    });
</script>
