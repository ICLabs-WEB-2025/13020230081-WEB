<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Area;
use App\Models\Report;

class DashboardController extends Controller
{
    public function index()
{
    $totalSchedules = Schedule::count();
    $totalAreas = Area::count();
    $totalReports = Report::count();

    $statusCounts = [
        'selesai' => Report::where('status', 'selesai')->count(),
        'diproses' => Report::where('status', 'diproses')->count(),
        'pending' => Report::where('status', 'pending')->count(),
    ];

    return view('admin.dashboard', compact('totalSchedules', 'totalReports', 'totalAreas', 'statusCounts'));
}


    
}

