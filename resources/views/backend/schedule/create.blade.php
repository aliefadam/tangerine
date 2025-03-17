@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
            'before' => [
                'name' => 'Schedule',
                'url' => route('admin.schedule.index'),
            ],
        ])
    </div>

    <div class="bg-white w-1/2 rounded-md shadow-md p-5 mt-5">
        <form action="{{ route('admin.schedule.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-5">
                <label for="date" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Date
                </label>
                <input type="date" id="date" name="date"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5"
                    required />
            </div>

            <div class="mb-5">
                <label for="time" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Time
                </label>
                <input type="time" id="time" name="time"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5"
                    required />
            </div>

            <div class="mb-5">
                <label for="course_id" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Class
                </label>
                <select id="course_id" name="course_id"
                    class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option selected>-- Choose --</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- <div class="mb-5">
                <label for="trainer_id" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Trainer
                </label>
                <select id="trainer_id" name="trainer_id"
                    class="select-2-dropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option selected>-- Choose --</option>
                </select>
            </div> --}}

            <div class="flex justify-end">
                <button type="submit"
                    class="text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection
