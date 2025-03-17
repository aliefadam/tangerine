@extends('layouts.user')

@section('content')
    {{-- Hero --}}
    <div class="h-[550px] relative">
        <img src="/uploads/courses/{{ $course->image }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-stone-800/60 bg-opacity-60"></div>
        <div
            class="absolute lg:ps-5 top-0 left-0 right-0 text-white flex flex-col justify-center items-center w-full h-full">
            <h2 class="text-4xl lg:text-5xl poppins-bold text-center">{{ $course->name }}</h2>
            <p class="text-base lg:text-lg text-white text-center w-[90%] lg:w-[70%]">
                {{ $course->description }}
            </p>
        </div>
    </div>
    {{-- EndHero --}}

    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        {{-- <div class="px-5 md:px-10 py-5 lg:py-20 min-h-screen border border-black"> --}}
        <h1 class="text-3xl text-center text-stone-700 poppins-bold">Pricelist</h1>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-5 mt-10">
            @foreach ($course->courseDetails as $detail)
                <div class="bg-stone-50 rounded-md shadow-md p-5">
                    <h1 class="text-center poppins-medium text-base text-stone-700">{{ $detail->name }}</h1>
                    <div class="mt-5 space-y-2">
                        <div class="flex justify-between text-sm text-stone-600">
                            <span>Drop In</span>
                            @if ($detail->drop_in_price)
                                <span>{{ format_rupiah($detail->drop_in_price) }}</span>
                            @else
                                <span class="text-gray-400">Not Available</span>
                            @endif
                        </div>
                        <div class="flex justify-between text-sm text-stone-600">
                            <span>10 Session</span>
                            @if ($detail['10_session_price'])
                                <span>{{ format_rupiah($detail['10_session_price']) }}</span>
                            @else
                                <span class="text-gray-400">Not Available</span>
                            @endif
                        </div>
                        <div class="flex justify-between text-sm text-stone-600">
                            <span>20 Session</span>
                            @if ($detail['20_session_price'])
                                <span>{{ format_rupiah($detail['20_session_price']) }}</span>
                            @else
                                <span class="text-gray-400">Not Available</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-0 lg:gap-5">
            <div class="flex border border-gray-800 justify-center items-center p-4 mb-4 text-sm text-gray-800 rounded-lg bg-gray-50"
                role="alert">
                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Expirated Date 10 Session is 4 Month</span>
                </div>
            </div>
            <div class="flex border border-gray-800 justify-center items-center p-4 mb-4 text-sm text-gray-800 rounded-lg bg-gray-50"
                role="alert">
                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Expirated Date 20 Session is 6 Month</span>
                </div>
            </div>
        </div>
        <div class="mt-16 lg:mt-20">
            <h1 class="text-3xl text-center text-stone-700 poppins-bold">Become a Membership</h1>
            <form method="POST" id="form-membership" action=""
                class="mt-10 sm:w-full lg:w-1/2 mx-auto space-y-5 pb-20">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <div class="">
                    <label for="plan" class="text-center block mb-3 text-sm font-medium text-gray-900 ">
                        Choose your plan
                    </label>
                    <select id="plan" name="plan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5">
                        <option value="" selected>-- Choose --</option>
                        @foreach ($course->courseDetails as $detail)
                            @foreach ($detail->getAttributes() as $column => $value)
                                @if (!in_array($column, ['id', 'course_id', 'name', 'person_max', 'created_at', 'updated_at']))
                                    @php
                                        $col = Str::replace('Price', '', Str::headline(str_replace('_', ' ', $column)));
                                    @endphp
                                    @if ($value)
                                        <option data-type="{{ $detail->name }}"
                                            value="{{ $detail->id }}#{{ $column }}">
                                            {{-- value="{{ $course->name }}#{{ $detail->name }}#{{ $col }}#{{ $value }}"> --}}
                                            {{ $detail->name }} - {{ $col }} •
                                            {{ format_rupiah($value) }}
                                        </option>
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                </div>
                {{-- <div class="hidden" id="container-trainer">
                    <label for="trainer" class="text-center block mb-3 text-sm font-medium text-gray-900 ">
                        Choose your trainer
                    </label>
                    <select id="trainer" name="trainer"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full p-2.5">
                        <option selected>-- Choose --</option>
                        @foreach ($trainers as $trainer)
                            <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="">
                    <button type="submit"
                        class="cursor-pointer w-full text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Continue
                    </button>
                    {{-- <button type="submit"
                        class="w-full text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        <i class="fa-solid fa-credit-card mr-1.5"></i>
                        Go Payment
                    </button> --}}
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $("#form-membership").submit(submitMembership);

        function submitMembership(e) {
            e.preventDefault();

            const data = $(this).serialize();
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

            const plan = $("select[name=plan]").val();
            if (!plan) {
                Swal.fire({
                    icon: "error",
                    title: 'Plan Required',
                    text: 'You must select a plan first'
                });
                return;
            }

            $.ajax({
                type: "POST",
                url: "/wellness/membership",
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
                    location.href = response.redirect_url;
                }
            });
        }
    </script>
@endsection
