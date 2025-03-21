@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
        ])
    </div>

    <div class="mt-5">
        <div class="relative overflow-x-auto rounded-md bg-white shadow-md">
            <table id="data-table" class="w-full text-sm text-left text-gray-700">
                <thead class="text-xs text-stone-600 uppercase bg-white">
                    <tr class="bg-white border-b border-t border-gray-200">
                        <th scope="col" class="px-6 py-4">No</th>
                        <th scope="col" class="px-6 py-4">Customer Name</th>
                        <th scope="col" class="px-6 py-4">Service</th>
                        <th scope="col" class="px-6 py-4">Price</th>
                        <th scope="col" class="px-6 py-4">Whatsapp Number</th>
                        <th scope="col" class="px-6 py-4">Booking Date</th>
                        <th scope="col" class="px-6 py-4">Session</th>
                        <th scope="col" class="px-6 py-4">Queue Number</th>
                        <th scope="col" class="px-6 py-4">Created At</th>
                        {{-- <th scope="col" class="px-6 py-4">Proof of Payment</th> --}}
                        <th scope="col" class="px-6 py-4">Status</th>
                        <th scope="col" class="px-6 py-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr class="bg-white border-b border-gray-200">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $transaction->customer_name }}</td>
                            <td class="px-6 py-4">{{ $transaction->service_name }}</td>
                            <td class="px-6 py-4">{{ format_rupiah($transaction->service_price) }}</td>
                            <td class="px-6 py-4">{{ $transaction->phone_number }}</td>
                            <td class="px-6 py-4">{{ $transaction->booking_date }}</td>
                            <td class="px-6 py-4 capitalize">{{ $transaction->session }}</td>
                            <td class="px-6 py-4">{{ $transaction->queue_number }}</td>
                            <td class="px-6 py-4">{{ $transaction->created_at->format('d-m-Y H:i') }}</td>
                            {{-- <td class="px-6 py-4">
                                @if ($transaction->payment_proof)
                                    <a href="{{ asset('uploads/proof/' . $transaction->payment_proof) }}" target="_blank">
                                        <img src="{{ asset('uploads/proof/' . $transaction->payment_proof) }}"
                                            alt="Proof of Payment" class="h-10 w-10 object-cover border rounded-md">
                                    </a>
                                @else
                                    <span class="text-red-500">No Proof</span>
                                @endif
                            </td> --}}
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 rounded-md text-white text-xs font-semibold
                                     @if ($transaction->status == 'pending') bg-yellow-500
                                     @elseif ($transaction->status == 'confirmed') bg-green-500
                                     @elseif ($transaction->status == 'cancelled') bg-red-500
                                     @else bg-gray-500 @endif">
                                    {{ ucfirst($transaction->status) }}
                                </span>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($transaction->status == 'pending')
                                    <div class="inline-flex items-center border rounded-md shadow-sm">
                                        <button data-transaction-id="{{ $transaction->id }}"
                                            class="btn-confirm flex items-center px-2 py-1 text-xs text-green-700 hover:text-green-800 transition duration-300 ease-in-out">
                                            <i class="fa-solid fa-check mr-1"></i> Confirm
                                        </button>

                                        <button data-transaction-id="{{ $transaction->id }}"
                                            class="btn-deny flex items-center px-2 py-1 text-xs text-red-700 hover:text-red-800 transition duration-300 ease-in-out border-l">
                                            <i class="fa-solid fa-xmark mr-1"></i> Calcelled
                                        </button>
                                    </div>
                                @else
                                    <span>...</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(".btn-confirm, .btn-deny").click(function() {
                const transactionID = $(this).data("transaction-id");
                const status = $(this).hasClass("btn-confirm") ? "confirmed" :
                    "cancelled"; // Ubah dari 'denied' ke 'cancelled'

                Swal.fire({
                    title: `Are you sure you want to ${status} this transaction?`,
                    icon: status === "confirmed" ? "success" : "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('admin.booking-salon.update', ':id') }}"
                                .replace(
                                    ':id', transactionID),
                            type: "PUT",
                            data: {
                                _token: "{{ csrf_token() }}",
                                status: status
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
                                window.location.reload();
                            },
                        });
                    }
                });
            });
        });
    </script>
@endsection
