<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{

    public function index()
    {
        $anggota = Anggota::paginate(5);
        return view('dashboard.table', compact('anggota'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'address' => 'required|string',
            'wilayah_komda' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        Anggota::create($request->all());

        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan!');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:20',
            'address' => 'required|string',
            'wilayah_komda' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $anggota = Anggota::findOrFail($id);
        $anggota->update($request->all());

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $anggota = Anggota::find($id);
        if (!$anggota) {
            return response()->json(['message' => 'Anggota tidak ditemukan'], 404);
        }

        $anggota->delete();

        return response()->json(['message' => 'Anggota berhasil dihapus']);
    }
}
