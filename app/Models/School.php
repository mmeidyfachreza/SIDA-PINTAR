<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = ['name','level','headmaster','nip','letterhead'];

    // public function student()
    // {
    //     return $this->hasOne(Student::class);
    // }
}
