<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'order_time',
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderProducts(): hasOne
    {
        return $this->hasOne(OrderProduct::class);
    }

    public function product(): belongsTo
    {
        return $this->belongsTo(Product::class);
    }


}
