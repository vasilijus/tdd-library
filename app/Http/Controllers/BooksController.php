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

        $book = Book::create($data);

        // get book id
        // redurect ti newly created book
        return redirect( $book->path() );
    }

    // Route Model Binding (Book)
    public function update(Book $book)
    {
        $data = $this->validate_request();
        
        $book->update($data);

        return redirect( $book->path() );
    }
    
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect('/books');
    }

    public function validate_request()
    {
        return request()->validate([
            'title' => 'required',
            'author_id'=> 'required',
        ]);

    }

    
}
