@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
            'before' => [
                'name' => 'Schedule',
                'url' => route('admin.schedule.index'),
            ],
        ])
    </div>

    <div class="mt-5">
        <div class="container mx-auto p-6">
            <h2 class="text-2xl font-bold mb-4 text-center">
                Schedule at {{ $selectedDate->isoFormat('dddd, D MMMM Y') }}
            </h2>

            <div class="grid grid-cols-1 gap-4 mt-10">
                {{-- @foreach ($hours as $hour)
                    <div class="p-4 border rounded-lg shadow-md bg-white">
                        <div class="flex justify-between items-center">
                            <h3 class="text-base font-medium">
                                {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00
                            </h3>
                            <button type="button" data-time="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00"
                                data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                                data-date="{{ Carbon\Carbon::parse($selectedDate)->format('Y/m/d') }}"
                                class="btn-add-schedule bg-white border border-stone-700 text-stone-700 hover:bg-stone-50 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-xs px-5 py-2.5">
                                <i class="fas fa-plus mr-1.5"></i>
                                Add Schedule
                            </button>
                        </div>
                        <div class="mt-2 text-sm">
                            @php
                                $schedulesSelected = $schedules
                                    ->where('time', str_pad($hour, 2, '0', STR_PAD_LEFT) . ':00:00')
                                    ->all();
                            @endphp
                            @if (sizeof($schedulesSelected) == 0)
                                <span class="text-gray-600">
                                    <i class="fa-regular fa-empty-set"></i>
                                    No schedule yet
                                </span>
                            @endif

                            @foreach ($schedulesSelected as $schedule)
                                <div class="p-3 shadow-md bg-stone-50 rounded-md w-fit flex gap-3">
                                    <div class="">
                                        <img src="{{ auth()->user()->image ? '/uploads/users/' . auth()->user()->image : '/imgs/no-image.png' }}"
                                            class="size-[60px] object-cover rounded-full">
                                    </div>
                                    <div class="flex flex-col text-stone-800">
                                        <span class="poppins-medium mb-0.5">{{ $schedule->member->user->name }}</span>
                                        <span class="text-xs">{{ $schedule->room->name }} -
                                            {{ $schedule->trainer->name }}</span>
                                        <span>{{ getPlanLabel($schedule->course_id, $schedule->course_detail_id) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach --}}

                @foreach ($hours as $hour)
                    @php
                        // $isAvailableSchedule = isAvailableSchedule($selectedDate, $hour);
                        $schedulesSelected = getSchedules($selectedDate, $hour);
                    @endphp

                    {{-- @if (!$isAvailableSchedule)
                    data-schedule-label="{{ $selectedDate->format('l, d F Y') }}  -  {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00"
                    data-time="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00"
                    data-date="{{ Carbon\Carbon::parse($selectedDate)->format('Y/m/d') }}"
                    @endif --}}

                    <div class="p-4 border rounded-lg shadow-md bg-white">
                        <div class="flex justify-between items-center">
                            <h3 class="text-base font-medium">
                                {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00
                            </h3>
                            @if (sizeof($schedulesSelected) == 0)
                                <button type="button" data-time="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00"
                                    data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                                    data-date="{{ Carbon\Carbon::parse($selectedDate)->format('Y/m/d') }}"
                                    class="btn-add-schedule bg-white border border-stone-700 text-stone-700 hover:bg-stone-50 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-xs px-5 py-2.5">
                                    <i class="fas fa-plus mr-1.5"></i>
                                    Add Schedule
                                </button>
                            @endif
                        </div>
                        <div class="mt-2 text-sm space-y-3">
                            {{-- @if (!$isAvailableSchedule)
                                <span class="text-emerald-700">
                                    <i class="fa-regular fa-circle-check"></i>
                                    Available
                                </span>
                            @else
                                <span class="text-red-700">
                                    <i class="fa-regular fa-empty-set"></i>
                                    Not Available
                                </span>
                            @endif --}}

                            @if (sizeof($schedulesSelected) == 0)
                                <span class="text-gray-600">
                                    <i class="fa-regular fa-empty-set"></i>
                                    No schedule yet
                                </span>
                            @endif

                            @foreach ($schedulesSelected as $schedule)
                                <div class="p-3 shadow-md bg-stone-50 rounded-md w-fit flex gap-3">
                                    <div class="">
                                        <img src="{{ auth()->user()->image ? '/uploads/users/' . auth()->user()->image : '/imgs/no-image.png' }}"
                                            class="size-[60px] object-cover rounded-full">
                                    </div>
                                    <div class="flex flex-col text-stone-800">
                                        <div class="flex justify-between mb-0.5">
                                            <span class="poppins-medium">{{ $schedule->member->user->name }}</span>
                                            <span data-schedule-id="{{ $schedule->id }}"
                                                class="btn-delete-schedule poppins-semibold text-red-600 hover:underline cursor-pointer">
                                                Delete
                                            </span>
                                        </div>
                                        <span class="text-xs">{{ $schedule->room->name }} -
                                            {{ $schedule->trainer ? $schedule->trainer->name : 'No Trainer' }}</span>
                                        <span>{{ getPlanLabel($schedule->course_id, $schedule->course_detail_id) }}</span>
                                    </div>
                                </div>
                            @endforeach

                            @foreach ($rentTransactions->where('time', '0' . $hour . ':00:00') as $rent)
                                <div class="p-3 shadow-md bg-stone-50 rounded-md w-fit flex gap-3">
                                    <div class="">
                                        <img src="{{ $rent->rentTransaction->user->image ? '/uploads/users/' . $rent->rentTransaction->user->image : '/imgs/no-image.png' }}"
                                            class="size-[60px] object-cover rounded-full">
                                    </div>
                                    <div class="flex flex-col text-stone-800">
                                        <div class="flex justify-between mb-0.5">
                                            <span class="poppins-medium">{{ $rent->rentTransaction->user->name }}</span>
                                        </div>
                                        <span class="text-xs">Rental Room at {{ $rent->room->name }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Main modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 id="title-modal" class="text-base font-semibold text-gray-900">
                        Add Schedule
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" id="form-add-schedule">
                    @csrf
                    <input type="hidden" name="date">
                    <input type="hidden" name="time">
                    <input type="hidden" name="plan">
                    <div class="mb-4">
                        <div class="mb-5">
                            <label for="member_id" class="block mb-2 text-sm font-medium text-gray-900">
                                Member
                            </label>
                            <select id="member_id" name="member_id"
                                class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5">
                                <option value="" selected>-- Select --</option>
                                @foreach ($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="member_class_plan" class="block mb-2 text-sm font-medium text-gray-900">
                                Member Class Plan
                            </label>
                            <select id="member_class_plan" name="member_class_plan"
                                class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5">
                                <option value="" selected="">-- Please select a member first --</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="trainer_id" class="block mb-2 text-sm font-medium text-gray-900">
                                Trainer
                            </label>
                            <select id="trainer_id" name="trainer_id"
                                class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5">
                                <option selected="">-- Please select a member first --</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="room_id" class="block mb-2 text-sm font-medium text-gray-900">
                                Room
                            </label>
                            <select id="room_id" name="room_id"
                                class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5">
                                <option selected="">-- Please select a member first --</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:outline-none focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(".btn-add-schedule").click(setModal);
        $("select[name='member_id']").change(getMemberPlan);
        $("select#member_class_plan").change(getTrainerAndRoom);
        $("#form-add-schedule").submit(addSchedule);
        $(".btn-delete-schedule").click(deleteSchedule);

        function getMemberPlan() {
            const memberID = $(this).val();

            $.ajax({
                type: "GET",
                url: "{{ route('admin.member.show', ':id') }}".replace(':id', memberID),
                success: function(response) {
                    const plans = response;
                    $("select#member_class_plan").html(
                        `<option value="" selected>-- Choose --</option>`
                    );
                    plans.forEach((plan) => {
                        $("select#member_class_plan").append(
                            `<option value="${plan.id}">${plan.plan}</option>`
                        );
                    })
                    $("select#trainer_id").html(
                        `<option value="" selected>-- Please select a member class plan first --</option>`
                    );
                    $("select#room_id").html(
                        `<option value="" selected>-- Please select a member class plan first --</option>`
                    );
                }
            });
        }

        function getTrainerAndRoom() {
            const memberPlanID = $(this).val();
            const trainers = @json($trainers);
            const rooms = @json($rooms);
            $.ajax({
                type: "GET",
                url: "{{ route('admin.member-plan.show', ':id') }}".replace(':id', memberPlanID),
                success: function(response) {
                    const roomID = response.room_id;
                    const trainerID = response.trainer_id;
                    const plan = response.plan;

                    $("input[name='plan']").val(plan);
                    $("select#trainer_id").html(
                        `<option value="" selected>-- Choose --</option>`
                    );
                    trainers.forEach((trainer) => {
                        if (trainer.id == trainerID) {
                            $("select#trainer_id").append(
                                `<option value="${trainer.id}" selected>${trainer.name}</option>`
                            );
                        } else {
                            $("select#trainer_id").append(
                                `<option value="${trainer.id}">${trainer.name}</option>`
                            );
                        }
                    })

                    $("select#room_id").html(
                        `<option value="" selected>-- Choose --</option>`
                    );

                    rooms.forEach((room) => {
                        if (room.id == roomID) {
                            $("select#room_id").append(
                                `<option value="${room.id}" selected>${room.name}</option>`
                            );
                        } else {
                            $("select#room_id").append(
                                `<option value="${room.id}">${room.name}</option>`
                            );
                        }
                    })
                }
            });

        }

        function setModal() {
            const date = $(this).data('date');
            const time = $(this).data('time');
            $("#title-modal").html(`Add Schedule - ${time}`);
            $("input[name='date']").val(date);
            $("input[name='time']").val(time);
        }

        function addSchedule(e) {
            e.preventDefault();
            const data = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('admin.schedule.store') }}",
                data: data,
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

        function deleteSchedule() {
            const scheduleID = $(this).data('schedule-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('admin.schedule.destroy', ':id') }}".replace(':id', scheduleID),
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Deleting...',
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
    </script>
@endsection
