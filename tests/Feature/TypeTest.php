<?php

namespace Tests\Feature;

use App\Type;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TypeTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_product_can_be_added()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/types', [
            'name' => 'Compact par 7 tri',
            'brand' => 'Showtec',
            'specifications' => json_encode(['led' => '7 x 3w RGB'])
        ]);

        $response->assertOk();
        $this->assertCount(1, Type::all());
    }

    /** @test */
    public function a_name_is_required()
    {
        $response = $this->post('/types', [
            'name' => '',
            'brand' => 'Showtec',
            'specifications' => json_encode(['led' => '7 x 3w RGB'])
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_brand_is_required()
    {
        $response = $this->post('/types', [
            'name' => 'Compact par 7 tri',
            'brand' => '',
            'specifications' => json_encode(['led' => '7 x 3w RGB'])
        ]);

        $response->assertSessionHasErrors('brand');
    }

    /** @test */
    public function a_type_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->post('/types', [
            'name' => 'Compact par 7 tri',
            'brand' => 'Showtec',
            'specifications' => json_encode(['led' => '7 x 3w RGB'])
        ]);

        $type = Type::first();

        $response = $this->patch('/types/' . $type->id, [
            'name' => 'New name',
            'brand' => 'Showtec',
            'specifications' => json_encode(['led' => '7 x 3w RGB'])
        ]);

        $this->assertEquals('New name', Type::first()->name);
    }



}
