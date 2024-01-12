<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','external_id'
    ];

    //attribute
    //scope
    //rel
    public function movies()
    {
        return $this->belongsToMany(Movie::class,'movie_genre');
    }

    //fun

}//end of model

