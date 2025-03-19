<div class="flex flex-col flex-grow">
    <div class="flex flex-col items-center p-6">
        <div class="grid grid-cols-2 gap-6">
            @foreach($jadwals as $jadwal)
                <div class="flex items-center bg-green-700 text-white p-4 rounded-lg shadow-md w-96">
                    <img src="{{ asset('storage/' . $jadwal->foto) }}" alt="{{ $jadwal->name }}" class="w-20 h-20 rounded-full border-2 border-white mr-4">
                    <div>
                        <h3 class="text-lg font-bold">{{ strtoupper($jadwal->name) }}</h3>
                        <p class="text-sm">dr. {{ $jadwal->doctor_name }}</p>
                        <p class="text-sm font-semibold">{{ $jadwal->start_time }} s/d {{ $jadwal->end_time }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
<div>

