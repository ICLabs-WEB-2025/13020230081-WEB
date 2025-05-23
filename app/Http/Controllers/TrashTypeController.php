<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\TrashType;

class TrashTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trashTypes = TrashType::all();
        return view('admin.trash-types.index', compact('trashTypes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trashTypes = TrashType::all();
        return view('admin.trash-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'jenis' => 'required|string|max:255|unique:trash_types,jenis'
        ]);

        try {
            // Simpan data ke database
            TrashType::create($validatedData);
            
            return redirect()->route('trash-types.index')
                ->with('success', 'Jenis sampah berhasil ditambahkan');
                
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal menambahkan jenis sampah: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        try {
            $type = TrashType::findOrFail($id);

            if ($type->reports()->exists() || $type->schedules()->exists()) {
                return redirect()->route('trash-types.index')->with('error', 'Jenis sampah tidak dapat dihapus karena masih digunakan dalam laporan atau jadwal.');
            }

            $type->delete();

            return redirect()->route('trash-types.index')->with('success', 'Jenis sampah berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('trash-types.index')->with('error', 'Terjadi kesalahan saat menghapus jenis sampah.');
        }
    }
}
