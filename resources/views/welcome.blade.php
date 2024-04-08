<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Philcoastal — VMP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'figtree', sans-serif;
        }
        .darken-bg {
            background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
        }
    </style>
</head>
<body style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('logo/land-bg.jpg') }}'); background-attachment: fixed; background-size: cover; background-position: center;" class="bg-fixed bg-cover bg-center" style="background-image: url('{{ asset('logo/land-bg.jpg') }}');">
    <div class="min-h-screen flex flex-col justify-between"> <!-- Removed darken-bg class for demonstration -->
        <!-- Top Navigation Bar with distinct header bar -->
        <nav class="bg-gray-900 bg-opacity-75 text-white p-4 fixed top-0 left-0 w-full z-10">
            <div class="max-w-6xl mx-auto flex justify-between items-center">
                <div class="text-lg font-semibold flex items-center">
                    <img src="{{ asset('logo/logo-1.png') }}" alt="Logo" class="h-8 mr-2"> Vendor Management Portal
                </div>
                <div>
                    <a href="{{ route('login') }}" class="bg-transparent hover:bg-white hover:text-gray-900 text-white px-4 py-2 transition duration-300 ease-in-out">Sign In</a>
                    <a href="{{ route('register') }}" class="ml-4 bg-white hover:bg-gray-100 text-gray-900 px-4 py-2 transition duration-300 ease-in-out">Sign Up</a>
                </div>
            </div>
        </nav>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center pt-20 pb-12">
        <div class="text-center text-white px-4">
            <h1 class="text-6xl font-bold mb-6">Welcome to Vendor Management Portal</h1>
            <p class="text-lg mb-8">Streamline vendor registration and procurement.<br></p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4">
        <p>&copy; {{ date('Y') }} Philippine Coastal Storage & Pipeline Corporation Vendorify. All rights reserved.</p>
    </footer>

    <!-- Modal for Registration Success -->
    @if(session('registration_success'))
    <div class="modal-overlay fixed inset-0 flex items-center justify-center z-50">
        <!-- Modal content -->
        <div class="modal-container bg-white w-3/4 md:w-1/2 lg:w-1/3 p-8 rounded-lg shadow-lg relative">
            <!-- Modal close button -->
            <button class="absolute top-0 right-0 mt-4 mr-4" onclick="closeModal()">
                <!-- SVG icon -->
            </button>
            <h3 class="text-lg font-semibold mb-4">Thank You for Registering!</h3>
            <p>Your account is currently pending approval. You will receive an email once your account and requirements have been reviewed and approved. This process may take some time, so we appreciate your patience.</p>
            <button class="mt-8 bg-gray-800 hover:bg-gray-900 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 ease-in-out" onclick="closeModal()">Got It</button>
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
</html>
