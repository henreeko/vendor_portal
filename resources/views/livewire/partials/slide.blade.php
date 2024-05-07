<div x-data="{ 
    slideOverOpen: false 
}"
class="relative z-50 w-auto h-auto">
<button @click="slideOverOpen=true" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
    <path fill-rule="evenodd" d="M4.72 9.47a.75.75 0 0 0 0 1.06l4.25 4.25a.75.75 0 1 0 1.06-1.06L6.31 10l3.72-3.72a.75.75 0 1 0-1.06-1.06L4.72 9.47Zm9.25-4.25L9.72 9.47a.75.75 0 0 0 0 1.06l4.25 4.25a.75.75 0 1 0 1.06-1.06L11.31 10l3.72-3.72a.75.75 0 0 0-1.06-1.06Z" clip-rule="evenodd" />
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
                        class="w-screen max-w-md">
                        <div class="flex flex-col h-full py-5 overflow-y-scroll bg-white border-l shadow-lg border-neutral-100/70">
                            <div class="px-4 sm:px-5">
                                <div class="flex items-start justify-between pb-1">
                                    <h2 class="text-base font-semibold leading-6 text-gray-900" id="slide-over-title">Vendor Details</h2>
                                    <div class="flex items-center h-auto ml-3">
                                        <button @click="slideOverOpen=false" class="absolute top-0 right-0 z-30 flex items-center justify-center px-3 py-2 mt-4 mr-5 space-x-1 text-xs font-medium uppercase border rounded-md border-neutral-200 text-neutral-600 hover:bg-neutral-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            <span>Close</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="relative flex-1 px-4 mt-5 sm:px-5">
                                <div class="absolute inset-0 px-4 sm:px-5">
                                    <div class="relative w-auto">
                                        <table class="min-w-full table-auto border-collapse border border-gray-300">
                                            <tbody>
                                            <tr class="border-b">
                                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Supplier Type:</td>
                                                <td class="w-3/4 px-4 py-2">{{ $vendor->supplier_type }}</td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Company Name:</td>
                                                <td class="w-3/4 px-4 py-2">{{ $vendor->company_name }}</td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Email Address:</td>
                                                <td class="w-3/4 px-4 py-2">{{ $vendor->email }}</td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Office Address:</td>
                                                <td class="w-3/4 px-4 py-2">
                                                    {{ $vendor->office_street }},
                                                    {{ $vendor->office_barangay }},
                                                    {{ $vendor->office_zip }},
                                                    {{ $vendor->office_city }}
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">TIN Number:</td>
                                                <td class="w-3/4 px-4 py-2">{{ $vendor->tin_number }}</td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Website URL:</td>
                                                <td class="w-3/4 px-4 py-2">
                                                    <a href="{{ Str::startsWith($vendor->website_url, ['http://', 'https://']) ? $vendor->website_url : 'http://' . $vendor->website_url }}" target="_blank" rel="noopener noreferrer" class="text-blue-500 hover:text-blue-600">
                                                        {{ $vendor->website_url }}
                                                    </a>
                                                </td>
                                            </tr>                            
                                            <tr class="border-b">
                                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Telephone/Fax Number:</td>
                                                <td class="w-3/4 px-4 py-2">{{ $vendor->telephone_fax_number }}</td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Authorized Representative:</td>
                                                <td class="w-3/4 px-4 py-2">{{ $vendor->first_name }} {{ $vendor->last_name }}</td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Billing Representative:</td>
                                                <td class="w-3/4 px-4 py-2">{{ $vendor->billing_representative_first_name }} {{ $vendor->billing_representative_last_name }}</td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Contact Number:</td>
                                                <td class="w-3/4 px-4 py-2">{{ $vendor->phone_number }}</td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Business Type:</td>
                                                <td class="w-3/4 px-4 py-2">{{ $vendor->businessType->name ?? 'N/A' }}</td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Products/Services:</td>
                                                <td class="w-3/4 px-4 py-2">{{ $vendor->products_or_services }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
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

