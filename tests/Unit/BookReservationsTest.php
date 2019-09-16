<?php

namespace Tests\Unit;
use App\Book;
use App\Reservation;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationsTest extends TestCase
{
    use RefreshDatabase;
    /** @test     */
    public function a_book_can_be_checked_out()
    {
        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();

        $book->checkout($user);

        $this->assertCount(1, Reservation::all() );
        $this->assertEquals( $user->id , Reservation::first()->user_id );
        $this->assertEquals( $book->id , Reservation::first()->book_id );
        $this->assertEquals( now() , Reservation::first()->checked_out_at );

    }


    // /**     @test     */
    // public function a_book_can_be_returned()
    // {

    //     $book = factory(Book::class)->create();
    //     $user = factory(User::class)->create();

    //     $book->ckeckin($user);

    //     $this->assertCount(1, Reservation::all() );
    //     $this->assertEquals( $user->id , Reservation::first()->user_id );
    //     $this->assertEquals( $book->id , Reservation::first()->book_id );
    //     $this->assertNull(Reservation::first()->checked_in_at );
    //     $this->assertEquals( now() , Reservation::first()->checked_in_at );

    // }

    // if book is not checked out
}
