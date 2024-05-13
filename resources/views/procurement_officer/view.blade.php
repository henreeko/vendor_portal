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
                            <h1 class="text-lg font-bold my-2 ml-5">Overview</h1>
                        </div>
                        <!-- Menu Bar with Border -->
                        <div class="relative">
                            <div class="flex space-x-4 border border-gray-300 p-1 rounded-md bg-white">
                                <button class="rounded text-sm cursor-default flex items-center leading-tight justify-center px-3 py-1.5 h-full hover:bg-neutral-100">Archive</button>
                                <button class="rounded text-sm cursor-default flex items-center leading-tight justify-center px-3 py-1.5 h-full hover:bg-neutral-100">Action 2</button>
                                <button class="rounded text-sm cursor-default flex items-center leading-tight justify-center px-3 py-1.5 h-full hover:bg-neutral-100">Action 3</button>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-5">

                    <div class="overflow-x-auto">
                        <table class="border min-w-full text-sm font-light text-surface dark:text-gray-700">
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            <tr>
                            <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-50">Company Name</td>
                            <td class="w-3/4 px-4 py-2">{{ $vendor->company_name }}</td>
                            </tr>
                            <tr>
                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-50">Supplier Type</td>
                                <td class="w-3/4 px-4 py-2 text-left text-blue-500">{{ $vendor->supplier_type }} </td>
                            </tr>
                            <tr>
                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-50">Business Type</th>
                                <td class="w-3/4 px-4 py-2">{{ $vendor->businessType->name ?? 'N/A' }}</td>                                                            
                            </tr>
                            <tr>
                                 <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-50">Product/Services</th>
                                <td class="w-3/4 px-4 py-2">{{ $vendor->products_or_services }} </td>
                            </tr>
                            <tr>
                                 <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-50">Office Address</th>
                                <td class="w-3/4 px-4 py-2">{{ $vendor->office_city}}, {{ $vendor->office_street}}, {{ $vendor->office_barangay}}, {{ $vendor->office_zip}} </td>
                            </tr>
                            <tr>
                                 <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-50">TIN Number</th>
                                <td class="w-3/4 px-4 py-2">{{ $vendor->tin_number }} </td>
                            </tr>
                            <tr>
                                 <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-50">Website URL</th>
                                <td class="w-3/4 px-4 py-2">{{ $vendor->website_url }} </td>
                            </tr>
                            <tr>
                                 <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-50">Relationship since</th>
                                <td class="w-3/4 px-4 py-2">{{ $vendor->created_at->timezone('Asia/Manila')->format('m-d-Y-A') }} </td>
                            </tr>
                            <tr>
                                 <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-50">Procurement Officer Approver</th>
                                <td class="w-3/4 px-4 py-2">
                                    {{ $vendor->procurementOfficerApprover ? $vendor->procurementOfficerApprover->first_name . ' ' . $vendor->procurementOfficerApprover->last_name : 'Not Available' }}
                                </td>
                            </tr>
                            <tr>
                                 <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-50">Procurement Officer Approval Date</th>
                                <td class="w-3/4 px-4 py-2">
                                    @if($vendor->procurement_officer_approval_date)
                                        {{ \Carbon\Carbon::parse($vendor->procurement_officer_approval_date)->timezone('Asia/Manila')->format('M d, Y | h:i A') }}
                                    @else
                                        Not Set
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                 <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-50">Procurement Head</th>
                                <td class="w-3/4 px-4 py-2">
                                    {{ $vendor->procurementHeadApprover ? $vendor->procurementHeadApprover->first_name . ' ' . $vendor->procurementHeadApprover->last_name : 'Not Available' }}
                                </td>
                            </tr>
                            <tr>
                                 <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-50">Procurement Head Approval Date</th>
                                <td class="w-3/4 px-4 py-2">
                                    @if($vendor->procurement_head_approval_date)
                                        {{ \Carbon\Carbon::parse($vendor->procurement_head_approval_date)->timezone('Asia/Manila')->format('M d, Y | h:i A') }}
                                    @else
                                        Not Set
                                    @endif
                                </td>
                            </tr>                                                        
                            <!-- Additional rows as needed -->
                        </tbody>
                        </table>
                    </div>
                    <br>
                <!-- Contact Info Section -->
                <h2 class="font-bold mb-2 mt-4 px-6 py-2 text-lg text-gray-900 bg-none dark:bg-gray-700 dark:text-white">Contact Information</h2>
                <hr>
                <br>
                <div class="overflow-x-auto">
                    <table class="border min-w-full text-sm font-light text-surface dark:text-white">
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <!-- Example Row -->
                        <tr>
                        <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-50">Main Contact Person</th>
                        <td class="px-6 py-4 text-left">{{ $vendor->first_name }} {{ $vendor->last_name }} </td>
                        </tr>
                        <tr>
                             <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-50">E-mail Address</th>
                            <td class="px-6 py-4 text-left">{{ $vendor->email }} </td>
                        </tr>
                        <tr>
                             <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-50">Contact No.</th>
                            <td class="px-6 py-4 text-left">{{ $vendor->phone_number }} </td>
                        </tr>
                        <tr>
                             <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-50">Telephone/FAX Number</th>
                            <td class="px-6 py-4 text-left">{{ $vendor->telephone_fax_number }} </td>
                        </tr>
                        <tr>
                             <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-50">Billing Representative</th>
                            <td class="px-6 py-4 text-left">{{ $vendor->billing_representative_first_name }} {{ $vendor->billing_representative_last_name }}  </td>
                        </tr>
                        <tr>
                             <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-50">Billing Representative Email</th>
                            <td class="px-6 py-4 text-left"> {{ $vendor->br_email }}  </td>
                        </tr>
                        <tr>
                             <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-50">Billing Representative Contact No.</th>
                            <td class="px-6 py-4 text-left"> {{ $vendor->br_phone_number }}  </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                </div>
                    <div class="mt-5">
                        @livewire('documents-table', ['userId' => $vendor->id])
                    </div>
                    <div class="mt-6 flex justify-between items-center">
                        <!-- Left-aligned Back to Pending Vendors Button -->
                        <a href="{{ route('admin.vendors.index') }}" class="ml-5 mb-5 inline-flex items-center px-4 py-2 bg-white border border-transparent rounded-md font-semibold text-xs text-gray-900 uppercase tracking-widest hover:bg-gray-100 active:bg-gray-100 focus:outline-none focus:border-none focus:ring ring-gray-50 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Back to Approved Vendors
                        </a>
                </div>
                </div>
        </div>
    </div>
</x-app-layout>
