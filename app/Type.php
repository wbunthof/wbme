<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function path()
    {
        return route('types.show', $this->id);
    }

    protected $fillable = ['name', 'brand', 'specifications'];
}
