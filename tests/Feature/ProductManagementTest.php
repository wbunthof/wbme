<?php

namespace Tests\Feature;

use App\Product;
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

//        $this->post('/products', [
//            'serialnumber' => 'Showtec Ledpar 7 Tri 001',
//            'buyed_at' => '01-02-2002',
//            'type_id' => 0
//        ]);

//        $this->assertCount(1, Product::all());
    }
}
