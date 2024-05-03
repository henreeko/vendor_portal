<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Philcoastal — Vendor Management Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif; /* Unified font style */
        }
        .hero-background {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('logo/land-bg.jpg') }}');
            background-attachment: fixed; background-size: cover; background-position: center;
        }
    </style>
</head>
<body class="hero-background">
    <nav class="bg-gray-900 bg-opacity-75 text-white p-4 fixed top-0 left-0 w-full z-10">
        <div class="max-w-6xl mx-auto flex justify-between items-center">
            <div>
            <img src="{{ asset('logo/logo-1.png') }}" alt="Logo" class="h-12 mr-2">
            </div>
            <div>
                <a href="{{ route('login') }}" class="auth-link">Sign In</a>
                <a href="{{ route('register') }}" class="auth-link ml-4" style="color: gray-900;">Sign Up</a>
            </div>
        </div>
    </nav>

    <div class="flex items-center justify-center pt-32 pb-12 min-h-screen">
        <div class="text-center text-white px-4">
            <h1 class="text-3xl font-bold mb-4">Welcome to the Vendor Management Portal</h1>
            <p>Streamline your interactions and enhance your business operations with us.</p>
            <div class="center mt-10">
                <a href="https://www.philcoastal.com/who-we-are/" target="_blank" rel="noopener noreferrer" class="hover:bg-white hover:text-gray-900 hover:-translate-y-1 transition-all duration-500 bg-gray-900 text-white px-4 py-2 font-bold mb-2">About Us</a>
            </div>
        </div>
    </div>
    

    
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} Philippine Coastal Storage & Pipeline Corporation Vendor Management Portal. All rights reserved.</p>
    </footer>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <!-- Modal for Registration Success -->
    @if(session('registration_success'))
    <div class="modal-overlay fixed inset-0 flex items-center justify-center z-50">
        <!-- Modal content -->
        <div class="modal-container bg-white w-3/4 md:w-1/2 lg:w-1/3 p-8 rounded-lg shadow-lg relative">
            <!-- Modal close button -->
            <button class="absolute top-0 right-0 mt-4 mr-4" onclick="closeModal()">
                <svg class="w-[21px] h-[21px] text-gray-800 dark:text-white hover:gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                  </svg>                  
            </button>
            <h3 class="text-2xl font-semibold mb-4" style="font-family: 'Inter', sans-serif;">Thank You for Registering!</h3>
            <hr class="mb-3">
            <p style="font-family: 'Inter', sans-serif;"> Your account is currently pending approval. You will receive an email once your account and requirements have been reviewed and approved. </p> <br>
            <p style="font-family: 'Inter', sans-serif;"> This process may take some time, so we appreciate your patience.</p>
            <hr class="mt-3">
            <button style="font-family: 'Inter', sans-serif;" class="mt-6 bg-gray-700 text-sm text-white px-6 py-3 rounded font-semibold transition duration-300 ease-in-out shadow-md hover:shadow-lg hover:bg-gray-800" onclick="closeModal()" style="font-family: 'Inter', sans-serif;">Got It</button>
        </div>
    </div>
    @endif

    <!-- Script for Modal -->
    <script>
        function closeModal() {
            document.querySelector('.modal-overlay').classList.add('hidden');
        }
    </script>
    
</body>
<style>
    .auth-link {
        background: transparent;
        color: white;
        padding: 4px 16px;
        transition: all 0.3s ease-in-out;
        position: relative;
        display: inline-block;
        text-decoration: none;
    }
    .auth-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 3px; /* Thickness of the underline */
        background-color: red; /* Color of the underline */
        bottom: 0;
        left: 50%;
        transition: all 0.3s ease-in-out;
    }
    .auth-link:hover::after {
        width: 100%;
        left: 0;
    }
    .auth-link:hover {
        background-color: ;
        color: gray-900;
    }
</style>
</html>

