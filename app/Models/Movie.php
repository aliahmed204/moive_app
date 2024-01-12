<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id' ,'title', 'description','poster',
        'banner','release_date', 'vote', 'vote_count','type'
    ];

    protected $casts = [
        'release_date' => 'date',
    ];

    protected $appends = [
      'poster_path','banner_path'
    ];
    //attribute
    public function getPosterPathAttribute()
    {
        return 'https://image.tmdb.org/t/p/w500/'.$this->poster;
    }
    public function getBannerPathAttribute()
    {
        return 'https://image.tmdb.org/t/p/w500/'.$this->banner;
    }
    //scope
    public function scopeWhenGenreId(Builder $builder,$genreId)
    {
       return $builder->when($genreId,function($q) use ($genreId){
           return $q->whereHas('genres' ,function($r) use ($genreId){
             return $r->where('genres.id',$genreId);
           });
        });
    }
    public function scopeWhenActorId(Builder $builder,$actorId)
    {
        return $builder->when($actorId,function($q) use ($actorId){
            return $q->whereHas('actors' ,function($r) use ($actorId){
                return $r->where('actors.id',$actorId);
            });
        });
    }

    public function scopeWhenType(Builder $builder, $type)
    {
        return $builder->when($type, function($q) use ($type){
            $q->where('type',$type);
        });
    }
    //relations
    public function genres()
    {
        return $this->belongsToMany(Genre::class,'movie_genre');
    }
    public function actors()
    {
        return $this->belongsToMany(Actor::class,'movie_actor');
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    //functions

}//end of model
