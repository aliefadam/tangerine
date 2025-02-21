@extends('layouts.auth')

@section('content')
    <form action="{{ route('verification.send') }}" method="POST">
        @csrf
        <div class="w-full h-screen flex justify-center items-center">
            <div class="bg-white shadow-md rounded-md px-20 py-10 w-1/2 text-center">
                <h1 class="text-2xl poppins-semibold text-stone-700">Anda belum memverifikasi email</h1>
                <p class="mt-2 text-base">
                    Sebelum memulai, silahkan memverifikasi alamat email Anda
                    dengan mengklik tautan yang baru saja kami kirimkan ke email Anda?
                </p>

                <div class="mt-7 flex flex-col items-center gap-3">
                    <p class="text-base text-gray-700">Jika anda tidak menerima verifikasi email, silahkan klik tombol
                        berikut
                    </p>
                    <button type="submit"
                        class="block w-1/2 text-white bg-stone-700 hover:bg-stone-800 focus:ring-4 focus:ring-stone-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Kirim Ulang Verifikasi
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
