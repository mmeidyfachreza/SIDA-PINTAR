<?php
namespace App\Exports;

use App\Models\Consumer;
use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class StudentSheetFormat implements WithTitle, WithHeadings, FromArray
{

    protected $schoolId;

    public function __construct($schoolId = Null)
    {
        $this->schoolId = $schoolId;
    }

    public function array(): array
    {
        if ($this->schoolId==0) {
            return [
                ["0044959620", "ABIDAH IZDIHAR DZAKIYYAH", "BONTANG", "DD/MM/YYYY", "Islam", "P", "Wasikin", "", "8 (silahkan lihat dari sheet Id Sekolah)", 2012, "2010/2011", "DN-16/D-SMP/13/2106457"],
            ];
        }else {
            return [
                ["0044959620", "ABIDAH IZDIHAR DZAKIYYAH", "BONTANG", "DD/MM/YYYY", "Islam", "P", "Wasikin", "", 2012, "2010/2011", "DN-16/D-SMP/13/2106457"],
            ];
        }
    }

    public function headings(): array
    {
        if ($this->schoolId==0) {
            return [
                'NISN',
                'Nama',
                'Tempat_Lahir',
                'Tanggal_Lahir',
                'Agama',
                'JK',
                'Nama_Orang_Tua',
                'Nama_Wali',
                'Id_Sekolah',
                'Tahun_Lulus',
                'Tahun_Ajaran',
                'Nomor_Ijazah',
            ];
        }else {
            return [
                'NISN',
                'Nama',
                'Tempat_Lahir',
                'Tanggal_Lahir',
                'Agama',
                'JK',
                'Nama_Orang_Tua',
                'Nama_Wali',
                'Tahun_Lulus',
                'Tahun_Ajaran',
                'Nomor_Ijazah',
            ];
        }

    }

    public function title(): string
    {
        return 'Siswa';
    }

}
