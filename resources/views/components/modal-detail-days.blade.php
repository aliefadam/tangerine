<div class="container mx-auto">
    <div class="flex justify-center items-center p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50"
        role="alert">
        <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-medium">Now choose the time</span>
        </div>
    </div>
    <h2 class="text-xl font-semibold mb-4 text-center mt-5">
        Schedule at {{ $selectedDate->isoFormat('dddd, D MMMM Y') }}
    </h2>
    <div class="grid grid-cols-3 gap-4 mt-5">
        @foreach ($hours as $hour)
            @php
                $isAvailable =
                    isAvailableSchedule($selectedDate, $hour, $capacity, $roomID) ||
                    isNotAvailableTrainer($trainerID, $selectedDate, $hour) ||
                    isRentedRoom($selectedDate, $hour);

                $notAvailableSchedule = isAvailableSchedule($selectedDate, $hour, $capacity, $roomID);
                $notAvailableTrainer = isNotAvailableTrainer($trainerID, $selectedDate, $hour);
                $isRentedRoom = isRentedRoom($selectedDate, $hour);
                $notAvailableLabel = '';
                if ($notAvailableSchedule) {
                    $notAvailableLabel = 'Capacity Full';
                }

                if ($notAvailableTrainer) {
                    $notAvailableLabel = 'Not Available Trainer';
                }

                if ($isRentedRoom) {
                    $notAvailableLabel = 'Rented Room';
                }
            @endphp

            <div class="p-4 border rounded-lg shadow-md {{ !$isAvailable ? 'bg-white cursor-pointer hover:bg-gray-50 btn-choose-schedule' : 'cursor-not-allowed bg-gray-200' }}"
                @if (!$isAvailable) data-schedule-label="{{ $selectedDate->format('l, d F Y') }} - {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00" data-capacity="{{ $capacity }}" data-time="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00"
                    data-date="{{ Carbon\Carbon::parse($selectedDate)->format('Y/m/d') }}" @endif>
                <div class="flex justify-between items-center">
                    <h3 class="text-base font-medium">
                        {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:00
                    </h3>
                </div>
                <div class="mt-2 text-sm">
                    @if (!$isAvailable)
                        <span class="text-emerald-700">
                            <i class="fa-regular fa-circle-check"></i>
                            Available
                        </span>
                    @else
                        <span class="text-red-700">
                            <i class="fa-regular fa-empty-set"></i>
                            {{-- Not Available --}}
                            {{ $notAvailableLabel }}
                        </span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
