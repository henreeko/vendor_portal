<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="p-8 text-center relative">
                    <div class="shrink-0 flex items-center">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </div>
                    <br>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">
                        Your account is still for approval. 
                    </h2>
                    <p class="text-lg text-gray-600 mb-8">Please wait for confirmation.</p>
                    <br>
                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="absolute bottom-4 right-4">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-800 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:red-blue-500 flex items-center">
                            <span>Got It</span>
                            <i class="fas fa-check-circle ml-2"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
