<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = Area::all();
        return view('admin.areas.index', compact('areas'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.areas.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_wilayah' => 'required|string|max:255',
        ]);

        Area::create(['nama_wilayah' => $request->nama_wilayah]);

        return redirect()->route('areas.index')->with('success', 'Wilayah berhasil ditambahkan.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $area = Area::findOrFail($id);

        // Cegah penghapusan jika masih terhubung ke schedule
        if ($area->schedules()->exists()) {
            return redirect()->route('areas.index')
                ->with('area_delete_error', 'Wilayah tidak dapat dihapus karena masih digunakan dalam jadwal.');
        }

        $area->delete();
        return redirect()->route('areas.index')->with('success', 'Wilayah berhasil dihapus.');
    }
}
