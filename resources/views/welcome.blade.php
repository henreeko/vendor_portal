<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Philcoastal — Vendorify</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        body {
            font-family: 'figtree', sans-serif;
        }
        .modal-overlay {
            background-color: rgba(0, 0, 0, 0.5);
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

    @if(session('registration_success'))
    <!-- Modal -->
    <div class="modal-overlay fixed inset-0 flex items-center justify-center z-50">
        <div class="modal-container bg-white w-3/4 p-8 rounded-lg shadow-lg">
            <!-- Close button -->
            <button class="absolute top-0 right-0 mt-4 mr-4" onclick="closeModal()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <!-- Modal header -->
            <div class="modal-header">
                <h3 class="text-lg font-semibold">Thank You for Registering!</h3>
            </div>
        
            <!-- Modal body -->
            <div class="modal-body">
                <p class="text-base text-gray-800">Your registration has been received successfully. Please wait for approval.</p>
            </div>
        
            <!-- Modal footer -->
            <div class="modal-footer text-right">
                <button class="bg-red-600 hover:bg-red-800 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 ease-in-out" onclick="closeModal()">Got It</button>
            </div>
        </div>
    </div>
    @endif

<!-- Script to close the modal -->
<script>
    // Function to close the modal
    function closeModal() {
        document.querySelector('.modal-overlay').classList.add('hidden');
    }
</script>
</body>
</html>
