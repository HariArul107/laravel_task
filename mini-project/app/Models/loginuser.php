<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loginuser extends Model
{
    protected $table = 'projectusers';

    protected $fillable = [
        'Fname',
        'Lname',
        'email',
        'phone',
        'dob',
        'gender',
        'password',
    ];
    protected $casts = [
        'dob' => 'date',
    ];
    protected $hidden = [
        'password',
    ];
}
