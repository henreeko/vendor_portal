<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PCSPC Vendorify</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        body {
            font-family: 'figtree', sans-serif;
        }
    </style>
</head>
<body class="bg-fixed bg-cover bg-center" style="background-image: url('{{ asset('logo/land-bg.jpg') }}')">
    <div class="min-h-screen flex items-center justify-center bg-gray-900 bg-opacity-75">
        <div class="text-center text-white">
            <h1 class="text-6xl font-bold mb-6">Welcome to Vendorify</h1>
            <p class="text-lg mb-8">Streamline vendor registration and procurement. 
                <br>Register requirements directly, eliminate emails, and simplify vendor interactions.</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('login') }}" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 ease-in-out">Sign In</a>
                <a href="{{ route('register') }}" class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 ease-in-out">Sign Up</a>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="absolute bottom-0 w-full bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} Philippine Coastal Storage & Pipeline Corporation Vendorify. All rights reserved.</p>
    </footer>
</body>
</html>
