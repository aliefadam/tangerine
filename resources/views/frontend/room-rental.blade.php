@extends('layouts.user')

@section('content')
    <div class="px-4 sm:px-6 lg:px-8 py-14 bg-white w-[90%] mx-auto min-h-[70vh]">
        <div class="flex justify-center">
            <div class="bg-white shadow-md rounded-md p-10 w-full lg:w-1/2">
                <h1 class="text-2xl text-stone-700 text-center poppins-semibold">Rent a room</h1>
                <form action="" class="w-full mt-5">
                    <div class="mt-10 mb-5">
                        <label for="" class="block text-sm font-medium text-gray-900 ">
                            Select Room
                        </label>
                        <ul class="grid w-full gap-10 grid-cols-1 md:grid-cols-2 mt-3">
                            @foreach ($rooms as $index => $room)
                                <li>
                                    <input type="radio" id="hosting-small-{{ $index }}" name="room_id"
                                        value="{{ $room->id }}" class="hidden peer" />
                                    <label for="hosting-small-{{ $index }}"
                                        class="inline-flex flex-col items-center justify-between w-full text-gray-500 bg-white border border-gray-200 rounded-lg overflow-hidden cursor-pointer peer-checked:border-2 peer-checked:border-stone-600 peer-checked:text-stone-600 hover:text-gray-600 hover:bg-gray-100">
                                        <img src="/uploads/rooms/{{ $room->image }}" class="h-[250px] w-full object-cover">
                                        <div class="p-3">
                                            <h1 class="text-center text-stone-700 poppins-medium">{{ $room->name }}</h1>
                                            <h1 class="text-center text-sm">{{ format_rupiah($room->rent_price) }} /hour
                                            </h1>
                                        </div>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mb-5">
                        <label for="participant" class="block mb-3 text-sm font-medium text-gray-900 ">
                            Number of participants
                        </label>
                        <input type="number" id="participant" name="participant"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5" />
                    </div>
                    <div class="mb-5">
                        <label for="used_for" class="block mb-3 text-sm font-medium text-gray-900 ">
                            Used for
                        </label>
                        <input type="text" id="used_for" name="used_for"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5" />
                    </div>
                    <div class="flex justify-center">
                        <button type="button" data-modal-target="large-modal" data-modal-toggle="large-modal"
                            class="bg-white border border-stone-700 text-stone-700 hover:bg-stone-50 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-xs px-5 py-2.5">
                            Choose Schedule
                        </button>
                    </div>
                    <div id="detail-rent" class="hidden">
                        <div class="flex flex-col items-center mt-5 poppins-medium">
                            <h1 class="text-lg" id="selected-date">Sunday, 10 Nov 2025</h1>
                            {{-- <div class="flex flex-col items-center gap-2 mt-3 text-base" id="selected-time"></div> --}}
                        </div>
                        <div class="mt-10 border-t border-dashed border-stone-700 pt-5 text-sm flex flex-col gap-2">
                            <div class="flex justify-between">
                                <span>Sub Total</span>
                                <span id="sub-total">3 Hours x Rp. 100,000</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Total</span>
                                <span id="total">Rp. 300,000</span>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="btn-store-transaction"
                        class="mt-10 cursor-pointer w-full text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-3">
                        <i class="fa-solid fa-credit-card mr-1.5"></i>
                        Go Payment
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Select Schedule Modal --}}
    <div id="large-modal" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-4xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <div class="flex items-center gap-3" id="modal-title">
                        <h3 class="text-lg font-medium text-gray-900">
                            Select Schedule
                        </h3>
                    </div>
                    <button type="button" id="btn-close-modal"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="large-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 h-[500px] overflow-y-auto scrollbar" id="modal-body">
                    <div class="flex justify-center items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50"
                        role="alert">
                        <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">Please select date first!</span>
                        </div>
                    </div>
                    @foreach ($years as $year)
                        <div class="mb-10">
                            @foreach ($calendarData[$year] as $month => $data)
                                <div class="mb-8 p-5 border rounded-lg shadow-md bg-white">
                                    <h3 class="text-xl font-semibold text-center mb-2">{{ $month }}
                                        {{ $year }}</h3>
                                    <div
                                        class="grid grid-cols-7 text-xs lg:text-sm text-center poppinsmedium bg-stone-700 text-white py-2.5 mt-3">
                                        <div>Sunday</div>
                                        <div>Monday</div>
                                        <div>Tuesday</div>
                                        <div>Wednesday</div>
                                        <div>Thursday</div>
                                        <div>Friday</div>
                                        <div>Saturday</div>
                                    </div>
                                    <div class="grid grid-cols-7 gap-2 mt-2 text-center">
                                        @php
                                            $carbonMonth = \Carbon\Carbon::parse("1 $month $year");
                                            $monthNumber = $carbonMonth->format('m');
                                        @endphp

                                        @for ($i = 0; $i < $data['startDay']; $i++)
                                            <div class="text-stone-700 poppins-semibold flex justify-center items-center">-
                                            </div>
                                        @endfor

                                        @foreach ($data['days'] as $day)
                                            @php
                                                $date = str_pad($day, 2, '0', STR_PAD_LEFT);
                                                $today = now()->format('Y-m-d');
                                                $dateFormated = "$year-$monthNumber-$date";
                                                $canSelect = $dateFormated > now()->addDay()->format('Y-m-d');
                                            @endphp
                                            <button data-date="{{ $dateFormated }}"
                                                class="px-2 py-2 lg:py-5 border border-stone-700 {{ $canSelect ? 'bg-white hover:bg-stone-100 text-stone-700 btn-date cursor-pointer' : 'bg-gray-300 cursor-not-allowed' }} rounded">
                                                {{ $day }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <!-- Modal footer -->
                <div class="flex hidden justify-center items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600"
                    id="modal-footer">
                    <button type="button" id="btn-accept-schedule"
                        class="text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center">
                        Accept
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(".btn-date").click(selectDate);
        $("#btn-back").click(backToSelectDate);
        $(".btn-choose-schedule").click(chooseSchedule);
        $("#btn-accept-schedule").click(acceptSchedule);
        $("#btn-store-transaction").click(storeTransaction);

        let dateSelected = null;
        let timeSelected = null;
        let priceRoom = null;
        let totalTransaction = null;
        let countHour = null;

        function storeTransaction() {
            const roomID = $("input[name=room_id]:checked").val();
            const participant = $("input[name=participant]").val();
            const used_for = $("input[name=used_for]").val();
            const hour = countHour;
            const date = dateSelected;
            const time = timeSelected;

            if (!roomID) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Please select the room"
                });
                return;
            }

            if (!participant) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Please fill the number of participant"
                });
                return;
            }

            if (!used_for) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Please fill the used for"
                });
                return;
            }

            if (!hour || !date || !time) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Please select the schedule"
                });
                return;
            }

            $.ajax({
                type: "POST",
                url: "/rent-transaction",
                data: {
                    _token: "{{ csrf_token() }}",
                    roomID: roomID,
                    participant: participant,
                    used_for: used_for,
                    hour: hour,
                    date: date,
                    time: time
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
                    // console.log(response);
                    window.location.href = response.redirect_url;
                }
            });
        }

        function acceptSchedule() {
            const date = $(".time-selected").data("schedule-label-date");
            const timeSelectedValidation = $(".time-selected").map(function() {
                return $(this).data('time');
            }).get().map((time) => +time.replace(":00", "")).sort((a, b) => a - b);

            timeSelected = $(".time-selected").map(function() {
                return $(this).data('time');
            }).get();


            if (timeSelectedValidation.length > 1) {
                const isConsecutive = timeSelectedValidation.every((val, index, arr) => {
                    if (index === 0) {
                        return true;
                    }
                    return Math.abs(val - arr[index - 1]) === 1;
                });

                if (!isConsecutive) {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Time must be consecutive"
                    });
                    return;
                }
            }
            $("#btn-close-modal").click();


            const labelDateTimeSelected = `${date} • ${timeSelected[0]} - ${timeSelected[timeSelected.length - 1]}`;
            $("#selected-date").html(labelDateTimeSelected);
            $("#detail-rent").removeClass("hidden");

            const roomID = $("input[name=room_id]:checked").val();
            countHour = timeSelected.length - 1;
            $.ajax({
                type: "GET",
                url: `/get-price-rent-room/${countHour}/${roomID}`,
                beforeSend: function() {
                    $("#sub-total").html(`Loading...`);
                    $("#total").html(`Loading...`);
                },
                success: function(response) {
                    priceRoom = response.price;
                    totalTransaction = response.total;
                    $("#sub-total").html(`${countHour} Hours x ${priceRoom}`);
                    $("#total").html(totalTransaction);
                }
            });

        }

        function chooseSchedule() {
            const time = $(this).data('time');
            if ($(this).hasClass("border-stone-700 bg-stone-50")) {
                $(this).removeClass("border-stone-700 bg-stone-50 time-selected").addClass("bg-white");
            } else {
                $(this).addClass("border-stone-700 bg-stone-50 time-selected").removeClass("bg-white");
            }
        }

        function selectDate() {
            const date = $(this).data('date');
            dateSelected = date;

            if ($("input[name=room_id]").length != 0) {
                if ($("input[name=room_id]:checked").length == 0) {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Please select the room first"
                    });
                    return;
                }
            }

            $.ajax({
                type: "GET",
                url: `/get-schedule-day-rent-room/${date}`,
                data: {
                    roomID: $("input[name=room_id]:checked").val(),
                },
                beforeSend: function() {
                    $("#modal-body").addClass("h-[500px]").html(`
                        <div class="flex justify-center items-center h-full py-5">
                            <div role="status">
                                <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin  fill-stone-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    `);
                },
                success: function(response) {
                    const detailDaysHTML = response.detailDaysHTML;
                    $("#modal-body").html(detailDaysHTML);
                    $("#modal-title").html(`
                        <button type="button" id="btn-back"
                            class="cursor-pointer bg-white border border-stone-700 text-stone-700 hover:bg-stone-50 focus:ring-4 focus:ring-stone-300 font-medium rounded-md text-sm px-3.5 py-1.5">
                            <i class="fa-solid fa-caret-left"></i>
                        </button>
                        <h3 class="text-lg font-medium text-gray-900">
                            Select Schedule
                        </h3>
                    `);
                    $("#btn-back").click(backToSelectDate);
                    $(".btn-choose-schedule").click(chooseSchedule);
                    $("#modal-footer").removeClass("hidden");
                }
            });
        }

        function backToSelectDate() {
            $.ajax({
                type: "GET",
                url: `/get-schedule-month`,
                beforeSend: function() {
                    $("#modal-body").addClass("h-[500px]").html(`
                    <div class="flex justify-center items-center h-full py-5">
                        <div role="status">
                            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin  fill-stone-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    `);
                },
                success: function(response) {
                    const detailMonthHTML = response.detailMonthHTML;
                    $("#modal-body").html(detailMonthHTML);
                    $("#modal-title").html(`
                    <h3 class="text-lg font-medium text-gray-900">
                        Select Date
                    </h3>
                    `);
                    $("#modal-footer").addClass("hidden");
                    $(".btn-date").click(selectDate);
                }
            });
        }
    </script>
@endsection
