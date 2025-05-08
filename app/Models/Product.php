<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $nama
 * @property int $jumlah
 * @property string|null $photo
 * @property int $harga
 * @property string|null $category
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cart> $carts
 * @property-read int|null $carts_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereHarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    //
    protected $fillable = ['nama', 'jumlah', 'harga','category', 'photo'];

    public function carts()
{
    return $this->hasMany(Cart::class);
}

}
