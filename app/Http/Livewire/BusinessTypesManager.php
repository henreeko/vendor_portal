<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BusinessType;
use Illuminate\Support\Facades\Validator;

class BusinessTypesManager extends Component
{
    use WithPagination;

    public $sortField = 'created_at';
    public $sortAsc = true;
    public $showModal = false;
    public $newTypeName = '';
    public $search = '';
    public $showEditModal = false;
    public $editBusinessTypeId;
    public $editBusinessTypeName;
    public $deleteBusinessTypeId;

    protected $paginationTheme = 'tailwind';
    protected $listeners = ['refreshComponent' => '$refresh'];
    
    // Confirm deletion of a business type
    public function confirmDelete($id)
    {
        $this->deleteBusinessType($id);
    }

    // Delete the business type
    public function deleteBusinessType($id)
    {
        BusinessType::findOrFail($id)->delete();
        $this->emit('toast', 'success', 'Business type deleted successfully!');
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortField = $field;
            $this->sortAsc = true;
        }
    }

    public function showAddModal()
    {
        $this->resetValidation();
        $this->newTypeName = '';
        $this->toggleModal();
    }

    public function showEditModal($id)
    {
        $businessType = BusinessType::findOrFail($id);
        $this->editBusinessTypeId = $businessType->id;
        $this->editBusinessTypeName = $businessType->name;
        $this->toggleEditModal();
    }

    public function updateBusinessType()
    {
        $this->validate([
            'editBusinessTypeName' => 'required|string|unique:business_types,name,' . $this->editBusinessTypeId,
        ]);
        $this->validateUpdate();
        $businessType = BusinessType::findOrFail($this->editBusinessTypeId);
        $businessType->update([
            'name' => $this->editBusinessTypeName,
        ]);

        $this->toggleEditModal();
        $this->emit('toast', 'success', 'Business type updated successfully!');
    }

    
    public function saveBusinessType()
    {
        $this->validate([
            'newTypeName' => 'required|regex:/^[a-zA-Z\s]+$/|unique:business_types,name,' . optional($this->editingBusinessType)->id,
        ]);
    
        if ($this->editingBusinessType) {
            $this->editingBusinessType->update(['name' => $this->newTypeName]);
        } else {
            BusinessType::create(['name' => $this->newTypeName]);
        }
    
        $this->emit('toast', ['type' => 'success', 'message' => $this->editingBusinessType ? 'Business type updated successfully!' : 'Business type added successfully!']);
    
        $this->resetInput();
        $this->toggleModal('modal');
    }

    public function resetInput()
    {
        $this->newTypeName = '';
    }

    public function toggleEditModal()
    {
        $this->showEditModal = !$this->showEditModal;
    }

    
    public function toggleModal()
    {
        $this->showModal = !$this->showModal;
    }

    public function mount()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

        // Validate input for update business type
        private function validateUpdate()
        {
            return $this->validate([
                'editBusinessTypeName' => 'required|regex:/^[a-zA-Z\s]+$/|unique:business_types,name,' . $this->editBusinessTypeId,
            ]);
        }

    public function createBusinessType()
    {
        try {
            $this->validate([
                'newTypeName' => 'required|regex:/^[a-zA-Z\s]+$/|unique:business_types,name',
            ]);
    
            BusinessType::create(['name' => $this->newTypeName]);
    
            $this->emit('toast', 'success', 'Business type added successfully!');
    
            $this->resetInput();
            $this->toggleModal(); // Close the modal after success
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errors = $e->validator->getMessageBag()->first();
    
            $this->emit('toast', 'error', $errors);
        }
    }
    
    
    
    public function render()
    {
        $query = BusinessType::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');

        return view('livewire.business-types-manager', [
            'businessTypes' => $query->paginate(10)
        ]);
    }
}