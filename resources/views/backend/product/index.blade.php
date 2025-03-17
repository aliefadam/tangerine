@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
        ])
        <a href="{{ route('admin.product.create') }}"
            class="text-white bg-stone-600 border border-stone-600 hover:bg-stone-700 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
            <i class="fas fa-plus mr-1.5"></i> Add Product
        </a>
    </div>

    <div class="mt-5">
        <div class="relative overflow-x-auto rounded-md bg-white shadow-md">
            <table id="data-table" class="w-full text-sm text-left rtl:text-right text-gray-700">
                <thead class="text-xs text-stone-600 uppercase bg-white">
                    <tr class="bg-white border-b border-t border-gray-200">
                        <th scope="col" class="px-6 py-4">
                            No
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-4 w-[250px]">
                            Link
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Images
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $product->name }}
                            </td>
                            <td class="px-6 py-4 w-fit">
                                {{ $product->link }}
                            </td>
                            <td class="px-6 py-4">
                                <img src="/uploads/Products/{{ $product->image }}"
                                    class="size-20 object-cover rounded-md shadow-md">
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-5">
                                    <a href="{{ route('admin.product.edit', $product->id) }}"
                                        class="text-sm text-blue-700 poppins-medium hover:underline">
                                        <i class="fa-regular fa-pen-to-square"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-sm text-red-700 poppins-medium hover:underline">
                                            <i class="fa-regular fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
