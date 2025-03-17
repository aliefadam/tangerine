@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
        ])
        <a href="{{ route('admin.trainer.create') }}"
            class="text-white bg-stone-600 border border-stone-600 hover:bg-stone-700 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
            <i class="fas fa-plus mr-1.5"></i> Add Trainer
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
                            Name
                        </th>
                        <th scope="col" class="px-6 py-4 w-[250px]">
                            Description
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Photo
                        </th>
                        <th scope="col" class="px-6 py-4">
                            For Class
                        </th>
                        {{-- <th scope="col" class="px-6 py-4">
                            Social Media Link
                        </th> --}}
                        <th scope="col" class="px-6 py-4">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trainers as $trainer)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $trainer->name }}
                            </td>
                            <td class="px-6 py-4 w-fit">
                                {{ $trainer->description }}
                            </td>
                            <td class="px-6 py-4">
                                <img src="/uploads/trainers/{{ $trainer->image }}"
                                    class="size-20 object-cover rounded-md shadow-md">
                            </td>
                            <td class="px-6 py-4 w-fit">
                                {{ $trainer->for_class }}
                            </td>
                            {{-- <td class="px-6 py-4">
                                <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside">
                                    <li>
                                        Facebook :
                                        @if ($trainer->facebook_link)
                                            <a href="{{ $trainer->facebook_link }}"
                                                class="text-stone-700 hover:underline poppins-medium" target="_blank">
                                                {{ $trainer->facebook_link }}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </li>
                                    <li>
                                        Instagram :
                                        @if ($trainer->instagram_link)
                                            <a href="{{ $trainer->instagram_link }}"
                                                class="text-stone-700 hover:underline poppins-medium" target="_blank">
                                                {{ $trainer->instagram_link }}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </li>
                                    <li>
                                        Twitter :
                                        @if ($trainer->twitter_link)
                                            <a href="{{ $trainer->twitter_link }}"
                                                class="text-stone-700 hover:underline poppins-medium" target="_blank">
                                                {{ $trainer->twitter_link }}
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </li>
                                </ul>
                            </td> --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-5">
                                    <a href="{{ route('admin.trainer.edit', $trainer->id) }}"
                                        class="text-sm text-blue-700 poppins-medium hover:underline">
                                        <i class="fa-regular fa-pen-to-square"></i> Edit
                                    </a>
                                    <a href="javascript:void(0)" data-trainer-id="{{ $trainer->id }}"
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
            const trainerID = $(this).data("trainer-id");

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
                        url: `{{ route('admin.trainer.destroy', ':id') }}`.replace(':id', trainerID),
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
