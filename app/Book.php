<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // protects from injections to database 
    protected $guarded = [];

}
