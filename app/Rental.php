<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Rental
 *
 * @property int $id
 * @property string $name
 * @property string $client
 * @property string $explanation
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $product
 * @property-read int|null $product_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rental newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rental newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rental query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rental whereClient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rental whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rental whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rental whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rental whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Rental whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Rental extends Model
{
    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}
