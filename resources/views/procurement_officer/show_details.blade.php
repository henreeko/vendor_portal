{{-- for pending --}}
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

                    <div class="flex justify-between items-center mb-4">
                    <!-- Vendor Details Table -->
                    <div>
                    <h1 class="text-lg font-bold my-2 ml-2"> Overview </h1>
                    </div>
                                            <!-- Menu Bar with Border -->
                                            <div class="relative">
                                                <div class="flex space-x-4 border border-gray-300 p-1 rounded-md bg-white">
                                                    <button class="rounded text-sm cursor-default flex items-center leading-tight justify-center px-3 py-1.5 h-full hover:bg-neutral-100">Action 1</button>
                                                    <button class="rounded text-sm cursor-default flex items-center leading-tight justify-center px-3 py-1.5 h-full hover:bg-neutral-100">Action 2</button>
                                                    <button class="rounded text-sm cursor-default flex items-center leading-tight justify-center px-3 py-1.5 h-full hover:bg-neutral-100">Action 3</button>
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
                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Contact Number:</td>
                                <td class="w-3/4 px-4 py-2">{{ $vendor->phone_number }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Billing Representative:</td>
                                <td class="w-3/4 px-4 py-2">{{ $vendor->billing_representative_first_name }} {{ $vendor->billing_representative_last_name }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Billing Representative Email:</td>
                                <td class="w-3/4 px-4 py-2">{{ $vendor->br_email }} </td>
                            </tr>
                            <tr class="border-b">
                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Billing Representative Contact No.:</td>
                                <td class="w-3/4 px-4 py-2">{{ $vendor->br_phone_number }} </td>
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
                <br>
                <div>
                    <h1 class="text-lg font-bold my-2 ml-2"> Documents </h1>
                </div>
                <hr class="mb-5">
                <div>
                    @livewire('documents-table', ['userId' => $vendor->id])
                </div>

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
                        <button onclick="openModal()" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Approve Vendor
                        </button>
                </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Confirmation -->
    <div id="approvalModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" onclick="closeModal(event)">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Confirm Approval</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">Are you sure you want to approve this vendor?</p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="cancelButton" onclick="closeModal(event)" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors border rounded-md focus:outline-none focus:ring-2 focus:ring-neutral-100 focus:ring-offset-2 hover:bg-gray-200">
                        Cancel
                    </button>
                    <button onclick="confirmApproval()" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium text-white transition-colors border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 bg-green-500 hover:bg-green-600">
                        Yes, Approve
                    </button>

                </div>
            </div>
        </div>
    </div>

    <!-- Form (hidden) for Approval -->
    <form id="approvalForm" action="{{ route('procurement_officer.approve_vendor', $vendor->id) }}" method="POST" style="display: none;">
        @csrf
        <input type="hidden" name="_method" value="POST">
    </form>
</div>
</div>
</div>
</div>

    <script>
        function openModal() {
            document.getElementById('approvalModal').classList.remove('hidden');
        }
        function closeModal(event) {
        // This checks if the clicked element is the modal background or the close button
        if (event.target.id === 'approvalModal' || event.target.id === 'cancelButton') {
            document.getElementById('approvalModal').classList.add('hidden');
        }
    }
        function confirmApproval() {
            document.getElementById('approvalForm').submit();
            document.getElementById('approvalModal').classList.add('hidden');
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
