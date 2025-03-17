@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => $title,
        ])
    </div>

    <div class="mt-5">

        <div class="container mx-auto">
            @foreach ($years as $year)
                <div class="mb-10">
                    <h2 class="text-3xl font-bold mb-6">{{ $year }}</h2>
                    @foreach ($calendarData[$year] as $month => $data)
                        <div class="mb-8 p-5 border rounded-lg shadow-md bg-white">
                            <h3 class="text-xl font-semibold text-center mb-2">{{ $month }} {{ $year }}</h3>
                            <div class="grid grid-cols-7 text-center poppinsmedium bg-stone-700 text-white py-2 mt-3">
                                <div>Minggu</div>
                                <div>Senin</div>
                                <div>Selasa</div>
                                <div>Rabu</div>
                                <div>Kamis</div>
                                <div>Jumat</div>
                                <div>Sabtu</div>
                            </div>
                            <div class="grid grid-cols-7 gap-2 mt-2 text-center">
                                @php
                                    $carbonMonth = \Carbon\Carbon::parse("1 $month $year");
                                    $monthNumber = $carbonMonth->format('m');
                                @endphp

                                @for ($i = 0; $i < $data['startDay']; $i++)
                                    <div class="text-stone-700 poppins-semibold flex justify-center items-center">-</div>
                                @endfor

                                @foreach ($data['days'] as $day)
                                    @php
                                        $date = str_pad($day, 2, '0', STR_PAD_LEFT);
                                        $today = now()->format('Y-m-d');
                                        $dateFormated = "$year-$monthNumber-$date";
                                    @endphp
                                    <a href="{{ route('admin.schedule.show', $dateFormated) }}"
                                        class="px-2 py-5 border border-stone-700 {{ $today == $dateFormated ? 'bg-stone-700 text-white hover:bg-stone-800' : 'bg-white text-stone-700 hover:bg-stone-100' }} rounded">
                                        {{ $day }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(".btn-delete").click(deleteTrainer);

        function deleteTrainer() {
            const roomID = $(this).data("room-id");

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `{{ route('admin.schedule.destroy', ':id') }}`.replace(':id', roomID),
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            location.reload();
                        },
                    });
                }
            });
        }
    </script>
@endsection
