<?php

namespace Tests\Unit;

use App\Product;
use App\Type;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_product_factory_gets_created()
    {
        factory(Product::class)->create();
        $this->assertCount(1, Product::all());
    }


    /** @test */
    public function an_product_factory_gets_created_with_new_type()
    {
        $product = factory(Product::class)->create(['type_id' => 'New type']);
        $this->assertCount(1, Product::all());
        $this->assertEquals(1, $product->type_id);
    }

    /** @test */
    public function if_a_product_is_generated_and_a_number_is_given_try_to_find_it_as_id()
    {
        $type = factory(Type::class)->create();
        $product = factory(Product::class)->create(['type_id' => $type->id]);

        $this->assertCount(1, Product::all());
        $this->assertCount(1, Type::all());
        $this->assertEquals($type->id, $product->type_id);
    }

    /** @test */
    public function if_a_product_is_generated_and_a_number_is_given_to_make_new_type()
    {
        $product = factory(Product::class)->create(['type_id' => 12]);

        $this->assertCount(1, Product::all());
        $this->assertCount(1, Type::all());
        $this->assertEquals(1, $product->type_id);
    }
}
