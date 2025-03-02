@extends('layouts.user')

@section('content')
    <main class="max-w-8xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="relative h-48 bg-custom"
                style="background-image: url('/imgs/profile-bg.jpg'); background-size: cover; background-position: center;">
                <div class="absolute -bottom-12 left-8">
                    <div class="relative">
                        <img src="{{ auth()->user()->image ? '/uploads/users/' . auth()->user()->image : '/imgs/no-image.png' }}"
                            alt="Profile" class="w-24 h-24 rounded-full border-4 border-white object-cover" />
                        <span
                            class="absolute bottom-0 right-0 w-6 h-6 bg-green-500 border-2 border-white rounded-full"></span>
                    </div>
                </div>
            </div>

            <div class="pt-16 pb-8 px-8">
                <div class="flex flex-col lg:flex-row gap-5 justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                        <p class="text-gray-500">{{ $user->email }}</p>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
                        <a href=""
                            class="!rounded-button cursor-pointer inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            <i class="fas fa-history mr-2"></i>
                            Transaction History
                        </a>
                        <a href=""
                            class="!rounded-button cursor-pointer inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            <i class="fas fa-key mr-2"></i>
                            Change Password
                        </a>
                        <a href=""
                            class="!rounded-button cursor-pointer inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-stone-700 hover:bg-stone-700/90">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Profile
                        </a>
                    </div>
                </div>

                <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-lg border border-gray-200 p-6">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h2>
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-stone-800">Full Name</label>
                                    <p class="mt-1 text-stone-600">{{ $user->name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-stone-800">Email</label>
                                    <p class="mt-1 text-stone-600">{{ $user->email }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-stone-800">Phone</label>
                                    <p class="mt-1 text-stone-600">{{ $user->phone ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 bg-white rounded-lg border border-gray-200 p-6">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Upcoming class</h2>
                            <div class="space-y-4">
                                @forelse ($upcoming_schedules as $schedule)
                                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                        <div class="flex-shrink-0">
                                            <i class="fa-solid fa-person-dots-from-line text-2xl"></i>
                                            {{-- <i class="fas fa-dumbbell text-2xl text-custom"></i> --}}
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">{{ $schedule->course->name }} -
                                                {{ $schedule->courseDetail->name }}</p>
                                            <p class="text-sm text-gray-500">
                                                {{ $schedule->date->format('l, d F Y') }} -
                                                {{ $schedule->time->format('H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <h1 class="text-gray-600">
                                        <i class="fa-regular fa-calendar mr-1"></i>
                                        You don't have a schedule yet
                                    </h1>
                                @endforelse
                            </div>
                        </div>

                        <div class="mt-6 bg-white rounded-lg border border-gray-200 p-6">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Classes that have been passed</h2>
                            <div class="space-y-4">
                                @forelse ($previous_schedules as $schedule)
                                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                                        <div class="flex-shrink-0">
                                            <i class="fa-solid fa-person-dots-from-line text-2xl"></i>
                                            {{-- <i class="fas fa-dumbbell text-2xl text-custom"></i> --}}
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">{{ $schedule->course->name }} -
                                                {{ $schedule->courseDetail->name }}</p>
                                            <p class="text-sm text-gray-500">
                                                {{ $schedule->date->format('l, d F Y') }} -
                                                {{ $schedule->time->format('H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <h1 class="text-gray-600">
                                        <i class="fa-regular fa-calendar mr-1"></i>
                                        You don't have a schedule yet
                                    </h1>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="bg-white rounded-lg border border-gray-200 p-6">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Class Membership</h2>
                            <div class="space-y-4">
                                @foreach ($user->member->memberPlans as $memberPlan)
                                    @php
                                        $image = getCourse($memberPlan->plan)->image;
                                        $name = getCourse($memberPlan->plan)->name;
                                        $type = explode('-', $memberPlan->plan)[1];
                                    @endphp
                                    <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm">
                                        <a href="#">
                                            <img class="rounded-t-lg w-full h-[200px] object-cover"
                                                src="/uploads/courses/{{ $image }}" alt="" />
                                        </a>
                                        <div class="p-5">
                                            <a href="#">
                                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">
                                                    {{ $name }}
                                                </h5>
                                            </a>
                                            <div class="space-y-4 mb-3">
                                                <div>
                                                    <label class="block text-sm font-semibold text-stone-700">Status</label>
                                                    @if ($memberPlan->status == 'active')
                                                        <span
                                                            class="mt-1 w-fit block bg-emerald-100 text-emerald-800 text-xs font-medium px-2.5 py-0.5 rounded-sm">
                                                            Active
                                                        </span>
                                                    @else
                                                        <span
                                                            class="mt-1 w-fit block bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-sm">
                                                            Inactive
                                                        </span>
                                                    @endif
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-semibold text-stone-700">
                                                        Class type
                                                    </label>
                                                    <p class="mt-1 text-gray-900">{{ $type }}</p>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-semibold text-stone-700">Subscribed
                                                        Date</label>
                                                    <p class="mt-1 text-gray-900">
                                                        {{ $memberPlan->subscribed_date->format('l, d F Y - H:i') }}</p>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-semibold text-stone-700">Expired
                                                        Date</label>
                                                    <p class="mt-1 text-gray-900">
                                                        {{ $memberPlan->expired_date->format('l, d F Y - H:i') }}</p>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-semibold text-stone-700">
                                                        Remaining Session
                                                    </label>
                                                    <p class="mt-1 text-gray-900">
                                                        {{ $memberPlan->remaining_session }}</p>
                                                </div>
                                            </div>
                                            <a href="#"
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-stone-700 rounded-lg hover:bg-stone-800 focus:ring-4 focus:outline-none focus:ring-stone-300">
                                                Detail
                                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
