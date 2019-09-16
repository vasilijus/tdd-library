<?php

namespace App;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    // All Model class with auto incremental id should have
    protected $guarded = [];
    // automatically cast them into carbon instances
    protected $dates = ['dob'];

    public function setDobAttribute($dob)
    {
        // attributes is an actual array !
        $this->attributes['dob'] = Carbon::parse($dob);
    }
    
   
}
