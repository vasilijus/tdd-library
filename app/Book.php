<?php
use App\User;
use App\Reservation;
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

    public function checkout($user)
    {
        $this->reservations()->create([
            'user_id' => $user->id,
            'checked_out_at' => now(),
        ]);
    }
    
    public function checkin($user)
    {
        // otherwise , nothing will be found from this->reservations WHERE
        $this->reservations()->create([
            'user_id' => $user->id,
            'checked_out_at' => now(),
        ]);

        $reservation = $this->reservations()->where('user_id' , $user->id)
            ->whereNotNull('checked_out_at')
            ->whereNull('checked_in_at')
            ->first();
            
// dd($reservation);
        
        if( is_null($reservation) ) {
            throw new \Exception();
        }

        $reservation->update([
            'checked_in_at' => now(),
        ]);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }



}
