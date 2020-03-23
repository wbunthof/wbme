<?php

namespace Tests\Unit;

use App\Type;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_name_is_required_to_create_a_type()
    {
        Type::create([
            'name' => 'Compact par 7 tri'
        ]);

        $this->assertCount(1, Type::all());
    }

    /** @test */
    public function an_type_factory_gets_created()
    {
        $type = factory(Type::class)->create();
        $this->assertCount(1, Type::all());
    }
}
