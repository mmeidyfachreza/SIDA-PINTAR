<?php
namespace App\Exports;

use App\Models\Consumer;
use App\Models\Employee;
use App\Models\School;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class SchoolIdSheet implements WithHeadings, FromCollection, WithTitle
{

    public function collection()
    {
        return School::select('id','name')->get();
    }

    public function headings(): array
    {
        return [
            'Id Sekolah',
            'Nama Sekolah',
        ];
    }

    public function title(): string
    {
        return 'Id Sekolah';
    }

}
