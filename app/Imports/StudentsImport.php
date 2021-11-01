<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class StudentsImport implements WithMultipleSheets
{
    protected $schoolId;

    public function __construct($schoolId = Null)
    {
        $this->schoolId = $schoolId;
    }

    public function sheets(): array
    {
        return [
            'Siswa' => new StudentsSheetImport($this->schoolId),
        ];
    }
}
