@extends('layouts.user')

@section('content')
    {{-- Hero --}}
    <div class="h-[550px] relative">
        <img src="/imgs/bg_3.jpg" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-stone-800/50 bg-opacity-60"></div>
        <div class="absolute ps-5 top-0 left-0 text-white flex flex-col justify-center items-center w-full h-full">
            <h2 class="text-4xl lg:text-5xl poppins-bold">Our Professional Trainer</h2>
            {{-- <p class="text-lg text-white">Home Trainer</p> --}}
        </div>
    </div>
    {{-- EndHero --}}

    {{-- Rooms --}}
    <div class="px-4 sm:px-6 lg:px-8 py-28 bg-stone-100">
        <div class="w-[90%] mx-auto">
            <h1 class="text-4xl text-stone-700 text-center poppins-semibold">
                Our Trainers
            </h1>
            <div class="mt-20 grid grid-cols-1 lg:grid-cols-4 gap-12">
                @foreach ($trainers as $trainer)
                    <div class="bg-white rounded-md shadow-md overflow-hidden" data-aos="fade-up" data-aos-duration="1000"
                        data-aos-delay="100">
                        <img src="/uploads/trainers/{{ $trainer->image }}" class="w-full h-[350px] object-cover">
                        <div class="mt-5 flex flex-col px-5">
                            <span class="text-xs text-stone-800 poppins-medium uppercase">Owner / Head Coach</span>
                            <h1 class="text-lg mt-2 text-stone-700 poppins-semibold">{{ $trainer->name }}</h1>
                            <p class="text-sm text-stone-600">
                                {{ $trainer->description }}
                            </p>
                            <div class="mt-4 grid grid-cols-4 pb-5">
                                <a href="{{ $trainer->facebook_link }}" target="_blank"
                                    class="bg-stone-700 text-white flex justify-center items-center w-12 h-12 rounded-full">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                                <a href="{{ $trainer->instagram_link }}" target="_blank"
                                    class="bg-stone-700 text-white flex justify-center items-center w-12 h-12 rounded-full">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                                {{-- <a href="{{ $trainer->twitter_link }}" target="_blank"
                                    class="bg-stone-700 text-white flex justify-center items-center w-12 h-12 rounded-full">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </a> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- End Rooms --}}
@endsection
