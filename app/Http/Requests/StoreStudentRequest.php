<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'nisn'=> 'required|unique:students,nisn',
            'birth_place' => 'required',
            'birth_date' => 'required|date_format:d/m/Y',
            'religion' => 'required',
            'gender' => 'required',
            'father_name'=> 'required',
            'school_id'=> 'required|integer',
            'graduated_year' => 'required|date_format:Y',
            'school_year' => 'required',
            'ijazah' => 'required|mimes:pdf|max:2048',
            'ijazah_number'=> 'required',
            'photo' => 'mimes:png,jpeg,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi',
            'nisn.required' => 'NISN wajib diisi',
            'birth_place.required' => 'Tempat lahir wajib diisi',
            'birth_date.required' => 'Tanggal lahir wajib diisi',
            'religion.required' => 'Agama wajib dipilih',
            'gender.required' => 'Jenis kelamin wajib dipilih',
            'father_name.required' => 'Nama Orang tua wajib diisi',
            'school_id.required' => 'Nama sekolah asal wajib dipilih',
            'graduated_year.required' => 'Tahub lulus wajib diisi',
            'school_year.required' => 'Tahun ajaran wajib diisi',
            'ijazah.required' => 'Ijazag wajib di upload',
            'ijazah_number.required' => 'Nomor ijazah wajib diisi',

            'nisn.unique' => 'NISN sudah terdaftar, silahkan gunakan NISN lain',
            'birth_date.date_format' => 'Format tanggal lahir salah',
            'graduated_year.date_format' => 'Format tahun lulus salah',

            'ijazah.mimes' => 'Format file ijazah harus pdf',
            'photo.mimes' => 'Format file foto harus png,jpeg atau jpg',
            'ijazah.max' => 'File ijazah maksimal 2Mb',
            'photo.max' => 'File foto maksimal 2Mb',
            // 'date_format' => ':attribute tidak boleh menggunakan angka',
        ];
    }
}
