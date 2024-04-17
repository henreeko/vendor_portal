<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-gray-800 p-3 rounded">
            {{ __('Pending Vendor Approvals') }}
        </h2>
    </x-slot>
<div class="py-1">
    <div class="my-5 ml-5 mr-5 relative overflow-x-auto shadow-md sm:rounded-lg">
                    @if ($pendingVendors->isEmpty())
                        <p class="text-center bg-red-500 font-bold text-white">No vendors currently awaiting approval.</p>
                    @else
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-sm text-white uppercase bg-gray-700 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Company Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Supplier Type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Business Type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Products and Services
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Approved By
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Approval Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white text-gray-900 divide-y divide-gray-400">
                                @foreach ($pendingVendors as $vendor)
                                    <tr class="hover:bg-gray-200" onclick="window.location.href='{{ route('procurement_head.vendors.show', $vendor->id) }}';" style="cursor:pointer;">
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            {{ $vendor->company_name }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            {{ $vendor->supplier_type }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            {{ $vendor->business_type }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            {{ $vendor->products_or_services }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            {{ $vendor->approver ? $vendor->approver->first_name . ' ' . $vendor->approver->last_name : 'Not Available' }}
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 text-sm">
                                            @if($vendor->procurement_officer_approval_date)
                                            {{ \Carbon\Carbon::parse($vendor->procurement_officer_approval_date)->format('m-d-Y') }}
                                        @else
                                            Not Set
                                        @endif
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
