@extends('layouts.user')

@section('content')
    {{-- Hero --}}
    <div class="h-[550px] relative">
        <img src="/imgs/bg_3.jpg" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-stone-800/50 bg-opacity-60"></div>
        <div class="absolute ps-5 top-0 left-0 text-white flex flex-col justify-center items-center w-full h-full">
            <h2 class="text-4xl lg:text-5xl poppins-bold">About Us</h2>
            {{-- <p class="text-lg text-white">Home About</p> --}}
        </div>
    </div>
    {{-- EndHero --}}

    {{-- Services --}}
    <div class="px-4 sm:px-6 lg:px-8 py-28 bg-white">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-7 w-[90%] mx-auto">
            <div class="flex flex-col items-center">
                <img src="/imgs/classes-6.jpg" class="size-[230px] object-cover rounded-full shadow-md">
                <div class="mt-5">
                    <h1 class="text-center text-stone-700 text-2xl poppins-semibold">Power Yoga</h1>
                    <p class="text-sm mt-3 text-center">
                        Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                        the blind texts.
                    </p>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <img src="/imgs/classes-1.jpg" class="size-[230px] object-cover rounded-full shadow-md">
                <div class="mt-5">
                    <h1 class="text-center text-stone-700 text-2xl poppins-semibold">Comunnity Class</h1>
                    <p class="text-sm mt-3 text-center">
                        Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                        the blind texts.
                    </p>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <img src="/imgs/classes-7.jpg" class="size-[230px] object-cover rounded-full shadow-md">
                <div class="mt-5">
                    <h1 class="text-center text-stone-700 text-2xl poppins-semibold">Foundation Yoga</h1>
                    <p class="text-sm mt-3 text-center">
                        Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                        the blind texts.
                    </p>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <img src="/imgs/classes-2.jpg" class="size-[230px] object-cover rounded-full shadow-md">
                <div class="mt-5">
                    <h1 class="text-center text-stone-700 text-2xl poppins-semibold">Prenatal Yoga</h1>
                    <p class="text-sm mt-3 text-center">
                        Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                        the blind texts.
                    </p>
                </div>
            </div>
        </div>
    </div>
    {{-- End Services --}}

    {{-- Experience Yoga --}}
    <div class="px-4 sm:px-6 lg:px-8 py-28 bg-stone-100">
        <div class="w-[90%] mx-auto" data-aos="fade-down" data-aos-duration="1000">
            <h1 class="text-4xl text-stone-700 text-center poppins-semibold">Experience Of Yoga</h1>
            <div class="mt-20 grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="space-y-10 h-fit">
                    <div class="flex gap-5">
                        <div class="text-end h-fit">
                            <h1 class="poppins-medium text-stone-700 text-xl">Balance Body & Mind</h1>
                            <p class="text-sm mt-2 text-stone-600">A small river named Duden flows by their place and
                                supplies it with the necessary regelialia.
                            </p>
                        </div>
                        <div class="h-fit">
                            <i
                                class="size-16 text-xl flex justify-center items-center leading-none fa-regular fa-hand-holding-droplet p-5 rounded-full bg-stone-700 text-white"></i>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="text-end h-fit">
                            <h1 class="poppins-medium text-stone-700 text-xl">Healthy Daily Life</h1>
                            <p class="text-sm mt-2 text-stone-600">A small river named Duden flows by their place and
                                supplies it with the necessary regelialia.
                            </p>
                        </div>
                        <div class="h-fit">
                            <i
                                class="size-16 text-xl flex justify-center items-center leading-none fa-regular fa-hand-holding-droplet p-5 rounded-full bg-stone-700 text-white"></i>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="text-end h-fit">
                            <h1 class="poppins-medium text-stone-700 text-xl">Improves your flexibility</h1>
                            <p class="text-sm mt-2 text-stone-600">A small river named Duden flows by their place and
                                supplies it with the necessary regelialia.
                            </p>
                        </div>
                        <div class="h-fit">
                            <i
                                class="size-16 text-xl flex justify-center items-center leading-none fa-regular fa-hand-holding-droplet p-5 rounded-full bg-stone-700 text-white"></i>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="text-end h-fit">
                            <h1 class="poppins-medium text-stone-700 text-xl">Protects your spine</h1>
                            <p class="text-sm mt-2 text-stone-600">A small river named Duden flows by their place and
                                supplies it with the necessary regelialia.
                            </p>
                        </div>
                        <div class="h-fit">
                            <i
                                class="size-16 text-xl flex justify-center items-center leading-none fa-regular fa-hand-holding-droplet p-5 rounded-full bg-stone-700 text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="h-fit">
                    <img src="/imgs/services.jpg" class="w-full h-[550px] object-cover rounded-md shadow-md">
                </div>
                <div class="space-y-10 h-fit">
                    <div class="flex gap-5">
                        <div class="h-fit">
                            <i
                                class="size-16 text-xl flex justify-center items-center leading-none fa-regular fa-hand-holding-droplet p-5 rounded-full bg-stone-700 text-white"></i>
                        </div>
                        <div class="text-start h-fit">
                            <h1 class="poppins-medium text-stone-700 text-xl">Betters your bone health</h1>
                            <p class="text-sm mt-2 text-stone-600">A small river named Duden flows by their place and
                                supplies it with the necessary regelialia.
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="h-fit">
                            <i
                                class="size-16 text-xl flex justify-center items-center leading-none fa-regular fa-hand-holding-droplet p-5 rounded-full bg-stone-700 text-white"></i>
                        </div>
                        <div class="text-start h-fit">
                            <h1 class="poppins-medium text-stone-700 text-xl">Increases your blood flow</h1>
                            <p class="text-sm mt-2 text-stone-600">A small river named Duden flows by their place and
                                supplies it with the necessary regelialia.
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="h-fit">
                            <i
                                class="size-16 text-xl flex justify-center items-center leading-none fa-regular fa-hand-holding-droplet p-5 rounded-full bg-stone-700 text-white"></i>
                        </div>
                        <div class="text-start h-fit">
                            <h1 class="poppins-medium text-stone-700 text-xl">Keep a practice journal</h1>
                            <p class="text-sm mt-2 text-stone-600">A small river named Duden flows by their place and
                                supplies it with the necessary regelialia.
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="h-fit">
                            <i
                                class="size-16 text-xl flex justify-center items-center leading-none fa-regular fa-hand-holding-droplet p-5 rounded-full bg-stone-700 text-white"></i>
                        </div>
                        <div class="text-start h-fit">
                            <h1 class="poppins-medium text-stone-700 text-xl">Builds muscle strength</h1>
                            <p class="text-sm mt-2 text-stone-600">A small river named Duden flows by their place and
                                supplies it with the necessary regelialia.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Experience Yoga --}}

    {{-- Testimonial --}}
    <div class="px-4 sm:px-6 lg:px-8 py-28 bg-white">
        <div class="w-[90%] mx-auto">
            <h1 class="text-4xl text-stone-700 text-center poppins-semibold" data-aos="fade-up" data-aos-duration="1000">
                Testimony Success Stories
            </h1>
            <div class="mt-20 grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div class="" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <div class="">
                        <div
                            class="absolute -top-7 -left-7 bg-stone-700 text-white flex justify-center items-center size-10 rounded-full">
                            <i class="fa-solid fa-quote-left"></i>
                        </div>
                        <p class="text-base text-stone-700 relative">Far far away, behind the word mountains, far from the
                            countries
                            Vokalia and Consonantia, there
                            live the blind texts.
                        </p>
                    </div>
                    <div class="mt-10 flex items-center justify-center gap-5">
                        <img src="/imgs/person_1.jpg" class="rounded-full size-24 object-cover shadow-md">
                        <div class="">
                            <h1 class="text-lg text-stone-700 poppins-medium">Lance Roger</h1>
                            <p class="text-sm text-stone-600">Customer</p>
                        </div>
                    </div>
                </div>
                <div class="" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <div class="">
                        <div
                            class="absolute -top-7 -left-7 bg-stone-700 text-white flex justify-center items-center size-10 rounded-full">
                            <i class="fa-solid fa-quote-left"></i>
                        </div>
                        <p class="text-base text-stone-700 relative">Far far away, behind the word mountains, far from the
                            countries
                            Vokalia and Consonantia, there
                            live the blind texts.
                        </p>
                    </div>
                    <div class="mt-10 flex items-center justify-center gap-5">
                        <img src="/imgs/person_2.jpg" class="rounded-full size-24 object-cover shadow-md">
                        <div class="">
                            <h1 class="text-lg text-stone-700 poppins-medium">John Doe</h1>
                            <p class="text-sm text-stone-600">Customer</p>
                        </div>
                    </div>
                </div>
                <div class="" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                    <div class="">
                        <div
                            class="absolute -top-7 -left-7 bg-stone-700 text-white flex justify-center items-center size-10 rounded-full">
                            <i class="fa-solid fa-quote-left"></i>
                        </div>
                        <p class="text-base text-stone-700 relative">Far far away, behind the word mountains, far from the
                            countries
                            Vokalia and Consonantia, there
                            live the blind texts.
                        </p>
                    </div>
                    <div class="mt-10 flex items-center justify-center gap-5">
                        <img src="/imgs/person_3.jpg" class="rounded-full size-24 object-cover shadow-md">
                        <div class="">
                            <h1 class="text-lg text-stone-700 poppins-medium">Jane Sint</h1>
                            <p class="text-sm text-stone-600">Customer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Testimonial --}}

    {{-- Rooms --}}
    <div class="px-4 sm:px-6 lg:px-8 py-28 bg-stone-100">
        <div class="w-[90%] mx-auto">
            <h1 class="text-4xl text-stone-700 text-center poppins-semibold" data-aos="fade-down"
                data-aos-duration="1000">
                Our Rooms
            </h1>
            <div class="mt-20 grid grid-cols-2 lg:grid-cols-3 gap-12">
                <img src="/imgs/room/IMG-20250206-WA0025.jpg" class="w-full h-[300px] object-cover rounded-md shadow-md"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                <img src="/imgs/room/IMG-20250206-WA0020.jpg" class="w-full h-[300px] object-cover rounded-md shadow-md"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <img src="/imgs/room/IMG-20250206-WA0021.jpg" class="w-full h-[300px] object-cover rounded-md shadow-md"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                <img src="/imgs/room/IMG-20250206-WA0023.jpg" class="w-full h-[300px] object-cover rounded-md shadow-md"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                <img src="/imgs/room/IMG-20250206-WA0019.jpg" class="w-full h-[300px] object-cover rounded-md shadow-md"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <img src="/imgs/room/IMG-20250206-WA0026.jpg" class="w-full h-[300px] object-cover rounded-md shadow-md"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                <img src="/imgs/room/IMG-20250206-WA0027.jpg" class="w-full h-[300px] object-cover rounded-md shadow-md"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                <img src="/imgs/room/IMG-20250206-WA0028.jpg" class="w-full h-[300px] object-cover rounded-md shadow-md"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <img src="/imgs/room/IMG-20250206-WA0030.jpg" class="w-full h-[300px] object-cover rounded-md shadow-md"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
            </div>
        </div>
    </div>
    {{-- End Rooms --}}
@endsection
