{{-- views/procurement_officer/reassessment.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Vendors for Reassessment') }}
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="sm:rounded-lg mb-4">
                <form method="GET" action="{{ route('procurement_officer.reassessment') }}">
                    <div class="flex items-center space-x-2">
                        <input type="text" name="search" placeholder="Search vendors..." class="h-10 px-3 py-2 text-sm bg-white border rounded-md border-neutral-300 ring-offset-background placeholder:text-gray-900 focus:border-neutral-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50">
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border rounded-md hover:text-gray-900 hover:bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-200/60">Search</button>
                        <a href="{{ route('procurement_officer.reassessment') }}" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border rounded-md hover:text-gray-900 hover:bg-neutral-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neutral-200/60">
                            Refresh
                        </a>
                    </div>
                </form>
            </div>
                <!-- Table for displaying vendors -->
                <table class="min-w-full leading-normal relative overflow-x-auto shadow-md sm:rounded-lg">
                    <thead class="bg-gray-900 text-white font-bold">
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">ID</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Company Name</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Contact</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Business Type</th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Products/Services</th>                            
                            <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($vendors as $vendor)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $vendor->id }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $vendor->company_name }}<br>
                                <p class="text-xs text-blue-500">{{ $vendor->supplier_type }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $vendor->email }}<br>
                                <p class="text-xs"> {{ $vendor->phone_number }} </td></p>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $vendor->business_type_id }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $vendor->products_or_services }}</td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <!-- View Details Button -->
                                <button onclick="openModal('modal{{ $vendor->id }}')" class="text-blue-500 hover:text-blue-800">Details</button>
                                <!-- Reapprove Button -->
                                <button onclick="openReapprovalModal('reapprovalModal{{ $vendor->id }}')" class="text-green-500 hover:text-green-800 ml-2">Reapprove</button>
                            </td>
                        </tr>
                        <!-- View Details Modal -->
                        @include('partials.vendor_details_modal', ['vendor' => $vendor])
                        <!-- Reapproval Confirmation Modal -->
                        @include('partials.reapproval_modal', ['vendor' => $vendor])
                        @empty
                        <tr>
                            <td colspan="6" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap text-center text-red-600">No vendors currently awaiting reassessment.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Pagination -->
                <div class="mt-4">
                    {{ $vendors->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
function openModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}
function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function openReapprovalModal(modalId) {
    document.getElementById(modalId).style.display = 'block';
}
function closeReapprovalModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}
function confirmReapproval(id) {
    const baseUrl = '{{ route("procurement_officer.reapprove_vendor", ["vendorId" => "tempId"]) }}';
    const actionUrl = baseUrl.replace('tempId', id);
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = actionUrl;
    const csrfField = document.createElement('input');
    csrfField.type = 'hidden';
    csrfField.name = '_token';
    csrfField.value = '{{ csrf_token() }}';
    form.appendChild(csrfField);
    document.body.appendChild(form);
    form.submit();
}
</script>
