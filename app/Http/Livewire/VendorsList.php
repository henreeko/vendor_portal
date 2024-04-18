<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use App\Models\BusinessType;

class VendorsList extends Component
{
    use WithPagination;

    public $businessTypes = [];
    public $selectAll = false; // Declaration of the selectAll property
    public $selectedVendors = [];
    public $openDropdown = false; // Ensure this is declared
    public $supplierType = '';
    public $sortOption = '';
    public $search = '';
    public $sortField = 'created_at'; // Default sort field
    public $sortDirection = 'desc'; // Default sort direction
    protected $paginationTheme = 'tailwind';
    protected $queryString = ['selectedDate','search'];
    public $businessTypeFilter = '';
    public $selectedDate = null;

    public $showModal = false;
    public $selectedVendorId;


    public function mount()
    {
        $this->businessTypes = BusinessType::all(); // Load business types from the database
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedVendors = $this->getFilteredVendors()->pluck('id')->toArray();
        } else {
            $this->selectedVendors = [];
        }
    }

    public function updatedSelectedVendors()
    {
        $this->selectAll = count($this->selectedVendors) === count($this->getFilteredVendors()->pluck('id')->toArray());
    }

    public function selectAllVendors()
    {
        $this->selectAll = true;
        $this->updatedSelectAll(true);
    }

    public function deselectAllVendors()
    {
        $this->selectAll = false;
        $this->updatedSelectAll(false);
    }

    public function toggleDropdown()
    {
        $this->openDropdown = !$this->openDropdown;
    }

    public function closeDropdown()
    {
        $this->openDropdown = false;
    }
    
    public function setSupplierType($type)
    {
        $this->supplierType = $type;
        $this->openDropdown = false;
        $this->resetPage(); // Reset pagination or other dependent data
    }

    protected function normalizeSortDirection()
    {
        if (!in_array($this->sortDirection, ['asc', 'desc'])) {
            $this->sortDirection = 'desc'; // Default to 'desc' if invalid
        }
    }

    public function applySort($sortOption)
    {
        if (!empty($sortOption)) {
            [$field, $direction] = explode('_', $sortOption);
            $this->sortField = $field;
            $this->sortDirection = $direction;
        } else {
            // Reset to default sort if no option is selected
            $this->sortField = 'created_at';
            $this->sortDirection = 'desc';
        }

        $this->resetPage(); // Optionally reset pagination
    }

    public function resetFilters()
    {
        $this->reset(['search', 'selectedDate', 'businessTypeFilter', 'supplierType']);

            // Reset sorting to default
        $this->sortField = 'created_at';
        $this->sortDirection = 'desc';
    }

    public function toggleSelectAll()
    {
        if (count($this->selectedVendors) === count($this->getFilteredVendors()->pluck('id')->toArray())) {
            $this->selectedVendors = [];
        } else {
            $this->selectedVendors = $this->getFilteredVendors()->pluck('id')->toArray();
        }
    }

    public function exportSelected()
    {
        // Export logic for selected vendors
        $this->dispatchBrowserEvent('notify', 'Exporting selected vendors.');
    }

    public function archiveSelected()
    {
        // Archive logic for selected vendors
        User::whereIn('id', $this->selectedVendors)->update(['archived' => true]);
        $this->selectedVendors = [];
        $this->dispatchBrowserEvent('notify', 'Selected vendors have been archived.');
    }
    
    public function performBulkAction()
    {
        // Example action on selected vendors
        // Modify based on your needs, e.g., deactivate selected vendors
        User::whereIn('id', $this->selectedVendors)->update(['status' => 'inactive']);
        $this->selectedVendors = []; // Reset after action
        $this->emit('vendorActionDone'); // Optional: emit event for notifications
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function toggleSortDirection($field)
    {
        if ($this->sortField === $field) {
            // Toggle the sort direction for the current field
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // If changing the sort field, reset the direction to 'asc' for all except 'created_at', which defaults to 'desc'
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    
        $this->resetPage(); // Optionally reset pagination
    }

    public function sortByCompanyNameAtoZ()
    {
        $this->sortField = 'company_name';
        $this->sortDirection = 'asc';
        $this->resetPage(); // Resets pagination to the first page.
    
        // Emit a browser event that Alpine.js will listen for
        $this->dispatchBrowserEvent('notify-sort', ['message' => 'Sorted A-Z by Company Name']);
    }
    

    public function showVendorModal($vendorId)
    {
        $this->emitTo('vendor-details-modal', 'show', $vendorId);
    }

    public function updatingBusinessTypeFilter()
    {
        $this->resetPage();
    }

    public function updatingSelectedDate()
    {
        $this->resetPage();
    }

    public function toggleVendorSelection($vendorId)
    {
        if (in_array($vendorId, $this->selectedVendors)) {
            $this->selectedVendors = array_filter($this->selectedVendors, function ($id) use ($vendorId) {
                return $id != $vendorId;
            });
        } else {
            $this->selectedVendors[] = $vendorId;
        }
    }

    private function getFilteredVendors()
{
    return User::query()
        ->where('usertype', 'vendor')
        ->where('procurement_officer_approval', 'approved')
        ->where('procurement_head_approval', 'approved')
        ->when($this->businessTypeFilter, function($query) {
            $query->where('business_type_id', $this->businessTypeFilter);
        })
        ->when($this->selectedDate, function ($query) {
            $query->whereDate('created_at', $this->selectedDate);
        })
        ->when($this->supplierType, function ($query) {
            $query->where('supplier_type', $this->supplierType);
        })
        ->where(function ($query) {
            $query->where('company_name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('first_name', 'like', '%' . $this->search . '%')
                  ->orWhere('last_name', 'like', '%' . $this->search . '%');

            if (strpos($this->search, ' ') !== false) {
                $names = explode(' ', $this->search);
                if (count($names) === 2) {
                    $query->orWhere(function ($q) use ($names) {
                        $q->where('first_name', 'like', '%' . $names[0] . '%')
                          ->where('last_name', 'like', '%' . $names[1] . '%');
                    });
                }
            }

            $query->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$this->search}%"]);
        })
        ->orderBy($this->sortField, $this->sortDirection)
        ->when($this->sortField !== 'created_at', function ($query) {
            return $query->orderBy('created_at', 'desc');
        });
}

public function render()
{
    $vendors = $this->getFilteredVendors()->paginate(10);

    return view('livewire.vendors-list', [
        'vendors' => $vendors
    ]);
}
}