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
                                <button class="rounded text-sm cursor-default flex items-center leading-tight justify-center px-3 py-1.5 h-full hover:bg-neutral-100">Action 1</button>
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
                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Company Name</th>
                            <td class="px-6 py-4 text-left">{{ $vendor->company_name }}</td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Supplier Type</th>
                                <td class="px-6 py-4 text-left text-blue-500">{{ $vendor->supplier_type }} </td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Business Type</th>
                                <td class="px-6 py-4">{{ $vendor->businessType->name ?? 'N/A' }}</td>                                                            
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Product/Services</th>
                                <td class="px-6 py-4 text-left">{{ $vendor->products_or_services }} </td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Office Address</th>
                                <td class="px-6 py-4 text-left">{{ $vendor->office_city}} <br> <small> {{ $vendor->office_street}} {{ $vendor->office_barangay}} {{ $vendor->office_zip}} </small></td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">TIN Number</th>
                                <td class="px-6 py-4 text-left">{{ $vendor->tin_number }} </td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Website URL</th>
                                <td class="px-6 py-4 text-left">{{ $vendor->website_url }} </td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Relationship since</th>
                                <td class="px-6 py-4 text-left">{{ $vendor->created_at->timezone('Asia/Manila')->format('m-d-Y-A') }} </td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Procurement Officer Approver</th>
                                <td class="px-6 py-4 text-left">
                                    {{ $vendor->procurementOfficerApprover ? $vendor->procurementOfficerApprover->first_name . ' ' . $vendor->procurementOfficerApprover->last_name : 'Not Available' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Procurement Officer Approval Date</th>
                                <td class="px-6 py-4 text-left">
                                    @if($vendor->procurement_officer_approval_date)
                                        {{ \Carbon\Carbon::parse($vendor->procurement_officer_approval_date)->timezone('Asia/Manila')->format('M d, Y | h:i A') }}
                                    @else
                                        Not Set
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Procurement Head</th>
                                <td class="px-6 py-4 text-left">
                                    {{ $vendor->procurementHeadApprover ? $vendor->procurementHeadApprover->first_name . ' ' . $vendor->procurementHeadApprover->last_name : 'Not Available' }}
                                </td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Procurement Head Approval Date</th>
                                <td class="px-6 py-4 text-left">
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
                <h2 class="mt-4 px-6 py-2 text-lg font-semibold text-gray-900 bg-none dark:bg-gray-700 dark:text-white">Contact Information</h2>
                <hr>
                <br>
                <div class="overflow-x-auto">
                    <table class="border min-w-full text-sm font-light text-surface dark:text-white">
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <!-- Example Row -->
                        <tr>
                        <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-800">Main Contact Person</th>
                        <td class="px-6 py-4 text-left">{{ $vendor->first_name }} {{ $vendor->last_name }} </td>
                        </tr>
                        <tr>
                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">E-mail Address</th>
                            <td class="px-6 py-4 text-left">{{ $vendor->email }} </td>
                        </tr>
                        <tr>
                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Contact No.</th>
                            <td class="px-6 py-4 text-left">{{ $vendor->phone_number }} </td>
                        </tr>
                        <tr>
                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Telephone/FAX Number</th>
                            <td class="px-6 py-4 text-left">{{ $vendor->telephone_fax_number }} </td>
                        </tr>
                        <tr>
                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Billing Representative</th>
                            <td class="px-6 py-4 text-left">{{ $vendor->billing_representative_first_name }} {{ $vendor->billing_representative_last_name }}  </td>
                        </tr>
                        <tr>
                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Billing Representative Email</th>
                            <td class="px-6 py-4 text-left"> {{ $vendor->br_email }}  </td>
                        </tr>
                        <tr>
                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Billing Representative Contact No.</th>
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
