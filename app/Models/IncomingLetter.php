<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Carbon;

class IncomingLetter extends Model
{
    use HasFactory;

    protected $fillable = ['ref_number','date','purpose','content','description','file'];

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = date('Y-m-d', strtotime($value));
    }

    public function getDateAttribute($value)
    {
        return $this->attributes['date'] = date('Y-m-d', strtotime($value));
    }
}
