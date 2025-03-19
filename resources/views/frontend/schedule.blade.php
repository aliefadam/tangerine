@extends('layouts.user')

@section('content')
    {{-- Hero --}}
    <div class="h-[550px] relative">
        <img src="/imgs/bg_3.jpg" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-stone-800/50 bg-opacity-60"></div>
        <div class="absolute ps-5 top-0 left-0 text-white flex flex-col justify-center items-center w-full h-full">
            <h2 class="text-4xl lg:text-5xl poppins-bold">Class Schedule</h2>
            {{-- <p class="text-lg text-white mt-2">Home Schedule</p> --}}
        </div>
    </div>
    {{-- EndHero --}}

    {{-- Schedule --}}
    <div class="px-4 sm:px-6 lg:px-8 py-28 bg-stone-100">
        <div class="w-[90%] mx-auto">
            <h1 class="text-4xl text-stone-700 text-center poppins-semibold" data-aos="fade-down" data-aos-duration="1000">
                Class Time Table
            </h1>
            <div class="overflow-x-auto overflow-y-hidden scrollbar">
                <div class="mt-16 w-[1000px] lg:w-auto" data-aos="fade-up" data-aos-duration="1000">
                    {{-- <div class="grid grid-cols-7">
                        <div class="p-5 text-center bg-stone-600 text-white border border-l-2 border-gray-300">Monday</div>
                        <div class="p-5 text-center bg-stone-600 text-white border border-gray-300">Tuesday</div>
                        <div class="p-5 text-center bg-stone-600 text-white border border-gray-300">Wednesday</div>
                        <div class="p-5 text-center bg-stone-600 text-white border border-gray-300">Thursday</div>
                        <div class="p-5 text-center bg-stone-600 text-white border border-gray-300">Friday</div>
                        <div class="p-5 text-center bg-stone-600 text-white border border-gray-300">Saturday</div>
                        <div class="p-5 text-center bg-stone-600 text-white border border-r-2 border-gray-300">Sunday</div>
                    </div>
                    <div class="grid grid-cols-7">
                        <div class="h-[200px] border border-l-2 border-gray-300 flex items-center justify-center">
                            <i class="fa-regular fa-times text-stone-700"></i>
                        </div>
                        <div class="h-[200px] border border-gray-300 flex items-center justify-center">
                            <div class="flex flex-col items-center">
                                <img src="/imgs/classes-1.jpg" class="rounded-full size-20 object-cover shadow-md">
                                <div class="mt-2 text-center">
                                    <h1 class="text-base text-stone-700 poppins-medium">Yoga Training</h1>
                                    <p class="mt-0.5 text-xs text-stone-600">01:00 PM - 03:00 PM</p>
                                </div>
                            </div>
                        </div>
                        <div class="h-[200px] border border-gray-300 flex items-center justify-center">
                            <i class="fa-regular fa-times text-stone-700"></i>
                        </div>
                        <div class="h-[200px] border border-gray-300 flex items-center justify-center">
                            <div class="flex flex-col items-center">
                                <img src="/imgs/classes-2.jpg" class="rounded-full size-20 object-cover shadow-md">
                                <div class="mt-2 text-center">
                                    <h1 class="text-base text-stone-700 poppins-medium">Yoga Training</h1>
                                    <p class="mt-0.5 text-xs text-stone-600">01:00 PM - 03:00 PM</p>
                                </div>
                            </div>
                        </div>
                        <div class="h-[200px] border border-gray-300 flex items-center justify-center">
                            <i class="fa-regular fa-times text-stone-700"></i>
                        </div>
                        <div class="h-[200px] border border-gray-300 flex items-center justify-center">
                            <div class="flex flex-col items-center">
                                <img src="/imgs/classes-1.jpg" class="rounded-full size-20 object-cover shadow-md">
                                <div class="mt-2 text-center">
                                    <h1 class="text-base text-stone-700 poppins-medium">Yoga Training</h1>
                                    <p class="mt-0.5 text-xs text-stone-600">01:00 PM - 03:00 PM</p>
                                </div>
                            </div>
                        </div>
                        <div class="h-[200px] border border-r-2 border-gray-300 flex items-center justify-center">
                            <i class="fa-regular fa-times text-stone-700"></i>
                        </div>
                    </div>
                    <div class="grid grid-cols-7">
                        <div class="h-[200px] border border-l-2 border-gray-300 flex items-center justify-center">
                            <div class="flex flex-col items-center">
                                <img src="/imgs/classes-4.jpg" class="rounded-full size-20 object-cover shadow-md">
                                <div class="mt-2 text-center">
                                    <h1 class="text-base text-stone-700 poppins-medium">Yoga Training</h1>
                                    <p class="mt-0.5 text-xs text-stone-600">01:00 PM - 03:00 PM</p>
                                </div>
                            </div>
                        </div>
                        <div class="h-[200px] border border-gray-300 flex items-center justify-center">
                            <i class="fa-regular fa-times text-stone-700"></i>
                        </div>
                        <div class="h-[200px] border border-gray-300 flex items-center justify-center">
                            <div class="flex flex-col items-center">
                                <img src="/imgs/classes-5.jpg" class="rounded-full size-20 object-cover shadow-md">
                                <div class="mt-2 text-center">
                                    <h1 class="text-base text-stone-700 poppins-medium">Yoga Training</h1>
                                    <p class="mt-0.5 text-xs text-stone-600">01:00 PM - 03:00 PM</p>
                                </div>
                            </div>
                        </div>
                        <div class="h-[200px] border border-gray-300 flex items-center justify-center">
                            <i class="fa-regular fa-times text-stone-700"></i>
                        </div>
                        <div class="h-[200px] border border-gray-300 flex items-center justify-center">
                            <div class="flex flex-col items-center">
                                <img src="/imgs/classes-6.jpg" class="rounded-full size-20 object-cover shadow-md">
                                <div class="mt-2 text-center">
                                    <h1 class="text-base text-stone-700 poppins-medium">Yoga Training</h1>
                                    <p class="mt-0.5 text-xs text-stone-600">01:00 PM - 03:00 PM</p>
                                </div>
                            </div>
                        </div>
                        <div class="h-[200px] border border-gray-300 flex items-center justify-center">
                            <i class="fa-regular fa-times text-stone-700"></i>
                        </div>
                        <div class="h-[200px] border border-r-2 border-gray-300 flex items-center justify-center">
                            <div class="flex flex-col items-center">
                                <img src="/imgs/classes-7.jpg" class="rounded-full size-20 object-cover shadow-md">
                                <div class="mt-2 text-center">
                                    <h1 class="text-base text-stone-700 poppins-medium">Yoga Training</h1>
                                    <p class="mt-0.5 text-xs text-stone-600">01:00 PM - 03:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-7">
                        <div class="h-[200px] border border-l-2 border-gray-300 flex items-center justify-center">
                            <i class="fa-regular fa-times text-stone-700"></i>
                        </div>
                        <div class="h-[200px] border border-gray-300 flex items-center justify-center">
                            <div class="flex flex-col items-center">
                                <img src="/imgs/classes-1.jpg" class="rounded-full size-20 object-cover shadow-md">
                                <div class="mt-2 text-center">
                                    <h1 class="text-base text-stone-700 poppins-medium">Yoga Training</h1>
                                    <p class="mt-0.5 text-xs text-stone-600">01:00 PM - 03:00 PM</p>
                                </div>
                            </div>
                        </div>
                        <div class="h-[200px] border border-gray-300 flex items-center justify-center">
                            <i class="fa-regular fa-times text-stone-700"></i>
                        </div>
                        <div class="h-[200px] border border-gray-300 flex items-center justify-center">
                            <div class="flex flex-col items-center">
                                <img src="/imgs/classes-2.jpg" class="rounded-full size-20 object-cover shadow-md">
                                <div class="mt-2 text-center">
                                    <h1 class="text-base text-stone-700 poppins-medium">Yoga Training</h1>
                                    <p class="mt-0.5 text-xs text-stone-600">01:00 PM - 03:00 PM</p>
                                </div>
                            </div>
                        </div>
                        <div class="h-[200px] border border-gray-300 flex items-center justify-center">
                            <i class="fa-regular fa-times text-stone-700"></i>
                        </div>
                        <div class="h-[200px] border border-gray-300 flex items-center justify-center">
                            <div class="flex flex-col items-center">
                                <img src="/imgs/classes-1.jpg" class="rounded-full size-20 object-cover shadow-md">
                                <div class="mt-2 text-center">
                                    <h1 class="text-base text-stone-700 poppins-medium">Yoga Training</h1>
                                    <p class="mt-0.5 text-xs text-stone-600">01:00 PM - 03:00 PM</p>
                                </div>
                            </div>
                        </div>
                        <div class="h-[200px] border border-r-2 border-gray-300 flex items-center justify-center">
                            <i class="fa-regular fa-times text-stone-700"></i>
                        </div>
                    </div>
                    <div class="grid grid-cols-7">
                        <div class="h-[200px] border border-l-2 border-gray-300 flex items-center justify-center">
                            <div class="flex flex-col items-center">
                                <img src="/imgs/classes-4.jpg" class="rounded-full size-20 object-cover shadow-md">
                                <div class="mt-2 text-center">
                                    <h1 class="text-base text-stone-700 poppins-medium">Yoga Training</h1>
                                    <p class="mt-0.5 text-xs text-stone-600">01:00 PM - 03:00 PM</p>
                                </div>
                            </div>
                        </div>
                        <div class="h-[200px] border border-gray-300 flex items-center justify-center">
                            <i class="fa-regular fa-times text-stone-700"></i>
                        </div>
                        <div class="h-[200px] border border-gray-300 flex items-center justify-center">
                            <div class="flex flex-col items-center">
                                <img src="/imgs/classes-5.jpg" class="rounded-full size-20 object-cover shadow-md">
                                <div class="mt-2 text-center">
                                    <h1 class="text-base text-stone-700 poppins-medium">Yoga Training</h1>
                                    <p class="mt-0.5 text-xs text-stone-600">01:00 PM - 03:00 PM</p>
                                </div>
                            </div>
                        </div>
                        <div class="h-[200px] border border-gray-300 flex items-center justify-center">
                            <i class="fa-regular fa-times text-stone-700"></i>
                        </div>
                        <div class="h-[200px] border border-gray-300 flex items-center justify-center">
                            <div class="flex flex-col items-center">
                                <img src="/imgs/classes-6.jpg" class="rounded-full size-20 object-cover shadow-md">
                                <div class="mt-2 text-center">
                                    <h1 class="text-base text-stone-700 poppins-medium">Yoga Training</h1>
                                    <p class="mt-0.5 text-xs text-stone-600">01:00 PM - 03:00 PM</p>
                                </div>
                            </div>
                        </div>
                        <div class="h-[200px] border border-gray-300 flex items-center justify-center">
                            <i class="fa-regular fa-times text-stone-700"></i>
                        </div>
                        <div class="h-[200px] border border-r-2 border-gray-300 flex items-center justify-center">
                            <div class="flex flex-col items-center">
                                <img src="/imgs/classes-7.jpg" class="rounded-full size-20 object-cover shadow-md">
                                <div class="mt-2 text-center">
                                    <h1 class="text-base text-stone-700 poppins-medium">Yoga Training</h1>
                                    <p class="mt-0.5 text-xs text-stone-600">01:00 PM - 03:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div> --}}

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
@endsection
