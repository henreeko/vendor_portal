<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BusinessType; // Ensure BusinessType model is imported
use Livewire\WithPagination;
use App\Models\User;

class AdminDashboard extends Component
{
    use WithPagination;
    public $countBusinessTypes;
    
    public $totalUsers, $totalVendors, $approvedVendors, $pendingVendors, $softDeletedUsers;
    public function mount()
    {
        $this->countBusinessTypes = BusinessType::count();
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
        return view('livewire.admin-dashboard', [
            'count' => $this->countBusinessTypes // Pass the count to the view
        ]);
    }
}
