<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-gray-800 p-3 rounded">
            {{ __('Pending Vendor Approvals') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-700 border-b border-gray-600">
                    @if ($pendingVendors->isEmpty())
                        <p class="text-white">No vendors currently awaiting approval.</p>
                    @else
                        <table class="min-w-full leading-normal">
                            <thead class="bg-gray-600 text-white">
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-500 text-left text-xs font-semibold uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-500 text-left text-xs font-semibold uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-500 text-left text-xs font-semibold uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-800 text-white divide-y divide-gray-600">
                                @foreach ($pendingVendors as $vendor)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-600 text-sm">
                                            <div class="flex items-center">
                                                <div class="ml-3">
                                                    <p class="whitespace-no-wrap">
                                                        {{ $vendor->first_name }} {{ $vendor->last_name }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-600 text-sm">
                                            <p class="whitespace-no-wrap">{{ $vendor->email }}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-600 text-sm">
                                            <a href="#" class="text-blue-400 hover:text-blue-500">View Details</a> <!-- Placeholder action -->
                                            <form action="{{ route('procurement_head.approve', $vendor->id) }}" method="POST" class="inline">
                                                @csrf
                                        <!-- Approve Button -->
                                        <button type="button" onclick="confirmApproval(this)" data-url="{{ route('procurement_head.approve', $vendor->id) }}" class="ml-4 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                                            Approve
                                        </button>                      
                                            </form>
                                            <!-- Static Reject Button -->
                                        <button class="ml-4 bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">
                                        Reject
                                        </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
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
            // Create and submit a form to POST to the approval URL
            let form = document.createElement('form');
            form.action = approvalUrl;
            form.method = 'POST';

            // Add CSRF token to the form
            let csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            form.appendChild(csrfInput);

            document.body.appendChild(form);
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
