<?php

namespace centaur;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use centaur\Note;

class Notebook extends Model
{
    //
    
    
    
    //Relationships
    // Notebook (1:M) Notes
    public function notes()
    {
    	return $this->hasMany(Note::class);
    }

    // Query Scopes
    // TimezoneStamp for create_at
    // public function getCreatedAtAttribute($value)
    // {
    //     return Carbon::createFromTimestamp(strtotime($value))
    //         ->timezone('Asia/Kolkata')
    //         ->toDateTimeString()
    //     ;
    // }
}
