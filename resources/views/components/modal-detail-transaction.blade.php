<div class="p-4 md:p-5 space-y-4 scrollbar overflow-y-auto h-[500px]">
    <div class="space-y-4">
        <div class="flex justify-between">
            <span class="lg:text-sm text-xs ">Payment Status</span>
            <span class="lg:text-sm text-xs text-gray-600">
                @if ($transaction->payment_status == 'waiting')
                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-1 rounded-sm">
                        Waiting for payment
                    </span>
                @elseif($transaction->payment_status == 'paid')
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
        {{-- <div class="flex justify-between">
            <span class="lg:text-sm text-xs flex-[3]">Payment Method</span>
            <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
                BCA Virtual Account
            </span>
        </div>
        <div class="flex justify-between">
            <span class="lg:text-sm text-xs flex-[3]">Virtual Account</span>
            <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
                8277 0812 3456 7890
            </span>
        </div> --}}
    </div>
    <hr>
    <div class="">
        <h1 class="poppins-semibold">Membership Plan</h1>
        <div class="mt-4 flex flex-col gap-4">
            <div class="flex justify-between">
                <span class="lg:text-sm text-xs flex-[3]">
                    Plan Name
                </span>
                <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
                    {{ $transaction->plan }}
                </span>
            </div>
            <div class="flex justify-between">
                <span class="lg:text-sm text-xs flex-[3]">
                    Room Name
                </span>
                <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
                    {{ $transaction->room->name }}
                </span>
            </div>
            <div class="flex justify-between">
                <span class="lg:text-sm text-xs flex-[3]">
                    Trainer Name
                </span>
                <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
                    {{ $transaction->trainer ? $transaction->trainer->name : '-' }}
                </span>
            </div>
            <div class="flex justify-between">
                <span class="lg:text-sm text-xs flex-[3]">
                    First Class Schedule
                </span>
                <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
                    @if ($transaction->date)
                        {{ Carbon\Carbon::parse($transaction->date)->format('l, d F Y') }} - {{ $transaction->time }}
                    @else
                        -
                    @endif
                </span>
            </div>
            <div class="flex justify-between">
                <span class="lg:text-sm text-xs flex-[3]">
                    Injury or Healty Notes
                </span>
                <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
                    {{ $transaction->notes ?? '-' }}
                </span>
            </div>
        </div>
    </div>
    <hr>
    <div class="space-y-4">
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
@if ($user_role == 'admin' && $transaction->payment_status != 'confirmed')
    <!-- Modal footer -->
    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
        <button type="button" data-transaction-id="{{ $transaction->id }}"
            class="btn-confirm-payment w-1/2 mx-auto text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Confirm this payment
        </button>
    </div>
@endif
