@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
            'before' => [
                'name' => 'Trainer',
                'url' => route('admin.trainer.index'),
            ],
        ])
    </div>

    <div class="bg-white w-1/2 rounded-md shadow-md p-5 mt-5">
        <form action="{{ route('admin.trainer.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Trainer Name
                </label>
                <input type="text" id="name" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5"
                    required />
            </div>
            <div class="mb-5">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Description
                </label>
                <textarea id="description" name="description" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-stone-500 focus:border-stone-500 resize-none"
                    placeholder="" required></textarea>
            </div>
            <div class="mb-5">
                <label for="facebook_link" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Facebook Link • <span class="text-gray-600 text-xs">Opsional</span>
                </label>
                <input type="text" id="facebook_link" name="facebook_link"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5" />
            </div>
            <div class="mb-5">
                <label for="instagram_link" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Instagtram Link • <span class="text-gray-600 text-xs">Opsional</span>
                </label>
                <input type="text" id="instagram_link" name="instagram_link"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5" />
            </div>
            <div class="mb-5">
                <label for="twitter_link" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Twitter Link • <span class="text-gray-600 text-xs">Opsional</span>
                </label>
                <input type="text" id="twitter_link" name="twitter_link"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5" />
            </div>
            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900 " for="image">
                    Photo
                </label>
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="image" type="file" name="image">
            </div>
            <div class="flex justify-end">
                <button type="submit"
                    class="text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection
