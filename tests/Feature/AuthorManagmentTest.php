<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Author;

class AuthorManagmentTest extends TestCase
{
    use RefreshDatabase;
    /** @test    */
    public function an_author_can_be_created()
    {
        
        $this->withoutExceptionHandling();

        $response = $this->post('/author', [
            'name'=> 'Author Name',
            'dob' => '05/25/1989',
        ]);
        
        $author = Author::all();

        $this->assertCount(1, $author );

        $this->assertInstanceOf(Carbon::class, $author->first()->dob );

        $this->assertEquals('1989/05/25', $author->first()->dob->format('Y/m/d') );

    }
   
}
