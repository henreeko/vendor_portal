<div class="ml-5 mr-5 relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class= "w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-white uppercase bg-gray-900">
            <tr>
                <th scope="col" class="px-6 py-3 w-1/12">
                    <input type="checkbox" class="w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 rounded focus:ring-gray-500" wire:model="selectAll">
                </th>                
                <th scope="col" class="px-6 py-3 w-1/12">ID</th>
                <th scope="col" class="px-6 py-3 w-1/12">Vendor</th>
                <th scope="col" class="px-6 py-3 w-1/12">Email</th>
                <th scope="col" class="px-6 py-3 w-1/12">Location</th>
                <th scope="col" class="px-6 py-3 w-1/12">Business Type</th>
                <th scope="col" class="px-6 py-3 cursor-pointer w-1/12" wire:click="toggleSortDirection('created_at')">
                    Registered
                    @if ($sortField === 'created_at')
                        <span>{!! $sortDirection === 'asc' ? '&#9650;' : '&#9660;' !!}</span>
                    @endif
                </th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Actions</th>    
            </tr>
        </thead>
        <tbody>
            @foreach($vendors as $vendor)
            <tr class="dark:text-white bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4">
                    <input type="checkbox" class="w-4 h-4 text-gray-600 bg-gray-100 border-gray-300 rounded focus:ring-gray-500" wire:model="selectedVendors" value="{{ $vendor->id }}">
                </td>
                <td class="px-6 py-4">{{ $vendor->id }}</td>              
                <td class="px-6 py-4">
                    <div class="font-medium text-gray-900 dark:text-white">{{ $vendor->company_name }}</div>
                    <div class="text-sm text-blue-500">{{ $vendor->supplier_type }}</div>
                </td>
                <td class="px-6 py-4">{{ $vendor->email }}</td>
                <td class="px-6 py-4">{{ $vendor->office_city }}</td>
                <td class="px-6 py-4">{{ $vendor->business_type_id }}</td>
                <td class="px-6 py-4 text-xs font-bold">{{ $vendor->created_at->timezone('Asia/Manila')->format('m-d-Y') }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 me-2"></div> Active
                    </div>
                </td>
                

{{-- START OF SLIDE OVER--}}
<td class="px-6 py-4">
    <div x-data="{ slideOverOpen: false }" class="relative z-50 w-auto h-auto">
        <button @click="slideOverOpen=true" class="inline-flex items-center justify-center h-10 px-4 py-2 text-sm font-medium transition-colors bg-white border rounded-md hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none focus:ring-2 focus:ring-neutral-200/60 focus:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none dark:text-gray-900">View</button>
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
                                                            <td class="px-6 py-4 text-left">{{ $vendor->business_type_id }} </td>
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
                                                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Approved By</th>
                                                            <td class="px-6 py-4 text-left">{{ $vendor->approver ? $vendor->approver->first_name . ' ' . $vendor->approver->last_name : 'Not Available' }} </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="px-6 py-4 text-left bg-gray-50 dark:bg-gray-100">Approval Date</th>
                                                            <td class="px-6 py-4 text-left">@if($vendor->procurement_officer_approval_date)
                                                                {{ \Carbon\Carbon::parse($vendor->procurement_officer_approval_date)->format('m-d-Y | h:i A') }}
                                                            @else
                                                                Not Set
                                                            @endif </td>
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
                                                </div>
                                                @include('livewire.partials.documents-table')
                                            </div>
                                        </div>
                                    </div>
                                    <div>
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
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<br>