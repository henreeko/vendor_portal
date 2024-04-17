<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For Approval</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome CDN for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col justify-center items-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white shadow-md rounded-lg">
                <div class="px-10 py-8 text-center">
                    <!-- Logo Placeholder - Ensure you replace it with your actual logo component or image -->
                    <div class="shrink-0 flex items-center">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </div>
                    <br>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">
                        Awaiting Approval
                    </h2>
                    <p class="text-md text-gray-600">Your account is under review. Please wait for confirmation.</p>
                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="mt-6">
                        @csrf
                        <button type="submit" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                            <i class="fas fa-check-circle"></i>
                            <span>Got It</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


