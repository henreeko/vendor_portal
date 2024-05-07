<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class ArchivedVendors extends Component
{
    public $businessTypes = [];
    public $search = '';
    public $selectedVendors = [];
    public $selectAll = false;
    public $selectedVendorId;

    public function render()
    {
        $archivedVendors = User::with('businessType') // Eager loading businessType
            ->where('archived', true)
            ->where(function ($query) {
                $query->where('company_name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->paginate(6);
    
        if ($this->selectAll) {
            // Manual iteration to collect IDs
            $this->selectedVendors = [];
            foreach ($archivedVendors as $vendor) {
                $this->selectedVendors[] = $vendor->id;
            }
        }
    
        return view('livewire.vendor-archiver', ['archivedVendors' => $archivedVendors]);
    }    

    
    public function updated($propertyName)
    {
        logger("Updated property: $propertyName");
    }


    public function unarchiveSelected()
    {
        $vendors = User::whereIn('id', $this->selectedVendors)->get();
        foreach ($vendors as $vendor) {
            if ($vendor->archived) {
                $vendor->archived = false;
                $vendor->save();
            }
        }
        $this->selectedVendors = []; // Reset selection
        $this->selectAll = false; // Reset the select all checkbox
        $this->emit('vendorsUnarchived'); // Optionally emit an event
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Selected vendors successfully unarchived']);
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectAll = true;
        } else {
            $this->selectedVendors = [];
            $this->selectAll = false;
        }
    }
}
