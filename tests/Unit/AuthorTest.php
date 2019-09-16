<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Author;

class AuthorTest extends TestCase
{
    use RefreshDatabase;

    /** @test    */
    public function a_dob_is_nullable()
    {
        Author::firstOrCreate([
            'name' => 'John Doe',
        ]);

        $this->assertCount(1 , Author::all() );
    }
}
