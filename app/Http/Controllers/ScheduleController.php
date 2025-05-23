<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Area;
use App\Models\TrashType;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['area', 'trashType'])->get();
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        $areas = Area::all();
        $trashTypes = TrashType::all();
        return view('admin.schedules.create', compact('areas', 'trashTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'area_id' => 'required|exists:areas,id',
            'trash_type_id' => 'required|exists:trash_types,id',
            'tanggal' => 'required|date',
            'waktu' => 'required',
        ]);

        Schedule::create([
            'area_id' => $request->area_id,
            'trash_type_id' => $request->trash_type_id,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(Schedule $schedule)
    {
        $areas = Area::all();
        $trashTypes = TrashType::all();
        return view('admin.schedules.edit', compact('schedule', 'areas', 'trashTypes'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'area_id' => 'required|exists:areas,id',
            'trash_type_id' => 'required|exists:trash_types,id',
            'tanggal' => 'required|date',
            'waktu' => 'required',
        ]);

        $schedule->update($request->only('area_id', 'trash_type_id', 'tanggal', 'waktu'));

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return back()->with('success', 'Jadwal berhasil dihapus.');
    }
}
