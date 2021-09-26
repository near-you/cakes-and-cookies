<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
            'name',
            'description',
            'shop_id'
        ];

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public static function updateProductData($request, $id): int
    {
        $data = $request->except(['_token', '_method']);
        return self::query()->where('id', $id)
            ->update($data);
    }

    public static function getAuthUserProduct()
    {
        $shop_id = Auth::user()->shop_id;
        return Product::query()->get()->where('shop_id', $shop_id);
    }

    public static function getNotAuthUserProducts()
    {
        //
    }
}
