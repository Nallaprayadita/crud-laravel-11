<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MahasiswaExport implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize
{
    /**
     * Ambil data dari model Mahasiswa
     */
    public function collection()
    {
        // Pilih kolom yang mau diexport (biar rapi)
        return Mahasiswa::select('nama', 'nim', 'email')->get();
    }

    /**
     * Judul kolom (header) di file Excel
     */
    public function headings(): array
    {
        return [
            'Nama Mahasiswa',
            'NIM',
            'Email',
        ];
    }

    /**
     * Nama sheet di file Excel
     */
    public function title(): string
    {
        return 'Daftar Mahasiswa';
    }
}
