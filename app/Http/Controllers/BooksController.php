<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;

class BooksController extends Controller
{
    //
    public function store()
    {
        $data = $this->validate_request();

        Book::create($data);
    }

    // Route Model Binding (Book)
    public function update(Book $book)
    {
        $data = $this->validate_request();
        
        $book->update($data);
    }
    
    public function validate_request()
    {
        return request()->validate([
            'title' => 'required',
            'author'=> 'required',
        ]);
    }
}
