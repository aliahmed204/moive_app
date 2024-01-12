<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'e_id', 'name', 'image',
        'gender', 'character',
    ];

    protected $appends = ['image_path'];

    public function scopeWhenGenreId(Builder $builder,$movieId)
    {
        return $builder->when($movieId,function($q) use ($movieId){
            return  $q->whereHas('movies' ,function($r) use ($movieId){
                return  $r->where('movies.id',$movieId);
            });
        });
    }
    public function getImagePathAttribute()
    {
        return 'https://image.tmdb.org/t/p/w500'.$this->image;
    }

    public function movies()
    {
        return $this->belongsToMany(Movie::class,'movie_actor');
    }



}
