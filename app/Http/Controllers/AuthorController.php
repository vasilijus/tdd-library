<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Author;

class AuthorController extends Controller
{
    //
    public function store()
    {
        Author::create( request()->only([
            'name',
            'dob',
        ]));
    }
}
