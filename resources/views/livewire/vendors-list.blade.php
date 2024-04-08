{{-- views\livewire\vendors-list.blade.php --}}

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="p-4 bg-white dark:bg-gray-900">
            {{-- Filters Row --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-between items-center pb-4">
                {{-- SWITCH --}}
<div x-data="{ darkMode: false }" :class="{ 'dark': darkMode }" class="flex items-center justify-center space-x-2">
    <input id="darkModeSwitch" type="checkbox" name="switch" class="hidden" x-model="darkMode">

    <button 
        x-ref="switchButton"
        type="button" 
        @click="darkMode = ! darkMode; document.documentElement.classList.toggle('dark', darkMode);"
        :class="darkMode ? 'bg-gray-800' : 'bg-neutral-200'" 
        class="relative inline-flex items-center h-6 py-0.5 ml-4 focus:outline-none rounded-full w-11"
        x-cloak>
        <span :class="darkMode ? 'translate-x-5' : 'translate-x-0.5'" class="block w-5 h-5 duration-200 ease-in-out bg-white rounded-full shadow-md transform"></span>
    </button>
</div>

                {{-- Search --}}
                <div class="relative mt-1 sm:w-1/3">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input wire:model.debounce.500ms="search" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Search vendors...">
                </div>

                    {{-- ASC DESC --}}
        <button wire:click="toggleSortDirection" class="font-medium text-gray-600 ">
            @if($sortDirection === 'asc')
                <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                </svg>
                </span>
            @else
                <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                </svg>
                </span>
            @endif
        </button>

            {{-- DATE PICKER --}}
            <div class="relative mt-1 sm:w-1/3">
                <input type="date" wire:model="selectedDate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" />
            </div>

            {{-- Business type filter --}}
            <div class="relative mt-1 sm:w-1/3">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 10a5 5 0 105 5v-2.5a2.5 2.5 0 11-5 0V10zm0 0a5 5 0 015-5V2a7 7 0 00-7 7h2zm0 0a5 5 0 015 5h2a7 7 0 00-7-7v2z" clip-rule="evenodd" />
                    </svg>
                </div>
                <select wire:model="businessTypeFilter" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    <option value="">All Business Types</option>
                    <option value="Software">Software services</option>
                    <option value="Training">Training services</option>
                    <option value="Event planning">Event planning services</option>
                    <option value="Consulting">Consulting services</option>
                    <option value="Marketing">Marketing services</option>
                    <option value="Waste management">Waste management services</option>
                    <option value="Construction">Construction services</option>
                    <option value="Legal services">Legal services</option>
                    <option value="Health and wellness">Health and wellness services</option>
                    <option value="Insurance">Insurance services</option>
                    <option value="Security">Security services</option>
                    <option value="Travel">Travel services</option>
                    <option value="Research">Research services</option>
                    <option value="Design">Design services</option>
                    <option value="Finance">Finance services</option>
                    <option value="Delivery">Delivery services</option>
                    <option value="Real estate">Real estate services</option>
                    <option value="Child care">Child care services</option>
                    <option value="Utilities">Utilities</option>
                    <option value="Printing">Printing services</option>
                    <option value="Personal">Personal services</option>
                    <option value="Landscaping">Landscaping</option>
                    <option value="Pest extermination">Pest extermination services</option>
                    <option value="Maintenance">Maintenance services</option>
                    <option value="Tech support">Tech support services</option>
                    <option value="Bookkeeping">Bookkeeping services</option>
                    <option value="Video and photography">Video and photography services</option>
                    <option value="Translation">Translation services</option>
                    <option value="Parking">Parking services</option>
                    <option value="Public relations">Public relations services</option>
                </select>
            </div>
        
            <!-- Reset Filters Button with Icon -->
        <div class="relative mt-1 sm:w-1/3">
            <button wire:click="resetFilters" class="flex items-center justify-center w-full h-10 px-3 py-2 text-sm bg-gray-50 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 -ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
            </button>
            </div>
        </div>

        {{-- Table --}}
        <table class="w-full text-sm text-left text-gray-900 dark:text-gray-900 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 ">
                <tr>
                    <th scope="col" class="px-6 py-3 w-1/12">ID</th>
                    <th scope="col" class="px-6 py-3 w-1/12">Vendor Info</th>
                    <th scope="col" class="px-6 py-3 w-1/12">Contact</th>
                    <th scope="col" class="px-6 py-3 w-1/12">Location</th>
                    <th scope="col" class="px-6 py-3 w-1/12">Business Details</th>
                    <th scope="col" class="px-6 py-3 w-1/12">
                        Date Registered
                    </th>
                    <th scope="col" class="px-6 py-3 w-1/12 text-center">Status</th>
                    <th scope="col" class="px-6 py-3 w-1/12 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($vendors as $vendor)
                <tr class="dark:text-white bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">{{ $vendor->id }}</td>
                    <td class="px-6 py-4">
                        <div class="font-medium text-gray-900 dark:text-white">{{ $vendor->company_name }}</div>
                        <div class="text-sm text-gray-500">{{ $vendor->first_name }} {{ $vendor->last_name }}</div>
                    </td>
                    <td class="px-6 py-4"><div class="font-medium text-gray-900 dark:text-white">{{ $vendor->email }}</div>
                        <div class="text-sm text-gray-500">{{ $vendor->phone_number}}</div></td>
                    <td class="px-6 py-4">{{ $vendor->office_city }}</td>
                    <td class="px-6 py-4">
                        <div>{{ $vendor->business_type }}</div>
                        <div class="text-sm text-gray-500">{{ $vendor->products_or_services }}</div>
                    </td>
                    <td class="px-6 py-4">{{ $vendor->created_at->timezone('Asia/Manila')->format('m-d-Y') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Active
                        </div>
                    </td>

                    {{-- Slide over modal --}}
                    <td class="py-4 px-6 text-right dark:text-gray-900">
                    <div x-data="{ 
                            slideOverOpen: false 
                        }"
                        class="relative z-50 w-auto h-auto">
                        <button @click="slideOverOpen=true" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z" clip-rule="evenodd" />
                        </svg>
                        </button>
                        <template x-teleport="body">
                            <div 
                                x-show="slideOverOpen"
                                @keydown.window.escape="slideOverOpen=false"
                                class="relative z-[99]">
                                <div x-show="slideOverOpen" x-transition.opacity.duration.600ms @click="slideOverOpen = false" class="fixed inset-0 bg-black bg-opacity-10"></div>
                                <div class="fixed inset-0 overflow-hidden">
                                    <div class="absolute inset-0 overflow-hidden">
                                        <div class="fixed inset-y-0 right-0 flex max-w-full pl-10">
                                            <div 
                                                x-show="slideOverOpen" 
                                                @click.away="slideOverOpen = false"
                                                x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" 
                                                x-transition:enter-start="translate-x-full" 
                                                x-transition:enter-end="translate-x-0" 
                                                x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" 
                                                x-transition:leave-start="translate-x-0" 
                                                x-transition:leave-end="translate-x-full" 
                                                class="w-screen max-w-full">
                                                <div class="flex flex-col h-full py-5 overflow-y-scroll bg-white border-l shadow-lg border-neutral-100/70">
                                                    <div class="px-4 sm:px-5">
                                                        <div class="flex items-start justify-between pb-1">
                                                                                <h2 class="text-xl font-medium text-gray-900" id="slide-over-title">
                                                                                    Overview
                                                                                </h2>
                                                                                <div class="ml-3 h-7 flex items-center">
                                                                                    <button @click="slideOverOpen = false" class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none">
                                                                                        <span class="sr-only">Close</span>
                                                                                        <!-- Heroicons: outline/x -->
                                                                                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                                                        </svg>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="p-6">
                                                                            <div class="overflow-hidden border border-gray-200 shadow sm:rounded-lg">
                                                                                <table class="min-w-full divide-y divide-gray-200">
                                                                                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                                                                        <!-- Company Name -->
                                                                                        <tr>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-400">Company Name</td>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ $vendor->company_name }}</td>
                                                                                        </tr>
                                                                                        <!-- Contact Name -->
                                                                                        <tr>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-400">Contact Name</td>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ $vendor->first_name }} {{ $vendor->last_name }}</td>
                                                                                        </tr>
                                                                                        <!-- Billing Rep -->
                                                                                        <tr>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-400">Billing Representative</td>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ $vendor->billing_representative_first_name }} {{ $vendor->billing_representative_last_name }}</td>
                                                                                        </tr>                                                                                       
                                                                                        <!-- Email -->
                                                                                        <tr>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-400">Email</td>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ $vendor->email }}</td>
                                                                                        </tr>
                                                                                        <!-- Phone Number -->
                                                                                        <tr>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-400">Phone Number</td>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ $vendor->phone_number }}</td>
                                                                                        </tr>
                                                                                        <!-- Business Type -->
                                                                                        <tr>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-400">Business Type</td>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ $vendor->business_type }}</td>
                                                                                        </tr>
                                                                                        <!-- Services/Products -->
                                                                                        <tr>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-400">Services/Products</td>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ $vendor->products_or_services }}</td>
                                                                                        </tr>
                                                                                        <!-- Supplier Type -->
                                                                                        <tr>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-400">Supplier Type</td>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ $vendor->supplier_type }}</td>
                                                                                        </tr>
                                                                                        <!-- Address -->
                                                                                        <tr>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-400">Address</td>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                                                                                <strong>{{ $vendor->office_city }},</strong><br>
                                                                                                {{ $vendor->office_street }}<br>
                                                                                                <small>{{ $vendor->office_zip }}</small>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <!-- Company Website -->
                                                                                        <tr>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-400">Company Website</td>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">{{ $vendor->website_url }}</td>
                                                                                        </tr>

                                                                                        <!-- Status -->
                                                                                        <tr>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-400">Status</td>
                                                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-green-500 dark:text-green-400">Active</td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>

                                                                        <h2 class="ml-5 text-xl font-medium text-gray-900" id="slide-over-title">
                                                                            Documents
                                                                        </h2>
                                                                        <div class="p-6">
                                                                            <div class="overflow-hidden border border-gray-200 shadow sm:rounded-lg">
                                                                            <div class="mt-4 space-y-4">
                                                                                <!-- Document Card -->
                                                                                <div class="flex justify-between p-4 bg-white rounded-lg shadow dark:bg-gray-800">
                                                                                    <div>
                                                                                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Annual Report 2021.pdf</h4>
                                                                                        <p class="text-xs text-gray-600 dark:text-gray-400">Expiry Date: 02-04-2025</p>
                                                                                    </div>
                                                                                    <div class="flex flex-col space-y-1">
                                                                                        <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-400">View</a>
                                                                                        <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-400">Download</a>
                                                                                        <a href="#" class="text-sm font-medium text-yellow-600 hover:underline dark:text-yellow-400">Update Request</a>
                                                                                    </div>
                                                                                </div>
                                                                        
                                                                                <!-- Another Document Card -->
                                                                                <div class="flex justify-between p-4 bg-white rounded-lg shadow dark:bg-gray-800">
                                                                                    <div>
                                                                                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-300">BIR.pdf</h4>
                                                                                        <p class="text-xs text-red-600">Expired!</p>
                                                                                    </div>
                                                                                    <div class="flex flex-col space-y-1">
                                                                                        <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-400">View</a>
                                                                                        <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-400">Download</a>
                                                                                        <a href="#" class="text-sm font-medium text-yellow-600 hover:underline dark:text-yellow-400">Update Request</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        {{ $vendors->links() }}
    </div>
</div>
<script>
    function toggleDarkMode() {
        document.documentElement.classList.toggle('dark');
    }
</script>




