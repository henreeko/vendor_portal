<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VendorDocument;

class DocumentUpdateRequest extends Model
{
    use HasFactory;

    protected $fillable = ['document_id', 'requested_by', 'message', 'requested_at'];

    public function requestedByUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'requested_by');
    }

    public function vendorDocument()
    {
        return $this->belongsTo(\App\Models\VendorDocument::class, 'document_id');
    }

    public static function updateDocument($id)
    {
        $request = DocumentUpdateRequest::find($id);
        // Logic to handle the update

        return redirect()->back()->with('status', 'Document updated successfully!');
    }
}
