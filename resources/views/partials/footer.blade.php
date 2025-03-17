<footer
    class="px-4 sm:px-6 lg:px-12 py-16 {{ request()->routeIs('classes') || request()->routeIs('member.checkout') || request()->routeIs('payment.waiting') || request()->routeIs('class.detail') || request()->routeIs('profile') || request()->routeIs('transaction') || request()->routeIs('gate') || request()->routeIs('rent-transaction') || request()->routeIs('services.salon') || request()->routeIs('booking-salon') || request()->routeIs('service.detail.salon') ? 'bg-stone-100' : 'bg-white' }}">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10 lg:gap-4 w-[90%] mx-auto">
        <div class="flex flex-col text-stone-700 h-fit">
            <h1 class="poppins-medium text-base">Tangerine</h1>
            <p class="w-[80%] text-sm text-stone-600 mt-2">Far far away, behind the word mountains, far from the
                countries
                Vokalia and
                Consonantia,
                there live the
                blind texts.</p>
            <div class="mt-4 grid grid-cols-5">
                <a href="" class="bg-stone-700 text-white flex justify-center items-center w-12 h-12 rounded-full">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href=""
                    class="bg-stone-700 text-white flex justify-center items-center w-12 h-12 rounded-full">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>
                <a href=""
                    class="bg-stone-700 text-white flex justify-center items-center w-12 h-12 rounded-full">
                    <i class="fa-brands fa-instagram"></i>
                </a>
            </div>
        </div>
        <div class="flex flex-col text-stone-700 h-fit">
            <h1 class="poppins-medium text-base">Wellness Classes</h1>
            <div class="mt-2 flex flex-col gap-1">
                @foreach (getClassFooter() as $course)
                    <a href="{{ route('class.detail', $course->slug) }}"
                        class="text-stone-600 text-sm hover:font-medium hover:translate-x-1 duration-100">
                        {{ $course->name }}
                    </a>
                    {{-- <a href=""
                        class="text-stone-600 text-sm hover:font-medium hover:translate-x-1 duration-100">Yoga
                        For
                        Pregnant
                    </a>
                    <a href=""
                        class="text-stone-600 text-sm hover:font-medium hover:translate-x-1 duration-100">Yoga
                        Barre
                    </a>
                    <a href=""
                        class="text-stone-600 text-sm hover:font-medium hover:translate-x-1 duration-100">Yoga
                        Advance
                    </a> --}}
                @endforeach
                <a href="{{ route('classes') }}"
                    class="text-stone-600 text-sm hover:font-medium hover:translate-x-1 duration-100">
                    Show All
                </a>
            </div>
        </div>
        <div class="flex flex-col text-stone-700 h-fit">
            <h1 class="poppins-medium text-base">Salon Services</h1>
            {{-- <h1 class="poppins-medium text-base">Quick Links</h1> --}}
            <div class="mt-2 flex flex-col gap-1">
                @foreach (getServiceFooter() as $service)
                    <a href="{{ route('service.detail.salon', $service->slug) }}"
                        class="text-stone-600 text-sm hover:font-medium hover:translate-x-1 duration-100">
                        {{ $service->name }}
                    </a>
                @endforeach
                <a href="{{ route('services.salon') }}"
                    class="text-stone-600 text-sm hover:font-medium hover:translate-x-1 duration-100">
                    Show All
                </a>
                {{-- <a href=""
                    class="text-stone-600 text-sm hover:font-medium hover:translate-x-1 duration-100">About
                </a>
                <a href=""
                    class="text-stone-600 text-sm hover:font-medium hover:translate-x-1 duration-100">Classes
                </a>
                <a href=""
                    class="text-stone-600 text-sm hover:font-medium hover:translate-x-1 duration-100">Schedule
                </a> --}}
            </div>
        </div>
        <div class="flex flex-col text-stone-700 h-fit">
            <h1 class="poppins-medium text-base">Have a Question?</h1>
            <div class="mt-3 space-y-4">
                <div class="flex items-center gap-2 text-sm">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>Jl. Raya Tangerang, Tangerang, Banten</span>
                </div>
                <div class="flex items-center gap-2 text-sm">
                    <i class="fa-solid fa-phone"></i>
                    <span>+62 1234 5678</span>
                </div>
                <div class="flex items-center gap-2 text-sm">
                    <i class="fa-solid fa-envelope"></i>
                    <span>website@tangerine.my.id</span>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center text-stone-600 mt-20 lg:mt-12 text-base">
        Copyright ©2025 All rights reserved
    </div>
</footer>
