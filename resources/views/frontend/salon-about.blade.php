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

    {{-- Services --}}
    <div class="px-4 sm:px-6 lg:px-8 py-28 bg-white">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-7 w-[90%] mx-auto">
            <div class="flex flex-col items-center">
                <img src="/imgs/service/treatment.jpg" class="size-[230px] object-cover rounded-full shadow-md">
                <div class="mt-5">
                    <h1 class="text-center text-stone-700 text-2xl poppins-semibold">Treatment</h1>
                    <p class="text-sm mt-3 text-center">
                        Restore and nourish your hair with deep conditioning, leaving it healthier, softer, and shinier.
                    </p>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <img src="/imgs/service/haircut.jpg" class="size-[230px] object-cover rounded-full shadow-md">
                <div class="mt-5">
                    <h1 class="text-center text-stone-700 text-2xl poppins-semibold">Haircut</h1>
                    <p class="text-sm mt-3 text-center">
                        Get a stylish and well-defined haircut, customized to suit your personality and preferences.
                    </p>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <img src="/imgs/service/makeup.jpg" class="size-[230px] object-cover rounded-full shadow-md">
                <div class="mt-5">
                    <h1 class="text-center text-stone-700 text-2xl poppins-semibold">Makeup</h1>
                    <p class="text-sm mt-3 text-center">
                        Professional makeup application for any event, enhancing your features with a flawless finish.
                    </p>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <img src="/imgs/service/nails.jpg" class="size-[230px] object-cover rounded-full shadow-md">
                <div class="mt-5">
                    <h1 class="text-center text-stone-700 text-2xl poppins-semibold">Nails</h1>
                    <p class="text-sm mt-3 text-center">
                        Enjoy expert manicure and pedicure services, ensuring clean, polished, and stylish nails.
                    </p>
                </div>
            </div>
        </div>
    </div>
    {{-- End Services --}}

    {{-- Why Tangerine? --}}
    <div class="px-4 sm:px-6 lg:px-8 py-28 bg-stone-100">
        <div class="w-[90%] mx-auto" data-aos="fade-down" data-aos-duration="1000">
            <h1 class="text-4xl text-stone-700 text-center poppins-semibold">Why Tangerine Salon?</h1>
            <div class="mt-20 grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="space-y-10 h-fit">
                    <div class="flex gap-5">
                        <div class="text-end h-fit">
                            <h1 class="poppins-medium text-stone-700 text-xl">Expert Beauticians</h1>
                            <p class="text-sm mt-2 text-stone-600">Our skilled professionals provide high-quality beauty
                                treatments with great care and precision.
                            </p>
                        </div>
                        <div class="h-fit">
                            <i
                                class="size-16 text-xl flex justify-center items-center leading-none fa-regular fa-hand-holding-droplet p-5 rounded-full bg-stone-700 text-white"></i>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="text-end h-fit">
                            <h1 class="poppins-medium text-stone-700 text-xl">Premium Products</h1>
                            <p class="text-sm mt-2 text-stone-600">We use top-tier beauty products that are safe, effective,
                                and dermatologically tested for the best results.
                            </p>
                        </div>
                        <div class="h-fit">
                            <i
                                class="size-16 text-xl flex justify-center items-center leading-none fa-regular fa-hand-holding-droplet p-5 rounded-full bg-stone-700 text-white"></i>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="text-end h-fit">
                            <h1 class="poppins-medium text-stone-700 text-xl">Relaxing Atmosphere</h1>
                            <p class="text-sm mt-2 text-stone-600">Enjoy a peaceful and luxurious space designed to make you
                                feel comfortable and pampered.
                            </p>
                        </div>
                        <div class="h-fit">
                            <i
                                class="size-16 text-xl flex justify-center items-center leading-none fa-regular fa-hand-holding-droplet p-5 rounded-full bg-stone-700 text-white"></i>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="text-end h-fit">
                            <h1 class="poppins-medium text-stone-700 text-xl">Personalized Services</h1>
                            <p class="text-sm mt-2 text-stone-600">Get beauty treatments tailored to your needs, ensuring
                                the best care for your hair and skin.
                            </p>
                        </div>
                        <div class="h-fit">
                            <i
                                class="size-16 text-xl flex justify-center items-center leading-none fa-regular fa-hand-holding-droplet p-5 rounded-full bg-stone-700 text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="h-fit">
                    <img src="/imgs/why.jpg" class="w-full h-[550px] object-cover rounded-md shadow-md">
                </div>
                <div class="space-y-10 h-fit">
                    <div class="flex gap-5">
                        <div class="h-fit">
                            <i
                                class="size-16 text-xl flex justify-center items-center leading-none fa-regular fa-hand-holding-droplet p-5 rounded-full bg-stone-700 text-white"></i>
                        </div>
                        <div class="text-start h-fit">
                            <h1 class="poppins-medium text-stone-700 text-xl">Hygiene Standards</h1>
                            <p class="text-sm mt-2 text-stone-600">We prioritize cleanliness and sterilization to maintain a
                                safe and healthy beauty environment.
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="h-fit">
                            <i
                                class="size-16 text-xl flex justify-center items-center leading-none fa-regular fa-hand-holding-droplet p-5 rounded-full bg-stone-700 text-white"></i>
                        </div>
                        <div class="text-start h-fit">
                            <h1 class="poppins-medium text-stone-700 text-xl">Latest Techniques</h1>
                            <p class="text-sm mt-2 text-stone-600">Experience modern beauty treatments with advanced
                                techniques to enhance your natural beauty.
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="h-fit">
                            <i
                                class="size-16 text-xl flex justify-center items-center leading-none fa-regular fa-hand-holding-droplet p-5 rounded-full bg-stone-700 text-white"></i>
                        </div>
                        <div class="text-start h-fit">
                            <h1 class="poppins-medium text-stone-700 text-xl">Exceptional Customer Care </h1>
                            <p class="text-sm mt-2 text-stone-600">Our friendly staff is dedicated to ensuring a comfortable
                                and satisfying beauty experience.
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        <div class="h-fit">
                            <i
                                class="size-16 text-xl flex justify-center items-center leading-none fa-regular fa-hand-holding-droplet p-5 rounded-full bg-stone-700 text-white"></i>
                        </div>
                        <div class="text-start h-fit">
                            <h1 class="poppins-medium text-stone-700 text-xl">Affordable Luxury</h1>
                            <p class="text-sm mt-2 text-stone-600">Get high-quality beauty treatments at reasonable prices,
                                making luxury services more accessible.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Why Tangerine? --}}

    {{-- Rooms --}}
    <div class="px-4 sm:px-6 lg:px-8 py-28 bg-white">
        <div class="w-[90%] mx-auto">
            <h1 class="text-4xl text-stone-700 text-center poppins-semibold" data-aos="fade-down" data-aos-duration="1000">
                Our Rooms
            </h1>
            <div class="mt-20 grid grid-cols-1 lg:grid-cols-3 gap-12">
                <img src="/imgs/room-salon/Salon1.jpg" class="w-full h-[300px] object-cover rounded-md shadow-md"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                <img src="/imgs/room-salon/Salon2.jpg" class="w-full h-[300px] object-cover rounded-md shadow-md"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <img src="/imgs/room-salon/Salon3.jpg" class="w-full h-[300px] object-cover rounded-md shadow-md"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                <img src="/imgs/room-salon/Salon4.jpg" class="w-full h-[300px] object-cover rounded-md shadow-md"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                <img src="/imgs/room-salon/Salon5.jpg" class="w-full h-[300px] object-cover rounded-md shadow-md"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <img src="/imgs/room-salon/Salon9.jpg" class="w-full h-[300px] object-cover rounded-md shadow-md"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                <img src="/imgs/room-salon/Salon7.jpg" class="w-full h-[300px] object-cover rounded-md shadow-md"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                <img src="/imgs/room-salon/Salon6.jpg" class="w-full h-[300px] object-cover rounded-md shadow-md"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <img src="/imgs/room-salon/Salon8.jpg" class="w-full h-[300px] object-cover rounded-md shadow-md"
                    data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
            </div>
        </div>
    </div>
    {{-- End Rooms --}}
@endsection
