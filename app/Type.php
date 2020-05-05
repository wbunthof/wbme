<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Str;

/**
 * App\Type
 *
 * @property int $id
 * @property string $name
 * @property string $brand
 * @property string|null $specifications
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $product
 * @property-read int|null $product_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereSpecifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $slug
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Type whereSlug($value)
 */
class Type extends Model
{

    use Searchable;

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function path()
    {
        return route('types.show', ['type' => $this->id]);
    }

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = Str::slug($name);
    }

    protected $casts = [
        'specifications' => 'array'
    ];

    protected $fillable = ['name', 'slug','brand', 'specifications'];
    protected $relations = [Product::class];

    public function toSearchableArray()
    {
        $array = $this->toArray();

        foreach ($this->relations as $relation) {
            if($relation = substr( strrchr( $relation, '\\' ), 1 ))
            {
                $array = array_merge($array, [$relation => $this->$relation()->get()->toArray()]);
            }
        }

        return $array;
    }
}
