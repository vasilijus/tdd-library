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


    /**     @test     */
    public function a_book_can_be_returned()
    {
      
        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();

        $book->checkin($user);
        $this->assertCount(1, Reservation::all() );
        $this->assertEquals( $user->id , Reservation::first()->user_id );
        $this->assertEquals( $book->id , Reservation::first()->book_id );
        $this->assertEquals( now() , Reservation::first()->checked_out_at );

        // temp
        // $book->checkout($user);
        // $this->assertCount(1, Reservation::all() );
        // $this->assertEquals( $user->id , Reservation::first()->user_id );
        // $this->assertEquals( $book->id , Reservation::first()->book_id );
        // $this->assertEquals( now() , Reservation::first()->checked_out_at );

    }

    /**     @test     */
    public function a_user_can_check_out_a_book_twice()
    {
      
        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();
        $book->checkout($user);
        $book->checkin($user);

        $book->checkout($user);
// $res = Reservation::all();
// dd($res);
        // Reservation is 3 , because we create a second time at checkin
        $this->assertCount(3, Reservation::all() );
        $this->assertEquals( $user->id , Reservation::find(3)->user_id );
        $this->assertEquals( $book->id , Reservation::find(3)->book_id );
        $this->assertNull(Reservation::find(3)->checked_in_at);
        $this->assertEquals( now() , Reservation::first()->checked_out_at );

        $book->checkin($user);

        $this->assertCount(4, Reservation::all() );
        $this->assertEquals( $user->id , Reservation::find(3)->user_id );
        $this->assertEquals( $book->id , Reservation::find(3)->book_id );
        $this->assertNull(Reservation::find(4)->checked_in_at);
        $this->assertEquals( now() , Reservation::first()->checked_out_at );

    }

}
