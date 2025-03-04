@extends('layouts.auth')

@section('content')
    <form action="{{ route('verification.send') }}" method="POST">
        @csrf
        <div class="w-full h-screen flex justify-center items-center">
            <div class="bg-white shadow-md rounded-md px-20 py-10 w-1/2 text-center">
                <h1 class="text-2xl poppins-semibold text-stone-700">Please verify your email</h1>
                <p class="mt-2 text-base">
                    Before you start, please verify your email address by clicking on the link we just sent you via email
                </p>

                <div class="mt-7 flex flex-col items-center gap-3">
                    <p class="text-base text-gray-700">If you didn't receive the verification email, please click the
                        following button
                    </p>
                    <button type="submit"
                        class="block w-1/2 text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Resend Verification
                    </button>
                </div>
            </div>
        </div>
        <div class="absolute w-full flex justify-center items-center left-0 right-0 bottom-10">
            <a href="{{ route('logout') }}" class="">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                Logout
            </a>
        </div>
    </form>
@endsection
