<?php

namespace App\Http\Controllers\Admin;

use App\Models\HistoryLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoryLogController extends Controller
{
    public function index()
    {
        $historyLogs = HistoryLog::latest()->paginate(10);
        return view('admin.history_logs.index', compact('historyLogs'));
    }
}
