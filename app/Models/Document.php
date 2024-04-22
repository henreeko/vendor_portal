<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'vendor_documents'; // Ensure this matches the actual table name

    protected $fillable = ['user_id', 'document_type', 'path', 'expiry_date', 'name'];
}
