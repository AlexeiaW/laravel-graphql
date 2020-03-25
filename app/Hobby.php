<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    /**
     * The users that belong to the hobby.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function user($user)
    {
        return $this->users()->attach($user);
    }
}
