<?php

namespace Tests\Feature;

use App\Product;
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
        $this->withoutExceptionHandling();

        $this->post('/products', [
            'serialnumber' => 'Showtec Ledpar 7 Tri 001',
            'buyed_at' => '02/13/2002',
            'type_id' => 0
        ]);

        $product = Product::all();

        $this->assertCount(1, $product);

        $this->assertInstanceOf(Carbon::class, $product->first()->buyed_at);
        $this->assertEquals('2002/13/02', $product->first()->buyed_at->format('Y/d/m'));
    }
}
