<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\TrashType;
use App\Models\Report;
use App\Models\Area;
use Carbon\Carbon;
class LandingController extends Controller
{
    public function index(Request $request)
    {
        $query = Schedule::with(['area', 'trashType'])->orderBy('tanggal')->orderBy('waktu');

        // Filter pencarian nama wilayah
        if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->whereHas('area', function ($q) use ($search) {
            $q->where('nama_wilayah', 'like', '%' . $search . '%');
        });
    }

        $schedules = $query->get();
        $trashTypes = TrashType::all();
        return view('welcome', compact('schedules', 'trashTypes'));
    }


    public function storeLaporan(Request $request)
    {
        $data = $request->validate([
            'nama_pengirim' => 'nullable|string',
            'lokasi' => 'required|string',
            'deskripsi' => 'required|string',
            'trash_type_id' => 'required|exists:trash_types,id',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_laporan', 'public');
        }

        \App\Models\Report::create($data);
        return back()->with('success', 'Laporan berhasil dikirim.');
    }
}
