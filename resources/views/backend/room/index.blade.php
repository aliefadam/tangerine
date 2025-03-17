@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
        ])
        <a href="{{ route('admin.room.create') }}"
            class="text-white bg-stone-600 border border-stone-600 hover:bg-stone-700 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
            <i class="fas fa-plus mr-1.5"></i> Add Room
        </a>
    </div>

    <div class="mt-5">
        <div class="relative overflow-x-auto rounded-md bg-white shadow-md">
            <table id="data-table" class="w-full text-sm text-left rtl:text-right text-gray-700">
                <thead class="text-xs text-stone-600 uppercase bg-white">
                    <tr class="bg-white border-b border-t border-gray-200">
                        <th scope="col" class="px-6 py-4">
                            No
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Room Name
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Used For
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Capacity
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Can be rented
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Rental Price
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $room)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $room->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $room->used_for }}
                            </td>
                            <td class="px-6 py-4">
                                <img src="/uploads/rooms/{{ $room->image }}"
                                    class="size-20 object-cover rounded-md shadow-md">
                            </td>
                            <td class="px-6 py-4 w-fit">
                                {{ $room->capacity }}
                            </td>
                            <td class="px-6 py-4 w-fit">
                                @if ($room->can_be_rent)
                                    <span
                                        class="bg-emerald-100 text-emerald-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                                        Yes
                                    </span>
                                @else
                                    <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">
                                        No
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="border shadow-sm bg-white p-2 rounded-md">
                                    <h1 class="poppins-medium">Under 10 Participant</h1>
                                    <div class="text-xs flex flex-col mt-1">
                                        <span class="text-gray-600">
                                            With Bath : {{ format_rupiah($room->rent_price_under_10['with_bath'] ?? 0) }}
                                        </span>
                                        <span class="text-gray-600">
                                            Without Bath :
                                            {{ format_rupiah($room->rent_price_under_10['without_bath'] ?? 0) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-3 border shadow-sm bg-white p-2 rounded-md">
                                    <h1 class="poppins-medium">Over 10 Participant</h1>
                                    <div class="text-xs flex flex-col mt-1">
                                        <span class="text-gray-600">
                                            With Bath : {{ format_rupiah($room->rent_price_over_10['with_bath'] ?? 0) }}
                                        </span>
                                        <span class="text-gray-600">
                                            Without Bath :
                                            {{ format_rupiah($room->rent_price_over_10['without_bath'] ?? 0) }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-5">
                                    <a href="{{ route('admin.room.edit', $room->id) }}"
                                        class="text-sm text-blue-700 poppins-medium hover:underline">
                                        <i class="fa-regular fa-pen-to-square"></i> Edit
                                    </a>
                                    <a href="javascript:void(0)" data-room-id="{{ $room->id }}"
                                        class="btn-delete text-sm text-red-700 poppins-medium hover:underline">
                                        <i class="fa-regular fa-trash"></i> Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                        url: `{{ route('admin.room.destroy', ':id') }}`.replace(':id', roomID),
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
    </script>
@endsection
