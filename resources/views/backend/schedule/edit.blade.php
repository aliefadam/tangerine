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

    <div class="bg-white w-1/2 rounded-md shadow-md p-5 mt-5">
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
            <div class="flex justify-end">
                <button type="submit"
                    class="text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection
