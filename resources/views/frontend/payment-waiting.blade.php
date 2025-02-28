@extends('layouts.user')

@section('content')
    <div class="max-w-8xl mx-auto px-5 lg:px-20 py-5 lg:py-10 min-h-screen">
        <div class="mx-auto max-w-2xl">
            @if ($transaction->payment_status == 'waiting')
                <div class="flex flex-col gap-2 items-center mx-4 p-6 text-yellow-700">
                    <i class="fa-regular fa-hourglass-start text-2xl"></i>
                    <h1 class="text-center text-2xl poppins-semibold">Waiting for payment</h1>
                </div>
            @elseif ($transaction->payment_status == 'paid')
                <div class="flex flex-col gap-2 items-center mx-4 p-6 text-purple-700">
                    <i class="fa-sharp fa-regular fa-person-circle-exclamation text-4xl"></i>
                    <h1 class="text-center text-2xl poppins-semibold">Has been paid, waiting for admin confirmation</h1>
                </div>
            @else
                <div class="flex flex-col gap-2 items-center mx-4 p-6 text-emerald-700">
                    <i class="fa-regular fa-circle-check text-4xl"></i>
                    <h1 class="text-center text-2xl poppins-semibold">Your payment has been confirmed </h1>
                </div>
            @endif
            <div class="mx-4 p-6 mt-5 bg-white rounded-lg shadow-md">
                <div class="text-center">
                    <p class="text-sm text-gray-600">Payment Total</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">
                        {{ format_rupiah($transaction->total) }}
                    </p>
                    <div class="mt-4 pt-4 border-t">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-700">Invoice</span>
                            <span class="font-medium text-stone-700">{{ $transaction->invoice }}</span>
                        </div>
                        @if ($transaction->payment_status == 'waiting')
                            <div class="flex justify-between text-sm items-center mt-3">
                                <span class="text-gray-700 text-sm">Expiration Date</span>
                                <div class="font-medium text-stone-700">
                                    {{ format_date($transaction->expirated_date) }}
                                </div>
                            </div>
                        @elseif ($transaction->payment_status == 'paid')
                            <div class="flex justify-between text-sm items-center mt-3">
                                <span class="text-gray-700 text-sm">Paid at</span>
                                <div class="font-medium text-stone-700">
                                    {{ format_date($transaction->updated_at) }}
                                </div>
                            </div>
                        @else
                            <div class="flex justify-between text-sm items-center mt-3">
                                <span class="text-gray-700 text-sm">Confirmed at</span>
                                <div class="font-medium text-stone-700">
                                    {{ format_date($transaction->updated_at) }}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="mx-4 mt-4 p-6 bg-white rounded-lg shadow-md">
                <h3 class="font-medium text-gray-900">Payment Method</h3>
                <div class="mt-4 space-y-4">
                    <div class="flex items-center justify-between p-4 border rounded-lg">
                        <div class="flex items-center gap-3">
                            <img src="/imgs/BCA.png" alt="BCA" class="h-4" />
                            <div>
                                <p class="text-sm font-medium">Virtual Account BCA</p>
                                <p class="text-sm text-gray-600">8277 0812 3456 7890</p>
                            </div>
                        </div>
                        <button
                            class="!rounded-button px-3 py-1.5 text-sm border border-custom text-custom hover:bg-custom/5">
                            <i class="far fa-copy mr-1"></i>Copy
                        </button>
                    </div>
                </div>
            </div>
            @if ($transaction->payment_status == 'paid' || $transaction->payment_status == 'confirmed')
                <div class="mx-4 mt-4 bg-white rounded-lg shadow-md p-6 mb-10">
                    @csrf
                    <div class="flex flex-col justify-center items-center">
                        <label class="block mb-2 text-base font-medium text-gray-900" for="file_input">
                            Proof of payment
                        </label>
                        <img src="/uploads/proofs/{{ $transaction->proof_of_payment }}"
                            class="w-full h-auto object-cover rounded-md shadow-md">
                    </div>
                </div>
            @else
                <div class="mx-4 mt-4 bg-white rounded-lg shadow-md p-6 mb-10">
                    <form id="form-proof" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="flex flex-col justify-center items-center">
                            <label class="block mb-2 text-base font-medium text-gray-900" for="file_input">
                                Upload proof of payment
                            </label>
                            <input type="file" class="hidden" name="proof_of_payment" id="proof_of_payment">
                            <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                            <button type="button" id="btn-choose-file"
                                class="bg-white border border-stone-700 text-stone-700 hover:bg-stone-50 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-xs px-5 py-2.5">
                                Choose File
                            </button>
                            <div class="mt-5 flex flex-col items-center gap-2">
                                <img src="" id="file-upload-image" class="w-full object-cover rounded-md shadow-md">
                                <span class="text-gray-700 text-sm" id="image-title"></span>
                            </div>
                        </div>
                        <div class="mt-5">
                            <button type="submit"
                                class="text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm w-full px-5 py-2.5">
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('script')
    <script>
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
                url: "/upload/proof",
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
