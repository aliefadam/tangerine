@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
            'before' => [
                'name' => 'Beautician',
                'url' => route('admin.beautician.index'),
            ],
        ])
    </div>

    <div class="bg-white w-full lg:w-1/2 rounded-md shadow-md p-5 mt-5">
        <form action="{{ route('admin.beautician.update', $beautician->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Beautician Name
                </label>
                <input type="text" id="name" name="name" value="{{ $beautician->name }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5"
                    required />
            </div>
            <div class="mb-5">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Description (Hairstylist/Therapist)
                </label>
                <textarea id="description" name="description" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-stone-500 focus:border-stone-500 resize-none"
                    placeholder="" required>{{ $beautician->description }}</textarea>
            </div>
            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900 " for="image">
                    Photo
                </label>
                <img src="/uploads/beauticians/{{ $beautician->image }}"
                    class="size-20 object-cover rounded-md shadow-md mb-3">
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                    id="image" type="file" name="image">
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
