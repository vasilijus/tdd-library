<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // protects from injections to database 
    protected $guarded = [];

    public function path()
    {
        return '/books/' . $this->id;

        // making a path to the by title would be better this way
        // return '/books/' . $this->id . '-' . Str::slug($this->title);
    }
    
    public function setAuthorIdAttribute($author)
    {
        $this->attributes['author_id'] = (Author::firstOrCreate([
            'name' => $author,
        ]))->id;
    }


}
