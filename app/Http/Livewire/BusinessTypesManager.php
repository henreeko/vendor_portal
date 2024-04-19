<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BusinessType;

class BusinessTypesManager extends Component
{
    public $businessTypes;
    public $newTypeName = '';
    public $search = '';

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function businessType()
    {
        return $this->belongsTo(BusinessType::class, 'business_type_id');
    }

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
    
        $this->businessTypes = $query->orderBy('created_at', 'asc')->get();
    }

    public function createBusinessType()
    {
        $this->validate([
            'newTypeName' => 'required|regex:/^[a-zA-Z\s]+$/|unique:business_types,name',
        ]);
    
        BusinessType::create(['name' => $this->newTypeName]);
    
        $this->newTypeName = ''; // Reset the input
    
        // Reload business types to reflect the new addition
        $this->loadBusinessTypes();
        $this->emit('closeModal'); // This should tell the frontend to close the modal
        $this->emit('refreshComponent'); // Optionally refresh components
    
        // toast
        $this->dispatchBrowserEvent('swal:toast', [
            'icon' => 'success',
            'title' => 'Business type added successfully!',
            'timer' => 1500,
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

        // $count = $businessTypes->count(); // gamitin if kailangan

        return view('livewire.business-types-manager', [
            'businessTypes' => $businessTypes,
        ]);
    }
}
