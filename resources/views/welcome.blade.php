<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Philcoastal — VMP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>
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
                    <img src="{{ asset('logo/logo-1.png') }}" alt="Logo" class="h-8 mr-2"> 
                    <h3 style="font-family: 'Inter', sans-serif;">Vendor Management Portal</h3>
                </div>
                <div>
                    <a href="{{ route('login') }}" style="font-family: 'Inter', sans-serif;" class="bg-transparent hover:bg-white hover:text-gray-900 text-white px-4 py-2 transition duration-300 ease-in-out">Sign In</a>
                    <a href="{{ route('register') }}" style="font-family: 'Inter', sans-serif;" class="ml-4 bg-white hover:bg-gray-100 text-gray-900 px-4 py-2 transition duration-300 ease-in-out">Sign Up</a>
                </div>
            </div>
        </nav>

    <!-- Main Content -->
    <div class="min-h-screen flex items-center justify-center pt-20 pb-12">
    <div class="text-center text-white px-4 ">
    <h1 x-data="{
        startingAnimation: { opacity: 0, y: 50, rotation: '25deg' },
        endingAnimation: { opacity: 1, y: 0, rotation: '0deg', stagger: 0.02, duration: 0.7, ease: 'back' },
        addCNDScript: true,
        splitCharactersIntoSpans(element) {
        text = element.innerHTML;
        modifiedHTML = [];
        for (var i = 0; i < text.length; i++) {
        attributes = '';
        if(text[i].trim()){ attributes = 'class=\'inline-block\''; }
        modifiedHTML.push('<span ' + attributes + '>' + text[i] + '</span>');
        }
        element.innerHTML = modifiedHTML.join('');
        },
        addScriptToHead(url) {
        script = document.createElement('script');
        script.src = url;
        document.head.appendChild(script);
        },
        animateText() {
        $el.classList.remove('invisible');
        gsap.fromTo($el.children, this.startingAnimation, this.endingAnimation);
        }
        }"
        x-init="
        splitCharactersIntoSpans($el);
        if(addCNDScript){
        addScriptToHead('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js');
        }
        gsapInterval2 = setInterval(function(){
        if(typeof gsap !== 'undefined'){
        animateText();
        clearInterval(gsapInterval2);
        }
        }, 5);
        "
        class="invisible block pb-0.5 overflow-hidden text-3xl font-bold custom-font"
        >
        Welcome to Vendor Management Portal
        </h1>
    </div>
</div>
    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-4" style="font-family: 'Inter', sans-serif;">
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
            <h3 class="text-lg font-semibold mb-4" style="font-family: 'Inter', sans-serif;">Thank You for Registering!</h3>
            <p style="font-family: 'Inter', sans-serif;"> Your account is currently pending approval. You will receive an email once your account and requirements have been reviewed and approved. This process may take some time, so we appreciate your patience.</p>
            <button style="font-family: 'Inter', sans-serif;" class="mt-6 bg-gray-700 text-sm text-white px-6 py-3 rounded font-semibold transition duration-300 ease-in-out shadow-md hover:shadow-lg" onclick="closeModal()" style="font-family: 'Inter', sans-serif;">Got It</button>
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

<!-- Google Font -->


