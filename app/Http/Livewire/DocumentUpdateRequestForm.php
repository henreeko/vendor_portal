<?php

namespace App\Http\Livewire;

use App\Models\DocumentUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DocumentUpdateRequestForm extends Component
{
    public $documentId;
    public $message;
    public $formVisible = false; // Add this property

    public function mount($documentId)
    {
        $this->documentId = $documentId;
    }

    public function submitRequest()
    {
        // Create a new DocumentUpdateRequest record
        DocumentUpdateRequest::create([
            'document_id' => $this->documentId,
            'requested_by' => Auth::id(),
            'message' => $this->message,
            'requested_at' => now(),
        ]);

        // Emit an event to notify the parent component
        $this->emit('requestSent');
        
        // Hide the form after submission
        $this->formVisible = false;
    }

    public function toggleFormVisibility()
    {
        $this->formVisible = !$this->formVisible;
    }

    public function render()
    {
        return view('livewire.document-update-request-form');
    }
}
