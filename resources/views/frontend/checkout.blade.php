@extends('layouts.user')

@section('content')
    <form action="" id="form-checkout">
        @csrf
        <div class="px-5 lg:px-20 py-5 lg:py-10 min-h-screen">
            <div class="w-full lg:w-1/2 mx-auto">
                <div class="flex justify-center items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-400 dark:border-yellow-800"
                    role="alert">
                    <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">Warning!</span>
                        this is the last page to become a member, make sure everything is correct
                    </div>
                </div>
                <div class="mt-10">
                    <h1 class="text-center text-2xl text-stone-700 poppins-semibold">{{ $data['course_label_taken'] }}</h1>
                    <p class="text-center text-xl mt-1 poppins-medium text-stone-600">{{ format_rupiah($data['total']) }}
                    </p>
                </div>
                <div class="mt-10">
                    <h1 class="text-center text-xl text-stone-700 poppins-semibold">Choose your room</h1>
                    <ul class="grid w-full gap-10 md:grid-cols-2 mt-5">
                        @foreach ($rooms as $index => $room)
                            <li>
                                <input type="radio" id="hosting-small-{{ $index }}" name="room_id"
                                    value="{{ $room->id }}" class="hidden peer" />
                                <label for="hosting-small-{{ $index }}"
                                    class="inline-flex flex-col items-center justify-between w-full text-gray-500 bg-white border border-gray-200 rounded-lg overflow-hidden cursor-pointer peer-checked:border-2 peer-checked:border-stone-600 dark:peer-checked:border-stone-600 peer-checked:text-stone-600 hover:text-gray-600 hover:bg-gray-100">
                                    <img src="/uploads/rooms/{{ $room->image }}" class="h-[300px] w-full object-cover">
                                    <div class="p-3">
                                        <h1 class="text-center text-stone-700 poppins-medium">{{ $room->name }}</h1>
                                        <h1 class="text-center">{{ $room->used_for }}</h1>
                                    </div>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @if ($data['course_detail_name'] == 'Private Class')
                    <div class="mt-10">
                        <h1 class="text-center text-xl text-stone-700 poppins-semibold">Choose your trainer</h1>
                        <ul class="grid w-full gap-10 md:grid-cols-2 mt-5">
                            @foreach ($trainers as $index => $trainer)
                                <li>
                                    <input type="radio" id="trainer-{{ $index }}" name="trainer_id"
                                        value="{{ $trainer->id }}" class="hidden peer" />
                                    <label for="trainer-{{ $index }}"
                                        class="inline-flex flex-col items-center justify-between w-full text-gray-500 bg-white border border-gray-200 rounded-lg overflow-hidden cursor-pointer peer-checked:border-2 peer-checked:border-stone-600 dark:peer-checked:border-stone-600 peer-checked:text-stone-600 hover:text-gray-600 hover:bg-gray-100">
                                        <img src="/uploads/trainers/{{ $trainer->image }}"
                                            class="h-[300px] w-full object-cover">
                                        <div class="p-3">
                                            <h1 class="text-center text-stone-700 poppins-medium">{{ $trainer->name }}</h1>
                                            <h1 class="text-center text-sm mt-1">{{ $trainer->description }}</h1>
                                        </div>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mt-10">
                    <h1 class="text-center text-xl text-stone-700 poppins-semibold">Choose a routine schedule</h1>
                    <div class="grid grid-cols-2 gap-5 mt-10">
                        <div class="">
                            <label for="day"
                                class="text-center block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Day
                            </label>
                            <select id="day" name="day"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5">
                                <option value="">-- Select --</option>
                                <option value="Sunday">Sunday</option>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                            </select>
                        </div>
                        <div class="">
                            <label for="time"
                                class="text-center block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Time
                            </label>
                            <select id="time" name="time"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5">
                                <option value="">-- Select --</option>
                                <option value="06.00">06.00 - 07.00</option>
                                <option value="07.00">07.00 - 08.00</option>
                                <option value="08.00">08.00 - 09.00</option>
                                <option value="09.00">09.00 - 10.00</option>
                                <option value="10.00">10.00 - 11.00</option>
                                <option value="11.00">11.00 - 12.00</option>
                                <option value="12.00">12.00 - 13.00</option>
                                <option value="13.00">13.00 - 14.00</option>
                                <option value="14.00">14.00 - 15.00</option>
                                <option value="15.00">15.00 - 16.00</option>
                                <option value="16.00">16.00 - 17.00</option>
                                <option value="17.00">17.00 - 18.00</option>
                                <option value="18.00">18.00 - 19.00</option>
                                <option value="19.00">19.00 - 20.00</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-10">
                    <button type="submit"
                        class="w-full text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-3">
                        <i class="fa-solid fa-credit-card mr-1.5"></i>
                        Go Payment
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $("#form-checkout").submit(checkout);

        function checkout(e) {
            e.preventDefault();
            const data = $(this).serialize();
            let daySelected = $("select[name=day]").val();
            let timeSelected = $("select[name=time]").val();

            if ($("input[name=room_id]:checked").length == 0) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Please select the room"
                });
                return;
            } else if ($("input[name=trainer_id]").length != 0) {
                if ($("input[name=trainer_id]:checked").length == 0) {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Please select the trainer"
                    });
                    return;
                }
            } else if (!daySelected) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Please select day"
                });
                return;
            } else if (!timeSelected) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Please select time"
                });
                return;
            }

            const isLogin = @json(Auth::check());
            if (!isLogin) {
                Swal.fire({
                    icon: "warning",
                    title: 'Login Required',
                    text: 'You must login first before become a membership',
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
                url: "/membership/checkout",
                data: data,
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
                    location.href = response.redirect_url;
                }
            });
        }
    </script>
@endsection
