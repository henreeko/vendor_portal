<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class ProcurementOfficerStats extends Component
{
    public $totalVendors, $archivedVendors, $pendingApprovals, $officialVendors, $finalApproval;

    public function mount()
    {
        $this->totalVendors = User::where('usertype', 'vendor')->count();
        $this->archivedVendors = User::where('usertype', 'vendor')->where('archived', true)->count();
        $this->pendingApprovals = User::where('usertype', 'vendor')
                                      ->where('procurement_officer_approval', 'pending')
                                      ->count();

        $this->officialVendors = User::where('usertype', 'vendor')
                                     ->where('procurement_officer_approval', 'approved')
                                     ->where('procurement_head_approval', 'approved')
                                     ->count();

        $this->finalApproval = User::where('usertype', 'vendor')
                                     ->where('procurement_officer_approval', 'approved')
                                     ->where('procurement_head_approval', 'pending')
                                     ->count();
    }

    public function render()
    {
        return view('livewire.procurement-officer-stats');
    }
}
