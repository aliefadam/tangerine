@extends('layouts.user')
@section('content')
    {{-- Hero --}}
    <div class="h-[300px] lg:h-[550px] relative">
        <img src="/uploads/services/{{ $service->image }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-stone-800/60 bg-opacity-60"></div>
        <div
            class="absolute lg:ps-5 top-0 left-0 right-0 text-white flex flex-col justify-center items-center w-full h-full">
            <h2 class="text-4xl lg:text-5xl poppins-bold text-center">{{ $service->name }}</h2>
        </div>
    </div>
    {{-- End Hero --}}

    <div class="mt-16 lg:mt-20 p-5 lg:p-0">
        <h1 class="text-3xl text-center text-stone-700 poppins-bold">Booking</h1>
        <form method="POST" id="form-booking" action="" class="mt-10 w-full lg:w-1/2 mx-auto space-y-5 pb-20"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="service_id" value="{{ $service->id }}">
            <label for="service" class="block mb-2 text-sm font-medium text-gray-900">
                Service
            </label>
            <div class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5 w-full">
                <p class="text-gray-900">
                    <strong>{{ $service->name }}</strong> • {{ format_rupiah($service->price) }}
                </p>
            </div>

            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                    Name
                </label>
                <input required type="text" id="name" name="name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5"
                    placeholder="Enter your name" required>
            </div>

            <div>
                <label for="whatsapp" class="block mb-2 text-sm font-medium text-gray-900">
                    WhatsApp Number
                </label>
                <input type="text" id="whatsapp" name="whatsapp"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5"
                    placeholder="Enter your WhatsApp number" required>
            </div>

            <div id="schedule-container" class="mt-5 flex flex-col items-center gap-2 justify-center">
                <h2 class="text-lg font-medium text-gray-900">Select Date & Session</h2>
                <input type="date" name="date" id="selected-date"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block p-2.5 w-1/2"
                    onchange="updateAvailableSessions()">
                <input type="hidden" id="selected-session" name="session">

                <div id="session-options" class="mt-3 flex gap-3">
                    @foreach (['morning', 'afternoon', 'evening'] as $session)
                        <button type="button" data-session="{{ $session }}"
                            class="session-btn px-4 py-2 border rounded bg-gray-400 text-white cursor-not-allowed" disabled>
                            {{ ucfirst($session) }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Payment Proof Upload -->
            <div class="mt-8">
                {{-- <div class="">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="payment_proof">
                        Upload Payment Proof
                    </label>
                    <input type="file" id="payment_proof" name="payment_proof" accept="image/*"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                        required>
                </div> --}}

                <div class="mt-5">
                    <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                        <svg class="shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Danger</span>
                        <div>
                            <span class="font-medium">Please Note:</span>
                            <ul class="mt-1.5 list-disc list-inside">
                                <li>Admin will confirm the schedule of treatment hours based on the queue number</li>
                                <li>Payment is only confirmed during working hours (Monday-Friday, 08.00-17.00 WIB).</li>
                                <li>Payment must be confirmed within 2 hours after booking.</li>
                            </ul>
                        </div>
                    </div>
                    {{-- <p class="mt-1 text-sm text-red-600">
                        - Admin akan mengonfirmasi jadwal jam perawatan berdasarkan nomor antrian
                    </p>
                    <p class="mt-1 text-sm text-red-600">
                        - Pembayaran hanya di konfirmasi di jam kerja (Senin-Jumat, 08.00-17.00 WIB)
                    </p>
                    <p class="mt-1 text-sm text-red-600">
                        - Pembayaran harus di konfirmasi dalam waktu 2 jam setelah booking
                    </p> --}}
                </div>
            </div>

            <div class="mt-10">
                <button type="submit"
                    class="w-full text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-3">
                    <i class="fa-solid fa-credit-card mr-1.5"></i>
                    Submit Booking
                </button>
            </div>
    </div>
    </form>
    </div>
@endsection

@section('script')
    <script>
        const availableSessions = @json($availableSessions);

        function updateAvailableSessions() {
            const selectedDate = document.getElementById('selected-date').value;
            const buttons = document.querySelectorAll('.session-btn');
            const hiddenSessionInput = document.getElementById('selected-session'); // Input hidden

            hiddenSessionInput.value = ""; // Reset value saat tanggal berubah

            buttons.forEach(btn => {
                btn.classList.remove('bg-stone-700', 'cursor-pointer');
                btn.classList.add('bg-gray-400', 'cursor-not-allowed');
                btn.onclick = null; // Hapus event listener lama
            });

            if (availableSessions[selectedDate]) {
                availableSessions[selectedDate].forEach(sessionId => {
                    const sessionName = ["morning", "afternoon", "evening"][sessionId - 1];
                    const btn = document.querySelector(`[data-session="${sessionName}"]`);
                    if (btn) {
                        btn.classList.remove('bg-gray-400', 'cursor-not-allowed');
                        btn.classList.add('bg-stone-700', 'cursor-pointer');

                        // Tambahkan event listener baru
                        btn.onclick = function() {
                            hiddenSessionInput.value = sessionName; // Simpan sesi yang dipilih
                            buttons.forEach(b => b.classList.remove('border-2', 'border-stone-900'));
                            btn.classList.add('border-2', 'border-stone-900');
                        };
                    }
                });
            }
        }

        // warnain hover
        function updateAvailableSessions() {
            let dateInput = document.getElementById("selected-date");
            let sessionButtons = document.querySelectorAll(".session-btn");

            // Aktifkan tombol jika tanggal dipilih
            if (dateInput.value) {
                sessionButtons.forEach(button => {
                    button.classList.remove("cursor-not-allowed", "bg-gray-400");
                    button.classList.add("bg-blue-500", "hover:bg-blue-600", "cursor-pointer");
                    button.disabled = false;
                });
            } else {
                sessionButtons.forEach(button => {
                    button.classList.add("cursor-not-allowed", "bg-gray-400");
                    button.classList.remove("bg-blue-500", "hover:bg-blue-600", "bg-green-500");
                    button.disabled = true;
                });
            }
        }

        document.querySelectorAll(".session-btn").forEach(button => {
            button.addEventListener("click", function() {
                if (!this.disabled) {
                    // Hapus warna dari semua tombol sesi
                    document.querySelectorAll(".session-btn").forEach(btn => {
                        btn.classList.remove("bg-green-500", "hover:bg-green-600");
                        btn.classList.add("bg-blue-500", "hover:bg-blue-600");
                    });

                    // Tambahkan warna hijau ke tombol yang dipilih
                    this.classList.remove("bg-blue-500", "hover:bg-blue-600");
                    this.classList.add("bg-green-500", "hover:bg-green-600");

                    // Simpan sesi yang dipilih ke dalam input hidden
                    document.getElementById("selected-session").value = this.getAttribute("data-session");
                }
            });
        });

        function copyToClipboard(elementId) {
            const text = document.getElementById(elementId).innerText;
            navigator.clipboard.writeText(text.replace(/\s/g, '')).then(() => {
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Copied!',
                    text: 'Account number has been copied to clipboard',
                    timer: 1500,
                    showConfirmButton: false
                });
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        }

        $(document).ready(function() {
            $("#form-booking").submit(function(e) {
                e.preventDefault();

                const name = $("input[name='name']").val().trim();
                const whatsapp = $("input[name='whatsapp']").val().trim();
                const plan = $("input[name='service_id']").val();
                const date = $("input[name='date']").val();
                // const paymentProof = $("#payment_proof")[0].files[0];
                const session = $("input[name='session']").val();

                if (!name) {
                    Swal.fire({
                        icon: "error",
                        title: 'Name Required',
                        text: 'Please enter your name'
                    });
                    return;
                }

                if (!whatsapp) {
                    Swal.fire({
                        icon: "error",
                        title: 'WhatsApp Number Required',
                        text: 'Please enter your WhatsApp number'
                    });
                    return;
                }

                if (!date) {
                    Swal.fire({
                        icon: "error",
                        title: 'Date Required',
                        text: 'Please select a date'
                    });
                    return;
                }

                if (!/^\d{10,15}$/.test(whatsapp)) {
                    Swal.fire({
                        icon: "error",
                        title: 'Invalid WhatsApp Number',
                        text: 'Please enter a valid WhatsApp number (10-15 digits)'
                    });
                    return;
                }

                if (!plan) {
                    Swal.fire({
                        icon: "error",
                        title: 'Plan Required',
                        text: 'You must select a plan first'
                    });
                    return;
                }

                // if (!paymentProof) {
                //     Swal.fire({
                //         icon: "error",
                //         title: 'Payment Proof Required',
                //         text: 'Please upload your payment proof'
                //     });
                //     return;
                // }

                const formData = new FormData(this);
                formData.append("session", session);
                formData.append("date", new Date(date).toISOString().split("T")[0]);
                const isLogin = @json(Auth::check());

                if (!isLogin) {
                    Swal.fire({
                        icon: "warning",
                        title: 'Login Required',
                        text: 'You must login first before proceeding',
                        confirmButtonText: 'Login',
                        showCancelButton: true,
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/login";
                        }
                    });
                    return;
                }

                $.ajax({
                    type: "POST",
                    url: "/salon/service/booking",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Loading',
                            text: 'Please wait...',
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Booking Success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = response.redirect_url;
                            }
                        });
                    },

                    error: function(xhr) {
                        let errorMessage = "Something went wrong!";

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        Swal.fire({
                            icon: "error",
                            title: "Booking Failed",
                            text: errorMessage,
                        });
                    }
                });
            });
        });
    </script>
@endsection
