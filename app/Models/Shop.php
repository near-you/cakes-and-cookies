<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shop extends Model
{
    use HasFactory;

    protected $table = 'shops';

    protected $fillable = [
        'name'
    ];

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }


    public static function updateData(int $id, string $name): int
    {
        return Shop::query()->where('id', $id)
            ->update(['name' => $name]);
    }

}
