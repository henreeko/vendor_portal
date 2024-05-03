{{-- START OF SLIDE OVER --}}
<td class="px-6 py-4">
    <div x-data="{ slideOverOpen: false }" class="relative z-50 w-auto h-auto">
        <button @click="slideOverOpen=true" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium tracking-wide text-blue-500 transition-colors duration-100 rounded-md focus:ring-2 focus:ring-offset-2 focus:ring-blue-100 bg-blue-50 hover:text-blue-600 hover:bg-blue-100"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
            <path d="M10 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
            <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 0 1 0-1.186A10.004 10.004 0 0 1 10 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0 1 10 17c-4.257 0-7.893-2.66-9.336-6.41ZM14 10a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z" clip-rule="evenodd" />
          </svg>
          @if($vendor->has_expired_documents)
          <div class="absolute inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-0 dark:border-gray-900"></div>
          @endif
        </button>
        <template x-teleport="body">
            <div x-show="slideOverOpen" @keydown.window.escape="slideOverOpen=false" class="relative z-[99]">
                <div x-show="slideOverOpen" x-transition.opacity.duration.600ms @click="slideOverOpen = false" class="fixed inset-0 bg-black bg-opacity-10"></div>
                <div class="fixed inset-0 overflow-hidden">
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="fixed inset-y-0 right-0 flex max-w-full pl-10">
                            <div x-show="slideOverOpen" @click.away="slideOverOpen = false" x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" class="w-screen max-w-2xl"> <!-- Changed from max-w-md to max-w-2xl for wider screen -->
                                <div class="flex flex-col h-full py-5 bg-white border-l shadow-lg border-neutral-100/70">
                                    <div class="px-4 sm:px-5">
                                        <div class="flex items-start justify-between pb-1">
                                            <h2 class="text-2xl font-semibold leading-6 text-gray-800" id="slide-over-title">{{ $vendor->company_name }}</h2>
                                            {{-- menu bar --}}
                                            <div>
                                                @include('livewire.partials.menu-bar')
                                            </div>
                                            
                                            <div class="flex items-center h-auto ml-3">
                                                <button @click="slideOverOpen=false" class="absolute top-0 right-0 z-30 flex items-end justify-center px-3 py-2 mt-4 mr-5 space-x-1 text-xs font-medium uppercase rounded-md border-neutral-200 text-neutral-600 hover:bg-neutral-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="relative flex-1 px-4 sm:px-6">
                                        <div class="absolute inset-0 px-4 sm:px-6">
                                            <div class="h-full overflow-y-auto" aria-hidden="true">
                                            {{-- TABLE --}}
                                            <div class="flex flex-col">
                                                <div class="py-4">
                                                <!-- Overview Section -->
                                                <h2 class="px-6 py-2 text-lg font-semibold text-gray-900 bg-none dark:bg-gray-700 dark:text-white">Overview</h2>
                                                <hr>
                                                <br>
                                                <div class="overflow-x-auto">
                                                    <table class="border min-w-full text-sm font-light text-surface dark:text-gray-700">
                                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                                        <tr>
                                                        <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Company Name</th>
                                                        <td class="px-6 py-4 text-left">{{ $vendor->company_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Supplier Type</th>
                                                            <td class="px-6 py-4 text-left">{{ $vendor->supplier_type }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Business Type</th>
                                                            <td class="px-6 py-4">{{ $vendor->businessType->name ?? 'N/A' }}</td>                                                            
                                                        </tr>
                                                        <tr>
                                                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Product/Services</th>
                                                            <td class="px-6 py-4 text-left">{{ $vendor->products_or_services }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Office Address</th>
                                                            <td class="px-6 py-4 text-left">{{ $vendor->office_city}} <br> <small> {{ $vendor->office_street}} {{ $vendor->office_barangay}} {{ $vendor->office_zip}} </small></td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">TIN Number</th>
                                                            <td class="px-6 py-4 text-left">{{ $vendor->tin_number }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Website URL</th>
                                                            <td class="px-6 py-4 text-left">{{ $vendor->website_url }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Relationship since</th>
                                                            <td class="px-6 py-4 text-left">{{ $vendor->created_at->timezone('Asia/Manila')->format('m-d-Y-A') }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Procurement Officer Approver</th>
                                                            <td class="px-6 py-4 text-left">
                                                                {{ $vendor->procurementOfficerApprover ? $vendor->procurementOfficerApprover->first_name . ' ' . $vendor->procurementOfficerApprover->last_name : 'Not Available' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Procurement Officer Approval Date</th>
                                                            <td class="px-6 py-4 text-left">
                                                                @if($vendor->procurement_officer_approval_date)
                                                                    {{ \Carbon\Carbon::parse($vendor->procurement_officer_approval_date)->timezone('Asia/Manila')->format('M d, Y | h:i A') }}
                                                                @else
                                                                    Not Set
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Procurement Head</th>
                                                            <td class="px-6 py-4 text-left">
                                                                {{ $vendor->procurementHeadApprover ? $vendor->procurementHeadApprover->first_name . ' ' . $vendor->procurementHeadApprover->last_name : 'Not Available' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Procurement Head Approval Date</th>
                                                            <td class="px-6 py-4 text-left">
                                                                @if($vendor->procurement_head_approval_date)
                                                                    {{ \Carbon\Carbon::parse($vendor->procurement_head_approval_date)->timezone('Asia/Manila')->format('M d, Y | h:i A') }}
                                                                @else
                                                                    Not Set
                                                                @endif
                                                            </td>
                                                        </tr>                                                        
                                                        <!-- Additional rows as needed -->
                                                    </tbody>
                                                    </table>
                                                </div>
                                            
                                                <!-- Contact Info Section -->
                                                <h2 class="mt-4 px-6 py-2 text-lg font-semibold text-gray-900 bg-none dark:bg-gray-700 dark:text-white">Contact Information</h2>
                                                <hr>
                                                <br>
                                                <div class="overflow-x-auto">
                                                    <table class="border min-w-full text-sm font-light text-surface dark:text-white">
                                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                                        <!-- Example Row -->
                                                        <tr>
                                                        <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-800">Main Contact Person</th>
                                                        <td class="px-6 py-4 text-left">{{ $vendor->first_name }} {{ $vendor->last_name }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">E-mail Address</th>
                                                            <td class="px-6 py-4 text-left">{{ $vendor->email }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Contact No.</th>
                                                            <td class="px-6 py-4 text-left">{{ $vendor->phone_number }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Telephone/FAX Number</th>
                                                            <td class="px-6 py-4 text-left">{{ $vendor->telephone_fax_number }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Billing Representative</th>
                                                            <td class="px-6 py-4 text-left">{{ $vendor->billing_representative_first_name }} {{ $vendor->billing_representative_last_name }}  </td>
                                                        </tr>
                                                    </tbody>
                                                    </table>
                                                </div>
                                                </div>
                                                <!-- DOCS TABLE -->
                                                <div>
                                                @livewire('documents-table', ['userId' => $vendor->id])
                                                </div>
                                                <!-- END OF DOCS TABLE -->
                                                                    </div>
                                                                </div>
                                                            <div>
                                                        </div>
                                                    </div>
                                            {{-- END OF THE TABLE --}}
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</td>
{{-- END OF SLIDE OVER--}}                                                