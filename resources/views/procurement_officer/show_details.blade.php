<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Vendor Details
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">                   

                    <!-- Header with Date and Menu Bar -->
                    {{-- <div class="bg-gray-800">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            <h1 class="text-2xl font-bold text-white">
                                Vendor Registration
                            </h1>
                        </div>
                    </div>
                    <br> --}}

                    <div class="flex justify-between items-center mb-4">
                        {{-- <!-- Date Display -->
                        <div>
                            <span class="inline-block bg-blue-100 text-blue-800 text-md px-2 rounded-full uppercase font-semibold tracking-wide">
                                {{ $vendor->created_at->timezone('Asia/Manila')->format('Y-m-d h:i:s A') }}
                            </span>
                        </div> --}}
                    <!-- Vendor Details Table -->
                    <div>
                    <h1 class="text-lg font-bold my-2 ml-2"> Overview </h1>
                    </div>
                                            <!-- Menu Bar with Border -->
                                            <div class="relative">
                                                <div class="flex space-x-4 border border-gray-300 p-1 rounded-md bg-white">
                                                    <button class="rounded text-sm cursor-default flex items-center leading-tight justify-center px-3 py-1.5 h-full hover:bg-neutral-100">Archive</button>
                                                    <button class="rounded text-sm cursor-default flex items-center leading-tight justify-center px-3 py-1.5 h-full hover:bg-neutral-100">Export</button>
                                                    <button class="rounded text-sm cursor-default flex items-center leading-tight justify-center px-3 py-1.5 h-full hover:bg-neutral-100">Print</button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                    <div class="container mx-auto p-4">
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
                                <td class="w-3/4 px-4 py-2">{{ $vendor->business_type }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Products/Services:</td>
                                <td class="w-3/4 px-4 py-2">{{ $vendor->products_or_services }}</td>
                            </tr>
                        </tbody>
                    </table>
<br>
                                                            <!-- Docs table -->
                                                            <h1 class="text-lg font-bold ml-1"> Documents </h1>
                                                            <br>
                                                            <hr>
                                                            <div class="container mx-auto p-4">
                                                                <table class="min-w-full table-auto border-collapse border border-gray-300">
                                                                    <tbody>
                                                                        <tr class="border-b">
                                                                            <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">BIR 2303</td>
                                                                            <td class="w-3/4 px-4 py-2 hover:underline text-blue-500">test.pdf</td>
                                                                            <td class="w-3/4 px-4 py-2 hover:underline text-gray-900"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                                        <path d="M10.75 2.75a.75.75 0 0 0-1.5 0v8.614L6.295 8.235a.75.75 0 1 0-1.09 1.03l4.25 4.5a.75.75 0 0 0 1.09 0l4.25-4.5a.75.75 0 0 0-1.09-1.03l-2.955 3.129V2.75Z" />
                                                                        <path d="M3.5 12.75a.75.75 0 0 0-1.5 0v2.5A2.75 2.75 0 0 0 4.75 18h10.5A2.75 2.75 0 0 0 18 15.25v-2.5a.75.75 0 0 0-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5Z" />
                                                                        </svg>
                                                                        </td>
                                                                            <td class="w-3/4 px-4 py-2">
                                                                        </tr>
                                                                        <tr class="border-b">
                                                                            <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">SEC</td>
                                                                            <td class="w-3/4 px-4 py-2 hover:underline text-blue-500">test.docx</td>
                                                                            <td class="w-3/4 px-4 py-2 hover:underline text-gray-900"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                                        <path d="M10.75 2.75a.75.75 0 0 0-1.5 0v8.614L6.295 8.235a.75.75 0 1 0-1.09 1.03l4.25 4.5a.75.75 0 0 0 1.09 0l4.25-4.5a.75.75 0 0 0-1.09-1.03l-2.955 3.129V2.75Z" />
                                                                        <path d="M3.5 12.75a.75.75 0 0 0-1.5 0v2.5A2.75 2.75 0 0 0 4.75 18h10.5A2.75 2.75 0 0 0 18 15.25v-2.5a.75.75 0 0 0-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5Z" />
                                                                        </svg>
                                                                        </td>
                                                                            <td class="w-3/4 px-4 py-2"></td>
                                                                        </tr>
                                                                        <tr class="border-b">
                                                                            <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Mayor's Permit</td>
                                                                            <td class="w-3/4 px-4 py-2 hover:underline text-blue-500">test2.pdf</td>
                                                                            <td class="w-3/4 px-4 py-2 hover:underline text-gray-900"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                                        <path d="M10.75 2.75a.75.75 0 0 0-1.5 0v8.614L6.295 8.235a.75.75 0 1 0-1.09 1.03l4.25 4.5a.75.75 0 0 0 1.09 0l4.25-4.5a.75.75 0 0 0-1.09-1.03l-2.955 3.129V2.75Z" />
                                                                        <path d="M3.5 12.75a.75.75 0 0 0-1.5 0v2.5A2.75 2.75 0 0 0 4.75 18h10.5A2.75 2.75 0 0 0 18 15.25v-2.5a.75.75 0 0 0-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5Z" />
                                                                        </svg>
                                                                        </td>
                                                                            <td class="w-3/4 px-4 py-2"></td>
                                                                        </tr>
                                                                        <tr class="border-b">
                                                                            <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Sample OR</td>
                                                                            <td class="w-3/4 px-4 py-2 hover:underline text-blue-500">test2.docx</td>
                                                                            <td class="w-3/4 px-4 py-2 hover:underline text-gray-900"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                                            <path d="M10.75 2.75a.75.75 0 0 0-1.5 0v8.614L6.295 8.235a.75.75 0 1 0-1.09 1.03l4.25 4.5a.75.75 0 0 0 1.09 0l4.25-4.5a.75.75 0 0 0-1.09-1.03l-2.955 3.129V2.75Z" />
                                                                            <path d="M3.5 12.75a.75.75 0 0 0-1.5 0v2.5A2.75 2.75 0 0 0 4.75 18h10.5A2.75 2.75 0 0 0 18 15.25v-2.5a.75.75 0 0 0-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5Z" />
                                                                            </svg>
                                                                            </td>
                                                                            <td class="w-3/4 px-4 py-2"></td>
                                                                        </tr>
                                                                        <tr class="border-b">
                                                                            <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Sample Invoice</td>
                                                                            <td class="w-3/4 px-4 py-2 hover:underline text-blue-500">test3.pdf</td>
                                                                            <td class="w-3/4 px-4 py-2 hover:underline text-gray-900"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                                            <path d="M10.75 2.75a.75.75 0 0 0-1.5 0v8.614L6.295 8.235a.75.75 0 1 0-1.09 1.03l4.25 4.5a.75.75 0 0 0 1.09 0l4.25-4.5a.75.75 0 0 0-1.09-1.03l-2.955 3.129V2.75Z" />
                                                                            <path d="M3.5 12.75a.75.75 0 0 0-1.5 0v2.5A2.75 2.75 0 0 0 4.75 18h10.5A2.75 2.75 0 0 0 18 15.25v-2.5a.75.75 0 0 0-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5Z" />
                                                                            </svg>
                                                                            </td>
                                                                            <td class="w-3/4 px-4 py-2"></td>
                                                                        </tr>
                                                                        <tr class="border-b">
                                                                            <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">SBMA Accreditation</td>
                                                                            <td class="w-3/4 px-4 py-2 hover:underline text-blue-500">test3.docx</td>
                                                                            <td class="w-3/4 px-4 py-2 hover:underline text-gray-900"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                                            <path d="M10.75 2.75a.75.75 0 0 0-1.5 0v8.614L6.295 8.235a.75.75 0 1 0-1.09 1.03l4.25 4.5a.75.75 0 0 0 1.09 0l4.25-4.5a.75.75 0 0 0-1.09-1.03l-2.955 3.129V2.75Z" />
                                                                            <path d="M3.5 12.75a.75.75 0 0 0-1.5 0v2.5A2.75 2.75 0 0 0 4.75 18h10.5A2.75 2.75 0 0 0 18 15.25v-2.5a.75.75 0 0 0-1.5 0v2.5c0 .69-.56 1.25-1.25 1.25H4.75c-.69 0-1.25-.56-1.25-1.25v-2.5Z" />
                                                                            </svg>
                                                                            </td>
                                                                            <td class="w-3/4 px-4 py-2"></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>                    
                                                            <!--end of docs table-->

                <!-- Action Buttons -->
                    <div class="mt-6 flex justify-between items-center">
                        <!-- Left-aligned Back to Pending Vendors Button -->
                        <a href="{{ route('procurement_officer.pending_vendors') }}" class="inline-flex items-center px-4 py-2 bg-white border border-transparent rounded-md font-semibold text-xs text-gray-900 uppercase tracking-widest hover:bg-gray-100 active:bg-gray-100 focus:outline-none focus:border-none focus:ring ring-gray-50 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Back to Pending Vendors
                        </a>
                    <div class="flex space-x-4">
                    <form action="{{ route('procurement_officer.approve_vendor', $vendor->id) }}" method="POST" onsubmit="return confirmApproval(this);">
                        @csrf
                        <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-none focus:ring ring-green-50 disabled:opacity-25 transition ease-in-out duration-150">                            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Approve
                    </form>

                    <button onclick="event.preventDefault();" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-800 focus:outline-none focus:border-none focus:ring ring-yellow-50 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Reassess
                        </button>
                </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmApproval(form) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to approve this vendor for preliminary assessment. Once approved, the vendor will be forwarded to the procurement head for final approval.",
                showCancelButton: true,
                confirmButtonColor: '#262121',
                cancelButtonColor: '#ef4c40',
                confirmButtonText: 'Yes, Approve'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
            return false; // Prevent form submission if the user cancels the action
        }
    </script>

    @if(session('success'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                showCloseButton: true,
                closeButtonHtml: '&times;',
                timerProgressBar: true,
            });
        </script>
    @endif
</x-app-layout>
