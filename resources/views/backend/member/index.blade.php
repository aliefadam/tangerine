@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
        ])
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
                            Name
                        </th>
                        <th scope="col" class="px-6 py-4 w-[200px]">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Phone
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Gender
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Total Purchase (Confirmed)
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $member->user->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $member->user->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $member->user->phone ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $member->user->gender ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ format_rupiah($member->user->transactions()->where('payment_status', 'confirmed')->sum('total')) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
