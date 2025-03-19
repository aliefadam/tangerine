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

    <div class="bg-white w-full lg:w-1/2 rounded-md shadow-md p-5 mt-5">
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
                <label for="for_class" class="block mb-2 text-sm font-medium text-gray-900 ">
                    For Class
                </label>
                <div class="grid grid-cols-2 gap-3">
                    <div class="flex items-center ps-4 border border-gray-200 rounded-sm">
                        <input id="bordered-radio-1" type="radio" value="Pilates" name="for_class"
                            class="w-4 h-4 text-stone-600 bg-gray-100 border-gray-300 focus:ring-stone-500">
                        <label for="bordered-radio-1" class="w-full py-3.5 ms-2 text-sm font-medium text-gray-900">
                            Pilates
                        </label>
                    </div>
                    <div class="flex items-center ps-4 border border-gray-200 rounded-sm">
                        <input id="bordered-radio-2" type="radio" value="Yoga" name="for_class"
                            class="w-4 h-4 text-stone-600 bg-gray-100 border-gray-300 focus:ring-stone-500">
                        <label for="bordered-radio-2" class="w-full py-3.5 ms-2 text-sm font-medium text-gray-900">
                            Yoga
                        </label>
                    </div>
                    <div class="flex items-center ps-4 border border-gray-200 rounded-sm">
                        <input id="bordered-radio-3" type="radio" value="Zumba" name="for_class"
                            class="w-4 h-4 text-stone-600 bg-gray-100 border-gray-300 focus:ring-stone-500">
                        <label for="bordered-radio-3" class="w-full py-3.5 ms-2 text-sm font-medium text-gray-900">
                            Zumba
                        </label>
                    </div>
                    <div class="flex items-center ps-4 border border-gray-200 rounded-sm">
                        <input id="bordered-radio-4" type="radio" value="Sweat Dance" name="for_class"
                            class="w-4 h-4 text-stone-600 bg-gray-100 border-gray-300 focus:ring-stone-500">
                        <label for="bordered-radio-4" class="w-full py-3.5 ms-2 text-sm font-medium text-gray-900">
                            Sweat Dance
                        </label>
                    </div>
                </div>
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
            {{-- <div class="mb-5">
                <label for="twitter_link" class="block mb-2 text-sm font-medium text-gray-900 ">
                    Twitter Link • <span class="text-gray-600 text-xs">Opsional</span>
                </label>
                <input type="text" id="twitter_link" name="twitter_link"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5" />
            </div> --}}
            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900 " for="image">
                    Photo
                </label>
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
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
