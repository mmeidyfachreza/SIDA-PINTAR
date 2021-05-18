<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSchoolRequest extends FormRequest
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
            'nip'=> 'unique:schools,nip,'.$this->sekolah,
            'headmaster' => 'string',
            'level'=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi',
            'nip.required' => 'NISN wajib diisi',
            'nip.unique' => 'NIP sudah pernah terdaftar silahkan gunakan yang lain',
        ];
    }
}
