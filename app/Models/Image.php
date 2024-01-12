<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public $fillable = [
        'image',
        'imageable_id',
        'imageable_type'
    ];

    public function imageable() {
        return $this->morphTo();
    }

    //attr
    protected $appends = [
        'image_path'
    ];
    //attribute
    public function getImagePathAttribute()
    {
        return 'https://image.tmdb.org/t/p/w500'.$this->image;
    }
}
