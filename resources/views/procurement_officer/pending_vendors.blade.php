{{-- views\procurement_officer_pending_vendors.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Pending Vendors for Approval') }}
        </h2>
    </x-slot>
    
    <div class="mt-5 mx-5">
        <form method="GET" action="{{ route('procurement_officer.pending_vendors') }}" class="flex items-center space-x-2">
            <select name="searchBy" class="h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50">
                <option value="company_name">Company Name</option>
                <option value="first_name">First Name</option>
                <option value="last_name">Last Name</option>
                <option value="email">Email</option>
                <option value="business_type">Business Type</option>
                <option value="products_or_services">Products or Services</option>
            </select>
            <input type="text" name="search" placeholder="Search vendors..." class="h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-gray-900 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50" value="{{ $searchQuery }}">
            <button type="submit" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border rounded-md hover:text-gray-900 hover:bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-200/60">
                Search
            </button>
            <a href="{{ route('procurement_officer.pending_vendors') }}" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border rounded-md hover:text-gray-900 hover:bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-200/60">
                Refresh
            </a>
        </form>
                {{-- <!-- Button to filter by reassessment status -->
                <a href="{{ route('procurement_officer.pending_vendors', ['status' => 'reassessment']) }}" class="px-4 py-2 mt-3 inline-block text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-600">
                    Show Reassessment Only
                </a> --}}
    </div>
    
    <div class="py-1">
        <div class="my-5 ml-5 mr-5 relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-900 dark:text-gray-400">
                <thead class="text-sm text-white uppercase bg-gray-900 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Company</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Authorized</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Business Type</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Products or Services</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider flex items-center">
                            <span>Registered</span>
                            @if ($sortBy === 'created_at')
                                @if ($sortDirection === 'asc')
                                    <a href="{{ route('procurement_officer.pending_vendors', ['sortBy' => 'created_at', 'sortDirection' => 'desc']) }}" class="ml-1">
                                        <span>&#9650;</span>                                                        
                                    </a>
                                @else
                                    <a href="{{ route('procurement_officer.pending_vendors', ['sortBy' => 'created_at', 'sortDirection' => 'asc']) }}" class="ml-1">
                                        <span>&#9660;</span>                                                       
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('procurement_officer.pending_vendors', ['sortBy' => 'created_at', 'sortDirection' => 'asc']) }}" class="ml-1">
                                    <svg class="w-[18px] h-[18px] text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M12.832 3.445a1 1 0 0 0-1.664 0l-4 6A1 1 0 0 0 8 11h8a1 1 0 0 0 .832-1.555l-4-6Zm-1.664 17.11a1 1 0 0 0 1.664 0l4-6A1 1 0 0 0 16 13H8a1 1 0 0 0-.832 1.555l4 6Z" clip-rule="evenodd"/>
                                      </svg>                                                      
                                </a>
                            @endif
                        </th>          
                        <th scope="col" class="px-6 py-3 w-1 text-center text-xs font-medium uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-gray-900 divide-y divide-gray-200">
                    @forelse ($pendingVendors as $vendor)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $vendor->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $vendor->company_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $vendor->first_name }} {{ $vendor->last_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $vendor->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $vendor->businessType->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-normal text-xs text-justify">{{ $vendor->products_or_services }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $vendor->created_at->timezone('Asia/Manila')->format('m/d/Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex items-center space-x-2">
                                <a href="{{ route('vendors.show_details', $vendor->id) }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-blue-500 transition-colors duration-100 rounded-md focus:ring-2 focus:ring-offset-2 focus:ring-blue-100 bg-blue-50 hover:text-blue-600 hover:bg-blue-100">
                                    View
                                </a>
                                <form id="approveForm-{{ $vendor->id }}" action="{{ route('procurement_officer.approve_vendor', $vendor->id) }}" method="POST">
                                    @csrf
                                    <button type="button" onclick="openModal({{ $vendor->id }})" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-green-500 transition-colors duration-100 rounded-md focus:ring-2 focus:ring-offset-2 focus:ring-green-100 bg-green-50 hover:text-green-600 hover:bg-green-100">
                                        Approve
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-sm text-red-600">No pending vendors available for approval.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4 mb-5 ml-4 mr-4">
            {{ $pendingVendors->links() }}  <!-- Pagination Links -->
        </div>
    </div>

    <div id="approvalModal" class="hidden fixed inset-0 z-30 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay, close modal on click -->
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75" onclick="toggleModal('approvalModal', false)"></div>
            <!-- Modal content -->
            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-green-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                            <!-- Check icon -->
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
                        <button type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green sm:text-sm sm:leading-5"
                        onclick="confirmApproval()">Approve
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
    


    <!-- Scripts for Modal and Form Submission -->
    <script>
function toggleModal(modalId, show) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = show ? 'block' : 'none';
    } else {
        console.error('Modal element not found');
    }
}

function openModal(formId) {
    currentFormId = 'approveForm-' + formId;
    toggleModal('approvalModal', true);
}

function closeModal() {
    toggleModal('approvalModal', false);
}

function confirmApproval() {
    if (currentFormId) {
        document.getElementById(currentFormId).submit();
    }
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
