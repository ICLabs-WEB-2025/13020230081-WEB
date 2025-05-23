<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with('trashType')->get();
        return view('admin.reports.index', compact('reports'));
    }

    public function show(Report $report)
    {
        $report->load('trashType');
        return view('admin.reports.show', compact('report'));
    }

    public function edit(Report $report)
    {
        return view('admin.reports.edit', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai'
        ]);

        $report->update(['status' => $request->status]);
        return redirect()->route('reports.index')->with('success', 'Status laporan diperbarui.');
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return back()->with('success', 'Laporan berhasil dihapus.');
    }
}
