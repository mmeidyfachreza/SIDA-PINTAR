<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class StudentImportFormat implements WithMultipleSheets
{

    protected $schoolId;

    public function __construct($schoolId = Null)
    {
        $this->schoolId = $schoolId;
    }

    public function sheets(): array
    {
        if ($this->schoolId==0) {
            $sheets = [
                new StudentSheetFormat(),
                new SchoolIdSheet()
            ];
        }else {
            $sheets = [
                new StudentSheetFormat($this->schoolId),
            ];
        }

        return $sheets;
    }
}
