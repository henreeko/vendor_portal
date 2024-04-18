<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'usertype',
        'supplier_type',
        'company_name',
        'office_street',
        'office_barangay',
        'office_zip',
        'office_city',
        'tin_number',
        'website_url',
        'phone_number',
        'billing_representative_first_name',
        'billing_representative_last_name',
        'business_type_id',
        'products_or_services',
        'telephone_fax_number',
        'procurement_officer_approval',
        'procurement_officer_approval_date',
        'procurement_head_approval',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = ['approver'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Determine if the vendor is fully approved.
     *
     * @return bool
     */
    protected $appends = ['is_fully_approved'];

    public function getIsFullyApprovedAttribute()
    {
        return $this->procurement_officer_approval === 'approved' && $this->procurement_head_approval === 'approved';
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function businessType()
    {
        return $this->belongsTo(BusinessType::class, 'business_type_id');
    }
}

