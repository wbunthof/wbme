<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * App\Product
 *
 * @property int $id
 * @property string $serialnumber
 * @property string $buyed_at
 * @property int $type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Rental[] $rental
 * @property-read int|null $rental_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Repair[] $repair
 * @property-read int|null $repair_count
 * @property-read \App\Type $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereBuyedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereSerialnumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Model
{
    use Searchable;

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function repair()
    {
        return $this->hasMany(Repair::class);
    }

    public function rental()
    {
        return $this->belongsToMany(Rental::class);
    }

    public function path()
    {
         return route('products.show', ['product' => $this->id]);
    }

    public function setTypeIdAttribute($type)
    {
        if (is_numeric($type) && Type::find($type))
        {
            $id = Type::find($type)->id;
        }
        if (!isset($id))
        {
            $id = (Type::firstOrCreate([
                'name' => $type,
            ]))->id;
        }

        $this->attributes['type_id'] = $id;
    }
//
//    public function search($search)
//    {
//        return
//            self::whereHas('type', function ($query) use ($search) {
//                $query->where('name', 'LIKE', '%' . $search . '%');
//            })
//                   ->orWhere('serialnumber', 'LIKE', '%' . $search. '%');
//    }

    protected $fillable = ['serialnumber', 'buyed_at', 'type_id'];
    protected $dates = ['buyed_at'];
    protected $relations = [Type::class, Repair::class, Rental::class];

    public function setBuyed_atAttribute($attribute)
    {
        $this->attributes['buyed_at'] = Carbon::parse($attribute);
    }

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
