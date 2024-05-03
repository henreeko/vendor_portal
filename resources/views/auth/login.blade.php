<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Philcoastal — VMP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="h-screen flex">
        <div class="hidden lg:flex w-full lg:w-1/2 login_img_section justify-around items-center" 
        style="font-family: 'Inter', sans-serif; background: linear-gradient(rgba(2,2,2,.7),rgba(0,0,0,.7)),url('{{ asset('logo/land-bg.jpg') }}') center center; background-size: cover;">
            <div class="bg-black opacity-20 inset-0 z-0"></div>
            <div class="w-full mx-auto px-20 flex-col items-center space-y-6">
                <h1 style="font-family: 'Inter', sans-serif;" class="text-white font-bold text-4xl font-sans">PCSPC Vendor Management Portal</h1>
                <p class="text-white mt-1"> Welcome to Philippine Coastal Storage & Pipeline Corporation's Vendor Management Portal. Are you dedicated to delivering top-notch quality? We're expanding our supplier network and inviting vendors to register their businesses as potential suppliers for PSCPC.</p>
                <div class="flex justify-center lg:justify-start mt-6">
                    <a href="https://www.philcoastal.com/who-we-are/" target="_blank" rel="noopener noreferrer" class="hover:bg-white hover:text-red-700 hover:-translate-y-1 transition-all duration-500 bg-red-700 text-white mt-4 px-4 py-2 font-bold mb-2">About Us</a>
                </div>
            </div>
        </div>

        <div class="flex w-full lg:w-1/2 justify-center items-center bg-white space-y-8">
            <div class="w-full px-8 md:px-32 lg:px-24">
                @if ($errors->any())
                <div class="mb-3 bg-red-100 text-red-700 px-4 py-3 rounded relative text-sm" role="alert">
                    <strong class="font-bold" style="font-family: 'Inter', sans-serif;">Whoops!</strong>
                    <span class="block sm:inline" style="text-xs font-family: 'Inter', sans-serif;">{{ $errors->first() }}</span>
                </div>
                @endif
                <form method="POST" action="{{ route('login') }}" class="bg-white rounded-md shadow-2xl p-5">
                    @csrf

                    <h1 style="font-family: 'Inter', sans-serif;" class="text-gray-800 font-bold text-2xl">Sign In</h1>
                    <br>

                <!-- Email Input with Floating Label -->
                <div class="mb-6 relative">
                    <input
                        style="font-family: 'Inter', sans-serif;"
                        class="peer h-14 w-full border-b-2 border-blue-gray-200 bg-transparent pt-6 pb-2 text-md font-normal text-blue-gray-700 outline-none transition-all placeholder-shown:border-blue-gray-200 focus:border-red-600"
                        type="email" name="email" required autofocus placeholder=" " />
                    <label style="font-family: 'Inter', sans-serif;"class="pointer-events-none absolute left-0 -top-1 translate-y-0 flex h-full w-full select-none text-lg font-normal text-gray-500 transition-all peer-placeholder-shown:translate-y-5 peer-placeholder-shown:text-base peer-focus:translate-y-[-5px] peer-focus:text-red-600 peer-focus:text-sm">
                        Email
                    </label>
                </div>

                <!-- Password Input with Floating Label -->
                <div class="relative">
                    <input
                        style="font-family: 'Inter', sans-serif;"
                        class="peer h-14 w-full border-b-2 border-blue-gray-200 bg-transparent pt-6 pb-2 text-md font-normal text-blue-gray-700 outline-none transition-all placeholder-shown:border-blue-gray-200 focus:border-red-600"
                        type="password" name="password" required placeholder=" " />
                    <label style="font-family: 'Inter', sans-serif;" class="pointer-events-none absolute left-0 -top-1 translate-y-0 flex h-full w-full select-none text-lg font-normal text-gray-500 transition-all peer-placeholder-shown:translate-y-5 peer-placeholder-shown:text-base peer-focus:translate-y-[-5px] peer-focus:text-red-600 peer-focus:text-sm">
                        Password
                    </label>
                </div>

                    <!-- Login Button -->
                    <button type="submit" style="font-family: 'Inter', sans-serif;" class="block w-full bg-gray-800 mt-5 py-2 text-white font-semibold mb-2 rounded-2xl hover:bg-red-700 hover:-translate-y-1 transition-all duration-500">Login</button>
                    
                    {{-- Register Button --}}
                    <div class="text-center mt-4">
                        <span style="font-family: 'Inter', sans-serif;" class="text-sm text-gray-700">Don't have an account yet?</span> 
                        <a href="{{ route('register') }}" style="font-family: 'Inter', sans-serif;" class="text-sm text-red-500 ml hover:text-red-700 cursor-pointer">Register</a>
                    </div>

                    <!-- Forgot Password Link -->
                    <div class="flex justify-center mt-4">
                    <a href="{{ route('password.request') }}" style="font-family: 'Inter', sans-serif;" class="text-sm text-gray-600 underline ml-2 hover:text-gray-900 cursor-pointer">Forgot Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
