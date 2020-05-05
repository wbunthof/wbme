<?php

namespace Tests\Feature;

use App\Type;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TypeManagementTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_type_can_be_created()
    {
        $response = $this->post('/types', $this->data());

        $type = Type::first();

        $this->assertCount(1, Type::all());

        $response->assertRedirect(route('types.show', [ 'type' => $type->id]));
    }

    /** @test */
    public function a_type_has_a_slug()
    {
        $response = $this->post('/types', $this->data());

        $type = Type::first();

        $this->assertCount(1, Type::all());
        $this->assertEquals(str_replace(' ', '-', strtolower($this->data()['name'])), $type->slug);
        $response->assertRedirect(route('types.show', [ 'type' => $type->id]));
    }

    /** @test */
    public function a_name_is_required()
    {
        $response = $this->post('/types', array_merge($this->data(), [
            'name' => '',
        ]));

        $response->assertSessionHasErrors('name');
    }

      /** @test */
    public function specifications_must_be_json()
    {
        $response = $this->post('/types', array_merge($this->data(), [
            'specifications' => 'String instead of json'
        ]));
        $response->assertSessionHasErrors('specifications');
    }

    /** @test */
    public function a_type_can_be_updated()
    {
        $this->post('/types', $this->data());

        $type = Type::first();

        $response = $this->patch('/types/' . $type->id, [
            'name' => 'New name',
            'brand' => 'New brand',
            'specifications' => json_encode(['Color' => 'RGB'])
        ]);

        $this->assertEquals('New name', Type::first()->name);
        $this->assertEquals('New brand', Type::first()->brand);
        $this->assertEquals(json_encode(['Color' => 'RGB']), Type::first()->specifications);

        $response->assertRedirect(route('types.show', [ 'type' => $type->id]));
    }

    /** @test */
    public function a_type_can_be_deleted()
    {
        $this->post('/types', $this->data());

        $type = Type::first();
        $this->assertCount(1, Type::all());

        $response = $this->delete('/types/' . $type->id);

        $this->assertCount(0, Type::all());

        $response->assertRedirect('types.index');
    }

    /**
     * @return array
     */
    public function data(): array
    {
        return [
            'name' => 'Compact par 7 tri',
            'brand' => 'Showtec',
            'specifications' => json_encode(['led' => '7 x 3w RGB'])
        ];
    }
}
