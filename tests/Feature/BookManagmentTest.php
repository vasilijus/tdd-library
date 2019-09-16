<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Book;
use App\Author;

class BookManagmentTest extends TestCase
{
    use RefreshDatabase;

    /**     @test      */
    public function a_book_can_be_added_to_the_library()
    {
        
        // $this->withoutExceptionHandling();

        $response = $this->post('/books', $this->data());
        // assert that we got a successfull response
        // No longer needed to assertOK , cuz we are making a redirect
        // $response->assertOk();

        $book = Book::first();

        $this->assertCount(1, Book::all() );

        $response->assertRedirect('/books/'.$book->id);
    }
    /**     @test      */
    public function a_title_is_required()
    {
        
        // $this->withoutExceptionHandling();

        $response = $this->post('/books', array_merge($this->data(), ['title' => '' ] ) );
        // assert that we got a successfull response
        $response->assertSessionHasErrors('title');
        // $this->assertArrayHasKey('title', $response);

    }

    /** @test */
    public function a_author_is_required()
    {
        $response = $this->post('/books', array_merge($this->data(), ['author_id' => ''] ) );
        // assert that we got a successfull response
        $response->assertSessionHasErrors('author_id');
        // $this->assertArrayHasKey('title', $response);

    } 

    /** @test */
    public function a_book_can_be_updated()
    {
    //    $this->withoutExceptionHandling();

        $response = $this->post('/books', $this->data() );

        $book = Book::first();
        
        $response = $this->patch('/books/' . $book->id , [
            'title'=>'New title',
            'author_id'=> 'New Author'
        ]);

        $this->assertEquals('New title', Book::first()->title );
        $this->assertEquals(2, Book::first()->author_id );

        $response->assertRedirect('/books/'.$book->id);

    } 

    /** @test */
    public function a_book_can_be_deleted()
    {
        // $this->withoutExceptionHandling();

        $response = $this->json('POST','/books', $this->data() );

        $book = Book::first();
        $items[] = $book;
        // dd( count((array)$book)  );
        $this->assertCount(1, $items );
        // $this->assertCount(1, (int)$book );

        // $this->assertCount(1, ['foo'] );
        
        $response = $this->delete('/books/' . $book->id );

        $this->assertCount(0, Book::all() );
        $response->assertRedirect('/books');

    }

       /** @test */
    public function a_new_author_is_automatically_added()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', [
            'title'=>'Cool book title',
            'author_id'=> 'Sergej'
        ]);


        $book = Book::first();
        $author = Author::first();
        // dd($book->author_id);

        $this->assertEquals($author->id , $book->author_id);
        $this->assertCount(1, Author::all() );

    }

    private function data()
    {
        return [
                'title'=>'Cool book titile',
                'author_id'=> 'Sergej'
            ];
        
    }

}
