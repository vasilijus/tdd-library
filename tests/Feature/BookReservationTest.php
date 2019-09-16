<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;
class BookReservationTest extends TestCase
{
    use RefreshDatabase;

    /**     @test      */
    public function a_book_can_be_added_to_the_library()
    {
        
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title'=>'Cool book titile',
            'author'=> 'Sergej'
        ]);
        // assert that we got a successfull response
        $response->assertOk();

        $this->assertCount(1, Book::all() );
    }
    /**     @test      */
    public function a_title_is_required()
    {
        
        // $this->withoutExceptionHandling();

        $response = $this->post('/books', [
            'title'=>'',
            'author'=> 'Sergej'
        ]);
        // assert that we got a successfull response
        $response->assertSessionHasErrors('title');
        // $this->assertArrayHasKey('title', $response);

    }

    /** @test */
    public function a_author_is_required()
    {
        $response = $this->post('/books', [
            'title'=>'Cool book',
            'author'=> ''
        ]);
        // assert that we got a successfull response
        $response->assertSessionHasErrors('author');
        // $this->assertArrayHasKey('title', $response);

    } 

       /** @test */
       public function a_book_can_be_updated()
       {
        //    $this->withoutExceptionHandling();

           $response = $this->post('/books', [
                'title'=>'Cool book title',
                'author'=> 'Sergej'
            ]);

            $book = Book::first();
           
            $response = $this->patch('/books/' . $book->id , [
                'title'=>'New title',
                'author'=> 'New author'
            ]);

            $this->assertEquals('New title', Book::first()->title );
            $this->assertEquals('New author', Book::first()->author );
   
       } 

}
