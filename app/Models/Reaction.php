<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    protected $fillable = [
        'word',
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
