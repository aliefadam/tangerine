@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
            'before' => [
                'name' => 'Class',
                'url' => route('admin.course.index'),
            ],
        ])
    </div>

    <form action="{{ route('admin.course.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="bg-white w-full lg:w-1/2 rounded-md shadow-md p-5 mt-5">
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Class Name
                </label>
                <input type="text" id="name" name="name" value="{{ $course->name }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5"
                    required />
            </div>
            <div class="mb-5">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Class Description
                </label>
                <textarea id="description" rows="4" name="description"
                    class="resize-none block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-stone-500 focus:border-stone-500"
                    placeholder="">{{ $course->description }}</textarea>
            </div>
            <div class="">
                <label for="image" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Class Image
                </label>
                <img src="/uploads/courses/{{ $course->image }}" class="size-20 object-cover rounded-md shadow-md mb-3">
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                    id="image" type="file" name="image">
            </div>
            <div class="mt-5">
                <div class="flex justify-end">
                    <button type="submit"
                        class="text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
