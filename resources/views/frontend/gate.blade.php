@extends('layouts.auth')

@section('content')
    <div class="absolute top-10 left-0 right-0 flex justify-center">
        <img class="drop-shadow-lg w-[80px] object-cover" src="{{ asset('imgs/Logo Tangerine-black.png') }}" alt="">
    </div>
    <div class="bg-white h-screen flex flex-col justify-center items-center px-10">
        <h1 class="text-3xl text-center text-stone-700 poppins-bold">Where are you going in?</h1>
        <div class="grid grid-cols-2 mt-16 items-center gap-10">
            <a href="{{ route('home') }}"
                class="border-2 border-stone-700 text-stone-700 hover:bg-stone-50 flex flex-col items-center rounded-md p-10">
                <i class="fa-solid fa-dumbbell text-6xl"></i>
                <h1 class="text-center mt-5 poppins-semibold text-lg">Tangerine Wellness</h1>
            </a>
            <a href="{{ route('home.salon') }}"
                class="border-2 border-stone-700 text-stone-700 hover:bg-stone-50 flex flex-col items-center rounded-md p-10">
                <i class="fa-solid fa-spa text-6xl"></i>
                <h1 class="text-center mt-5 poppins-semibold text-lg">Tangerine Salon</h1>
            </a>
        </div>
    </div>
    <div class="absolute bottom-10 left-0 right-0 flex justify-center">
        <p class="text-stone-700 poppins-medium">© 2025 Tangerine. All Rights Reserved.</p>
    </div>
@endsection
