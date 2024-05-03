<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\DocumentUpdateRequest;

class ViewDocumentUpdateRequests extends Component
{
    public $updateRequests;

    public function mount()
    {
        $this->loadRequests();
    }

    public function loadRequests()
    {
        $this->updateRequests = DocumentUpdateRequest::with('vendorDocument', 'requestedByUser')->get();
    }

    public function render()
    {
        return view('livewire.view-document-update-requests');
    }
}
