@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
        ])
        <a href="{{ route('admin.course-detail.create') }}"
            class="text-white bg-stone-600 border border-stone-600 hover:bg-stone-700 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
            <i class="fas fa-plus mr-1.5"></i> Add Detail Class
        </a>
    </div>

    <div class="mt-5">
        <div class="relative overflow-x-auto rounded-md bg-white shadow-md">
            <table id="data-table" class="w-full text-sm text-left rtl:text-right text-gray-700">
                <thead class="text-xs text-stone-600 uppercase bg-white">
                    <tr class="bg-white border-b border-t border-gray-200">
                        <th scope="col" class="px-6 py-4 w-[70px]">
                            No
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Class Name
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Detail Name
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Drop In Price
                        </th>
                        <th scope="col" class="px-6 py-4">
                            10 Session Price
                        </th>
                        <th scope="col" class="px-6 py-4">
                            20 Session Price
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Max Person
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($course_details as $detail)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $detail->course->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $detail->name }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($detail->drop_in_price)
                                    {{ format_rupiah($detail->drop_in_price) }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($detail['10_session_price'])
                                    {{ format_rupiah($detail['10_session_price']) }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($detail['20_session_price'])
                                    {{ format_rupiah($detail['20_session_price']) }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ $detail->person_max ?? '-' }}
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-5">
                                    <a href="{{ route('admin.course-detail.edit', $detail->id) }}"
                                        class="text-sm text-blue-700 poppins-medium hover:underline">
                                        <i class="fa-regular fa-pen-to-square"></i> Edit
                                    </a>
                                    <a href="javascript:void(0)" data-category-id="{{ $detail->id }}"
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
        $(".btn-delete").click(deleteCourse);

        function deleteCourse() {
            const categoryID = $(this).data("category-id");

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
                        url: `{{ route('admin.course-detail.destroy', ':id') }}`.replace(':id',
                            categoryID),
                        type: 'DELETE',
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
                        success: function(data) {
                            location.reload();
                        },
                    });
                }
            });
        }
    </script>
@endsection
