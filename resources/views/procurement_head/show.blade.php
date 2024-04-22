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
                    <h1 class="text-lg font-bold my-2 ml-2"> Overview </h1>
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
                                <tr>
                                    <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Approved By:</td>
                                    <td class="w-3/4 px-4 py-2">{{ $vendor->approver ? $vendor->approver->first_name . ' ' . $vendor->approver->last_name : 'Not Available' }}</td>
                                </tr>
                                <tr>
                                    <td class="w-1/4 px-4 py-2 border-r font-bold bg-gray-100">Approval Date:</td>
                                    <td class="w-3/4 px-4 py-2">@if($vendor->procurement_officer_approval_date)
                                    {{ \Carbon\Carbon::parse($vendor->procurement_officer_approval_date)->format('M d, Y | h:i A') }}</td>
                                @else
                                    Not Set
                                @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>                    

                    <!--end of the table-->
                                
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
                                <button type="button" onclick="event.stopPropagation(); confirmApproval(this);" data-url="{{ route('procurement_head.approve', $vendor->id) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Approve
                                </button>
                            </form>
                            <button onclick="event.preventDefault();" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-800 focus:outline-none focus:border-yellow-900 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Reassess
                            </button>
                        </div>
                    </div>                    
                    <!--buttons end-->

                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    <script>
                        function confirmApproval(buttonElement) {
                            const approvalUrl = buttonElement.getAttribute('data-url');
                
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You are about to approve this vendor to be an official vendor of PCSPC.",
                                showCancelButton: true,
                                confirmButtonColor: '#262121',
                                cancelButtonColor: '#ef4c40',
                                confirmButtonText: 'Yes, Approve'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    let form = buttonElement.closest('form');
                                    form.action = approvalUrl;
                                    form.method = 'POST';
                                    form.submit();
                                }
                            });
                        }
                    </script>
                
                @if(session('success'))
                <script>
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: "{{ session('success') }}",
                        showConfirmButton: false,
                        timer: 2000,
                        toast: true,
                        showCloseButton: true,
                        closeButtonHtml: '&times;',
                        timerProgressBar: true,
                    });
                </script>
                @endif
</x-app-layout>