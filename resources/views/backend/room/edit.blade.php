@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
            'before' => [
                'name' => 'Room',
                'url' => route('admin.room.index'),
            ],
        ])
    </div>

    <div class="bg-white w-full lg:w-1/2 rounded-md shadow-md p-5 mt-5">
        <form action="{{ route('admin.room.update', $room->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Trainer Name
                </label>
                <input type="text" id="name" name="name" value="{{ $room->name }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5"
                    required />
            </div>
            <div class="mb-5">
                <label for="capacity" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Capacity
                </label>
                <input type="number" id="capacity" name="capacity" value="{{ $room->capacity }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5"
                    required />
            </div>
            <div class="mb-5">
                <label for="used_for" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Used For
                </label>
                <div class="grid grid-cols-2 gap-3">
                    <div class="flex items-center ps-4 border border-gray-200 rounded-sm">
                        <input @checked($room->used_for == 'All Classes') id="bordered-radio-1" type="radio" value="All Classes"
                            name="used_for" class="w-4 h-4 text-stone-600 bg-gray-100 border-gray-300 focus:ring-stone-500">
                        <label for="bordered-radio-1" class="w-full py-3.5 ms-2 text-sm font-medium text-gray-900">
                            All Classes
                        </label>
                    </div>
                    <div class="flex items-center ps-4 border border-gray-200 rounded-sm">
                        <input @checked($room->used_for == 'Pilates Only') id="bordered-radio-2" type="radio" value="Pilates Only"
                            name="used_for" class="w-4 h-4 text-stone-600 bg-gray-100 border-gray-300 focus:ring-stone-500">
                        <label for="bordered-radio-2" class="w-full py-3.5 ms-2 text-sm font-medium text-gray-900">
                            Pilates Only
                        </label>
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <label for="used_for" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Can be rented
                </label>
                <div class="grid grid-cols-2 gap-3">
                    <div class="flex items-center ps-4 border border-gray-200 rounded-sm">
                        <input @checked($room->can_be_rent == true) id="can-be-rent-1" type="radio" value="true"
                            name="can_be_rent"
                            class="w-4 h-4 text-stone-600 bg-gray-100 border-gray-300 focus:ring-stone-500">
                        <label for="can-be-rent-1" class="w-full py-3.5 ms-2 text-sm font-medium text-gray-900">
                            Yes
                        </label>
                    </div>
                    <div class="flex items-center ps-4 border border-gray-200 rounded-sm">
                        <input @checked($room->can_be_rent == false) id="can-be-rent-2" type="radio" value="false"
                            name="can_be_rent"
                            class="w-4 h-4 text-stone-600 bg-gray-100 border-gray-300 focus:ring-stone-500">
                        <label for="can-be-rent-2" class="w-full py-3.5 ms-2 text-sm font-medium text-gray-900">
                            No
                        </label>
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Price For Participants Under 10
                </label>
                <div class="grid grid-cols-2 gap-5">
                    <div class="">
                        <label for="with_bath_under_10" class="block mb-2 text-xs font-medium text-gray-600 ">
                            With Bath
                        </label>
                        <input type="number" id="with_bath_under_10" name="with_bath_under_10"
                            value="{{ $room->rent_price_under_10['with_bath'] ?? 0 }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5" />
                    </div>
                    <div class="">
                        <label for="without_bath_under_10" class="block mb-2 text-xs font-medium text-gray-600 ">
                            Without Bath
                        </label>
                        <input type="number" id="without_bath_under_10" name="without_bath_under_10"
                            value="{{ $room->rent_price_under_10['without_bath'] ?? 0 }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5" />
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <label for="" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Price For Participants Over 10
                </label>
                <div class="grid grid-cols-2 gap-5">
                    <div class="">
                        <label for="with_bath_over_10" class="block mb-2 text-xs font-medium text-gray-600 ">
                            With Bath
                        </label>
                        <input type="number" id="with_bath_over_10" name="with_bath_over_10"
                            value="{{ $room->rent_price_over_10['with_bath'] ?? 0 }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5" />
                    </div>
                    <div class="">
                        <label for="without_bath_over_10" class="block mb-2 text-xs font-medium text-gray-600 ">
                            Without Bath
                        </label>
                        <input type="number" id="without_bath_over_10" name="without_bath_over_10"
                            value="{{ $room->rent_price_over_10['without_bath'] ?? 0 }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5" />
                    </div>
                </div>
            </div>
            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="room_image">
                    Room Image
                </label>
                <img src="/uploads/rooms/{{ $room->image }}" class="size-20 mb-3 object-cover rounded-md shadow-md">
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                    id="room_image" name="room_image" type="file">
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection
