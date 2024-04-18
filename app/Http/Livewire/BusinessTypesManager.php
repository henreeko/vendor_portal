<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BusinessType;

class BusinessTypesManager extends Component
{
    public $businessTypes;
    public $newTypeName = '';
    public $search = '';

    public function mount()
    {
        $this->loadBusinessTypes();
    }

    public function updatedSearch()
    {
        $this->loadBusinessTypes();
    }

    public function loadBusinessTypes()
    {
        logger('Loading business types...');
        $query = BusinessType::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
    
        $this->businessTypes = $query->orderBy('created_at', 'desc')->get();
    }

    public function createBusinessType()
    {
        $this->validate([
            'newTypeName' => [
                'required', // Check if the input is not empty
                'regex:/^[a-zA-Z\s]+$/', // Ensure that the name only contains letters and spaces
                'unique:business_types,name' // Ensure the name is unique in the database
            ],
        ], [
            'newTypeName.required' => 'The business type name is required.',
            'newTypeName.regex' => 'The business type name must only contain letters and spaces.',
            'newTypeName.unique' => 'This business type already exists.',
        ]);
    
        // Check if the business type already exists
        if (BusinessType::where('name', $this->newTypeName)->exists()) {
            // Use toast for showing that the business type already exists
            $this->dispatchBrowserEvent('close-modal');
            $this->dispatchBrowserEvent('swal:toast', [
                'icon' => 'error',
                'title' => 'This business type already exists!',
                'timer' => 3000, // Toast will close after 3000ms
                'position' => 'top-end', // Position of the toast
                'showConfirmButton' => false, // Hide confirm button
                'timerProgressBar' => true, // Show timer progress bar
            ]);
            return;
        }
    
        BusinessType::create([
            'name' => $this->newTypeName,
        ]);
    
        $this->newTypeName = ''; // Reset the input
        $this->emit('closeModal'); // Emit an event to close the modal
        $this->emit('openModal');
        $this->loadBusinessTypes(); // Reload the list
        $this->dispatchBrowserEvent('close-modal'); // Dispatch an event to close the modal
        $this->dispatchBrowserEvent('swal:toast', [
            'icon' => 'success',
            'title' => 'New business type added successfully!',
            'timer' => 3000,
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timerProgressBar' => true,
        ]);
    }

    public function render()
    {
        $query = BusinessType::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $businessTypes = $query->get();

        return view('livewire.business-types-manager', [
            'businessTypes' => $businessTypes
        ]);
    }
}
