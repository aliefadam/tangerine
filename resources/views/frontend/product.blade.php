@extends('layouts.user')

@section('content')
    {{-- Hero --}}
    <div class="h-[300px] lg:h-[550px] relative">
        <img src="/imgs/jumbotron-salon.jpg" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-stone-800/50 bg-opacity-60"></div>
        <div class="absolute ps-5 top-0 left-0 text-white flex flex-col justify-center lg:items-center w-full h-full">
            <h2 class="text-4xl lg:text-5xl poppins-bold">Embrace Your Radiance</h2>
            <p class="text-lg text-white w-[90%] lg:w-auto">Enhancing your natural beauty in a way that aligns with your
                values.</p>
        </div>
    </div>
    {{-- EndHero --}}

    <div class="px-4 sm:px-6 lg:px-8 py-28 bg-stone-100">
        <div class="w-[90%] mx-auto">
            {{-- Products --}}
            <h1 class="text-4xl text-stone-700 text-center poppins-semibold">
                Products
            </h1>
            <div class="mt-20 grid grid-cols-1 lg:grid-cols-3 gap-12">
                @foreach ($products as $product)
                    <div class="bg-white rounded-md shadow-md overflow-hidden" data-aos="fade-up" data-aos-duration="1000"
                        data-aos-delay="100">
                        <img src="/uploads/products/{{ $product->image }}" class="w-full h-[350px] object-cover">
                        <div class="mt-5 flex flex-col px-5">
                            <h1 class="text-lg mt-2 text-stone-700 poppins-semibold">{{ $product->name }}</h1>
                            <div class="mt-4 grid grid-cols-4 pb-5">
                                <a href="{{ $product->link }}" target="_blank"
                                    class="bg-stone-700 text-white flex justify-center items-center w-12 h-12 rounded-full">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- End Rooms --}}
    @endsection
