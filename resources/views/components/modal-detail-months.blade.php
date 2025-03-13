<div class="flex justify-center items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50"
    role="alert">
    <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
        viewBox="0 0 20 20">
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
                <div class="grid grid-cols-7 text-sm text-center poppinsmedium bg-stone-700 text-white py-2.5 mt-3">
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
                            $canSelect = $dateFormated > now()->addHours(12)->format('Y-m-d');
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
