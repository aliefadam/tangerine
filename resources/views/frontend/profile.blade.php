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
                    <div class="grid grid-cols-2 gap-3 w-full lg:w-auto">
                        <button type="button" data-modal-target="change-password-modal"
                            data-modal-toggle="change-password-modal"
                            class="!rounded-button cursor-pointer inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            <i class="fas fa-key mr-2"></i>
                            Change Password
                        </button>
                        <button type="button" data-modal-target="edit-profile-modal" data-modal-toggle="edit-profile-modal"
                            class="!rounded-button cursor-pointer inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-stone-700 hover:bg-stone-700/90">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Profile
                        </button>
                    </div>
                </div>

                <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-lg border border-gray-200 p-6">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h2>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
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
                                <div>
                                    <label class="block text-sm font-semibold text-stone-800">Gender</label>
                                    <p class="mt-1 text-stone-600">{{ $user->gender ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 bg-white rounded-lg border border-gray-200 p-6">
                            <h2 class="text-lg font-medium text-gray-900 mb-4">Upcoming class</h2>
                            <div class="space-y-4">
                                @forelse ($upcoming_schedules as $schedule)
                                    <div
                                        class="p-4 bg-gray-50 border border-gray-300 rounded-lg flex flex-col lg:flex-row lg:justify-between gap-3 lg:gap-0">
                                        <div class="flex items-center ">
                                            <div class="flex-shrink-0">
                                                <i class="fa-solid fa-person-dots-from-line text-2xl"></i>
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
                                        @if (canCancelClass($schedule))
                                            <div class="flex items-center">
                                                <button type="button" data-schedule-id="{{ $schedule->id }}"
                                                    class="btn-cancel-schedule text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-5 py-2.5">
                                                    <i class="fa-solid fa-ban mr-1"></i>
                                                    Cancel this schedule
                                                </button>
                                            </div>
                                        @endif
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
                                    <div class="flex items-center p-4 border border-gray-300 bg-gray-50 rounded-lg">
                                        <div class="flex-shrink-0">
                                            <i class="fa-solid fa-person-dots-from-line text-2xl"></i>
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
                            @if ($user->member)
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
                                                        <label
                                                            class="block text-sm font-semibold text-stone-700">Status</label>
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
                                                        <p class="mt-1 text-emerald-700">
                                                            {{ $memberPlan->subscribed_date->format('l, d F Y - H:i') }}
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <label class="block text-sm font-semibold text-stone-700">Expired
                                                            Date</label>
                                                        <p class="mt-1 text-red-700">
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
                                                @if ($memberPlan->status == 'active')
                                                    @php
                                                        $course_id = getCourse($memberPlan->plan)->id;
                                                        $course_detail_person_max = getCourseDetail(
                                                            $memberPlan->plan,
                                                            $course_id,
                                                        )->person_max;
                                                    @endphp
                                                    <button type="button" data-modal-target="large-modal"
                                                        data-modal-toggle="large-modal"
                                                        data-member-plan-id="{{ $memberPlan->id }}"
                                                        data-max-person="{{ $course_detail_person_max }}"
                                                        data-room-id="{{ $memberPlan->room_id }}"
                                                        data-trainer-id="{{ $memberPlan->trainer_id }}"
                                                        class="btn-add-schedule inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-stone-700 rounded-lg hover:bg-stone-800 focus:ring-4 focus:outline-none focus:ring-stone-300">
                                                        <i class="fa-regular fa-calendar mr-1.5"></i>
                                                        Add Schedule
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-sm text-gray-600">You have not subscribed to the membership</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Edit Profile --}}
    <div id="edit-profile-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Edit Profile
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="edit-profile-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2 flex flex-col items-center justify-center">
                            <img src="{{ auth()->user()->image ? '/uploads/users/' . auth()->user()->image : '/imgs/no-image.png' }}"
                                id="img-preview" class="size-24 object-cover rounded-full">
                            <button type="button" id="btn-change-photo"
                                class="bg-white border border-stone-700 text-stone-700 hover:bg-stone-50 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-xs px-5 py-2.5 mt-2">
                                Change Photo
                            </button>
                            <input type="file" name="image" id="image" class="hidden" accept="image/*">
                        </div>
                        <div class="col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ auth()->user()->name }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                        <div class="col-span-2">
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Phone</label>
                            <input type="text" name="phone" id="phone" value="{{ auth()->user()->phone }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        </div>
                        <div class="col-span-2">
                            <label for="gender" class="block mb-2 text-sm font-medium text-gray-900">Gender</label>
                            <select id="gender" name="gender"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option value="">-- Choose --</option>
                                <option value="Female" {{ auth()->user()->gender == 'Female' ? 'selected' : '' }}>Female
                                </option>
                                <option value="Male" {{ auth()->user()->gender == 'Male' ? 'selected' : '' }}>Male
                                </option>
                            </select>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:outline-none focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Password --}}
    <div id="change-password-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Change Password
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="change-password-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="{{ route('profile.change-password') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="password_old" class="block mb-2 text-sm font-medium text-gray-900">Old
                                Password</label>
                            <input type="password" name="password_old" id="password_old"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                        <div class="col-span-2">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">
                                New Password
                            </label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                        <div class="col-span-2">
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">
                                Password Confirmation
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:outline-none focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Select Schedule Modal --}}
    <div id="large-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-4xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <div class="flex items-center gap-3" id="modal-title">
                        <h3 class="text-lg font-medium text-gray-900">
                            Select Schedule
                        </h3>
                    </div>
                    <button type="button" id="btn-close-modal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="large-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 h-[500px] overflow-y-auto scrollbar" id="modal-body">
                    <div class="flex justify-center items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50"
                        role="alert">
                        <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">Please select date first!</span>
                        </div>
                    </div>
                    @foreach ($years as $year)
                        <div class="mb-10">
                            @foreach ($calendarData[$year] as $month => $data)
                                <div class="mb-8 p-5 border rounded-lg shadow-md bg-white">
                                    <h3 class="text-xl font-semibold text-center mb-2">{{ $month }}
                                        {{ $year }}</h3>
                                    <div
                                        class="grid grid-cols-7 text-xs lg:text-sm text-center poppinsmedium bg-stone-700 text-white py-2.5 mt-3">
                                        <div>Sunday</div>
                                        <div>Monday</div>
                                        <div>Tuesday</div>
                                        <div>Wednesday</div>
                                        <div>Thursday</div>
                                        <div>Friday</div>
                                        <div>Saturday</div>
                                    </div>
                                    <div class="grid grid-cols-7 gap-2 mt-2 text-center">
                                        @php
                                            $carbonMonth = \Carbon\Carbon::parse("1 $month $year");
                                            $monthNumber = $carbonMonth->format('m');
                                        @endphp

                                        @for ($i = 0; $i < $data['startDay']; $i++)
                                            <div class="text-stone-700 poppins-semibold flex justify-center items-center">-
                                            </div>
                                        @endfor

                                        @foreach ($data['days'] as $day)
                                            @php
                                                $date = str_pad($day, 2, '0', STR_PAD_LEFT);
                                                $today = now()->format('Y-m-d');
                                                $dateFormated = "$year-$monthNumber-$date";
                                                $canSelect = $dateFormated > now()->addHours(12)->format('Y-m-d');
                                            @endphp
                                            <button data-date="{{ $dateFormated }}"
                                                class="px-2 py-2 lg:py-5 border border-stone-700 {{ $canSelect ? 'bg-white hover:bg-stone-100 text-stone-700 btn-date cursor-pointer' : 'bg-gray-300 cursor-not-allowed' }} rounded">
                                                {{ $day }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#btn-change-photo").click(clickInput);
        $("#image").change(changeImage);
        $(".btn-date").click(selectDate);
        $("#btn-back").click(backToSelectDate);
        $(".btn-add-schedule").click(setMemberPlanID);
        $(".btn-cancel-schedule").click(cancelSchedule);

        let memberPlanID = null;
        let roomID = null;
        let trainerID = null;
        let max_person = null;

        function selectDate() {
            const date = $(this).data('date');

            Swal.fire({
                text: 'Enter the number of participants',
                input: "number",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Submit!',
            }).then((r) => {
                if (r.isConfirmed) {
                    if (r.value == "") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Please enter the number of participants!',
                        });
                        return;
                    }
                    if (r.value > max_person) {
                        const max = max_person
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: `The maximum number of participants for this class is ${max}!`,
                        });
                        return;
                    }

                    $.ajax({
                        type: "GET",
                        url: `/wellness/get-schedule-day/${date}`,
                        data: {
                            capacity: r.value,
                            roomID: roomID,
                            trainerID: trainerID
                        },
                        beforeSend: function() {
                            $("#modal-body").addClass("h-[500px]").html(`
                            <div class="flex justify-center items-center h-full py-5">
                                <div role="status">
                                    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin  fill-stone-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        `);
                        },
                        success: function(response) {
                            const detailDaysHTML = response.detailDaysHTML;
                            $("#modal-body").html(detailDaysHTML);
                            $("#modal-title").html(`
                            <button type="button" id="btn-back"
                                class="cursor-pointer bg-white border border-stone-700 text-stone-700 hover:bg-stone-50 focus:ring-4 focus:ring-stone-300 font-medium rounded-md text-sm px-3.5 py-1.5">
                                <i class="fa-solid fa-caret-left"></i>
                            </button>
                            <h3 class="text-lg font-medium text-gray-900">
                                Select Schedule
                            </h3>
                            `);
                            $("#btn-back").click(backToSelectDate);
                            $(".btn-choose-schedule").click(chooseSchedule);
                        }
                    });
                }
            });
        }

        function backToSelectDate() {
            $.ajax({
                type: "GET",
                url: `/wellness/get-schedule-month`,
                beforeSend: function() {
                    $("#modal-body").addClass("h-[500px]").html(`
                    <div class="flex justify-center items-center h-full py-5">
                        <div role="status">
                            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin  fill-stone-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    `);
                },
                success: function(response) {
                    const detailMonthHTML = response.detailMonthHTML;
                    $("#modal-body").html(detailMonthHTML);
                    $("#modal-title").html(`
                    <h3 class="text-lg font-medium text-gray-900">
                        Select Date
                    </h3>
                    `);
                    $(".btn-date").click(selectDate);
                }
            });
        }

        function chooseSchedule() {
            const scheduleLabel = $(this).data('schedule-label');
            const date = $(this).data('date');
            const time = $(this).data('time');
            const capacity = $(this).data('capacity');

            Swal.fire({
                title: 'Are you sure?',
                text: `You will select schedule at ${scheduleLabel}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, select schedule!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('schedule.store') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            memberPlanID: memberPlanID,
                            date: date,
                            time: time,
                            capacity: capacity,
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Loading',
                                text: 'Please wait...',
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            });
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                }
            })
        }

        function cancelSchedule() {
            const scheduleID = $(this).data('schedule-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You will cancel your schedule",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancel schedule!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('schedule.destroy', ':id') }}".replace(":id", scheduleID),
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Loading',
                                text: 'Please wait...',
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            });
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                }
            });
        }

        function setMemberPlanID() {
            memberPlanID = $(this).data("member-plan-id");
            max_person = +$(this).data('max-person');
            roomID = $(this).data('room-id');
            trainerID = $(this).data('trainer-id');
        }

        function clickInput() {
            $("#image").click();
        }

        function changeImage() {
            const file = this.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                $("#img-preview").attr("src", e.target.result);
            };
            reader.readAsDataURL(file);
        }
    </script>
@endsection
