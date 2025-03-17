@extends('layouts.user')

@section('content')
    <main class="max-w-8xl mx-auto py-10 px-4 sm:px-6 lg:px-8 min-h-screen">
        <h1 class="text-stone-700 text-2xl poppins-semibold">Rent Room History</h1>
        @if ($transactions->isEmpty())
            <p class="mt-5 text-gray-500">You don't have any rent room history</p>
        @else
            <div class="mt-10 space-y-5">
                @foreach ($transactions as $transaction)
                    <div class="bg-white rounded-md border border-gray-300 p-5 flex items-start justify-between">
                        <div class="">
                            <p class="text-sm text-gray-700">{{ $transaction->created_at->format('l, d F Y - H:i') }}</p>
                            <h1 class="poppins-medium text-base mt-1">Rental Room • {{ $transaction->participant }} Person
                            </h1>
                            <div class="mt-3 flex items-center gap-2">
                                <button type="button" data-transaction-id="{{ $transaction->id }}"
                                    data-modal-target="detail-transaction-modal"
                                    data-modal-toggle="detail-transaction-modal"
                                    class="btn-detail text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-xs px-5 py-2.5">
                                    Detail
                                </button>
                                @if ($transaction->status == 'waiting')
                                    <button type="button" data-transaction-id="{{ $transaction->id }}"
                                        data-modal-target="upload-proof-payment-modal"
                                        data-modal-toggle="upload-proof-payment-modal"
                                        class="btn-upload-proof-payment bg-white border border-stone-700 text-stone-700 hover:bg-stone-50 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-xs px-5 py-2.5">
                                        Upload Proof of Payment
                                    </button>
                                @endif
                            </div>
                        </div>
                        <div class="">
                            <h1 class="poppins-medium text-base text-stone-800 text-right">
                                {{ format_rupiah($transaction->total) }}</h1>
                            <div class="mt-2 flex justify-end">
                                @if ($transaction->status == 'waiting')
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-1 rounded-sm">
                                        Waiting for payment
                                    </span>
                                @elseif($transaction->status == 'paid')
                                    <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-1 rounded-sm">
                                        Paid
                                    </span>
                                @else
                                    <span
                                        class="bg-emerald-100 text-emerald-800 text-xs font-medium px-2.5 py-1 rounded-sm">
                                        Confirmed
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>


    {{-- Detail Transaction Modal --}}
    <div id="detail-transaction-modal" tabindex="-1" aria-hidden="true"
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
                        data-modal-hide="detail-transaction-modal">
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

    {{-- Upload Proof of Payment Modal --}}
    <div id="upload-proof-payment-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Upload Proof of payment
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="upload-proof-payment-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" id="form-proof" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col justify-center items-center mb-3">
                        <div class="mt-2 mb-5 text-sm text-gray-600">
                            <span class="text-center block">
                                Payment validation is done during working hours Monday to Friday at 07:00 -
                                21:00.
                            </span>
                        </div>
                        <input type="file" class="hidden" name="proof_of_payment" id="proof_of_payment">
                        <input type="hidden" name="transaction_id">
                        <button type="button" id="btn-choose-file"
                            class="cursor-pointer bg-white border border-stone-700 text-stone-700 hover:bg-stone-50 focus:ring-4 focus:ring-stone-300 w-fit font-medium rounded-lg text-xs px-5 py-2.5">
                            Choose File
                        </button>
                        <div class="mt-5 flex flex-col items-center gap-2">
                            <img src="" id="file-upload-image" class="w-full object-cover rounded-md shadow-md">
                            <span class="text-gray-700 text-sm" id="image-title"></span>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white inline-flex justify-center items-center bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 w-full font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Upload
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(".btn-detail").click(showDetail);
        $(".btn-upload-proof-payment").click(setTransactionID);

        function showDetail() {
            const transactionID = $(this).data("transaction-id");
            $.ajax({
                url: "{{ route('rent-transaction.detail', ':id') }}".replace(':id', transactionID),
                type: "GET",
                beforeSend: function() {
                    $("#container-modal").addClass("h-[500px]").html(`
                    <div class="flex justify-center items-center h-full py-5">
                        <div role="status">
                            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin  fill-stone-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    `);
                },
                success: function(response) {
                    $("#container-modal").removeClass("h-[500px]").html(response.html);
                }
            })
        }

        function setTransactionID() {
            const transactionID = $(this).data("transaction-id");
            $("input[name=transaction_id]").val(transactionID);
        }

        $("#proof_of_payment").change(function() {
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#file-upload-image").attr("src", e.target.result);
                $("#image-title").html(file.name);
            };
            reader.readAsDataURL(file);
        })

        $("#btn-choose-file").click(function() {
            $("#proof_of_payment").click();
        })

        $("#form-proof").submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "/wellness/upload/proof/rent",
                data: formData,
                processData: false,
                contentType: false,
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
        });
    </script>
@endsection
