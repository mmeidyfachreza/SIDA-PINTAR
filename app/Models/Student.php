<?php

namespace App\Models;

use App\Models\Utilities\FilterBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $casts = [
        'birth_date' => 'date:Y-m-d'
    ];
    protected $fillable = [
        'nisn',
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
        // 'guardian_phone',
        'school_id',
        // 'entry_year',
        'graduated_year',
        'school_year',
        'ijazah',
        'ijazah_number',
        'photo'
    ];

    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = date('Y-m-d', strtotime($value));
    }

    public function scopeDashboardSearch($querry,$request)
    {
        return $querry->where('school_id',$request['school_id'])
        ->where('nisn','like','%'.$request['nisn'].'%');
    }

    public function scopeSearch($querry,$value,$school = Null)
    {
        if ($school) {
            return $querry->where('nisn','like','%'.$value.'%')
            ->orWhere('name','like','%'.$value.'%')
            ->where('school_id',$school);
        }else {
            return $querry->where('nisn','like','%'.$value.'%')
            ->orWhere('name','like','%'.$value.'%');
        }

    }

    public function scopeFilterBy($query, $filters)
    {
        $namespace = 'App\Utilities\StudentFilters';
        $filter = new FilterBuilder($query, $filters, $namespace);
        return $filter->apply();
    }

    public function scopeGuestSearch($querry,$request)
    {
        return $querry->Where('nisn','like','%'.$request['nisn'].'%');
    }

    public function school()
    {
       return $this->belongsTo(School::class,'school_id');
    }
}
