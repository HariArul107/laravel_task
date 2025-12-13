<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    protected $tabel = 'items';
    protected $primaryKey = 'item_id';  // <-- important

    protected $fillable = [
        'item_name',
        'category_name',
        'prize',
        'user_id',
        'category_id',
    ];
}
