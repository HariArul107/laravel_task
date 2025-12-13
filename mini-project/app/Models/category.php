<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    //
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'category_name',
        'category_description',
        'user_id',
    ];
    
}
