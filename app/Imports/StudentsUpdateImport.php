<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class StudentsUpdateImport implements WithMultipleSheets
{
    protected $schoolId;

    public function __construct($schoolId = Null)
    {
        $this->schoolId = $schoolId;
    }

    public function sheets(): array
    {
        return [
            'Siswa' => new StudentsUpdateSheet($this->schoolId),
        ];
    }
}


