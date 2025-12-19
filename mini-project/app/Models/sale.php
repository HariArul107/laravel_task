<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sale extends Model
{
    //
    protected $table = 'sales';
    protected $primaryKey = 'sales_id'; // custom primary key
    protected $fillable = [
        'bill_no',
        'purchase_id',
        'customer_name',
        'sale_date',
        'address',
        'discount',
        'user_id',
        'quantity',
        'total_price',
    ];


    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id', 'purchase_id');
    }

    public function user()
    {
        return $this->belongsTo(loginuser::class, 'user_id', 'id');
    }
}
