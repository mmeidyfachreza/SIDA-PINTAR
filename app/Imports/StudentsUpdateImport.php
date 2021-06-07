<?php

namespace App\Imports;

use App\Models\School;
use App\Models\Student;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentsUpdateImport implements ToCollection, WithHeadingRow, WithValidation
{

    protected $schoolId;

    public function __construct($schoolId = Null)
    {
        $this->schoolId = $schoolId;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            // dd($row);
            if ($student = Student::where("nisn",$row["nisn"])->first()) {
                $student->update([
                    'name' => $row["nama"],
                    'birth_place' => $row["tempat_lahir"],
                    'birth_date' => Date::excelToDateTimeObject($row["tanggal_lahir"]),
                    'religion' => $row["agama"],
                    'gender' => $row["jk"],
                    'father_name' => $row["nama_orang_tua"],
                    'guardian_name' => $row["nama_wali"],
                    'school_id' => ($this->schoolId) ? $this->schoolId : $row["id_sekolah"],
                    'graduated_year' => $row["tahun_lulus"],
                    'school_year' => $row["tahun_ajaran"],
                    'ijazah_number' => $row["nomor_ijazah"],
                ]);
            }
        }
    }

    public function rules(): array
    {
        $schoolId = School::select("id")->get()->pluck("id")->toArray();
        $gender = array('L','P');
        return [
            'nisn'=> 'required',
            'nama' => 'required|string',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|integer',
            'agama' => 'required',
            'jk' => Rule::in($gender),
            'nama_orang_tua'=> 'required',
            'id_sekolah'=> Rule::in($schoolId),
            'tahun_lulus' => 'required|date_format:Y',
            'tahun_ajaran' => 'required',
            'nomor_ijazah' => 'required',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'nama.required' => 'Nama wajib diisi',
            'nisn.required' => 'NISN wajib diisi',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi',
            'agama.required' => 'Agama wajib diisi',
            'jk.required' => 'Jenis kelamin wajib diisi',
            'nama_orang_tua.required' => 'Nama Orang tua wajib diisi',
            'id_sekolah.in' => 'id sekolah tidak ditemukan, wajib isi id sekolah dan id berdasarkan sheet id seklah',
            'tahun_lulus.required' => 'Tahun lulus wajib diisi',
            'tahun_ajaran.required' => 'Tahun ajaran wajib diisi',
            'nomor_ijazah.required' => 'Nomor ijazah wajib diisi',

            'tanggal_lahir.integer' => 'Format tanggal lahir salah dan pastikan tidak ada tanda petik seperti \'02/12/2021',
            'tahun_lulus.date_format' => 'Format tahun lulus salah',

            // 'date_format' => ':attribute tidak boleh menggunakan angka',
        ];
    }
}
