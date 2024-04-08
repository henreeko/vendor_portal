<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Philcoastal — VMP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="h-screen flex">
        <div class="hidden lg:flex w-full lg:w-1/2 login_img_section justify-around items-center" 
        style="background: linear-gradient(rgba(2,2,2,.7),rgba(0,0,0,.7)),url('{{ asset('logo/land-bg.jpg') }}') center center; background-size: cover;">
            <div class="bg-black opacity-20 inset-0 z-0"></div>
            <div class="w-full mx-auto px-20 flex-col items-center space-y-6">
                <h1 class="text-white font-bold text-4xl font-sans">Vendor Management Portal</h1>
                <p class="text-white mt-1"> Welcome to Philippine Coastal Storage & Pipeline Corporation's Vendor Management Portal. If you're passionate about delivering quality and excellence, we invite you to join our growing network. Let's collaborate to create mutually beneficial opportunities.</p>
                <div class="flex justify-center lg:justify-start mt-6">
                    <a href="https://www.philcoastal.com/who-we-are/" target="_blank" rel="noopener noreferrer" class="hover:bg-white hover:text-red-700 hover:-translate-y-1 transition-all duration-500 bg-red-700 text-white mt-4 px-4 py-2 font-bold mb-2">About Us</a>
                </div>
            </div>
        </div>

        <div class="flex w-full lg:w-1/2 justify-center items-center bg-white space-y-8">
            <div class="w-full px-8 md:px-32 lg:px-24">
                <form method="POST" action="{{ route('login') }}" class="bg-white rounded-md shadow-2xl p-5">
                    @csrf

                    <h1 class="text-gray-800 font-bold text-2xl mb-1">Sign In</h1>
                    <br>

                    <div class="flex items-center rounded-2xl border-2 py-2 px-3 mb-8">
                        <!-- Email Input -->
                        <input id="email" class="pl-2 w-full outline-none border-none" type="email" name="email" placeholder="Email Address" required autofocus />
                    </div>

                    <div class="flex items-center rounded-2xl  border-2 py-2 px-3 mb-12">
                        <!-- Password Input -->
                        <input class="pl-2 w-full outline-none border-none" type="password" name="password" id="password" placeholder="Password" required />
                    </div>
                    
                    @if ($errors->any())
                    <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Whoops!</strong>
                        <span class="block sm:inline">{{ $errors->first() }}</span>
                    </div>
                    @endif
                    <!-- Login Button -->
                    <button type="submit" class="block w-full bg-gray-800 mt-5 py-2 text-white font-semibold mb-2 rounded-2xl hover:bg-red-700 hover:-translate-y-1 transition-all duration-500">Login</button>
                    
                    {{-- Register Button --}}
                    <div class="text-center mt-4">
                        <span class="text-sm text-gray-700">Don't have an account yet?</span> 
                        <a href="{{ route('register') }}" class="text-sm text-gray ml hover:text-red-700 cursor-pointer">Register</a>
                    </div>

                    <!-- Forgot Password Link -->
                    <div class="flex justify-center mt-4">
                    <a href="{{ route('password.request') }}" class="text-sm text-gray-600 underline ml-2 hover:text-red-700 cursor-pointer">Forgot Password?</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
@if ($errors->any())
<div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
    <strong class="font-bold">Whoops!</strong>
    <span class="block sm:inline">{{ $errors->first() }}</span>
</div>
@endif
</html>
