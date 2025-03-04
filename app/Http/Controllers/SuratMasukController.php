<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    public function index()
    {
        $suratMasuk = SuratMasuk::latest()->paginate(10);
        return view('dashboard.suratMasuk', compact('suratMasuk'));
    }

    public function create()
    {
        return view('dashboard.suratMasuk');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|unique:surat_masuk,nomor_surat',
            'pengirim' => 'required',
            'perihal' => 'required',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|in:baru,diproses,selesai',
        ]);

        SuratMasuk::create($request->all());

        return redirect()->route('suratMasuk.index')->with('success', 'Surat masuk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        return view('dashboard.suratMasuk', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $surat = SuratMasuk::findOrFail($id);

        $request->validate([
            'nomor_surat' => "required|unique:surat_masuk,nomor_surat,{$id}",
            'pengirim' => 'required',
            'perihal' => 'required',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|in:baru,diproses,selesai',
        ]);

        $surat->update($request->all());

        return redirect()->route('suratMasuk.index')->with('success', 'Surat masuk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $surat = SuratMasuk::find($id);
        if (!$surat) {
            return response()->json(['message' => 'Anggota tidak ditemukan'], 404);
        }

        $surat->delete();

        return response()->json(['message' => 'Anggota berhasil dihapus']);
    }
}
