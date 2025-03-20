<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jadwal Poli RSIG</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    @filamentScripts
    @filamentStyles

</head>
<body class="flex flex-col min-w-screen min-h-screen bg-gray-100">
    <header class="bg-green-600 text-white p-4 text-lg text-center">
        <h1 class="text-white-800 text-3xl font-bold mt-2" style="font-family: 'Edwardian Script ITC', cursive;">
            Jadwal Pelayanan
        </h1>
        <h1 class="text-white-800 text-2xl font-extrabold">
            POLIKLINIK RSIGONDANGLEGI
        </h1>
    </header>
    <main class="p-6 w-full h-full flex flex-grow">
        {{ $slot }}
    </main>

    <footer class="bg-green-700 text-white text-center p-6">
        <!-- Running Text -->
        <div class="overflow-hidden bg-green-600 py-2">
            <div class="whitespace-nowrap animate-marquee">
                <span class="text-lg font-semibold mx-4">⚠️ Jadwal dan jam praktik dokter dapat berubah sewaktu-waktu! ⚠️</span>
                <span class="text-lg font-semibold mx-4">📅 Silakan cek kembali untuk informasi terbaru. 📅</span>
                <span class="text-lg font-semibold mx-4">☎️ Hubungi kami di 0812.3154.3474 untuk info lebih lanjut. ☎️</span>
            </div>
        </div>

        <!-- Informasi Rumah Sakit -->
        <p class="font-semibold italic mt-4">Jadwal dan jam praktik dokter dapat berubah sewaktu-waktu</p>
        <p class="mt-2">Rumah Sakit Islam Gondanglegi - Jl. Hayam Wuruk No. 66 Gondanglegi - Malang</p>

        <!-- Kontak -->
        <div class="flex flex-wrap justify-center items-center space-x-4 mt-4">
            <div class="flex items-center space-x-2">
                <img src="https://img.icons8.com/ios-filled/24/ffffff/phone.png" alt="Phone">
                <span>0812.3154.3474</span>
            </div>
            <div class="flex items-center space-x-2">
                <img src="https://img.icons8.com/ios-filled/24/ffffff/phone.png" alt="Phone">
                <span>(0341).879879</span>
            </div>
            <div class="flex items-center space-x-2">
                <img src="https://img.icons8.com/ios-filled/24/ffffff/instagram.png" alt="Instagram">
                <span>@rsigondanglegi</span>
            </div>
            <div class="flex items-center space-x-2">
                <img src="https://img.icons8.com/ios-filled/24/ffffff/domain.png" alt="Website">
                <span>www.rsigondanglegi.co.id</span>
            </div>
        </div>
    </footer>

    <!-- Tambahkan ini di dalam <head> atau file CSS -->
    <style>
        @keyframes marquee {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(-100%);
            }
        }
        .animate-marquee {
            display: inline-block;
            white-space: nowrap;
            animation: marquee 10s linear infinite;
        }
    </style>

{{-- @stack('scripts')
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
                    }, 100);
                }, index * 1000); // Animasi berjalan satu per satu
            });
        }

        // Jalankan animasi pertama kali
        animateCards();

        // Looping animasi setiap 5 detik
        setInterval(animateCards, 5000);
    </script> --}}


</body>
</html>
