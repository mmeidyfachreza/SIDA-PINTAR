<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $casts = [
        'birth_date' => 'date:Y-m-d'
    ];
    protected $fillable = [
        'nis',
        'name',
        // 'address',
        'birth_place',
        'birth_date',
        'religion',
        'gender',
        'father_name',
        // 'father_phone',
        // 'mother_name',
        // 'mother_phone',
        'guardian_name',
        'guardian_phone',
        'school_id',
        // 'entry_year',
        // 'graduated_year',
        'school_year',
        'ijazah',
        'ijazah_number',
    ];

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = date('Y-m-d', strtotime($value));
    }

    public function scopeDashboardSearch($querry,$request)
    {
        return $querry->where('school_id',$request['school_id'])
        ->Where('nis','like','%'.$request['nis'].'%');
    }

    public function school()
    {
       return $this->belongsTo(School::class,'school_id');
    }
}
