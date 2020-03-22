<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    public function store()
    {
        Type::create($this->validateRequest());
    }

    public function update(Type $type)
    {
        $type->update($this->validateRequest());
    }

    /**
     * @return array
     */
    public function validateRequest(): array
    {
        return request()->validate([
            'name' => 'required',
            'brand' => 'required',
            'specifications' => ''
        ]);
    }
}
