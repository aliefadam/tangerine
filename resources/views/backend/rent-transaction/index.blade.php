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
                        <th scope="col" class="px-6 py-4">
                            No
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Room Name
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Rent Hour
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Total
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Payment Status
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-2">
                                    <span>
                                        {{ $transaction->user->name }}
                                    </span>
                                    <hr>
                                    <span class="poppins-semibold">
                                        {{ $transaction->user->email }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                {{ $transaction->rentTransactionDetails[0]->room->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $transaction->hour }} Hour
                            </td>
                            <td class="px-6 py-4">
                                {{ format_rupiah($transaction->price) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ format_rupiah($transaction->total) }}
                            </td>
                            <td class="px-6 py-4 w-fit">
                                @if ($transaction->status == 'waiting')
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-1 rounded-sm">
                                        Waiting for payment
                                    </span>
                                @elseif($transaction->status == 'paid')
                                    <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-1 rounded-sm">
                                        Paid
                                    </span>
                                @elseif($transaction->status == 'confirmed')
                                    <span
                                        class="bg-emerald-100 text-emerald-800 text-xs font-medium px-2.5 py-1 rounded-sm">
                                        Confirmed
                                    </span>
                                @else
                                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-1 rounded-sm">
                                        Cancelled
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-5">
                                    <a href="javascript:void(0)" data-modal-target="default-modal"
                                        data-modal-toggle="default-modal" data-transaction-id="{{ $transaction->id }}"
                                        class="btn-show-detail text-sm text-blue-700 poppins-medium hover:blue-800">
                                        <i class="fa-regular fa-arrow-up-right-from-square mr-1"></i>
                                        Detail
                                    </a>
                                    @if ($transaction->status == 'waiting')
                                        <a href="javascript:void(0)" data-transaction-id="{{ $transaction->id }}"
                                            class="btn-cancel-transaction text-sm text-red-700 poppins-medium hover:blue-800">
                                            <i class="fa-regular fa-ban mr-1"></i>
                                            Cancel Transaction
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Transaction Detail
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div id="container-modal" class="h-[500px]"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(".btn-cancel-transaction").click(cancelTransaction);
        $(".btn-show-detail").click(showDetail);

        function showDetail() {
            const transactionID = $(this).data("transaction-id");
            $.ajax({
                url: "{{ route('admin.rent-transaction.show', ':id') }}".replace(':id', transactionID),
                type: "GET",
                beforeSend: function() {
                    $("#container-modal").addClass("h-[500px]").html(`
                    <div class="flex justify-center items-center h-full py-5">
                        <div role="status">
                            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin fill-stone-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    `);
                },
                success: function(response) {
                    $("#container-modal").removeClass("h-[500px]").html(response.html);
                    $(".btn-confirm-payment").click(confirmPayment);
                }
            })
        }

        function cancelTransaction() {
            const transactionID = $(this).data("transaction-id");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, confirm it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.rent-transaction.update', ':id') }}".replace(':id',
                            transactionID),
                        type: "PUT",
                        data: {
                            _token: "{{ csrf_token() }}",
                            status: "cancelled",
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Loading',
                                text: 'Please wait...',
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            });
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                }
            });
        }

        function confirmPayment() {
            const transactionID = $(this).data("transaction-id");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, confirm it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.rent-transaction.update', ':id') }}".replace(':id',
                            transactionID),
                        type: "PUT",
                        data: {
                            _token: "{{ csrf_token() }}",
                            status: "confirmed",
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Loading',
                                text: 'Please wait...',
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            });
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                }
            });
        }
    </script>
@endsection
