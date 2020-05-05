<?php

namespace App\Http\Livewire\Types;

use App\Product;
use App\Type;
use Livewire\Component;

class Index extends Component
{
    public $types;

    public $typeSearch;

    public $name;
    public $brand;

    public function mount()
    {
        $this->types = Type::all();
        $this->reset('name', 'brand');
    }

    public function render()
    {
        return view('livewire.types.index');
    }

    public function addType()
    {
        $this->validate([
           'name' => 'required',
           'brand' => 'required'
        ]);

        Type::create([
           'name' => $this->name,
           'brand' => $this->brand
        ]);

        $this->types = Type::all();
        $this->reset('name', 'brand');
    }
}
