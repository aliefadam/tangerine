@extends('layouts.auth')

@section('content')
    <div class="min-h-screen bg-gray-100 flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl w-full h-[85vh] flex flex-col lg:flex-row shadow-xl rounded-2xl overflow-hidden bg-white">
            <div class="lg:w-1/2 relative hidden lg:block">
                <img src="/imgs/room/auth.jpg" alt="Fitness Motivation" class="w-full h-full object-cover" />
                <div class="absolute inset-0 bg-black/60"></div>
                <div class="absolute top-0 left-0 text-white flex flex-col justify-center items-center w-full h-full">
                    <h2 class="text-3xl font-bold">Tangerine</h2>
                    <p class="text-lg opacity-90">Join the best fitness community</p>
                </div>
            </div>

            <div class="lg:w-1/2 p-8 sm:p-12 flex flex-col justify-center">
                <div class="max-w-md w-full mx-auto">
                    <h2 class="text-2xl poppins-bold text-stone-700 text-center mb-8">Register Your Account</h2>

                    <form class="space-y-5" action="{{ route('register.post') }}" method="POST">
                        @csrf
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
                                Full Name
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <i class="fa-solid fa-user text-gray-500"></i>
                                </div>
                                <input type="text" id="name" name="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full ps-10 p-2.5 placeholder:text-gray-500"
                                    required placeholder="Enter your name">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">
                                Email
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <i class="fa-solid fa-envelope text-gray-500"></i>
                                </div>
                                <input type="email" id="email" name="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full ps-10 p-2.5 placeholder:text-gray-500"
                                    required placeholder="Enter your email">
                            </div>
                        </div>

                        <div>
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">
                                Phone
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <i class="fa-solid fa-phone text-gray-500"></i>
                                </div>
                                <input type="phone" id="phone" name="phone"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full ps-10 p-2.5 placeholder:text-gray-500"
                                    required placeholder="Enter your phone">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">
                                Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <i class="fa-solid fa-lock text-gray-500"></i>
                                </div>
                                <input type="password" id="password" name="password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full ps-10 p-2.5 placeholder:text-gray-500"
                                    required placeholder="**********">
                            </div>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900">
                                Password Confirmation
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <i class="fa-solid fa-lock text-gray-500"></i>
                                </div>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full ps-10 p-2.5 placeholder:text-gray-500"
                                    required placeholder="**********">
                            </div>
                        </div>

                        <button type="submit"
                            class="text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full">
                            Register
                        </button>
                    </form>

                    <p class="mt-8 text-center text-sm text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}"
                            class="font-medium text-stone-700 hover:text-stone-800 transition-colors">
                            Login now
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
