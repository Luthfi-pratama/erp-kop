<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $suratKeluar = SuratKeluar::latest()->paginate(10);
        return view('dashboard.suratKeluar', compact('suratKeluar'));
    }

    public function create()
    {
        return view('dashboard.suratKeluar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|unique:surat_keluar,nomor_surat',
            'tujuan' => 'required',
            'perihal' => 'required',
            'tanggal_keluar' => 'required|date',
            'status' => 'required|in:draft,dikirim,diterima',
        ]);

        SuratKeluar::create($request->all());

        return redirect()->route('suratKeluar.index')->with('success', 'Surat keluar berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        return view('dashboard.suratKeluar', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $surat = SuratKeluar::findOrFail($id);

        $request->validate([
            'nomor_surat' => "required|unique:surat_keluar,nomor_surat,{$id}",
            'tujuan' => 'required',
            'perihal' => 'required',
            'tanggal_keluar' => 'required|date',
            'status' => 'required|in:draft,dikirim,diterima',
        ]);

        $surat->update($request->all());

        return redirect()->route('suratKeluar.index')->with('success', 'Surat keluar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $surat = SuratKeluar::find($id);
        if (!$surat) {
            return response()->json(['message' => 'Anggota tidak ditemukan'], 404);
        }

        $surat->delete();

        return response()->json(['message' => 'Anggota berhasil dihapus']);
    }
}
