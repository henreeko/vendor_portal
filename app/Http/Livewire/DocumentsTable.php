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

    // public function downloadDocument($documentId)
    // {
    //     $document = VendorDocument::findOrFail($documentId);
    //     $path = $document->path;
    //     $name = $document->name; // the original file name
    
    //     if (Storage::disk('public')->exists($path)) {
    //         $headers = [
    //             'Content-Disposition' => 'attachment; filename="' . addslashes($name) . '"',
    //             'Content-Type' => Storage::disk('public')->mimeType($path)
    //         ];
    //         return response()->download(storage_path("app/public/{$path}"), $name, $headers);
    //     } else {
    //         return abort(404);
    //     }
    // }
    
    

    public function render()
    {
        $documents = VendorDocument::where('user_id', $this->userId)->get();
        return view('livewire.documents-table', compact('documents'));
    }   
}
