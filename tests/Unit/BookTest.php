<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Book;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /** @test    */
    public function an_author_id_is_recorded()
    {
        Book::create([
            'title' => 'John Doe',
            'author_id' => 1
        ]);

        $this->assertCount(1 , Book::all() );
    }
}
