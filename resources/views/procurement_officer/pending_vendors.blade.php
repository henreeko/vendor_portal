{{-- views\procurement_officer_pending_vendors.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pending Vendors for Approval') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="my-5 ml-5 mr-5 relative overflow-x-auto shadow-md sm:rounded-lg">
                    @if ($pendingVendors->isEmpty())
                    <p class="text-center bg-red-500 font-bold text-white">No vendors currently awaiting approval.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-sm text-white uppercase bg-gray-900 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                            id
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                            Company
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                            Authorized
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                            Business Details
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                            Registered
                                        </th>
                                        <th scope="col" class="px-6 py-3 w-1 text-center text-xs font-medium uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white text-gray-900 divide-y divide-gray-200">
                                    @foreach ($pendingVendors as $vendor)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $vendor->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $vendor->company_name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $vendor->first_name }} {{ $vendor->last_name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $vendor->email }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $vendor->businessType->name ?? 'N/A' }}<br>
                                                <small>{{ $vendor->products_or_services }}</small>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $vendor->created_at->timezone('Asia/Manila')->format('m/d/Y') }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('vendors.show_details', $vendor->id) }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-blue-500 transition-colors duration-100 rounded-md focus:ring-2 focus:ring-offset-2 focus:ring-blue-100 bg-blue-50 hover:text-blue-600 hover:bg-blue-100"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                    <path d="M10 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                                    <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 0 1 0-1.186A10.004 10.004 0 0 1 10 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0 1 10 17c-4.257 0-7.893-2.66-9.336-6.41ZM14 10a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z" clip-rule="evenodd" />
                                                  </svg>
                                                  </a>
                                                <form action="{{ route('procurement_officer.approve_vendor', $vendor->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="button" onclick="confirmApprovalOfficer(this)" data-url="{{ route('procurement_officer.approve_vendor', $vendor->id) }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-green-500 transition-colors duration-100 rounded-md focus:ring-2 focus:ring-offset-2 focus:ring-green-100 bg-green-50 hover:text-green-600 hover:bg-green-100">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                                                          </svg>
                                                          
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>        

    <script>
        function confirmApprovalOfficer(button) {
            const url = button.getAttribute('data-url');
        
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to approve this vendor for preliminary assessment. Once approved, the vendor will be forwarded to the procurement head for final approval.",
                showCancelButton: true,
                confirmButtonColor: '#22c55e',
                cancelButtonColor: '#ef4c40',
                confirmButtonText: 'Yes, Approve'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Create and submit a form to POST to the approval URL
                    let form = document.createElement('form');
                    form.action = url;
                    form.method = 'POST';
                    document.body.appendChild(form);
        
                    // CSRF Token
                    let csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';
                    form.appendChild(csrfInput);
        
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
