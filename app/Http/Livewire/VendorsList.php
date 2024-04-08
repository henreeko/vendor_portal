<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class VendorsList extends Component
{
    use WithPagination;

    public $search = '';
    public $sortDirection = 'desc';
    protected $paginationTheme = 'tailwind';
    protected $queryString = ['selectedDate','search'];
    public $businessTypeFilter = '';
    public $selectedDate = null;

    public $showModal = false;
    public $selectedVendorId;

    public function resetFilters()
{
    $this->reset(['search', 'selectedDate', 'businessTypeFilter']);
}

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function toggleSortDirection()
    {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
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

    public function render()
{
    $vendors = User::where('usertype', 'vendor')
        ->where('procurement_officer_approval', 'approved')
        ->where('procurement_head_approval', 'approved')
        ->when($this->businessTypeFilter, function($query) {
            $query->where('business_type', $this->businessTypeFilter);
        })
        ->when($this->selectedDate, function ($query) {
            $query->whereDate('created_at', $this->selectedDate);
        })
        ->when($this->selectedDate, function ($query) {
            $query->whereDate('created_at', $this->selectedDate);
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
        ->orderBy('created_at', $this->sortDirection)
        ->paginate(10);
        
    return view('livewire.vendors-list', compact('vendors'));
}

}
