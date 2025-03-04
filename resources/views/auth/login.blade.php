@extends('layouts.auth')

@section('content')
    <div class="h-screen bg-gray-100 flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl w-full h-[80vh] flex flex-col lg:flex-row shadow-xl rounded-2xl overflow-hidden bg-white">
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
                    <h2 class="text-2xl poppins-bold text-stone-700 text-center mb-8">Login to your account</h2>

                    <form class="space-y-6" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">
                                Email
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <i class="fa-solid fa-user text-gray-500"></i>
                                </div>
                                <input type="email" id="email" name="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-stone-500 focus:border-stone-500 block w-full ps-10 p-2.5 placeholder:text-gray-500"
                                    placeholder="Enter your email">
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
                                    placeholder="**********">
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input type="checkbox" id="remember-me" name="remember-me"
                                    class="h-4 w-4 !rounded-button text-custom border-gray-300 focus:ring-custom" />
                                <label for="remember-me" class="ml-2 block text-sm text-gray-700">Remember Me</label>
                            </div>
                            <a href="{{ route('forgot-password') }}"
                                class="text-sm font-medium text-custom hover:text-custom/80 transition-colors">
                                Forgot your password?
                            </a>
                        </div>

                        <button type="submit"
                            class="text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full">
                            Login
                        </button>
                    </form>
                    <div class="mt-8">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">Or sign in with</span>
                            </div>
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('login.google') }}"
                                class="flex items-center justify-center gap-2 w-full py-2.5 px-4 !rounded-button border border-gray-300 bg-white text-sm rounded-md font-medium text-gray-700 hover:bg-gray-50 transition-colors mx-auto">
                                <img class="size-4" src="/imgs/google.png" alt="">
                                Google
                            </a>
                        </div>
                    </div>
                    <p class="mt-8 text-center text-sm text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}"
                            class="font-medium text-stone-700 hover:text-stone-800 transition-colors">
                            Register now
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
