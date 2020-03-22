<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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
}
