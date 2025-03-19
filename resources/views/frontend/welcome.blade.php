@extends('layouts.user')

@section('content')
    {{-- Hero --}}
    <div class="h-[550px] relative">
        <img src="/imgs/jumbotron.png" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-stone-800/50 bg-opacity-60"></div>
        <div class="absolute ps-5 top-0 left-0 text-white flex flex-col justify-center lg:items-center w-full h-full">
            <h2 class="text-4xl lg:text-5xl poppins-bold">Discover Your Inner Sanctuary</h2>
            <p class="text-lg text-white w-[90%] lg:w-auto">Everyday We Bring Hope and Smile the Patient
                We Serve</p>
        </div>
    </div>
    {{-- EndHero --}}

    {{-- Services --}}
    <div class="px-4 sm:px-6 lg:px-8 py-28 bg-white">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-10 w-[90%] mx-auto">
            <div class="flex flex-col items-center">
                <img src="/imgs/classes-6.jpg" class="size-[230px] object-cover rounded-full shadow-md">
                <div class="mt-5">
                    <h1 class="text-center text-stone-700 text-2xl poppins-semibold">Pilates</h1>
                    <p class="text-sm mt-3 text-center">
                        Pilates strengthens the core, improves posture, and enhances flexibility with controlled movements.
                        It is gentle on the joints, making it ideal for injury recovery and muscle toning.
                        This workout boosts stability and body awareness for better overall movement.
                    </p>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <img src="/imgs/classes-1.jpg" class="size-[230px] object-cover rounded-full shadow-md">
                <div class="mt-5">
                    <h1 class="text-center text-stone-700 text-2xl poppins-semibold">Yoga</h1>
                    <p class="text-sm mt-3 text-center">
                        Yoga enhances flexibility, strength, and relaxation through mindful movement and breathing.
                        It promotes mental clarity, reduces stress, and improves overall well-being.
                        With its calming approach, yoga balances both body and mind for holistic health.
                    </p>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <img src="/imgs/classes-7.jpg" class="size-[230px] object-cover rounded-full shadow-md">
                <div class="mt-5">
                    <h1 class="text-center text-stone-700 text-2xl poppins-semibold">Zumba</h1>
                    <p class="text-sm mt-3 text-center">
                        Zumba is a high-energy dance workout that combines Latin rhythms with cardio exercise.
                        It helps burn calories, improve coordination, and boost endurance in a fun way.
                        With upbeat music, it keeps participants motivated while making fitness enjoyable.
                    </p>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <img src="/imgs/classes-2.jpg" class="size-[230px] object-cover rounded-full shadow-md">
                <div class="mt-5">
                    <h1 class="text-center text-stone-700 text-2xl poppins-semibold">Sweat Dance</h1>
                    <p class="text-sm mt-3 text-center">
                        Sweat Dance blends freestyle movement with high-intensity cardio for a dynamic workout.
                        It enhances stamina, flexibility, and confidence while allowing self-expression.
                        With energetic beats, it turns exercise into a fun and liberating experience.
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
                            <p class="text-sm mt-2 text-stone-600">
                                Yoga harmonizes movement and breath, promoting mental
                                clarity and inner peace.
                                It reduces stress, enhances focus, and fosters emotional well-being.
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
                            <p class="text-sm mt-2 text-stone-600">
                                Regular yoga practice supports a balanced and active
                                lifestyle.
                                It boosts energy levels and encourages mindful living habits.
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
                            <p class="text-sm mt-2 text-stone-600">
                                Yoga stretches and lengthens muscles for improved mobility.
                                With consistent practice, stiffness decreases, and movement becomes easier.
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
                            <p class="text-sm mt-2 text-stone-600">
                                Gentle yoga poses help maintain spinal health and posture.
                                It strengthens back muscles and alleviates tension.
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
                            <p class="text-sm mt-2 text-stone-600">
                                Weight-bearing yoga postures support stronger bones.
                                It reduces the risk of osteoporosis and improves stability.
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
                            <p class="text-sm mt-2 text-stone-600">
                                Yoga enhances circulation and oxygen delivery to the body.
                                Better blood flow leads to increased energy and healing.
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
                            <p class="text-sm mt-2 text-stone-600">
                                Tracking progress helps build discipline and motivation.
                                A journal allows reflection on growth and personal achievements.
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
                            <p class="text-sm mt-2 text-stone-600">
                                Yoga strengthens muscles using body weight as resistance.
                                It improves endurance, stability, and overall body tone.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Experience Yoga --}}

    {{-- Classes --}}
    <div class="px-4 sm:px-6 lg:px-8 py-28 bg-white">
        <div class="w-[90%] mx-auto">
            <h1 class="text-4xl text-stone-700 text-center poppins-semibold" data-aos="fade-up" data-aos-duration="1000">
                Our Classes
            </h1>
            <div class="mt-20 grid grid-cols-1 lg:grid-cols-3 gap-12">
                @foreach ($courses as $course)
                    <div class="" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                        <img src="/uploads/courses/{{ $course->image }}"
                            class="w-full h-[270px] object-cover rounded-md shadow-md">
                        <div class="mt-5 text-center">
                            <h1 class="text-xl text-stone-700 poppins-medium">{{ $course->name }}</h1>
                            <a href="{{ route('class.detail', $course->slug) }}"
                                class="block w-fit mt-2 mx-auto text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                <i class="fa-solid fa-arrow-up-right-from-square mr-1.5"></i>
                                View
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- End Classes --}}

    {{-- Schedule --}}
    <div class="px-4 sm:px-6 lg:px-8 py-28 bg-stone-100">
        <div class="w-[90%] mx-auto">
            <h1 class="text-4xl text-stone-700 text-center poppins-semibold" data-aos="fade-down"
                data-aos-duration="1000">
                Class Time Table
            </h1>
            <div class="overflow-x-auto overflow-y-hidden scrollbar">
                <div class="mt-16 w-[1000px] lg:w-auto" data-aos="fade-up" data-aos-duration="1000">
                    @php
                        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                    @endphp
                    <div class="grid grid-cols-7">
                        @foreach ($days as $index => $day)
                            <div class="p-5 text-center bg-stone-600 text-white border border-gray-300">
                                {{ $day }}</div>
                        @endforeach
                    </div>
                    @for ($i = 0; $i < 10; $i++)
                        @if (getTimeTable($i)->count() > 0)
                            <div class="grid grid-cols-7">
                                @for ($j = 0; $j < 7; $j++)
                                    <div
                                        class="h-[220px] border {{ $j == 0 ? 'border-l-2' : '' }} {{ $j == 6 ? 'border-r-2' : '' }} border-gray-300 flex items-center justify-center">
                                        @php
                                            $timeTableSelected = getTimeTable($i, $days[$j]);
                                        @endphp
                                        @if ($timeTableSelected)
                                            <div class="flex flex-col items-center px-2">
                                                <img src="/uploads/courses/{{ $timeTableSelected->course->image }}"
                                                    class="rounded-full size-20 object-cover shadow-md">
                                                <div class="mt-2 text-center">
                                                    <h1 class="text-base text-stone-700 poppins-medium">
                                                        {{ $timeTableSelected->course->name }}</h1>
                                                    <p class="mt-1 text-xs text-stone-600">
                                                        {{ $timeTableSelected->start_time->format('H:i') }} -
                                                        {{ $timeTableSelected->end_time->format('H:i') }}
                                                    </p>
                                                </div>
                                            </div>
                                        @else
                                            <i class="fa-regular fa-times text-stone-700"></i>
                                        @endif
                                    </div>
                                @endfor
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    </div>
    {{-- End Schedule --}}

    {{-- Testimonial --}}
    {{-- <div class="px-4 sm:px-6 lg:px-8 py-28 bg-white">
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
    </div> --}}
    {{-- End Testimonial --}}

    {{-- Rooms --}}
    <div class="px-4 sm:px-6 lg:px-8 py-28 bg-white">
        <div class="w-[90%] mx-auto">
            <h1 class="text-4xl text-stone-700 text-center poppins-semibold" data-aos="fade-down"
                data-aos-duration="1000">
                Our Rooms
            </h1>
            <div class="mt-20 grid grid-cols-1 lg:grid-cols-3 gap-12">
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
