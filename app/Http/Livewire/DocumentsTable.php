<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\VendorDocument;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentsTable extends Component
{
    protected $preventLazyLoading = false;
    public $userId;

    public function mount($userId = null)
    {
        $this->userId = $userId;
    }    

    public function render()
    {
        $documents = VendorDocument::where('user_id', $this->userId)->get();
        return view('livewire.documents-table', compact('documents'));
    }   
}
