<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Repair
 *
 * @property int $id
 * @property string $name
 * @property string $explanation
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repair newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repair newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repair query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repair whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repair whereExplanation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repair whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repair whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repair whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Repair whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Repair extends Model
{
    public function product()
    {
        return $this->hasOne(Product::class);
    }
}
