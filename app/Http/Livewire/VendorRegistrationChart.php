<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class VendorRegistrationChart extends Component
{
    public $labels = [];
    public $data = [];

    public function mount()
    {
        // Fetch data when the component mounts
        $vendorCounts = User::select(DB::raw("COUNT(*) as count"), DB::raw("MONTH(created_at) as month"));
            // ->where('usertype', 'vendor')
            // ->groupBy('month')
            // ->orderBy('month', 'asc')
            // ->get();

        // Prepare labels and data for the chart
        foreach ($vendorCounts as $month) {
            $this->labels[] = date('F', mktime(0, 0, 0, $month->month, 1)); // Convert month number to month name
            $this->data[] = $month->count;
        }
    }

    public function render()
    {
        return view('livewire.partials.vendor-registration-chart', [
            'labels' => $this->labels,
            'data' => $this->data
        ]);
    }
}

