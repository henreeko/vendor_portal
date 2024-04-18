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
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">
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
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{-- {{ $vendor->(business_type_name) }} <br> --}}
                                                <small>{{ $vendor->products_or_services }}<small>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $vendor->created_at->timezone('Asia/Manila')->format('m/d/Y') }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('vendors.show_details', $vendor->id) }}" class="ml-4 bg-white-600 hover:bg-blue-300 text-gray-600 border py-2 px-4 rounded">View</a>
                                                <form action="{{ route('procurement_officer.approve_vendor', $vendor->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="button" onclick="confirmApprovalOfficer(this)" data-url="{{ route('procurement_officer.approve_vendor', $vendor->id) }}" class="ml-4 bg-white-600 hover:bg-green-300 text-gray-600 border py-2 px-4 rounded">
                                                        Approve
                                                    </button>
                                                    
                                                </form>
                                                <button class="ml-4 bg-white-600 hover:bg-yellow-200 text-gray-600 border py-2 px-4 rounded">
                                                    For Pending
                                                </button>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmApprovalOfficer(button) {
            const url = button.getAttribute('data-url');
        
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to approve this vendor for preliminary assessment. Once approved, the vendor will be forwarded to the procurement head for final approval.",
                showCancelButton: true,
                confirmButtonColor: '#262121',
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



