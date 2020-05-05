<?php

namespace App\Http\Livewire\Products;

use App\Product;
use App\Type;
use Livewire\Component;

class Index extends Component
{
    public $products;
    public $types = [];

    public $productSearch;

    public $serialnumber;
    public $buyed_at;
    public $type;

    public function mount()
    {
        $this->products = Product::all();
        $this->reset('serialnumber', 'buyed_at', 'type');
    }

    public function render()
    {
        $this->productSearching();

        return view('livewire.products.index');
    }

    public function addProduct()
    {
        $this->validate([
            'serialnumber' => 'required',
            'buyed_at' => 'required|date',
            'type' => 'required'
        ]);

        Product::create([
            'serialnumber' => $this->serialnumber,
            'buyed_at' => $this->buyed_at,
            'type_id' => $this->type
        ]);

        $this->products = Product::all();
        $this->reset('serialnumber', 'buyed_at', 'type');

    }

    public function updatedType($value)
    {
        $this->types = $this->type ? Type::search($value)->get()->toArray() : [];
    }

    public function productSearching()
    {

        if ($this->productSearch)
        {
            $this->products = Product::search($this->productSearch)->get();
        } elseif (!(Product::count() == $this->products->count())) {
            $this->products = Product::all();
        }
    }
}
