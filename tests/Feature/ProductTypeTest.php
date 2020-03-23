<?php

namespace Tests\Feature;

use App\Product;
use App\Type;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_new_type_is_automatically_added()
    {
        $response = $this->post('/products', $this->data());

        $product = Product::first();
        $type = Type::first();

        $this->assertEquals($product->type_id, $type->id);
        $this->assertCount(1, Type::all());

        $response->assertRedirect(route('products.show', [ 'product' => $product->id]));
    }

    /** @test */
    public function a_product_can_be_made_with_new_type_and_integer_name()
    {
        $this->post('/products', array_merge($this->data(), ['type_id' => 12]));

        $product = Product::first();

        $this->assertCount(1, Product::all());
        $this->assertEquals(1, $product->type_id);
    }

    /** @test */
    public function a_product_can_be_made_with_type_as_id()
    {
        $type = factory(Type::class)->create();

        $this->post('/products', array_merge($this->data(), ['type_id' => $type->id]));

        $product = Product::first();

        $this->assertCount(1, Product::all());
        $this->assertEquals($type->id, $product->type_id);
    }

    /** @test */
    public function a_type_can_be_updated_from_a_product()
    {
        $this->withoutExceptionHandling();
        $type = factory(Type::class)->create();
        $product = factory(Product::class)->create(['type_id' => $type->id]);
        $this->assertEquals($type->id, $product->type_id);

        $type2 = factory(Type::class)->create();
        $this->assertCount(2, Type::all());
        $this->patch('/products/' . $product->id, array_merge($product->toArray(), ['type_id' => $type2->id]));
        $product->refresh();
        $this->assertEquals($type2->id, $product->type_id);
    }

    /** @test */
    public function a_new_type_can_be_created_and_updated_from_a_product()
    {
        $this->withoutExceptionHandling();
        $type = factory(Type::class)->create();
        $product = factory(Product::class)->create(['type_id' => $type->id]);
        $this->assertEquals($type->id, $product->type_id);

        $this->patch('/products/' . $product->id, array_merge($product->toArray(), ['type_id' =>'New awesome type']));
        $product->refresh();
        $this->assertCount(2, Type::all());
        $this->assertEquals('New awesome type', $product->type->name);
    }

    /**
     * @return array
     */
    public function data(): array
    {
        return [
            'serialnumber' => '120050205050202',
            'buyed_at' => Carbon::now(),
            'type_id' => 'New type'
        ];
    }
}
