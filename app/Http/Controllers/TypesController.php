<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;

class TypesController extends Controller
{
    public function store()
    {
        $type = Type::create($this->validateRequest());

        return redirect($type->path());
    }

    public function show(Type $type)
    {

    }

    public function update(Type $type)
    {
        $type->update($this->validateRequest());

        return redirect($type->path());
    }

    public function destroy(Type $type)
    {
        $type->delete();

        return redirect('types.index');
    }

    /**
     * @return array
     */
    protected function validateRequest(): array
    {
        return request()->validate([
            'name' => 'required',
            'brand' => 'required',
            'specifications' => 'json|nullable'
        ]);
    }
}
