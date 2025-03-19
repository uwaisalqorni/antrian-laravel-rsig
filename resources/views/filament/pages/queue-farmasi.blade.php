<div class="flex flex-col flex-grow">

    <div class="flex justify-end gap-2">
        <button id="connect-button" class="bg-blue-500 text-white p-2 rounded">
            Sambungkan Printer
        </button>
    </div>

    <div class="flex flex-col flex-grow justify-center items-center h-full">
        <div class="grid grid-cols-2 gap-4">
            @foreach($polies as $poli)
                <button wire:click="print({{ $poli->id }})" class="bg-red-500 text-white text-2xl font-bold py-16 px-24 shadow-lg">
                    {{ $poli->name }}
                </button>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('livewire:initialized', () => {
    const connectButton = document.getElementById('connect-button');

    connectButton.addEventListener('click', async () => {
        window.connectedPrinter = await getPrinter()
    })

    Livewire.on("print-start", async (text) => {
        await printThermal(text)
    })
})
</script>
@endpush
