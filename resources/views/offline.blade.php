<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anda Sedang Offline - Eventama</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-blue-50 flex items-center justify-center min-h-screen p-4 text-center">
    <div class="bg-white p-8 rounded-3xl shadow-xl max-w-md w-full border border-blue-100">
        <div class="mb-6 flex justify-center">
            <svg class="w-24 h-24 text-blue-400 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18"></path>
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Ups, Anda Sedang Offline</h1>
        <p class="text-gray-500 mb-8">Sepertinya Anda kehilangan koneksi internet. Silakan periksa koneksi Anda dan coba lagi.</p>
        <button onclick="window.location.reload()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-full w-full transition duration-300 shadow-md shadow-blue-500/30">
            Coba Lagi
        </button>
    </div>
</body>
</html>
