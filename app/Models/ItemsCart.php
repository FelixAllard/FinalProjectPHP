<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemsCart extends Model
{
    protected $table = 'items_cart';
    protected $fillable = [
        'user_id',
        'quantity',
        'name',
        'price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
