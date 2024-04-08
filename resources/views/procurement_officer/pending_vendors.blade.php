<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pending Vendors for Approval') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    @if ($pendingVendors->isEmpty())
                        <div class="text-white">No vendors are currently awaiting approval.</div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-700 text-white">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                            id
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                            Business Details
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-700 divide-y divide-gray-600 text-white">
                                    @foreach ($pendingVendors as $vendor)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $vendor->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $vendor->first_name }} {{ $vendor->last_name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $vendor->email }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                {{ $vendor->business_type }} <br>
                                                {{ $vendor->products_or_services }}
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="#" class="text-indigo-400 hover:text-indigo-600">View Details</a>
                                                <form action="{{ route('procurement_officer.approve_vendor', $vendor->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="button" onclick="confirmApprovalOfficer(this)" data-url="{{ route('procurement_officer.approve_vendor', $vendor->id) }}" class="ml-4 bg-indigo-600 hover:bg-indigo-800 text-white py-2 px-4 rounded">
                                                        Approve
                                                    </button>
                                                    
                                                </form>
                                                <button class="ml-4 bg-yellow-500 hover:bg-yellow-700 text-white py-2 px-4 rounded">
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


