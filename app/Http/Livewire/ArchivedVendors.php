<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class ArchivedVendors extends Component
{
    public $search = '';
    public $selectedVendors = [];
    public $selectAll = false;

    public function render()
    {
        $archivedVendors = User::where('archived', true)
                            ->where(function($query) {
                                $query->where('company_name', 'like', '%' . $this->search . '%')
                                      ->orWhere('email', 'like', '%' . $this->search . '%');
                            })
                            ->paginate(10);

        if ($this->selectAll) {
            $this->selectedVendors = $archivedVendors->pluck('id')->toArray();
        }

        return view('livewire.vendor-archiver', ['archivedVendors' => $archivedVendors]);
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
