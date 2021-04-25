<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $casts = [
        'birth_date' => 'date:Y-m-d'
    ];
    protected $fillable = [
        'nis',
        'name',
        'address',
        'birth_place',
        'birth_date',
        'religion',
        'gender',
        'father_name',
        'father_phone',
        'mother_name',
        'mother_phone',
        'guardian_name',
        'guardian_phone',
        'school',
        'level',
        'entry_year',
        'graduated_year',
        'certificate',
        'statement_letter',
    ];

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = date('Y-m-d', strtotime($value));
    }

    public function scopeDashboardSearch($querry,$request)
    {
        return $querry->where('school','like','%'.$request['school'].'%')
        ->Where('level',$request['level'])
        ->Where('nis','like','%'.$request['nis'].'%');
    }
}
