@extends('layouts.user')

@section('content')
    {{-- Hero --}}
    <div class="h-[550px] relative">
        <img src="/imgs/bg_3.jpg" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-stone-800/50 bg-opacity-60"></div>
        <div class="absolute ps-5 top-0 left-0 text-white flex flex-col justify-center items-center w-full h-full">
            <h2 class="text-4xl lg:text-5xl poppins-bold">Class Program</h2>
            <p class="text-lg text-white mt-2">Home Class</p>
        </div>
    </div>
    {{-- EndHero --}}

    {{-- Classes --}}
    <div class="px-4 sm:px-6 lg:px-8 py-28 bg-white">
        <div class="w-[90%] mx-auto">
            <h1 class="text-4xl text-stone-700 text-center poppins-semibold" data-aos="fade-up" data-aos-duration="1000">
                Our Classes
            </h1>
            <div class="mt-20 grid grid-cols-1 lg:grid-cols-3 gap-12">
                <div class="" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <img src="/imgs/classes-1.jpg" class="w-full h-[270px] object-cover rounded-md shadow-md">
                    <div class="mt-5 text-center">
                        <h1 class="text-lg text-stone-700 poppins-medium">Private & Group Lessons</h1>
                        <p class="text-sm text-stone-600">Sunday, 01:00 PM - 03:00 PM</p>
                    </div>
                </div>
                <div class="" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <img src="/imgs/classes-2.jpg" class="w-full h-[270px] rounded-md shadow-md">
                    <div class="mt-5 text-center">
                        <h1 class="text-lg text-stone-700 poppins-medium">Yoga for Pregnants</h1>
                        <p class="text-sm text-stone-600">Sunday, 01:00 PM - 03:00 PM</p>
                    </div>
                </div>
                <div class="" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                    <img src="/imgs/classes-3.jpg" class="w-full h-[270px] rounded-md shadow-md">
                    <div class="mt-5 text-center">
                        <h1 class="text-lg text-stone-700 poppins-medium">Yoga for Beginners</h1>
                        <p class="text-sm text-stone-600">Sunday, 01:00 PM - 03:00 PM</p>
                    </div>
                </div>
                <div class="" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <img src="/imgs/classes-4.jpg" class="w-full h-[270px] rounded-md shadow-md">
                    <div class="mt-5 text-center">
                        <h1 class="text-lg text-stone-700 poppins-medium">Yoga Barre</h1>
                        <p class="text-sm text-stone-600">Sunday, 01:00 PM - 03:00 PM</p>
                    </div>
                </div>
                <div class="" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <img src="/imgs/classes-5.jpg" class="w-full h-[270px] rounded-md shadow-md">
                    <div class="mt-5 text-center">
                        <h1 class="text-lg text-stone-700 poppins-medium">Yoga Core</h1>
                        <p class="text-sm text-stone-600">Sunday, 01:00 PM - 03:00 PM</p>
                    </div>
                </div>
                <div class="" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                    <img src="/imgs/classes-6.jpg" class="w-full h-[270px] rounded-md shadow-md">
                    <div class="mt-5 text-center">
                        <h1 class="text-lg text-stone-700 poppins-medium">Yoga Restore</h1>
                        <p class="text-sm text-stone-600">Sunday, 01:00 PM - 03:00 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Classes --}}
@endsection
