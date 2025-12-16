<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //
    protected $table = 'purchase';

    protected $primaryKey = 'purchase_id'; // custom primary key
    protected $fillable = [
        'item_id',
        'user_id',
        'quantity',
        'total_price',
    ];

    /**
     * Get the item associated with the purchase
     */
    public function item()
    {
        return $this->belongsTo(item::class, 'item_id', 'item_id');
    }

    /**
     * Get the user who made the purchase
     */
    public function user()
    {
        return $this->belongsTo(loginuser::class, 'user_id', 'id');
    }
}
