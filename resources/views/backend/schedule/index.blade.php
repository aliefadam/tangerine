@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
        ])
        <a href="{{ route('admin.schedule.create') }}"
            class="text-white bg-stone-600 border border-stone-600 hover:bg-stone-700 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
            <i class="fas fa-plus mr-1.5"></i> Add Schedule
        </a>
    </div>

    <div class="mt-5">
        {{-- <div class="relative overflow-x-auto rounded-md bg-white shadow-md">
            <table id="data-table" class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-gray-400">
                <thead class="text-xs text-stone-600 uppercase bg-white dark:bg-gray-700 dark:text-gray-400">
                    <tr class="bg-white border-b border-t border-gray-200">
                        <th scope="col" class="px-6 py-4">
                            No
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-4 w-[250px]">
                            Time
                        </th>
                        <th scope="col" class="px-6 py-4 w-[250px]">
                            Class
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schedules as $schedule)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $schedule->date }}
                            </td>
                            <td class="px-6 py-4 w-fit">
                                {{ $schedule->time }}
                            </td>
                            <td class="px-6 py-4 w-fit">
                                {{ $schedule->course->name }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-5">
                                    <a href="{{ route('admin.schedule.edit', $schedule->id) }}"
                                        class="text-sm text-blue-700 poppins-medium hover:underline">
                                        <i class="fa-regular fa-pen-to-square"></i> Edit
                                    </a>
                                    <a href="javascript:void(0)" data-schedule-id="{{ $schedule->id }}"
                                        class="btn-delete text-sm text-red-700 poppins-medium hover:underline">
                                        <i class="fa-regular fa-trash"></i> Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}
        <div class="container mx-auto">
            @foreach ($years as $year)
                <div class="mb-10">
                    <h2 class="text-3xl font-bold mb-6">{{ $year }}</h2>
                    @foreach ($months as $keyMonth => $month)
                        <div class="mb-8 p-5 border rounded-lg shadow-md bg-white">
                            <h3 class="text-xl font-semibold text-center mb-2">{{ $month }} {{ $year }}</h3>
                            <div class="grid grid-cols-7 text-center poppinsmedium bg-stone-700 text-white py-2 mt-3">
                                <div>Minggu</div>
                                <div>Senin</div>
                                <div>Selasa</div>
                                <div>Rabu</div>
                                <div>Kamis</div>
                                <div>Jumat</div>
                                <div>Sabtu</div>
                            </div>
                            <div class="grid grid-cols-7 gap-2 mt-2 text-center">
                                @php
                                    $startDay = $calendarData[$year][$month]['startDay'];
                                    $days = $calendarData[$year][$month]['days'];
                                @endphp

                                @for ($i = 0; $i < $startDay; $i++)
                                    <div class="text-stone-700 poppins-semibold flex justify-center items-center">-</div>
                                @endfor

                                @php
                                    $keyMonth = str_pad($keyMonth + 1, 2, '0', STR_PAD_LEFT);
                                @endphp
                                @foreach ($days as $day)
                                    @php
                                        $date = str_pad($day, 2, '0', STR_PAD_LEFT);
                                    @endphp
                                    <a href="{{ route('admin.schedule.show', "$year-$keyMonth-$date") }}"
                                        class="px-2 py-5 border border-stone-700 bg-stone-50 hover:bg-stone-100 text-stone-700 rounded">
                                        {{ $day }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
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
