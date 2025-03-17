<nav class="bg-white shadow-md fixed top-0 w-full z-10">
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-[70px]">
            <div class="flex items-center">
                <a href="{{ route('home.salon') }}" class="flex items-center">
                    <img src="/imgs/Logo Tangerine-black.png" class="h-8 w-auto mr-2" alt="Tangerine Logo" />
                    <span class="text-xl font-bold text-stone-700 flex items-center gap-2">
                        Tangerine
                        <span
                            class="bg-red-100 border rounded-md border-red-800 text-red-800 text-xs font-medium me-2 px-2.5 py-1 poppins-medium">
                            Salon
                        </span>
                    </span>
                </a>
            </div>
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home.salon') }}"
                    class="{{ request()->routeIs('home.salon') ? 'text-stone-900 hover:text-stone-900 poppins-semibold' : 'text-stone-700 hover:text-stone-900 font-medium' }}">Home</a>
                <a href="{{ route('about.salon') }}"
                    class="{{ request()->routeIs('about.salon') ? 'text-stone-900 hover:text-stone-900 poppins-semibold' : 'text-stone-700 hover:text-stone-900 font-medium' }}">About</a>
                <a href="{{ route('beautician.salon') }}"
                    class="{{ request()->routeIs('beautician.salon') ? 'text-stone-900 hover:text-stone-900 poppins-semibold' : 'text-stone-700 hover:text-stone-900 font-medium' }}">Beauticians</a>
                <a href="{{ route('services.salon') }}"
                    class="{{ request()->routeIs('services.salon') || request()->routeIs('class.detail') ? 'text-stone-900 hover:text-stone-900 poppins-semibold' : 'text-stone-700 hover:text-stone-900 font-medium' }}">Services</a>
                <a href="{{ route('product.salon') }}"
                    class="{{ request()->routeIs('product.salon') ? 'text-stone-900 hover:text-stone-900 poppins-semibold' : 'text-stone-700 hover:text-stone-900 font-medium' }}">Product</a>

                @auth
                    <button id="dropdownAvatarNameButton"Mobile data-dropdown-toggle="dropdownAvatarName"
                        class="cursor-pointer flex items-center text-sm pe-1 font-medium text-gray-900 rounded-full hover:text-stone-600 md:me-0 focus:ring-4 focus:ring-gray-100"
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
                        class="z-10 hidden overflow-hidden bg-white divide-y divide-gray-100 rounded-lg shadow-md w-44">
                        <div class="px-4 py-3 text-sm text-gray-900 ">
                            <div class="font-medium">{{ auth()->user()->name }}</div>
                            <div class="truncate py-1">{{ auth()->user()->email }}</div>
                        </div>
                        <div class="px-4 py-3 text-sm text-gray-900 ">
                            <div class="font-medium">Transaction History</div>
                            <ul class="text-sm mt-2 text-gray-700"
                                aria-labelledby="dropdownInformdropdownAvatarNameButtonationButtonMobile">
                                <li>
                                    <a href="{{ route('transaction') }}" class="block py-2.5 hover:bg-gray-50">
                                        <i class="fa-regular fa-history mr-1"></i>
                                        Wellness
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('rent-transaction') }}" class="block py-2.5 hover:bg-gray-50">
                                        <i class="fa-regular fa-history mr-1"></i>
                                        Room Rental
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('booking-salon') }}" class="block py-2.5 hover:bg-gray-50">
                                        <i class="fa-regular fa-history mr-1"></i>
                                        Booking Salon
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <ul class="py-2 text-sm text-gray-700"
                            aria-labelledby="dropdownInformdropdownAvatarNameButtonationButtonMobile">
                            <li>
                                <a href="{{ route('profile') }}" class="block px-4 py-2.5 hover:bg-gray-100">
                                    <i class="fa-regular fa-user mr-1"></i>
                                    My Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:text-red-600">
                                    <i class="fa-regular fa-right-from-bracket mr-1"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="text-white bg-stone-800 py-2.5 px-4 rounded-md hover:bg-stone-900 font-medium">Login</a>
                @endauth
            </div>

            <div class="flex items-center gap-2 md:hidden">
                @auth
                    <button id="dropdownAvatarNameButtonMobile" data-dropdown-toggle="dropdownAvatarNameMobile"
                        class="flex items-center text-sm pe-1 font-medium text-gray-900 rounded-full hover:text-stone-600  md:me-0 focus:ring-4 focus:ring-gray-100 "
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
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-md w-44">
                        <div class="px-4 py-3 text-sm text-gray-900 ">
                            <div class="font-medium">{{ auth()->user()->name }}</div>
                            <div class="truncate py-1">{{ auth()->user()->email }}</div>
                        </div>
                        <div class="px-4 py-3 text-sm text-gray-900 ">
                            <div class="font-medium">Transaction History</div>
                            <ul class="text-sm mt-2 text-gray-700"
                                aria-labelledby="dropdownInformdropdownAvatarNameButtonationButtonMobile">
                                <li>
                                    <a href="{{ route('transaction') }}" class="block py-2.5 hover:bg-gray-50">
                                        <i class="fa-regular fa-history mr-1"></i>
                                        Wellness
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('rent-transaction') }}" class="block py-2.5 hover:bg-gray-50">
                                        <i class="fa-regular fa-history mr-1"></i>
                                        Room Rental
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('booking-salon') }}" class="block py-2.5 hover:bg-gray-50">
                                        <i class="fa-regular fa-history mr-1"></i>
                                        Booking Salon
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <ul class="py-2 text-sm text-gray-700"
                            aria-labelledby="dropdownInformdropdownAvatarNameButtonationButtonMobile">
                            <li>
                                <a href="{{ route('profile') }}" class="block px-4 py-2.5 hover:bg-gray-100">
                                    <i class="fa-regular fa-user mr-1"></i>
                                    My Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:text-red-600">
                                    <i class="fa-regular fa-right-from-bracket mr-1"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
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
            <a href="{{ route('home.salon') }}"
                class="block px-3 py-2 text-base {{ request()->routeIs('home.salon') ? 'poppins-medium text-stone-900 bg-stone-100 poppins-semibold' : 'poppins-medium text-stone-700 hover:text-stone-900 hover:bg-gray-50' }} ">Beranda</a>
            <a href="{{ route('about.salon') }}"
                class="block px-3 py-2 text-base {{ request()->routeIs('about.salon') ? 'poppins-medium text-stone-900 bg-stone-100 poppins-semibold' : 'poppins-medium text-stone-700 hover:text-stone-900 hover:bg-gray-50' }}">About</a>
            <a href="{{ route('beautician.salon') }}"
                class="block px-3 py-2 text-base {{ request()->routeIs('beautician.salon') ? 'poppins-medium text-stone-900 bg-stone-100 poppins-semibold' : 'poppins-medium text-stone-700 hover:text-stone-900 hover:bg-gray-50' }}">Beauticians</a>
            <a href="{{ route('services.salon') }}"
                class="block px-3 py-2 text-base {{ request()->routeIs('services.salon') || request()->routeIs('class.detail') ? 'poppins-medium text-stone-900 bg-stone-100 poppins-semibold' : 'poppins-medium text-stone-700 hover:text-stone-900 hover:bg-gray-50' }}">Services</a>
            <a href="{{ route('product.salon') }}"
                class="block px-3 py-2 text-base {{ request()->routeIs('product.salon') ? 'poppins-medium text-stone-900 bg-stone-100 poppins-semibold' : 'poppins-medium text-stone-700 hover:text-stone-900 hover:bg-gray-50' }}">Product</a>
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
