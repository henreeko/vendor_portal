<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProcurementOfficerDashboardController extends Controller
{
    public function index()
    {
        return view('procurement_officer.index');
    }
}
