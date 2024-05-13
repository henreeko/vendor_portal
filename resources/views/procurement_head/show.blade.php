<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendor Details') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">                   
                <!-- Header with Date and Menu Bar -->
                <!-- table -->
                <h1 class="text-lg font-bold my-2 ml-2">Overview</h1>
                <hr>
                <div class="container mx-auto p-4">
                    <table class="min-w-full table-auto border-collapse border border-gray-300">
                        <tbody>
                            <tr class="border-b">
                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Name:</td>
                                <td class="w-3/4 px-4 py-2">{{ $vendor->first_name }} {{ $vendor->last_name }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Email:</td>
                                <td class="w-3/4 px-4 py-2">{{ $vendor->email }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Company Name:</td>
                                <td class="w-3/4 px-4 py-2">{{ $vendor->company_name }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Supplier Type:</td>
                                <td class="w-3/4 px-4 py-2">{{ $vendor->supplier_type }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Business Type:</td>
                                <td class="w-3/4 px-4 py-2">{{ $vendor->businessType->name ?? 'N/A' }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Products/Services:</td>
                                <td class="w-3/4 px-4 py-2">{{ $vendor->products_or_services }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Approved By:</td>
                                <td class="w-3/4 px-4 py-2"> {{ $vendor->procurementOfficerApprover ? $vendor->procurementOfficerApprover->first_name . ' ' . $vendor->procurementOfficerApprover->last_name : 'Not Available' }}</td>
                            </tr>
                            <tr class="border-b">
                                <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Approval Date:</td>
                                <td class="w-3/4 px-4 py-2">
                                    @if($vendor->procurement_officer_approval_date)
                                    {{ \Carbon\Carbon::parse($vendor->procurement_officer_approval_date)->timezone('Asia/Manila')->format('M d, Y | h:i A') }}
                                    @else
                                        Not Set
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--end of the table-->
                <div>
                    <h1 class="text-lg font-bold my-2 ml-2"> Documents </h1>
                </div>
                <hr class="mb-5">
                                
                    <div>
                        @livewire('documents-table', ['userId' => $vendor->id])
                    </div>
                    
                    <div class="mt-6 flex justify-between items-center">
                        <!-- Left-aligned Back to Pending Vendors Button -->
                        <a href="{{ route('procurement_head.vendors.pending') }}" class="inline-flex items-center px-4 py-2 bg-white border border-transparent rounded-md font-semibold text-xs text-gray-900 uppercase tracking-widest hover:bg-gray-100 active:bg-gray-100 focus:outline-none focus:border-none focus:ring ring-gray-50 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Back to Pending Vendors
                        </a>
                    
                        
                        <!-- Right-aligned Approve and Reassess Buttons -->
                        <div class="flex space-x-4">
                            <form method="POST" action="{{ route('procurement_head.approve', $vendor->id) }}" class="inline">
                                @csrf
                                <button id="approvalButton" type="button" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Approve
                                </button>
                            </form>
                        
                            <div x-data="{ showModal: false }">
                                <!-- Trigger Button -->
                                <button @click="showModal = true" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-800 focus:outline-none focus:border-yellow-900 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Reassess Vendor
                                </button>
                            
                                <!-- Modal -->
                                <div x-show="showModal" class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                        <!-- Background Overlay -->
                                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showModal = false" aria-hidden="true"></div>
                            
                                        <!-- Modal Panel -->
                                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                <div class="sm:flex sm:items-start">
                                                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-yellow-500 sm:mx-0 sm:h-10 sm:w-10">
                                                        <!-- Icon -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                                          </svg>                                                          
                                                    </div>
                                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                                        <div class="mt-2">
                                                            <form method="POST" action="{{ route('procurement_head.reassess', $vendor->id) }}">
                                                                @csrf
                                                                <textarea name="reassessment_message" rows="3" class="form-textarea mt-1 p-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-300 focus:ring focus:ring-gray-200 focus:ring-opacity-50" placeholder="Please enter the reassessment reason here..." required></textarea>
                                                                <div class="mt-4 flex justify-end">
                                                                    <button type="button" @click="showModal = false" class="mr-3 inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                                                        Cancel
                                                                    </button>
                                                                    <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-yellow-500 border border-transparent rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                                                        Submit
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                       
                                <!-- Custom Approval Modal -->
<div id="approvalModal" class="hidden fixed inset-0 z-30 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay, close modal on click -->
        <div class="fixed inset-0 transition-opacity" onclick="toggleModal('approvalModal', false)">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- Modal content -->
        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-green-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                        <!-- Heroicon name: check -->
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-headline">
                            Confirm Approval
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm leading-5 text-gray-500">
                                Are you sure you want to approve this vendor? This action cannot be undone.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                    <button type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green sm:text-sm sm:leading-5" onclick="submitApprovalForm()">
                        Approve
                    </button>
                </span>
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                    <button type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium leading-6 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue sm:text-sm sm:leading-5" onclick="toggleModal('approvalModal', false)">
                        Cancel
                    </button>
                </span>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to toggle modal visibility
    function toggleModal(modalId, show) {
        const modal = document.getElementById(modalId);
        modal.style.display = show ? 'block' : 'none';
    }
    
    // Function to submit the approval form
    function submitApprovalForm() {
        document.querySelector('form[action="{{ route('procurement_head.approve', $vendor->id) }}"]').submit();
        toggleModal('approvalModal', false); // Close modal after submit
    }
    
    // Optional: add event listener for the approval button
    document.getElementById('approvalButton').addEventListener('click', function() {
        toggleModal('approvalModal', true);
    });
    </script>

                    <!--buttons end-->
                    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                    function confirmApproval(buttonElement) {
                        console.log("Confirm Approval Called"); // Debug statement
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You are about to approve this vendor to become an official vendor.",
                            showCancelButton: true,
                            confirmButtonColor: '#22c55e',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, approve it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                console.log("Approval Confirmed"); // Debug statement
                                buttonElement.closest('form').submit();
                            }
                        });
                    }

                    function confirmReassessment(buttonElement) {
                        console.log("Confirm Reassessment Called"); // Debug statement
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "This action will reset the approval status of the vendor.",
                            showCancelButton: true,
                            confirmButtonColor: '#eab308',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, reassess!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                console.log("Reassessment Confirmed"); // Debug statement
                                buttonElement.closest('form').submit();
                            }
                        });
                    }
                    </script> --}}
                              
</x-app-layout>