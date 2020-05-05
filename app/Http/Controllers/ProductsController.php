<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function store()
    {
        $product = Product::create($this->validateRequest());

        return redirect(route('products.show', ['product' => $product->id]));
    }

    public function update(Product $product)
    {
        $product->update($this->validateRequest());

        return redirect(route('products.show', ['product' => $product->id]));
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(route('products.index'));
    }

    /**
     * @return array
     */
    protected function validateRequest(): array
    {
        return request()->validate([
            'serialnumber' => 'required',
            'buyed_at' => 'required|date',
            'type_id' => ''
        ]);
    }
}
