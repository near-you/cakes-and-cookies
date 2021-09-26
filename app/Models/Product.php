<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
