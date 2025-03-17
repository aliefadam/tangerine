@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
            'before' => [
                'name' => 'Class Detail',
                'url' => route('admin.course-detail.index'),
            ],
        ])
    </div>

    <form action="{{ route('admin.course-detail.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white w-full lg:w-1/2 rounded-md shadow-md p-5 mt-5">
            <div class="mb-5">
                <label for="course_id" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Select Class
                </label>
                <select id="course_id" name="course_id"
                    class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option selected>-- Choose --</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Detail Name
                </label>
                <input type="text" id="name" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5"
                    required />
            </div>
            <div class="mb-5">
                <label for="drop_in_price" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Drop In Price
                </label>
                <input type="number" id="drop_in_price" name="drop_in_price"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5"
                    required />
            </div>
            <div class="mb-5">
                <label for="10_session_price" class="block mb-2 text-sm font-medium text-gray-900 ">
                    10 Session Price
                </label>
                <input type="number" id="10_session_price" name="10_session_price"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5"
                    required />
            </div>
            <div class="mb-5">
                <label for="20_session_price" class="block mb-2 text-sm font-medium text-gray-900 ">
                    20 Session Price
                </label>
                <input type="number" id="20_session_price" name="20_session_price"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5"
                    required />
            </div>
            <div class="mb-5">
                <label for="person_max" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Maximal Person
                </label>
                <input type="number" id="person_max" name="person_max"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5"
                    required />
            </div>

            <div class="mt-5">
                <div class="flex justify-end">
                    <button type="submit"
                        class="text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
