<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorDocument extends Model
{
    use HasFactory;
    
    protected $casts = [
        'expiry_date' => 'date',
        'registration_date' => 'date',
    ];

        // Define the table if it's not the default
        protected $table = 'vendor_documents';

        // Fillable attributes for mass assignment
        protected $fillable = ['user_id', 'document_type', 'path', 'expiry_date', 'name', 'registration_date'];
    
        // Define the inverse relationship
        public function user()
        {
            return $this->belongsTo(User::class);
        }
}
