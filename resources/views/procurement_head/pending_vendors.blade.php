{{-- views/procurement_head/pending_vendors.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Pending Vendor Approvals') }}
        </h2>
    </x-slot>
    <div class="py-1">
        <div class="my-5 ml-5 mr-5 relative overflow-x-auto shadow-md sm:rounded-lg">
            @if ($pendingVendors->isEmpty())  {{-- Start of if statement --}}
                <p class="text-center bg-red-500 font-bold text-white">No vendors currently awaiting approval.</p>
            @else  {{-- Else for if statement --}}
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-sm text-white uppercase bg-gray-900 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Company Name</th>
                            <th scope="col" class="px-6 py-3">Supplier Type</th>
                            <th scope="col" class="px-6 py-3">Business Type</th>
                            <th scope="col" class="px-6 py-3">Products and Services</th>
                            <th scope="col" class="px-6 py-3">Approved By Officer</th>
                            <th scope="col" class="px-6 py-3">Approval Date</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white text-gray-900 divide-y divide-gray-400">
                        @foreach ($pendingVendors as $vendor)  {{-- Start of foreach --}}
                            <tr class="hover:bg-gray-50">
                                <td class="px-5 py-5 border-b border-gray-200 text-md">{{ $vendor->id }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 text-md">{{ $vendor->company_name }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 text-md">{{ $vendor->supplier_type }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 text-md">{{ $vendor->businessType->name ?? 'N/A' }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 text-md">{{ $vendor->products_or_services }}</td>
                                <td class="px-5 py-5 border-b border-gray-200 text-md">
                                    {{ $vendor->procurementOfficerApprover ? $vendor->procurementOfficerApprover->first_name . ' ' . $vendor->procurementOfficerApprover->last_name : 'Not Available' }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-md">
                                    {{ $vendor->procurement_officer_approval_date ? \Carbon\Carbon::parse($vendor->procurement_officer_approval_date)->format('M d, Y') : 'Not Set' }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 text-md">
                                    <a href="{{ route('procurement_head.vendors.show', $vendor->id) }}" class="text-blue-500 hover:text-blue-700">View</a>
                                </td>
                            </tr>
                        @endforeach  {{-- End of foreach --}}
                    </tbody>
                </table>

            @endif  {{-- End of if statement --}}
        </div>
                            <!-- Pagination Links -->
                            <div class="mt-4 ml-5 mr-5">
                                {{ $pendingVendors->links() }}
                            </div>
    </div>
</div>

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

@if(session('error'))
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'error',
        title: "{{ session('error') }}",
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
