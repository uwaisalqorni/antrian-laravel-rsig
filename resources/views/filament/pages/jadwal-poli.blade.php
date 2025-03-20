<!-- Tambahkan Animate.css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="flex flex-col flex-grow w-full">
    <div class="container mx-auto p-6">
        <div id="jadwal-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($jadwals as $index => $jadwal)
                <div class="jadwal-card flex items-center bg-green-700 text-white p-4 rounded-lg shadow-md w-full animate__animated animate__zoomIn">
                    <img src="{{ asset('storage/' . $jadwal->foto) }}" alt="{{ $jadwal->name }}" class="w-20 h-20 rounded-xl border-2 border-white mr-4">
                    <div>
                        <h3 class="text-lg font-bold">{{ strtoupper($jadwal->name) }}</h3>
                        <p class="text-sm">dr. {{ $jadwal->doctor_name }}</p>
                        <p class="text-sm font-semibold">{{ $jadwal->start_time }} s/d {{ $jadwal->end_time }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function animateCards() {
        let cards = document.querySelectorAll('.jadwal-card');

        cards.forEach((card, index) => {
            setTimeout(() => {
                // Hapus kelas animasi
                card.classList.remove('animate__zoomIn');

                // Tunggu sedikit sebelum menambahkan kembali agar animasi bisa diulang
                setTimeout(() => {
                    card.classList.add('animate__zoomIn');
                }, 500);
            }, index * 1000); // Animasi berjalan satu per satu
        });
    }

    // Jalankan animasi pertama kali
    animateCards();

    // Looping animasi setiap 5 detik
    setInterval(animateCards, 5000);
</script>
