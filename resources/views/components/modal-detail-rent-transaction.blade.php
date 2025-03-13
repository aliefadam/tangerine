<div class="p-4 md:p-5 space-y-4 scrollbar overflow-y-auto h-[500px]">
    <div class="space-y-4">
        <div class="flex justify-between">
            <span class="lg:text-sm text-xs ">Payment Status</span>
            <span class="lg:text-sm text-xs text-gray-600">
                @if ($transaction->status == 'waiting')
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-1 rounded-sm">
                        Waiting for payment
                    </span>
                @elseif($transaction->status == 'paid')
                    <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-1 rounded-sm">
                        Paid
                    </span>
                @else
                    <span class="bg-emerald-100 text-emerald-800 text-xs font-medium px-2.5 py-1 rounded-sm">
                        Confirmed
                    </span>
                @endif
            </span>
        </div>
        <div class="flex justify-between">
            <span class="lg:text-sm text-xs ">Invoice</span>
            <span class="lg:text-sm text-xs text-gray-600">
                {{ $transaction->invoice }}
            </span>
        </div>
        <div class="flex justify-between">
            <span class="lg:text-sm text-xs ">Transaction Date</span>
            <span class="lg:text-sm text-xs text-gray-600 text-right">
                {{ format_date($transaction->created_at) }}
            </span>
        </div>
    </div>
    <hr>
    <div class="">
        <h1 class="poppins-semibold">Rent Detail</h1>
        <div class="mt-4 flex flex-col gap-4">
            <div class="flex justify-between">
                <span class="lg:text-sm text-xs flex-[3]">
                    Participant
                </span>
                <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
                    {{ $transaction->participant }} Person
                </span>
            </div>
            <div class="flex justify-between">
                <span class="lg:text-sm text-xs flex-[3]">
                    Room Name
                </span>
                <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
                    {{ $transaction->rentTransactionDetails[0]->room->name }}
                </span>
            </div>
            <div class="flex justify-between">
                <span class="lg:text-sm text-xs flex-[3]">
                    Type
                </span>
                <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
                    {{ $transaction->room_type == 'with_bath' ? 'With Bath' : 'Without Bath' }}
                </span>
            </div>
            <div class="flex justify-between">
                <span class="lg:text-sm text-xs flex-[3]">
                    Rent Date
                </span>
                <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
                    {{ Carbon\Carbon::parse($transaction->rentTransactionDetails[0]->date)->format('l, d F Y') }}
                </span>
            </div>
            <div class="flex justify-between">
                <span class="lg:text-sm text-xs flex-[3]">
                    Rent Time
                </span>
                <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
                    {{ Carbon\Carbon::parse($transaction->rentTransactionDetails->first()->time)->format('H:i') }}
                    -
                    {{ Carbon\Carbon::parse($transaction->rentTransactionDetails->last()->time)->format('H:i') }}
                </span>
            </div>
        </div>
    </div>
    <hr>
    <div class="space-y-4">
        <div class="flex justify-between">
            <span class="lg:text-sm text-xs flex-[3]">
                Sub Total
            </span>
            <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
                {{ $transaction->hour }} Hour x {{ format_rupiah($transaction->price) }}
            </span>
        </div>
        <div class="flex justify-between">
            <h1 class="poppins-semibold">Transaction Total</h1>
            <h1 class="poppins-semibold">{{ format_rupiah($transaction->total) }}</h1>
        </div>
    </div>
    <hr>
    <div class="space-y-4">
        <div class="flex flex-col gap-3 items-center">
            <h1 class="poppins-semibold">Proof of payment</h1>
            @if ($transaction->proof_of_payment)
                <img src="/uploads/proofs/{{ $transaction->proof_of_payment }}"
                    class="w-full h-auto object-cover rounded-md shadow-md">
            @else
                <span class="text-gray-600 text-sm flex flex-col items-center gap-2">
                    <i class="fa-regular fa-image-slash text-xl"></i>
                    <span>
                        No proof of payment uploaded yet
                    </span>
                </span>
            @endif
        </div>
    </div>
</div>
@php
    $user_role = auth()->user()->role;
@endphp
@if ($user_role == 'admin' && $transaction->status != 'confirmed')
    <!-- Modal footer -->
    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
        <button type="button" data-transaction-id="{{ $transaction->id }}"
            class="btn-confirm-payment w-1/2 mx-auto text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Confirm this payment
        </button>
    </div>
@endif
