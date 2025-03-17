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
                            Plan
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Trainer
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Room
                        </th>
                        {{-- <th scope="col" class="px-6 py-4">
                            Routine Schedule
                        </th> --}}
                        <th scope="col" class="px-6 py-4">
                            Validity Period
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member_plan)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $member_plan->member->user->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $member_plan->plan }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $member_plan->trainer ? $member_plan->trainer->name : '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $member_plan->room ? $member_plan->room->name : '-' }}
                            </td>
                            {{-- <td class="px-6 py-4">
                                {{ $member_plan->day }} - {{ $member_plan->time }}
                            </td> --}}
                            <td class="px-6 py-4 flex flex-col gap-2">
                                <span class="text-emerald-700">{{ $member_plan->subscribed_date }}</span>
                                <hr>
                                <span class="text-red-700">{{ $member_plan->expired_date }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($member_plan->status == 'active')
                                    <span
                                        class="bg-emerald-100 text-emerald-800 text-xs font-medium px-2.5 py-0.5 rounded-sm">
                                        Active
                                    </span>
                                @else
                                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-sm">
                                        Inactive
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
