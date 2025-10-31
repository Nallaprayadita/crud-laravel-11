<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MahasiswaExport;

class MahasiswaController extends Controller
{
    // 🏠 Menampilkan semua data mahasiswa + fitur pencarian
    public function index(Request $request)
    {
        $search = $request->input('search');

        $mahasiswa = Mahasiswa::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                         ->orWhere('nim', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        })->get();

        return view('mahasiswa.index', compact('mahasiswa', 'search'));
    }

    // ➕ Form tambah mahasiswa
    public function create()
    {
        return view('mahasiswa.create');
    }

    // 💾 Simpan data baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required',
            'nim'   => 'required|unique:mahasiswas',
            'email' => 'required|email',
        ]);

        Mahasiswa::create($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan!');
    }

    // ✏️ Form edit mahasiswa
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    // 🔁 Update data mahasiswa
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'  => 'required',
            'nim'   => 'required',
            'email' => 'required|email',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    // 🗑️ Hapus data mahasiswa
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus!');
    }

    // 🧾 Cetak data mahasiswa ke PDF
    public function cetakPDF()
    {
        $mahasiswas = Mahasiswa::all();
        $pdf = Pdf::loadView('mahasiswa.cetak', compact('mahasiswas'));
        return $pdf->download('data_mahasiswa.pdf');
    }

    // 📊 Export data mahasiswa ke Excel
    public function exportExcel()
    {
        return Excel::download(new MahasiswaExport, 'data_mahasiswa.xlsx');
    }
}
