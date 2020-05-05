<?php

namespace App\Http\Livewire\Products;

use App\Product;
use Arr;
use Livewire\Component;

class Show extends Component
{
    public $product;
    public $edit = -1;
    public $editValue;
    public $test;

    public function mount(Product $product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.products.show');
    }

    public function specToEdit($index, $value)
    {
        $this->edit = $index;
        $this->editValue = $value;
    }

    public function specOpslaan($spec, $value)
{
    dd(Arr::set($this->product->type->specifications, $spec, $this->editValue));

        $this->product->type->save();
        $this->test = $this->product->type;
        $this->product->type->update([
            'specifications' => ['color' => 'test']
        ]);
        $this->reset('edit', 'editValue');

    }
}
