<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory,Notifiable,SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'admins';

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password',  'remember_token'];
}
