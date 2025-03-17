@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
        ])
        {{-- <button type="button" id="btn-add-row"
            class="bg-white border border-stone-700 text-stone-600 hover:bg-stone-50 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
            <i class="fas fa-plus mr-1.5"></i> Add Row
        </button> --}}
    </div>

    <div class="mt-5">
        <div class="overflow-x-auto overflow-y-hidden scrollbar">
            <div class="w-[1000px] lg:w-auto" id="time-table">
                @php
                    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                @endphp
                <div class="grid grid-cols-7">
                    @foreach ($days as $day)
                        <div class="p-5 text-center bg-stone-600 text-white border border-l-2 border-gray-300">
                            {{ $day }}</div>
                    @endforeach
                </div>
                @for ($i = 0; $i < 10; $i++)
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
                                            class="rounded-full size-16 object-cover shadow-md">
                                        <div class="mt-2 text-center">
                                            <h1 class="text-sm text-stone-700 poppins-medium">
                                                {{ $timeTableSelected->course->name }}</h1>
                                            <p class="mt-0.5 text-xs text-stone-600">
                                                {{ $timeTableSelected->start_time->format('H:i') }} -
                                                {{ $timeTableSelected->end_time->format('H:i') }}
                                            </p>
                                        </div>
                                        <div class="mt-3 flex items-center gap-1">
                                            <button type="button" data-course-id="{{ $timeTableSelected->course_id }}"
                                                data-time-table-id="{{ $timeTableSelected->id }}"
                                                data-start-time="{{ $timeTableSelected->start_time->format('H:i') }}"
                                                data-end-time="{{ $timeTableSelected->end_time->format('H:i') }}"
                                                data-day="{{ $days[$j] }}" data-modal-target="edit-time-table-modal"
                                                data-modal-toggle="edit-time-table-modal"
                                                class="btn-edit-time-table text-white bg-yellow-600 hover:bg-yellow-700 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-4 py-2.5">
                                                <i class="fa-regular fa-pen"></i>
                                            </button>
                                            <button type="button" data-time-table-id="{{ $timeTableSelected->id }}"
                                                class="btn-delete-time-table text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-4 py-2.5">
                                                <i class="fa-regular fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @else
                                    <button type="button" data-index="{{ $i }}" data-day="{{ $days[$j] }}"
                                        data-modal-target="add-time-table-modal" data-modal-toggle="add-time-table-modal"
                                        class="btn-add-time-table text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-4 py-2.5">
                                        <i class="fa-regular fa-plus"></i>
                                    </button>
                                @endif
                            </div>
                        @endfor
                    </div>
                @endfor
            </div>
        </div>
    </div>

    {{-- Add Time Table Modal --}}
    <div id="add-time-table-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-base font-semibold text-gray-900">
                        Add Time Table
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="add-time-table-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" method="POST" id="form-add-time-table">
                    @csrf
                    <input type="hidden" name="index">
                    <input type="hidden" name="day">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="course_id" class="block mb-2 text-sm font-medium text-gray-900">Course</label>
                            <select id="course_id" name="course_id"
                                class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option selected="">-- Choose --</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="start_time" class="block mb-2 text-sm font-medium text-gray-900">Start Time</label>
                            <input type="time" name="start_time" id="start_time"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="end_time" class="block mb-2 text-sm font-medium text-gray-900">End
                                Time</label>
                            <input type="time" name="end_time" id="end_time"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white mt-3 inline-flex items-center bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:outline-none focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Add Time Table
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Time Table Modal --}}
    <div id="edit-time-table-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-base font-semibold text-gray-900">
                        Edit Time Table
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="edit-time-table-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" method="POST" id="form-edit-time-table">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="time_table_edit_id">
                    <input type="hidden" name="day_edit" id="day-edit">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="course_id_edit"
                                class="block mb-2 text-sm font-medium text-gray-900">Course</label>
                            <select id="course_id_edit" name="course_id_edit"
                                class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                <option>-- Choose --</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="start_time_edit" class="block mb-2 text-sm font-medium text-gray-900">Start
                                Time</label>
                            <input type="time" name="start_time_edit" id="start_time_edit"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="end_time_edit" class="block mb-2 text-sm font-medium text-gray-900">End
                                Time</label>
                            <input type="time" name="end_time_edit" id="end_time_edit"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white mt-3 inline-flex items-center bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:outline-none focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#btn-add-row").click(addRow);
        $(".btn-add-time-table").click(setForm);
        $(".btn-edit-time-table").click(setFormEdit);
        $(".btn-delete-time-table").click(deleteTimeTable);
        $("#form-add-time-table").submit(addTimeTable);
        $("#form-edit-time-table").submit(editTimeTable);

        function setForm() {
            const index = $(this).data("index");
            const day = $(this).data("day");

            $("input[name=index]").val(index);
            $("input[name=day]").val(day);
        }

        function setFormEdit() {
            const timeTableID = $(this).data("time-table-id");
            const courseID = $(this).data("course-id");
            const day = $(this).data("day");
            const startTime = $(this).data("start-time");
            const endTime = $(this).data("end-time");

            let courseIDHTML = "";
            const courses = @json($courses);
            courses.forEach((course) => {
                courseIDHTML +=
                    `<option value="${course.id}" ${courseID == course.id ? 'selected' : ''}>${course.name}</option>`
            });
            $("#course_id_edit").html(courseIDHTML);

            $("#day-edit").val(day);
            $("#start_time_edit").val(startTime);
            $("#end_time_edit").val(endTime);
            $("input[name=time_table_edit_id]").val(timeTableID);
        }

        function addTimeTable(e) {
            e.preventDefault();
            const data = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "{{ route('admin.time-table.store') }}",
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

        function editTimeTable(e) {
            e.preventDefault();
            const data = $(this).serialize();
            const timeTableID = $("input[name=time_table_edit_id]").val();

            $.ajax({
                type: "POST",
                url: "{{ route('admin.time-table.update', ':id') }}".replace(':id', timeTableID),
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

        function deleteTimeTable() {
            const timeTableID = $(this).data("time-table-id");
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
                        url: `{{ route('admin.time-table.destroy', ':id') }}`.replace(':id', timeTableID),
                        type: 'DELETE',
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
                        success: function(data) {
                            location.reload();
                        },
                    });
                }
            });
        }

        function addRow() {
            $("#time-table").append(htmlRow);
        }

        function htmlRow() {
            return `
            <div class="grid grid-cols-7">
                <div class="h-[220px] border border-l-2 border-gray-300 flex items-center justify-center">
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5">
                        Add
                    </button>
                </div>
                <div class="h-[220px] border border-gray-300 flex items-center justify-center">
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5">
                        Add
                    </button>
                </div>
                <div class="h-[220px] border border-gray-300 flex items-center justify-center">
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5">
                        Add
                    </button>
                </div>
                <div class="h-[220px] border border-gray-300 flex items-center justify-center">
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5">
                        Add
                    </button>
                </div>
                <div class="h-[220px] border border-gray-300 flex items-center justify-center">
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5">
                        Add
                    </button>
                </div>
                <div class="h-[220px] border border-gray-300 flex items-center justify-center">
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5">
                        Add
                    </button>
                </div>
                <div class="h-[220px] border border-r-2 border-gray-300 flex items-center justify-center">
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-5 py-2.5">
                        Add
                    </button>
                </div>
            </div>
            `;
        }
    </script>
@endsection
