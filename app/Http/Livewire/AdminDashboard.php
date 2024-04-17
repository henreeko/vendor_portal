<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class AdminDashboard extends Component
{
    public $totalUsers, $totalVendors, $approvedVendors, $pendingVendors, $softDeletedUsers;
    public function mount()
    {
        $this->totalUsers = User::count();
        $this->totalVendors = User::where('usertype', 'vendor')->count();
        $this->approvedVendors = User::where('usertype', 'vendor')
                                     ->where('procurement_officer_approval', 'approved')
                                     ->where('procurement_head_approval', 'approved')
                                     ->count();
        $this->pendingVendors = User::where('usertype', 'vendor')
                                    ->where(function($query) {
                                        $query->where('procurement_officer_approval', 'pending')
                                              ->orWhere('procurement_head_approval', 'pending');
                                    })
                                    ->count();
        $this->softDeletedUsers = User::onlyTrashed()->count();
    }

    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}
