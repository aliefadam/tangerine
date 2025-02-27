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
                @foreach ($hours as $hour)
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
                            <span class="text-gray-600">
                                <i class="fa-regular fa-empty-set"></i>
                                No schedule yet
                            </span>
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
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Add Schedule
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
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
                <form class="p-4 md:p-5">
                    <div class="mb-4">
                        <div class="mb-5">
                            <label for="member_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Member
                            </label>
                            <select id="member_id" name="member_id"
                                class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5">
                                <option selected="">-- Select --</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="course_detail_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Class
                            </label>
                            <select id="course_detail_id" name="course_detail_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5">
                                <option selected="">-- Please select a member first --</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <label for="trainer_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Trainer
                            </label>
                            <select id="trainer_id" name="trainer_id"
                                class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5">
                                <option selected="">-- Select --</option>
                                @foreach ($trainers as $trainer)
                                    <option selected="{{ $trainer->id }}">{{ $trainer->name }}</option>
                                @endforeach
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
        $(".btn-delete").click(deleteTrainer);

        function deleteTrainer() {
            const roomID = $(this).data("room-id");

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
                        url: `{{ route('admin.schedule.destroy', ':id') }}`.replace(':id', roomID),
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            location.reload();
                        },
                    });
                }
            });
        }
    </script>
@endsection
