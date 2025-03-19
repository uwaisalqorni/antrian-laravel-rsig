<div class="flex flex-col flex-grow p-4 bg-gray-100" wire:poll.5000ms="$refresh">
    <div class="grid grid-cols-2 gap-6 justify-center">
        @foreach($lokets as $loket)
        <div class="p-6 rounded-lg shadow-lg bg-white text-center border border-gray-300">
            <div class="mb-4">
                <h2 class="text-2xl font-bold text-gray-800">{{ $loket->name }}</h2>
                <p class="text-lg text-gray-500">{{ $loket->poli->name }}</p>
            </div>

            <!-- Nomor Antrian -->
            <div class="my-4">
                @if($loket->activeQueue)
                    <div class="text-5xl font-extrabold text-blue-600">
                        {{ $loket->activeQueue->number }}
                    </div>
                    <div class="text-lg font-semibold mt-2 bg-blue-100 text-blue-600 px-4 py-1 rounded-lg inline-block">
                        {{ $loket->activeQueue->farmasi_label }}
                    </div>
                @else
                    <div class="text-5xl font-bold text-gray-400">---</div>
                    <div class="text-lg text-gray-500 mt-2">Tidak ada antrian</div>
                @endif
            </div>

            <!-- Status Loket -->
            <div class="mt-4">
                @if(!$loket->is_active)
                    <p class="text-md font-medium bg-red-500 text-white px-3 py-1 rounded-full inline-block">
                        Loket Tidak Aktif
                    </p>
                @elseif($loket->is_available)
                    <p class="text-md font-medium bg-green-500 text-white px-3 py-1 rounded-full inline-block">
                        Siap Melayani
                    </p>
                @else
                    <p class="text-md font-medium bg-yellow-500 text-white px-3 py-1 rounded-full inline-block">
                        Sedang Melayani
                    </p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
