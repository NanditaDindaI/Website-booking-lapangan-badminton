<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;

class LapanganController extends Controller
{
    public function index()
    {
        $lapangan = Lapangan::all();
        return view('lapangan.index', compact('lapangan'));
    }

    public function create()
    {
        return view('lapangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_lapangan' => 'required',
            'nama_lapangan'  => 'required',
            'tipe_lapangan'  => 'required',
            'harga_per_jam'  => 'required|numeric',
            'status'         => 'required|in:tersedia,terpesan,libur',
            'kapasitas'      => 'required|integer',
            'deskripsi'      => 'nullable|string',
            'fasilitas'      => 'nullable|string',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('lapangan', 'public');
        }

        Lapangan::create([
            'nomor_lapangan' => $request->nomor_lapangan,
            'nama_lapangan'  => $request->nama_lapangan,
            'tipe_lapangan'  => $request->tipe_lapangan,
            'harga_per_jam'  => $request->harga_per_jam,
            'status'         => $request->status,
            'kapasitas'      => $request->kapasitas,
            'deskripsi'      => $request->deskripsi,
            'fasilitas'      => $request->fasilitas,
            'foto'           => $fotoPath,
        ]);

        return redirect('/lapangan')->with('success', 'Data berhasil ditambahkan');
    }

    public function show($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        return view('lapangan.show', compact('lapangan'));
    }

    public function edit($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        return view('lapangan.edit', compact('lapangan'));
    }

    public function update(Request $request, $id)
    {
        $lapangan = Lapangan::findOrFail($id);

        $request->validate([
            'nomor_lapangan' => 'required',
            'nama_lapangan'  => 'required',
            'tipe_lapangan'  => 'required',
            'harga_per_jam'  => 'required|numeric',
            'status'         => 'required|in:tersedia,terpesan,libur',
            'kapasitas'      => 'required|integer',
            'deskripsi'      => 'nullable|string',
            'fasilitas'      => 'nullable|string',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = $lapangan->foto;
        if ($request->hasFile('foto')) {
            // Hapus foto lama kalau ada
            if ($lapangan->foto) {
                \Storage::disk('public')->delete($lapangan->foto);
            }
            $fotoPath = $request->file('foto')->store('lapangan', 'public');
        }

        $lapangan->update([
            'nomor_lapangan' => $request->nomor_lapangan,
            'nama_lapangan'  => $request->nama_lapangan,
            'tipe_lapangan'  => $request->tipe_lapangan,
            'harga_per_jam'  => $request->harga_per_jam,
            'status'         => $request->status,
            'kapasitas'      => $request->kapasitas,
            'deskripsi'      => $request->deskripsi,
            'fasilitas'      => $request->fasilitas,
            'foto'           => $fotoPath,
        ]);

        return redirect('/lapangan')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $lapangan = Lapangan::findOrFail($id);
        $lapangan->delete();

        return redirect('/lapangan')->with('success', 'Data berhasil dihapus');
    }
}