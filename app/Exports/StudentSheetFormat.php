<?php
namespace App\Exports;

use App\Models\Consumer;
use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class StudentSheetFormat implements WithTitle, WithHeadings
{

    protected $schoolId;

    public function __construct($schoolId = Null)
    {
        $this->schoolId = $schoolId;
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
            ];
        }

    }

    public function title(): string
    {
        return 'Siswa';
    }

}
