<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class ProcurementHeadStats extends Component
{
    public $totalVendors, $pendingApprovals, $approvedVendors, $rejectedVendors;

    public function mount()
    {
        $this->totalVendors = User::where('usertype', 'vendor')->count();
        $this->pendingApprovals = User::where('usertype', 'vendor')
                                    ->where('procurement_officer_approval', 'approved')
                                      ->where('procurement_head_approval', 'pending')
                                      ->count();
        $this->approvedVendors = User::where('usertype', 'vendor')
                                     ->where('procurement_officer_approval', 'approved')
                                     ->where('procurement_head_approval', 'approved')
                                     ->count();
        $this->rejectedVendors = User::where('usertype', 'vendor')
                                     ->where('procurement_head_approval', 'rejected')
                                     ->count();
    }

    public function render()
    {
        return view('livewire.procurement-head-stats');
    }
}