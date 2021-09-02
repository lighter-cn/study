<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function users () {
        return $this->hasMany(User::class);
    }

    // latest
    public function latestUser () {
        return $this->hasOne(User::class)->latestOfMany();
    }

    // oldest
    public function oldestUser () {
        return $this->hasOne(User::class)->oldestOfMany();
    }

    // oneThrough
    public function userRole () {
        return $this->hasManyThrough(
            Role::class,
            User::class,
            'team_id',
            'id',
            'id',
            'id'
        );
    }
}
