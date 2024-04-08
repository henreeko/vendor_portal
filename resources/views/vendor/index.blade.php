<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendor Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-whitey min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-800 border-b border-gray-700 text-white">
                    <!-- Animated Welcome Message -->
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
                    Welcome, {{ Auth::user()->first_name }}!
                    </h1>

                    <!-- Personalized Welcome Note -->
                    <p class="mt-4 text-lg">
                        We are thrilled to have you on board.
                    </p>

                    <!-- Quick Start Guide Button -->
                    <div class="mt-6">
                        <a href="#quick-start-guide" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition">
                            Quick Start Guide
                        </a>
                    </div>

                     <!-- Dashboard Widgets -->
                     <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                        <!-- Document Update Reminder -->
                        <a href="/document-updates" class="transition transform hover:-translate-y-1 hover:shadow-lg p-4 bg-gray-700 rounded-lg shadow-md block"class="p-4 bg-gray-700 rounded-lg shadow-lg block">
                            <h2 class="font-semibold text-red-400">Document Updates</h2>
                            <p class="text-red-300 mt-1">Check for any documents that need renewal or updating.</p>
                        </a>

                        <!-- Status Check -->
                        <a href="/vendor-status" class="transition transform hover:-translate-y-1 hover:shadow-lg p-4 bg-gray-700 rounded-lg shadow-md block" class="p-4 bg-gray-700 rounded-lg shadow-lg block">
                            <h2 class="font-semibold text-red-400">Vendor Status</h2>
                            <p class="text-red-300 mt-1">View your current status and any pending approvals.</p>
                        </a>

                        <!-- Reports Submission -->
                        <a href="/submit-reports" class="transition transform hover:-translate-y-1 hover:shadow-lg p-4 bg-gray-700 rounded-lg shadow-md block" class="p-4 bg-gray-700 rounded-lg shadow-lg block">
                            <h2 class="font-semibold text-red-400">Submit Reports</h2>
                            <p class="text-red-300 mt-1">Easily submit performance or issue reports.</p>
                        </a>

                        <!-- Notifications -->
                        <a href="/notifications" class="transition transform hover:-translate-y-1 hover:shadow-lg p-4 bg-gray-700 rounded-lg shadow-md block" class="p-4 bg-gray-700 rounded-lg shadow-lg block">
                            <h2 class="font-semibold text-red-400">Notifications</h2>
                            <p class="text-red-300 mt-1">Stay informed with real-time notifications.</p>
                        </a>

                        <!-- Performance Overview -->
                        <a href="/performance-overview" class="transition transform hover:-translate-y-1 hover:shadow-lg p-4 bg-gray-700 rounded-lg shadow-md block" class="p-4 bg-gray-700 rounded-lg shadow-lg block">
                            <h2 class="font-semibold text-red-400">Performance Overview</h2>
                            <p class="text-red-300 mt-1">Insights into your contributions and impacts.</p>
                        </a>

                        <!-- Support & FAQs -->
                        <a href="/support-faqs" class="transition transform hover:-translate-y-1 hover:shadow-lg p-4 bg-gray-700 rounded-lg shadow-md block" class="p-4 bg-gray-700 rounded-lg shadow-lg block">
                            <h2 class="font-semibold text-red-400">Support & FAQs</h2>
                            <p class="text-red-300 mt-1">Access to support resources and frequently asked questions.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


