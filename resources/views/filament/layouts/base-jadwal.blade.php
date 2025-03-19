<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jadwal Poli RSIG</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="flex flex-col min-w-screen min-h-screen bg-gray-100">
    <header class="bg-green-600 text-white p-4 text-lg text-center">
        <h1 class="text-white-700 text-3xl font-bold mt-2" style="font-family: 'Edwardian Script ITC', cursive;">
            Jadwal Pelayanan
        </h1>
        <h1 class="text-white-800 text-2xl font-extrabold">
            POLIKLINIK RSIGONDANGLEGI
        </h1>
        {{-- <button id="jadwal-mode-button" class="bg-white text-blue-600 p-2 rounded absolute top-2 right-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
            </svg>
        </button> --}}
    </header>
    <main class="p-6 w-full h-full flex flex-grow">
        {{ $slot }}
    </main>

    {{-- @stack('scripts')
    <script>
        document.getElementById('farmasi-mode-button').addEventListener('click', () => {
           if (!document.fullscreenElement) {
               document.documentElement.requestFullscreen().catch((err) => {
                   console.error(`Error attempting to enable full-screen mode: ${err.message} (${err.name})`);
               });
           } else {
               document.exitFullscreen();
           }
       });
   </script> --}}

</body>
</html>
