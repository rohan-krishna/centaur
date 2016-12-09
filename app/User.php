<?php

namespace centaur;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relationships
    // User (1:M) Notebook
    public function notebooks()
    {
        return $this->hasMany(\centaur\Notebook::class);
    }

    public function notes()
    {
        return $this->hasManyThrough(\centaur\Note::class,\centaur\Notebook::class);
    }
}
