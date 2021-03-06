<?php

namespace App\Http\Controllers;
use App\Book;
use Illuminate\Http\Request;

class CheckoutBookController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Book $book)
    {
        // dd(auth()->user());
        $book->checkout(auth()->user() );
    }
}
