<?php

namespace Tests\Feature;

use App\Product;
use App\Type;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_product_can_be_created()
    {
        $response = $this->post('/products', $this->data());

        $products = Product::all();

        $this->assertCount(1, $products);

        //check if the date is an carbon instance
        $this->assertInstanceOf(Carbon::class, $products->first()->buyed_at);
        $this->assertEquals('2002/13/02', $products->first()->buyed_at->format('Y/d/m'));

        $response->assertRedirect(route('products.show', [ 'product' => $products->first()->id]));
    }

    /** @test */
    public function an_product_can_be_updated()
    {
         $this->post('/products', $this->data());

        $product = Product::first();

        $response = $this->patch(route('products.update', ['product' => $product->id]), [
            'serialnumber' => 'Cameo 002',
            'buyed_at' => '5/15/1999',
            'type_id' => 'New type'
        ]);

        $product->refresh();

        $this->assertEquals('Cameo 002', $product->serialnumber);
        $this->assertEquals('1999/15/05', $product->buyed_at->format('Y/d/m'));
        $this->assertEquals('New type', $product->type->name);

        $response->assertRedirect(route('products.show', [ 'product' => $product->id]));
    }



    /** @test */
    public function delete_a_product()
    {
        $this->withoutExceptionHandling();
        $this->post('/products', $this->data());

        $product = Product::first();

        $this->assertCount(1, Product::all());

        $respons = $this->delete(route('products.destroy', ['product' => $product->id]));

        $this->assertCount(0, Product::all());
        $respons->assertRedirect(route('products.index'));
    }


    /** @test */
    public function a_serialnumber_is_required()
    {
        $response = $this->post('/products', array_merge($this->data(), [
            'serialnumber' => '',
        ]));

        $response->assertSessionHasErrors('serialnumber');
    }

    /** @test */
    public function a_buyed_at_is_required()
    {
        $response = $this->post('/products', array_merge($this->data(), [
            'buyed_at' => '',
        ]));

        $response->assertSessionHasErrors('buyed_at');
    }


    /**
     * @return array
     */
    private function data(): array
    {
        return [
            'serialnumber' => 'Showtec Ledpar 7 Tri 001',
            'buyed_at' => '02/13/2002',
            'type_id' => 'Showtec Ledpar 7 tri'
        ];
    }
}
